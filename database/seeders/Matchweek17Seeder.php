<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Fixture;
use App\Models\FixtureLineup;
use App\Models\Round;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

// Суперлига 2024-25 — Matchweek 17 (15–16 February 2025)
// Source: futsal_kgz Instagram posts
// Excluded: Шам–Алай, Каракол–Алай
class Matchweek17Seeder extends Seeder
{
    public function run(): void
    {
        $transferDate = '2025-02-15';
        $now = now();

        // ── New players ───────────────────────────────────────────────────────────
        // Джумашов — Нарын (bench, ОшМУ vs Нарын)
        $djumashov = DB::table('players')->insertGetId(['name' => 'Джумашов', 'created_at' => $now, 'updated_at' => $now]);
        DB::table('player_team_seasons')->insert(['player_id' => $djumashov, 'team_id' => 4, 'season_id' => 1, 'joined_at' => $transferDate, 'created_at' => $now, 'updated_at' => $now]);

        // ── Round ─────────────────────────────────────────────────────────────────
        $round = Round::firstOrCreate(
            ['stage_id' => 1, 'name' => 'Matchweek 17'],
            ['order' => 17],
        );

        // ── Match 1: ОшМУ 5-4 Нарын  (15.02.2025 18:00, ФОК "Газпром", Кызыл-Кия) ──
        // Goals — ОшМУ: Насименто(4'), Абдыжалил уулу(23',28'), Барбоса(29'), Култаев(34')
        //         Нарын: Талантбек уулу(6',26'), Мурзакулов(11'АГ), Жылкайдар(38')
        $m1 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 9,  // ОшМУ
            'away_team_id' => 4,  // Нарын
            'venue'        => 'ФОК "Газпром", Кызыл-Кия',
            'scheduled_at' => '2025-02-15 18:00:00',
            'status'       => 'completed',
            'home_score'   => 5,
            'away_score'   => 4,
        ]);

        $this->lineup($m1->id, 9, [
            [186, false], // Кудайбердиев Сыймыкбек
            [191, true],  // Абдыжалил уулу Айдарбек — MVP
            [192, false], // Абдылдаев Нурсултан
            [261, false], // Насименто
            [248, false], // Мурзакулов
            [188, false], // Ураимов Урмат
            [197, false], // Исламов Алымбек
            [198, false], // Култаев Адилет
            [201, false], // Ражапов Сыймык
            [203, false], // Ташбалтаев Абдыкадыр
            [208, false], // Барбоса
            [249, false], // Аскеров Бахтияр
            [262, false], // Антунес
        ]);

        $this->lineup($m1->id, 4, [
            [253,        false], // Жылкайдар
            [75,         false], // Байгазы уулу Уланбек
            [82,         false], // Исаков Данияр
            [149,        false], // Аянбаев Адил
            [153,        false], // Карыпбеков Бекмат
            [71,         false], // Айылчиев Алманбет
            [88,         false], // Сыдыков Нурслан
            [89,         false], // Талантбек уулу Жыргалбек
            [$djumashov, false], // Джумашов
        ]);

        $this->goal($m1->id, 9, 261, 4);       // Насименто (4')
        $this->goal($m1->id, 4, 89,  6);       // Талантбек уулу (6')
        $this->ownGoal($m1->id, 9, 248, 11);   // Мурзакулов АГ (11')
        $this->goal($m1->id, 9, 191, 23);      // Абдыжалил уулу (23')
        $this->goal($m1->id, 4, 89,  26);      // Талантбек уулу (26')
        $this->goal($m1->id, 9, 191, 28);      // Абдыжалил уулу (28')
        $this->goal($m1->id, 9, 208, 29);      // Барбоса (29')
        $this->goal($m1->id, 9, 198, 34);      // Култаев (34')
        $this->goal($m1->id, 4, 253, 38);      // Жылкайдар (38')

        // ── Match 2: Art Blast Group 7-2 Талас  (15.02.2025 19:00, СК КФБ, Бишкек) ──
        // Goals — ABG: Муктарбеков(10',38'), Самат уулу(13'), Торобеков АГ(20'),
        //               Талайбеков(24'), Канетов(26'), Анарбек уулу(39')
        //         Талас: Торобеков(8'), Кочконов(31')
        $m2 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 10, // Art Blast Group
            'away_team_id' => 1,  // Талас
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2025-02-15 19:00:00',
            'status'       => 'completed',
            'home_score'   => 7,
            'away_score'   => 2,
        ]);

        $this->lineup($m2->id, 10, [
            [232, false], // Муктарбеков Эльдар
            [231, false], // Самат уулу Алмазбек
            [250, true],  // Талайбеков Данияр — MVP
            [229, false], // Канетов Эмил
            [230, false], // Анарбек уулу Акылбек
        ]);

        $this->lineup($m2->id, 1, [
            [5,  false], // Торобеков Бакдоолот
            [33, false], // Кочконов Бекжан
        ]);

        $this->goal($m2->id, 1,  5,   8);      // Торобеков (8')
        $this->goal($m2->id, 10, 232, 10);     // Муктарбеков (10')
        $this->goal($m2->id, 10, 231, 13);     // Самат уулу (13')
        $this->ownGoal($m2->id, 1, 5, 20);     // Торобеков АГ (20')
        $this->goal($m2->id, 10, 250, 24);     // Талайбеков (24')
        $this->goal($m2->id, 10, 229, 26);     // Канетов (26')
        $this->goal($m2->id, 1,  33,  31);     // Кочконов (31')
        $this->goal($m2->id, 10, 232, 38);     // Муктарбеков (38')
        $this->goal($m2->id, 10, 230, 39);     // Анарбек уулу (39')

        // ── Match 3: Виват 5-7 Кант  (15.02.2025 21:00, СК КФБ, Бишкек) ────────────
        // Goals — Виват: Вильямов С.(5'), Чиркин(9'), Лиров(30',34'), Кадыров(39')
        //         Кант: Шапданбек уулу(2'), Салымбеков(12'), Кадырбек уулу(16',35'),
        //               Султанбеков(25'), Замирбеков(28'), Айдаркул уулу(31')
        $m3 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 3,  // Виват
            'away_team_id' => 7,  // Кант
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2025-02-15 21:00:00',
            'status'       => 'completed',
            'home_score'   => 5,
            'away_score'   => 7,
        ]);

        $this->lineup($m3->id, 3, [
            [53, false], // Вильямов Сухраб
            [68, false], // Чиркин Кирилл
            [62, false], // Лиров Равил
            [58, false], // Кадыров Дильшат
        ]);

        $this->lineup($m3->id, 7, [
            [162, false], // Шапданбек уулу Жолдошбек
            [2,   false], // Салымбеков Нурсултан
            [152, false], // Кадырбек уулу Ислам
            [159, false], // Султанбеков Бекзат
            [3,   true],  // Замирбеков Женишбек — MVP
            [147, false], // Айдаркул уулу Эрмек
        ]);

        $this->goal($m3->id, 7, 162, 2);  // Шапданбек уулу (2')
        $this->goal($m3->id, 3, 53,  5);  // Вильямов С. (5')
        $this->goal($m3->id, 3, 68,  9);  // Чиркин (9')
        $this->goal($m3->id, 7, 2,   12); // Салымбеков (12')
        $this->goal($m3->id, 7, 152, 16); // Кадырбек уулу (16')
        $this->goal($m3->id, 7, 159, 25); // Султанбеков (25')
        $this->goal($m3->id, 7, 3,   28); // Замирбеков (28')
        $this->goal($m3->id, 3, 62,  30); // Лиров (30')
        $this->goal($m3->id, 7, 147, 31); // Айдаркул уулу (31')
        $this->goal($m3->id, 3, 62,  34); // Лиров (34')
        $this->goal($m3->id, 7, 152, 35); // Кадырбек уулу (35')
        $this->goal($m3->id, 3, 58,  39); // Кадыров (39')

        // ── Match 4: Спорткомитет 4-4 Нарын  (16.02.2025 16:00, СК "Шавкат", Ош) ──
        $m4 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 8,  // Спорткомитет
            'away_team_id' => 4,  // Нарын
            'venue'        => 'СК "Шавкат", Ош',
            'scheduled_at' => '2025-02-16 16:00:00',
            'status'       => 'completed',
            'home_score'   => 4,
            'away_score'   => 4,
        ]);

        $this->lineup($m4->id, 8, [
            [172, true], // Казакбаев Умар — MVP
        ]);
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