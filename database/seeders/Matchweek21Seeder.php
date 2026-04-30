<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Fixture;
use App\Models\FixtureLineup;
use App\Models\Round;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

// Суперлига 2024-25 — Matchweek 21 (22–23 March 2025)
// Source: futsal_kgz Instagram posts
// Excluded: Шам–Алай (no result data available)
class Matchweek21Seeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        // ── New players ───────────────────────────────────────────────────────────
        // Каракол (team 5)
        $nurbekov = 98;
        // Виват (team 3)
        $koshonov = 60;
        // ── Look up players added in earlier seeders ──────────────────────────────
        $ashymaliev   = DB::table('players')->where('name', 'Ашымалиев')->value('id');
        $sultanaliev  = DB::table('players')->where('name', 'Султаналиев')->value('id');
        $toktobayev   = DB::table('players')->where('name', 'Токтобаев')->value('id');
        $dzhumaliev   = DB::table('players')->where('name', 'Жумалиев')->value('id');
        $omursultanov = DB::table('players')->where('name', 'Омурсултанов')->value('id');
        $djumashov    = DB::table('players')->where('name', 'Джумашов')->value('id');
        $kalbayev     = DB::table('players')->where('name', 'Калбаев')->value('id');
        $sayakbevKant = DB::table('players')->where('name', 'Саякбаев Кыяз')->value('id');

        // ── Round ─────────────────────────────────────────────────────────────────
        $round = Round::firstOrCreate(
            ['stage_id' => 1, 'name' => 'Matchweek 21'],
            ['order' => 21],
        );

        // ── Match 1: Шам 2-2 Спорткомитет  (22.03.2025 16:00, ФОК "Газпром", Чолпон-Ата) ──
        $m1 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 6,  // Шам
            'away_team_id' => 8,  // Спорткомитет
            'venue'        => 'ФОК "Газпром", Чолпон-Ата',
            'scheduled_at' => '2025-03-22 16:00:00',
            'status'       => 'completed',
            'home_score'   => 2,
            'away_score'   => 2,
        ]);

        $this->lineup($m1->id, 6, [[124, true]]); // Мукаев Келдибек — MVP

        // ── Match 2: Каракол 0-13 Алай  (22.03.2025 20:00, ФОК "Каракол", Каракол) ──
        // Goals — Алай: Исабеков Азат(7'), Алимов(12',13',16',23',31',40',40'),
        //                Бабажанов(23',30'), Сакенов(24'), Мурзаев(34'), Кубанычов(35')
        $m2 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 5,  // Каракол
            'away_team_id' => 11, // Алай
            'venue'        => 'ФОК "Каракол", Каракол',
            'scheduled_at' => '2025-03-22 20:00:00',
            'status'       => 'completed',
            'home_score'   => 0,
            'away_score'   => 13,
        ]);

        $this->lineup($m2->id, 5, [
            [101,         false], // Токтобеков Темирлан
            [97,          false], // Конушбеков Кутман
            [99,          false], // Орозакун уулу Султан
            [103,         false], // Усенбаев Бексултан
            [104,         false], // Усупов А
            [94,          false], // Авазбеков Эрлан
            [$nurbekov,   false], // Нурбеков
            [$toktobayev, false], // Токтобаев
            [264,         false], // Кайыпбеков
            [265,         false], // Базаркулов
        ]);

        $this->lineup($m2->id, 11, [
            [233, false], // Джунушалиев Азирет
            [235, false], // Акматов Калдуубай
            [240, false], // Долоткелдиев Азамат
            [243, false], // Кубанычов Кайрат
            [247, false], // Турсунов Арстанбек
            [234, false], // Мурзаев Бекболсун
            [236, false], // Алимов Максат
            [237, false], // Бабажанов Саид
            [242, true],  // Исабеков Азат — MVP
            [241, false], // Исабеков Азамат
            [245, false], // Сакенов Илимбек
            [246, false], // Салимбаев Юлдашбай
        ]);

        $this->goal($m2->id, 11, 242, 7);  // Исабеков Азат (7')
        $this->goal($m2->id, 11, 236, 12); // Алимов (12')
        $this->goal($m2->id, 11, 236, 13); // Алимов (13')
        $this->goal($m2->id, 11, 236, 16); // Алимов (16')
        $this->goal($m2->id, 11, 237, 23); // Бабажанов (23')
        $this->goal($m2->id, 11, 236, 23); // Алимов (23')
        $this->goal($m2->id, 11, 245, 24); // Сакенов (24')
        $this->goal($m2->id, 11, 237, 30); // Бабажанов (30')
        $this->goal($m2->id, 11, 236, 31); // Алимов (31')
        $this->goal($m2->id, 11, 234, 34); // Мурзаев (34')
        $this->goal($m2->id, 11, 243, 35); // Кубанычов (35')
        $this->goal($m2->id, 11, 236, 40); // Алимов (40')
        $this->goal($m2->id, 11, 236, 40); // Алимов (40')

        // ── Match 3: Топ Тоголок 4-3 ОшМУ  (22.03.2025 19:30, СК КФБ, Бишкек) ──
        // Goals — ТТ: Ильясов(23'), Таштанов(24'), Канатбеков(34'), Азат уулу(35')
        //         ОшМУ: Абылдаев(4'), Абдыжалил уулу(15'), Культаев(18')
        $m3 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 2,  // Топ Тоголок
            'away_team_id' => 9,  // ОшМУ
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2025-03-22 19:30:00',
            'status'       => 'completed',
            'home_score'   => 4,
            'away_score'   => 3,
        ]);

        $this->lineup($m3->id, 2, [
            [20,        false], // Куватбек Адил
            [134,       false], // Азамат уулу Ильгиз
            [18,        false], // Доолотов Эрбол
            [21,        false], // Ильясов Бектур
            [28,        false], // Канатбеков Аймен
            [15,        true],  // Азатов Амир — MVP
            [24,        false], // Абдымамытов Адахан
            [37,        false], // Ахметов Арлан
            [25,        false], // Ашуров Сыймык
            [26,        false], // Жаанбаев Актан
            [42,        false], // Рыстаев Калыбек
            [90,        false], // Таштанов Актай
            [$kalbayev, false], // Калбаев
            [270,       false], // Карыбеков
        ]);

        $this->lineup($m3->id, 9, [
            [186, false], // Кудайбердиев Сыймыкбек
            [198, false], // Культаев Адилет
            [199, false], // Муктарали уулу
            [201, false], // Ражапов Сыймык
            [207, false], // Эркаев
            [188, false], // Ураимов Урмат
            [191, false], // Абдыжалил уулу Айдарбек
            [192, false], // Абылдаев Нурсултан
            [197, false], // Исламов Алымбек
            [249, false], // Аскеров Бахтияр
            [248, false], // Мурзакулов
        ]);

        $this->goal($m3->id, 9, 192, 4);  // Абылдаев (4')
        $this->goal($m3->id, 9, 191, 15); // Абдыжалил уулу (15')
        $this->goal($m3->id, 9, 198, 18); // Культаев (18')
        $this->goal($m3->id, 2, 21,  23); // Ильясов (23')
        $this->goal($m3->id, 2, 90,  24); // Таштанов (24')
        $this->goal($m3->id, 2, 28,  34); // Канатбеков (34')
        $this->goal($m3->id, 2, 15,  35); // Азат уулу (35')

        // ── Match 4: Кант 5-1 Нарын  (22.03.2025 21:30, СК КФБ, Бишкек) ──
        // Goals — Кант: Замирбеков(10'), Салымбеков(28',37'), Шапданбек уулу(36'), Кадырбек уулу(40')
        //         Нарын: Ашымалиев(15')
        $m4 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 7,  // Кант
            'away_team_id' => 4,  // Нарын
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2025-03-22 21:30:00',
            'status'       => 'completed',
            'home_score'   => 5,
            'away_score'   => 1,
        ]);

        $this->lineup($m4->id, 7, [
            [145,          true],  // Пензаев Чынгыз — MVP
            [151,          false], // Исроилов Кутбидин
            [152,          false], // Кадырбек уулу Ислам
            [157,          false], // Рахманкулов Азамат
            [162,          false], // Шапданбек уулу Жолдошбек
            [146,          false], // Хамидов Акжол
            [147,          false], // Айдаркул уулу Эрмек
            [154,          false], // Мамытов Эльдияр
            [155,          false], // Мелисбек уулу Азамат
            [159,          false], // Султанбеков Бекзат
            [$sayakbevKant,false], // Саякбаев Кыяз
            [3,            false], // Замирбеков Женишбек
            [2,            false], // Салымбеков Нурсултан
        ]);

        $this->lineup($m4->id, 4, [
            [253,         false], // Жылкайдар
            [75,          false], // Байгазы уулу Уланбек
            [149,         false], // Аянбаев Адил
            [$ashymaliev, false], // Ашымалиев
            [153,         false], // Карыпбеков Бекмат
            [71,          false], // Айылчиев Алманбет
            [73,          false], // Айтокторов Нурберген
            [83,          false], // Кубанычбеков Марат
            [88,          false], // Сыдыков Нурслан
            [89,          false], // Талантбек уулу Жыргалбек
            [$djumashov,  false], // Джумашов
            [$sultanaliev,false], // Султаналиев
        ]);

        $this->goal($m4->id, 7, 3,           10); // Замирбеков (10')
        $this->goal($m4->id, 4, $ashymaliev, 15); // Ашымалиев (15')
        $this->goal($m4->id, 7, 2,           28); // Салымбеков (28')
        $this->goal($m4->id, 7, 162,         36); // Шапданбек уулу (36')
        $this->goal($m4->id, 7, 2,           37); // Салымбеков (37')
        $this->goal($m4->id, 7, 152,         40); // Кадырбек уулу (40')

        // ── Match 5: Каракол 1-4 Спорткомитет  (23.03.2025 20:00, ФОК "Каракол", Каракол) ──
        $m5 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 5,  // Каракол
            'away_team_id' => 8,  // Спорткомитет
            'venue'        => 'ФОК "Каракол", Каракол',
            'scheduled_at' => '2025-03-23 20:00:00',
            'status'       => 'completed',
            'home_score'   => 1,
            'away_score'   => 4,
        ]);

        $this->lineup($m5->id, 8, [[251, true]]); // Сыдыков Нурмухамед — MVP

        // ── Match 6: Виват 3-7 Талас  (23.03.2025 19:30, СК КФБ, Бишкек) ──
        // Goals — Виват: Анарбеков(12'), Кадыров(23'), Эсенгелдиев(35')
        //         Талас: Мыктыбеков(9'), Батырбек уулу(12',36'), Болтобаев(25'),
        //                Саякбаев(32'), Жакыпов(37'), Сабырбек уулу(38')
        $m6 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 3,  // Виват
            'away_team_id' => 1,  // Талас
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2025-03-23 19:30:00',
            'status'       => 'completed',
            'home_score'   => 3,
            'away_score'   => 7,
        ]);

        $this->lineup($m6->id, 3, [
            [46,        false], // Кыргызов Айбек
            [50,        false], // Анарбеков Нурадил
            [54,        false], // Джумабеков Тариэл
            [63,        false], // Маликов Абдурасул
            [223,       false], // Эсенгелдиев Асылбек
            [132,       false], // Тургунбеков Адыл
            [53,        false], // Вильямов Сухраб
            [58,        false], // Кадыров Дильшат
            [62,        false], // Лиров Равил
            [$koshonov, false], // Кошонов
            [64,        false], // Минкеев Ильзат
            [68,        false], // Чиркин Кирилл
            [69,        false], // Юлдашев Набижан
            [255,       false], // Эрмеков
        ]);

        $this->lineup($m6->id, 1, [
            [6,           false], // Курманбеков Бектур
            [13,          false], // Алымжанов
            [139,         false], // Бактыбек уулу Талас
            [140,         true],  // Батырбек уулу Улан — MVP
            [281,         false], // Саякбаев Кудайберген
            [8,           false], // Болтобаев Темирлан
            [141,         false], // Виктор уулу Сабит
            [4,           false], // Жакыпов Руслан
            [33,          false], // Кочконов Бекжан
            [11,          false], // Мыктыбеков Аскат
            [34,          false], // Орунбеков Камбар
            [143,         false], // Сабырбек уулу Майрамбек
            [10,          false], // Сатыбалдиев Айдар
            [$dzhumaliev, false], // Жумалиев
        ]);

        $this->goal($m6->id, 1, 11,  9);  // Мыктыбеков (9')
        $this->goal($m6->id, 3, 50,  12); // Анарбеков (12')
        $this->goal($m6->id, 1, 140, 12); // Батырбек уулу (12')
        $this->goal($m6->id, 3, 58,  23); // Кадыров (23')
        $this->goal($m6->id, 1, 8,   25); // Болтобаев (25')
        $this->goal($m6->id, 1, 281, 32); // Саякбаев (32')
        $this->goal($m6->id, 3, 223, 35); // Эсенгелдиев (35')
        $this->goal($m6->id, 1, 140, 36); // Батырбек уулу (36')
        $this->goal($m6->id, 1, 4,   37); // Жакыпов (37')
        $this->goal($m6->id, 1, 143, 38); // Сабырбек уулу (38')

        // ── Match 7: Art Blast Group 8-5 ОшМУ  (23.03.2025 21:30, СК КФБ, Бишкек) ──
        // Goals — ABG: Самат уулу(6',14',18'), Кенешбеков(18'), Эралиев Муса(20',25'),
        //               Абдурашит уулу(26'), Андабеков(28')
        //         ОшМУ: Культаев(2'), Мурзакулов(7'), Абдыжалил уулу(28',36'), Омурсултанов(35')
        $m7 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 10, // Art Blast Group
            'away_team_id' => 9,  // ОшМУ
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2025-03-23 21:30:00',
            'status'       => 'completed',
            'home_score'   => 8,
            'away_score'   => 5,
        ]);

        $this->lineup($m7->id, 10, [
            [210, false], // Жусупов Абдуазим
            [213, false], // Абдурашит уулу Арген
            [218, false], // Кенешбеков Жанарбек
            [231, true],  // Самат уулу Алмазбек — MVP
            [250, false], // Талайбеков Данияр
            [212, false], // Насирдинов Султан
            [230, false], // Анарбек уулу Акылбек
            [217, false], // Андабеков Аман
            [222, false], // Бейшеналиев Урмат
            [216, false], // Мелисов Нурсултан
            [227, false], // Мендибаев Нурдин
            [232, false], // Муктарбеков Эльдар
            [225, false], // Сулайманбеков Данияр
            [219, false], // Эралиев Мухаммедмуса
        ]);

        $this->lineup($m7->id, 9, [
            [186,           false], // Кудайбердиев Сыймыкбек
            [191,           false], // Абдыжалил уулу Айдарбек
            [192,           false], // Абылдаев Нурсултан
            [198,           false], // Культаев Адилет
            [248,           false], // Мурзакулов
            [188,           false], // Ураимов Урмат
            [197,           false], // Исламов Алымбек
            [199,           false], // Муктарали уулу
            [201,           false], // Ражапов Сыймык
            [207,           false], // Эркаев
            [249,           false], // Аскеров Бахтияр
            [$omursultanov, false], // Омурсултанов
        ]);

        $this->goal($m7->id, 9,  198,           2);  // Культаев (2')
        $this->goal($m7->id, 10, 231,           6);  // Самат уулу (6')
        $this->goal($m7->id, 9,  248,           7);  // Мурзакулов (7')
        $this->goal($m7->id, 10, 231,           14); // Самат уулу (14')
        $this->goal($m7->id, 10, 231,           18); // Самат уулу (18')
        $this->goal($m7->id, 10, 218,           18); // Кенешбеков (18')
        $this->goal($m7->id, 10, 219,           20); // Эралиев Муса (20')
        $this->goal($m7->id, 10, 219,           25); // Эралиев Муса (25')
        $this->goal($m7->id, 10, 213,           26); // Абдурашит уулу (26')
        $this->goal($m7->id, 10, 217,           28); // Андабеков (28')
        $this->goal($m7->id, 9,  191,           28); // Абдыжалил уулу (28')
        $this->goal($m7->id, 9,  $omursultanov, 35); // Омурсултанов (35')
        $this->goal($m7->id, 9,  191,           36); // Абдыжалил уулу (36')
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