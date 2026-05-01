<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Fixture;
use App\Models\FixtureLineup;
use App\Models\Round;
use Illuminate\Database\Seeder;

// Суперлига 2025-26 — Matchweek 8 (8 November 2025)
// Source: futsal_kgz Instagram posts
// Postponed match, no lineup card published
class Matchweek8Season2Seeder extends Seeder
{
    public function run(): void
    {
        $round = Round::firstOrCreate(
            ['stage_id' => 4, 'name' => 'Matchweek 8'],
            ['order' => 8],
        );

        $naryn = 4;
        $vivat = 3;

        // ── Match 1: Нарын 4-2 Виват  (08.11.2025 18:00, ФОК «Газпром», Нарын) ──
        $m1 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $naryn,
            'away_team_id' => $vivat,
            'venue'        => 'ФОК «Газпром», Нарын',
            'scheduled_at' => '2025-11-08 18:00:00',
            'status'       => 'completed',
            'home_score'   => 4,
            'away_score'   => 2,
        ]);

        // Lineup not published — goal scorers + MVP only
        $this->lineup($m1->id, $naryn, [
            [153, true],  // Карыпбеков Бекмат (MVP)
            [111, false], // Абдыбеков Эдил
            [75,  false], // Байгазы уулу Уланбек
        ]);
        $this->lineup($m1->id, $vivat, [
            [50,  false], // Анарбеков Нурадил
            [58,  false], // Кадыров Дильшат
            [68,  false], // Чиркин Кирилл
        ]);

        $this->goal($m1->id, $naryn, 111, 6);  // Абдыбеков
        $this->goal($m1->id, $vivat, 58,  11); // Кадыров
        $this->goal($m1->id, $naryn, 153, 9);  // Карыпбеков
        $this->goal($m1->id, $naryn, 75,  17); // Байгазы уулу
        $this->ownGoal($m1->id, $naryn, 50, 31); // Анарбеков АГ (benefits Нарын)
        $this->goal($m1->id, $vivat, 68,  40); // Чиркин
    }

    private function lineup(int $fixtureId, int $teamId, array $players): void
    {
        foreach ($players as [$playerId, $isMvp]) {
            FixtureLineup::firstOrCreate(
                ['fixture_id' => $fixtureId, 'player_id' => $playerId],
                ['team_id' => $teamId, 'is_mvp' => $isMvp],
            );
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

    private function ownGoal(int $fixtureId, int $teamId, int $playerId, int $minute): void
    {
        Event::create([
            'fixture_id' => $fixtureId,
            'team_id'    => $teamId,
            'player_id'  => $playerId,
            'type'       => 'own_goal',
            'minute'     => $minute,
        ]);
    }
}