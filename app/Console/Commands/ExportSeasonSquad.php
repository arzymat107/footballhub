<?php

namespace App\Console\Commands;

use App\Models\PlayerTeamSeason;
use App\Models\Season;
use Illuminate\Console\Command;

class ExportSeasonSquad extends Command
{
    protected $signature = 'export:season-squad {season_id : The ID of the season to export}';
    protected $description = 'Export season squad (players per team) to a JSON file for seeder assistance';

    public function handle(): int
    {
        $seasonId = (int) $this->argument('season_id');

        $season = Season::with('division.league', 'teams')->find($seasonId);

        if (!$season) {
            $this->error("Season #{$seasonId} not found.");
            return self::FAILURE;
        }

        $records = PlayerTeamSeason::with('player', 'team')
            ->where('season_id', $seasonId)
            ->get();

        $teams = [];
        foreach ($season->teams as $team) {
            $players = $records
                ->where('team_id', $team->id)
                ->map(fn ($r) => ['id' => $r->player->id, 'name' => $r->player->name])
                ->sortBy('name')
                ->values()
                ->toArray();

            $teams[(string) $team->id] = [
                'name'    => $team->name,
                'players' => $players,
            ];
        }

        $output = [
            'season_id'   => $seasonId,
            'season_name' => $season->name,
            'league'      => $season->division->league->name,
            'division'    => $season->division->name,
            'teams'       => $teams,
        ];

        $dir = database_path('seeders/data');
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $path = "{$dir}/season_{$seasonId}_squad.json";
        file_put_contents($path, json_encode($output, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        $teamCount   = count($teams);
        $playerCount = $records->count();
        $this->info("Exported {$playerCount} player registrations across {$teamCount} teams.");
        $this->line("File: {$path}");

        return self::SUCCESS;
    }
}