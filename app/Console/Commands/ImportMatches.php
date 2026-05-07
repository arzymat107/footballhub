<?php

namespace App\Console\Commands;

use App\Models\Event;
use App\Models\Fixture;
use App\Models\FixtureLineup;
use App\Models\Player;
use App\Models\PlayerTeamSeason;
use App\Models\Round;
use App\Models\Season;
use App\Models\Team;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportMatches extends Command
{
    protected $signature = 'import:matches {file : Path to the match JSON file} {--dry-run : Validate only, do not insert}';
    protected $description = 'Import match fixtures, lineups and events from a JSON file';

    /** @var array<string, int> resolved player name → id cache for this run */
    private array $resolved = [];

    public function handle(): int
    {
        $path = $this->argument('file');
        if (!file_exists($path)) {
            $this->error("File not found: {$path}");
            return self::FAILURE;
        }

        $data = json_decode(file_get_contents($path), true);
        if (!$data) {
            $this->error('Invalid JSON.');
            return self::FAILURE;
        }

        $season = Season::with('teams')->find($data['season_id'] ?? null);
        if (!$season) {
            $this->error("Season #{$data['season_id']} not found.");
            return self::FAILURE;
        }

        $seasonTeamIds = $season->teams->pluck('id')->flip();
        $dry = $this->option('dry-run');

        $this->info("Season: {$season->name} (id={$season->id})");
        $this->info("Round:  {$data['round_name']} (order={$data['round_order']})");
        $this->newLine();

        $errors = false;

        // ── Pre-flight validation ─────────────────────────────────────────────
        foreach ($data['matches'] as $i => $match) {
            $label = "Match " . ($i + 1) . " (team {$match['home_team_id']} vs {$match['away_team_id']})";

            foreach ([$match['home_team_id'], $match['away_team_id']] as $tid) {
                if (!$seasonTeamIds->has($tid)) {
                    $this->error("{$label}: team {$tid} not registered in this season.");
                    $errors = true;
                }
            }

            if (array_key_exists('events', $match) && count($match['events']) > 0) {
                $homeGoals = 0;
                $awayGoals = 0;
                foreach ($match['events'] as $ev) {
                    if (in_array($ev['type'], ['goal', 'own_goal'])) {
                        if ($ev['team_id'] === $match['home_team_id']) $homeGoals++;
                        else $awayGoals++;
                    }
                }
                $scoreMismatch = false;
                if (isset($match['home_score']) && $homeGoals !== $match['home_score']) {
                    $this->warn("{$label}: home_score={$match['home_score']} but counted {$homeGoals} goal events.");
                    $scoreMismatch = true;
                }
                if (isset($match['away_score']) && $awayGoals !== $match['away_score']) {
                    $this->warn("{$label}: away_score={$match['away_score']} but counted {$awayGoals} goal events.");
                    $scoreMismatch = true;
                }
                if ($scoreMismatch && !$this->confirm('Score and events do not match. Continue anyway?')) {
                    $this->error('Import cancelled.');
                    return self::FAILURE;
                }
            }
        }

        if ($errors) {
            $this->error('Validation failed. Fix errors and retry.');
            return self::FAILURE;
        }

        // ── Resolve all player references (IDs + names) ───────────────────────
        foreach ($data['matches'] as $match) {
            foreach (array_merge($match['lineup'] ?? [], $match['events'] ?? []) as $entry) {
                if (!isset($entry['player_name']) && !isset($entry['player_id'])) continue;
                if (isset($entry['player_name'])) {
                    if (!$this->resolvePlayerName($entry['player_name'], $entry['team_id'], $season->id, $dry)) {
                        return self::FAILURE;
                    }
                }
            }
        }

        if ($dry) {
            $this->info('Dry run complete — no data written.');
            return self::SUCCESS;
        }

        // ── Insert ────────────────────────────────────────────────────────────
        DB::transaction(function () use ($data, $season) {
            $round = Round::firstOrCreate(
                ['stage_id' => $data['stage_id'], 'name' => $data['round_name']],
                ['order' => $data['round_order']],
            );

            foreach ($data['matches'] as $match) {
                $fixture = Fixture::create([
                    'season_id'    => $season->id,
                    'stage_id'     => $data['stage_id'],
                    'round_id'     => $round->id,
                    'home_team_id' => $match['home_team_id'],
                    'away_team_id' => $match['away_team_id'],
                    'venue'        => $match['venue'] ?? null,
                    'scheduled_at' => $match['scheduled_at'] ?? null,
                    'status'       => $match['status'] ?? 'completed',
                    'home_score'   => $match['home_score'] ?? null,
                    'away_score'   => $match['away_score'] ?? null,
                ]);

                foreach ($match['lineup'] ?? [] as $entry) {
                    FixtureLineup::firstOrCreate(
                        ['fixture_id' => $fixture->id, 'player_id' => $this->playerId($entry)],
                        ['team_id' => $entry['team_id'], 'is_mvp' => $entry['mvp'] ?? false],
                    );
                }

                foreach ($match['events'] ?? [] as $ev) {
                    Event::create([
                        'fixture_id' => $fixture->id,
                        'team_id'    => $ev['team_id'],
                        'player_id'  => $this->playerId($ev),
                        'type'       => $ev['type'],
                        'minute'     => $ev['minute'] ?? null,
                    ]);
                }

                $home = Team::find($match['home_team_id'])->name;
                $away = Team::find($match['away_team_id'])->name;
                $this->line("  ✓ {$home} {$match['home_score']}–{$match['away_score']} {$away}");
            }
        });

        $this->newLine();
        $this->info('Import complete.');
        return self::SUCCESS;
    }

    private function resolvePlayerName(string $name, int $teamId, int $seasonId, bool $dry): bool
    {
        if (isset($this->resolved[$name])) {
            return true;
        }

        $player = Player::where('name', $name)->first();

        if ($player) {
            // Player exists in DB — just attach to season/team if needed
            $this->line("  Found player '{$name}' (id={$player->id}).");
            if (!$dry) {
                PlayerTeamSeason::firstOrCreate([
                    'player_id' => $player->id,
                    'team_id'   => $teamId,
                    'season_id' => $seasonId,
                ]);
            }
            $this->resolved[$name] = $player->id;
            return true;
        }

        // Player not found — ask for confirmation
        $team = Team::find($teamId);
        $this->warn("Player '{$name}' not found in database.");
        $confirm = $this->confirm("Create '{$name}' and attach to {$team->name} (season {$seasonId})?");

        if (!$confirm) {
            $this->error("Aborted: unresolved player '{$name}'. Fix the JSON and retry.");
            return false;
        }

        if (!$dry) {
            $player = Player::firstOrCreate(['name' => $name]);
            PlayerTeamSeason::firstOrCreate([
                'player_id' => $player->id,
                'team_id'   => $teamId,
                'season_id' => $seasonId,
            ]);
            $this->info("  Created player '{$name}' (id={$player->id}) and attached.");
            $this->resolved[$name] = $player->id;
        }

        return true;
    }

    private function playerId(array $entry): int
    {
        if (isset($entry['player_id'])) {
            return $entry['player_id'];
        }
        return $this->resolved[$entry['player_name']];
    }
}
