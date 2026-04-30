<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Fixture;
use App\Models\FixtureLineup;
use App\Models\Round;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

// Суперлига 2024-25 — Matchweek 22 (29 March 2025)
// Source: futsal_kgz Instagram posts
class Matchweek22Seeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        // ── New players ───────────────────────────────────────────────────────────
        // Шам (team 6)
        $akylbekU = 113;
        $murzakarimU = 257;
        // ── Round ─────────────────────────────────────────────────────────────────
        $round = Round::firstOrCreate(
            ['stage_id' => 1, 'name' => 'Matchweek 22'],
            ['order' => 22],
        );

        // ── Match 1: Нарын 4-4 Шам  (29.03.2025 18:00, ФОК "Газпром", Нарын) ──
        // Goals — Нарын: Айтокторов(23',38'), Жыргалбеков(28'), Турсунбеков(36')
        //         Шам: Оморов(12'), Кубатбеков(18'), Акылбек уулу(19'), Мурзакарим уулу(30')
        $m1 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 4,  // Нарын
            'away_team_id' => 6,  // Шам
            'venue'        => 'ФОК "Газпром", Нарын',
            'scheduled_at' => '2025-03-29 18:00:00',
            'status'       => 'completed',
            'home_score'   => 4,
            'away_score'   => 4,
        ]);

        $this->lineup($m1->id, 6, [[110, true]]); // Абакиров Акжолтой — MVP

        $this->goal($m1->id, 6, 125,         12); // Оморов (12')
        $this->goal($m1->id, 6, 122,         18); // Кубатбеков (18')
        $this->goal($m1->id, 6, $akylbekU,   19); // Акылбек уулу (19')
        $this->goal($m1->id, 4, 73,          23); // Айтокторов (23')
        $this->goal($m1->id, 6, $murzakarimU,30); // Мурзакарим уулу (30')
        $this->goal($m1->id, 4, 79,          28); // Жыргалбеков (28')
        $this->goal($m1->id, 4, 91,          36); // Турсунбеков (36')
        $this->goal($m1->id, 4, 73,          38); // Айтокторов (38')

        // ── Match 2: Каракол 3-3 Топ Тоголок  (29.03.2025 20:00, ФОК "Каракол", Каракол) ──
        $m2 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 5,  // Каракол
            'away_team_id' => 2,  // Топ Тоголок
            'venue'        => 'ФОК "Каракол", Каракол',
            'scheduled_at' => '2025-03-29 20:00:00',
            'status'       => 'completed',
            'home_score'   => 3,
            'away_score'   => 3,
        ]);

        $this->lineup($m2->id, 2, [[90, true]]); // Таштанов Актай — MVP
    }

    private function lineup(int $fixtureId, int $teamId, array $players): void
    {
        foreach ($players as [$playerId, $isMvp]) {
            FixtureLineup::create([
                'fixture_id' => $fixtureId,
                'team_id'    => $teamId,
                'player_id'  => $playerId,
                'is_mvp'     => $isMvp,
            ]);
        }
    }

    private function goal(int $fixtureId, int $teamId, int $playerId, int $minute): void
    {
        Event::create([
            'fixture_id' => $fixtureId,
            'team_id'    => $teamId,
            'player_id'  => $playerId,
            'type'       => 'goal',
            'minute'     => $minute,
        ]);
    }
}