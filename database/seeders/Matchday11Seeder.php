<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Fixture;
use App\Models\FixtureLineup;
use App\Models\Round;
use Illuminate\Database\Seeder;

// Суперлига 2024-25 — Matchday 11 (27 November 2024)
// Source: futsal_kgz Instagram posts
class Matchday11Seeder extends Seeder
{
    public function run(): void
    {
        $round = Round::firstOrCreate(
            ['stage_id' => 1, 'name' => 'Matchday 11'],
            ['order' => 11],
        );

        // ── Match 1: Талас 4-2 Кант  (27.11.2024 20:00, СК КФБ, Бишкек) ──
        $m1 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 1,  // Талас
            'away_team_id' => 7,  // Кант
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2024-11-27 20:00:00',
            'status'       => 'completed',
            'home_score'   => 4,
            'away_score'   => 2,
        ]);

        // Талас lineup
        $this->lineup($m1->id, 1, [
            [6,   false], // Курманбеков
            [13,  false], // Алымжанов
            [4,   false], // Жакыпов
            [3,   true],  // Замирбеков Жениш — MVP
            [2,   false], // Салымбеков
            [139, false], // Бактыбек уулу
            [140, false], // Батырбек уулу
            [8,   false], // Болтобаев
            [141, false], // Виктор уулу
            [142, false], // Куттубек уулу
            [11,  false], // Мыктыбеков
            [143, false], // Сабырбек уулу
            [10,  false], // Сатыбалдиев
            [36,  false], // Шабданов
        ]);

        // Кант lineup
        $this->lineup($m1->id, 7, [
            [145, false], // Пензаев Чынгыз
            [149, false], // Аянбаев Адил
            [152, false], // Кадырбек уулу Ислам
            [153, false], // Карыпбеков Бекмат
            [155, false], // Мелисбек уулу Азамат
            [146, false], // Хамидов Акжол
            [147, false], // Айдаркул уулу Эрмек
            [148, false], // Аманбеков Мейирхан
            [151, false], // Исроилов Кутбидин
            [157, false], // Рахманкулов Азамат
            [159, false], // Султанбеков Бекзат
            [160, false], // Султанов Эрлан
            [162, false], // Шапданбек уулу Жолдошбек
        ]);

        // Goals — Талас (4): Замирбеков 13',37', Жакыпов 20', Мыктыбеков 26'
        //         Кант (2): Карыпбеков 21', Кадырбек уулу 33'
        $this->goal($m1->id, 1, 3,   13); // Замирбеков (13')
        $this->goal($m1->id, 7, 153, 21); // Карыпбеков (21')
        $this->goal($m1->id, 1, 4,   20); // Жакыпов (20')
        $this->goal($m1->id, 1, 11,  26); // Мыктыбеков (26')
        $this->goal($m1->id, 7, 152, 33); // Кадырбек уулу (33')
        $this->goal($m1->id, 1, 3,   37); // Замирбеков (37')
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