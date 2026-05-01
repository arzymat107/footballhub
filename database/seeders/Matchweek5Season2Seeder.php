<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Fixture;
use App\Models\FixtureLineup;
use App\Models\Round;
use Illuminate\Database\Seeder;

// Суперлига 2025-26 — Matchweek 5 (11 October 2025)
// Source: futsal_kgz Instagram posts
// Full Starting V lineup published
class Matchweek5Season2Seeder extends Seeder
{
    public function run(): void
    {
        $round = Round::firstOrCreate(
            ['stage_id' => 4, 'name' => 'Matchweek 5'],
            ['order' => 5],
        );

        $artBlast = 10;
        $kant     = 7;

        // ── Match 1: Art Blast Group 3-3 Кант  (11.10.2025 19:00, СК КФС, Бишкек) ──
        $m1 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $artBlast,
            'away_team_id' => $kant,
            'venue'        => 'СК КФС, Бишкек',
            'scheduled_at' => '2025-10-11 19:00:00',
            'status'       => 'completed',
            'home_score'   => 3,
            'away_score'   => 3,
        ]);

        $this->lineup($m1->id, $artBlast, [
            [210, false], // Жусупов Абдуазим
            [213, false], // Абдурашит уулу Арген
            [218, false], // Кенешбеков Жанарбек
            [250, false], // Талайбеков Данияр
            [150, false], // Джанат уулу Самат
            [212, false], // Насирдинов Султан
            [231, false], // Самат уулу Алмазбек
            [219, false], // Эралиев Мухаммедмуса
            [226, false], // Жумадилов Баатырхан
            [227, false], // Мендибаев Нурдин
            [229, false], // Канетов Эмил
            [230, false], // Анарбек уулу Акылбек
            [216, false], // Мелисов Нурсултан
            [355, false], // Эгенбергенов Нурдоолот
        ]);
        $this->lineup($m1->id, $kant, [
            [145, false], // Пензаев Чынгыз
            [147, false], // Айдаркул уулу Эрмек
            [157, false], // Рахманкулов Азамат
            [162, false], // Шапданбек уулу Жолдошбек
            [155, false], // Мелисбек уулу Азамат
            [152, false], // Кадырбек уулу Ислам
            [151, false], // Исроилов Кутбидин
            [222, false], // Бейшеналиев Урмат
            [35,  false], // Саякбаев Кыяз
            [315, false], // Эсенгелдиев Калысбек
            [3,   true],  // Замирбеков Женишбек (MVP)
            [2,   false], // Салымбеков Нурсултан
            [232, false], // Муктарбеков Эльдар
            [217, false], // Андабеков Аман
        ]);

        $this->goal($m1->id, $kant,     217, 5);   // Андабеков
        $this->goal($m1->id, $artBlast, 231, 10);  // Самат уулу
        $this->goal($m1->id, $artBlast, 226, 20);  // Жумадилов
        $this->goal($m1->id, $kant,     3,   22);  // Замирбеков
        $this->goal($m1->id, $kant,     232, 34);  // Муктарбеков
        $this->goal($m1->id, $artBlast, 250, 40);  // Талайбеков
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
}