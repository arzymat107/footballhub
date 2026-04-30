<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Fixture;
use App\Models\FixtureLineup;
use App\Models\Round;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

// Суперлига 2024-25 — Matchweek 19 (28 February – 2 March 2025)
// Source: futsal_kgz Instagram posts
class Matchweek19Seeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        // ── New players ───────────────────────────────────────────────────────────
        
        $abdrasulU = DB::table('players')->insertGetId(['name' => 'Абдрасул уулу', 'created_at' => $now, 'updated_at' => $now]);
        DB::table('player_team_seasons')->insert(['player_id' => $abdrasulU, 'team_id' => 8, 'season_id' => 1, 'joined_at' => '2025-03-01', 'created_at' => $now, 'updated_at' => $now]);

        // ОшМУ (team 9)
        $muktaraliU = 199;
        $omursultanov = DB::table('players')->insertGetId(['name' => 'Омурсултанов', 'created_at' => $now, 'updated_at' => $now]);
        DB::table('player_team_seasons')->insert(['player_id' => $omursultanov, 'team_id' => 9, 'season_id' => 1, 'joined_at' => '2025-03-01', 'created_at' => $now, 'updated_at' => $now]);

        // Каракол (team 5)
        $usupovA = 104;
        $toktobayev = DB::table('players')->insertGetId(['name' => 'Токтобаев', 'created_at' => $now, 'updated_at' => $now]);
        DB::table('player_team_seasons')->insert(['player_id' => $toktobayev, 'team_id' => 5, 'season_id' => 1, 'joined_at' => '2025-03-01', 'created_at' => $now, 'updated_at' => $now]);

        // Талас (team 1)
        $dzhumaliev = DB::table('players')->insertGetId(['name' => 'Жумалиев', 'created_at' => $now, 'updated_at' => $now]);
        DB::table('player_team_seasons')->insert(['player_id' => $dzhumaliev, 'team_id' => 1, 'season_id' => 1, 'joined_at' => '2025-03-02', 'created_at' => $now, 'updated_at' => $now]);

        // ── Look up players added in earlier seeders ──────────────────────────────
        $djumashov    = DB::table('players')->where('name', 'Джумашов')->value('id');
        $smanov       = DB::table('players')->where('name', 'Сманов')->value('id');
        $nurdolotov   = DB::table('players')->where('name', 'Нурдолотов')->value('id');
        $sayakbevKant = DB::table('players')->where('name', 'Саякбаев Кыяз')->value('id');

        // ── Round ─────────────────────────────────────────────────────────────────
        $round = Round::firstOrCreate(
            ['stage_id' => 1, 'name' => 'Matchweek 19'],
            ['order' => 19],
        );

        // ── Match 1: Шам 1-4 ОшМУ  (28.02.2025 18:00, ФОК "Газпром", Чолпон-Ата) ──
        // Goals — Шам: Мукаев(33')
        //         ОшМУ: Абдыжалил уулу(23',36',39',40')
        $m1 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 6,  // Шам
            'away_team_id' => 9,  // ОшМУ
            'venue'        => 'ФОК "Газпром", Чолпон-Ата',
            'scheduled_at' => '2025-02-28 18:00:00',
            'status'       => 'completed',
            'home_score'   => 1,
            'away_score'   => 4,
        ]);

        $this->lineup($m1->id, 9, [[191, true]]); // Абдыжалил уулу Айдарбек — MVP

        $this->goal($m1->id, 9, 191, 23); // Абдыжалил уулу (23')
        $this->goal($m1->id, 6, 124, 33); // Мукаев (33')
        $this->goal($m1->id, 9, 191, 36); // Абдыжалил уулу (36')
        $this->goal($m1->id, 9, 191, 39); // Абдыжалил уулу (39')
        $this->goal($m1->id, 9, 191, 40); // Абдыжалил уулу (40')

        // ── Match 2: Нарын 7-3 Виват  (28.02.2025 18:00, ФОК "Газпром", Нарын) ──
        // Goals — Нарын: Талантбек уулу(16'), Байгазы уулу(18',36'),
        //                Карыпбеков(25',33'), Сыдыков(39'), Джумашов(40')
        //         Виват: Кадыров(13',37',39')
        $m2 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 4,  // Нарын
            'away_team_id' => 3,  // Виват
            'venue'        => 'ФОК "Газпром", Нарын',
            'scheduled_at' => '2025-02-28 18:00:00',
            'status'       => 'completed',
            'home_score'   => 7,
            'away_score'   => 3,
        ]);

        $this->lineup($m2->id, 4, [
            [253,        false], // Жылкайдар
            [75,         true],  // Байгазы уулу Уланбек — MVP
            [89,         false], // Талантбек уулу Жыргалбек
            [149,        false], // Аянбаев Адил
            [153,        false], // Карыпбеков Бекмат
            [71,         false], // Айылчиев Алманбет
            [78,         false], // Жумабеков Султан
            [79,         false], // Жыргалбеков Бактияр
            [81,         false], // Ибраев Ислам
            [83,         false], // Кубанычбеков Марат
            [88,         false], // Сыдыков Нурслан
            [91,         false], // Турсунбеков Уран
            [$djumashov, false], // Джумашов
        ]);

        $this->lineup($m2->id, 3, [
            [46,          false], // Кыргызов Айбек
            [50,          false], // Анарбеков Нурадил
            [54,          false], // Джумабеков Тариэл
            [57,          false], // Искендербеков Талгат
            [223,         false], // Эсенгелдиев Асылбек
            [132,         false], // Тургунбеков Адыл
            [52,          false], // Вильямов Бахридин
            [56,          false], // Зажигаев Данил
            [58,          false], // Кадыров Дильшат
            [63,          false], // Маликов Абдурасул
            [64,          false], // Минкеев Ильзат
            [65, false], // Назаралиев
            [66,          false], // Тимченко Артем
            [68,          false], // Чиркин Кирилл
        ]);

        $this->goal($m2->id, 3, 58,         13); // Кадыров (13')
        $this->goal($m2->id, 4, 89,         16); // Талантбек уулу (16')
        $this->goal($m2->id, 4, 75,         18); // Байгазы уулу (18')
        $this->goal($m2->id, 4, 153,        25); // Карыпбеков (25')
        $this->goal($m2->id, 4, 153,        33); // Карыпбеков (33')
        $this->goal($m2->id, 4, 75,         36); // Байгазы уулу (36')
        $this->goal($m2->id, 3, 58,         37); // Кадыров (37')
        $this->goal($m2->id, 3, 58,         39); // Кадыров (39')
        $this->goal($m2->id, 4, 88,         39); // Сыдыков (39')
        $this->goal($m2->id, 4, $djumashov, 40); // Джумашов (40')

        // ── Match 3: Art Blast Group 4-1 Спорткомитет  (01.03.2025 19:00, СК КФБ, Бишкек) ──
        // Goals — ABG: Талайбеков(6',37'), Туратбеков(7'), Муктарбеков(23')
        //         СК: Абышев(25')
        $m3 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 10, // Art Blast Group
            'away_team_id' => 8,  // Спорткомитет
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2025-03-01 19:00:00',
            'status'       => 'completed',
            'home_score'   => 4,
            'away_score'   => 1,
        ]);

        $this->lineup($m3->id, 10, [
            [210, false], // Жусупов Абдуазим
            [213, false], // Абдурашит уулу Арген
            [218, false], // Кенешбеков Жанарбек
            [231, false], // Самат уулу Алмазбек
            [250, true],  // Талайбеков Данияр — MVP
            [212, false], // Насирдинов Султан
            [230, false], // Анарбек уулу Акылбек
            [217, false], // Андабеков Аман
            [227, false], // Мендибаев Нурдин
            [232, false], // Муктарбеков Эльдар
            [221, false], // Туратбеков Ислам
            [225, false], // Сулайманбеков Данияр
            [219, false], // Эралиев Мухаммедмуса
        ]);

        $this->lineup($m3->id, 8, [
            [269, false], // Абдувалиев
            [168,         false], // Алмазбеков Омурбек
            [170,         false], // Жакыпов Даулес
            [172,         false], // Казакбаев Умар
            [184,         false], // Эргашев Диёрбек
            [165,         false], // Эркинбаев Даниел
            [167,         false], // Абышев Элмар
            [175,         false], // Маматкасымов Давранбек
            [180,         false], // Султанали уулу Алымбек
            [183,    false], // Хакимов
            [185,         false], // Эшмамбет уулу Медербек
            [251,  false], // Сыдыков
            [268,     false], // Арапов
            [$abdrasulU,  false], // Абдрасул уулу
        ]);

        $this->goal($m3->id, 10, 250, 6);  // Талайбеков (6')
        $this->goal($m3->id, 10, 221, 7);  // Туратбеков (7')
        $this->goal($m3->id, 10, 232, 23); // Муктарбеков (23')
        $this->goal($m3->id, 8,  167, 25); // Абышев (25')
        $this->goal($m3->id, 10, 250, 37); // Талайбеков (37')

        // ── Match 4: Каракол 2-3 ОшМУ  (01.03.2025 20:00, ФОК "Каракол", Каракол) ──
        // Goals — Каракол: Орозбеков(19'), Культаев(34'АГ)
        //         ОшМУ: Абылдаев(21'), Абдыжалил уулу(36'), Муктарали уулу(38')
        $m4 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 5,  // Каракол
            'away_team_id' => 9,  // ОшМУ
            'venue'        => 'ФОК "Каракол", Каракол',
            'scheduled_at' => '2025-03-01 20:00:00',
            'status'       => 'completed',
            'home_score'   => 2,
            'away_score'   => 3,
        ]);

        $this->lineup($m4->id, 5, [
            [101,         false], // Токтобеков Темирлан
            [97,          false], // Конушбеков Кутман
            [100,         false], // Орозбеков Улукбек
            [$usupovA,    false], // Усупов А
            [$toktobayev, false], // Токтобаев
            [94,          false], // Авазбеков Эрлан
            [103,         false], // Усенбаев Бексултан
            [264,         false], // Кайыпбеков
            [265,         false], // Базаркулов
        ]);

        $this->lineup($m4->id, 9, [
            [186,           false], // Кудайбердиев Сыймыкбек
            [192,           false], // Абылдаев Нурсултан
            [$muktaraliU,   true],  // Муктарали уулу — MVP
            [207,           false], // Эркаев
            [249,           false], // Аскеров Бахтияр
            [188,           false], // Ураимов Урмат
            [191,           false], // Абдыжалил уулу Айдарбек
            [198,           false], // Культаев Адилет
            [201,           false], // Ражапов Сыймык
            [248,           false], // Мурзакулов
            [$omursultanov, false], // Омурсултанов
        ]);

        $this->goal($m4->id, 5, 100,          19); // Орозбеков (19')
        $this->goal($m4->id, 9, 192,          21); // Абылдаев (21')
        $this->ownGoal($m4->id, 9, 198,       34); // Культаев АГ (34') — counted for Каракол
        $this->goal($m4->id, 9, 191,          36); // Абдыжалил уулу (36')
        $this->goal($m4->id, 9, $muktaraliU,  38); // Муктарали уулу (38')

        // ── Match 5: Топ Тоголок 2-2 Спорткомитет  (02.03.2025 19:00, СК КФБ, Бишкек) ──
        // Goals — ТТ: Иманалиев(11'), Канатбеков(36')
        //         СК: Маматкасымов(18',40')
        $m5 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 2,  // Топ Тоголок
            'away_team_id' => 8,  // Спорткомитет
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2025-03-02 19:00:00',
            'status'       => 'completed',
            'home_score'   => 2,
            'away_score'   => 2,
        ]);

        $this->lineup($m5->id, 2, [
            [133,     false], // Мухтар уулу Байэл
            [37,      false], // Ахметов Арлан
            [27,      false], // Иманалиев Элбек
            [42,      false], // Рыстаев Калыбек
            [136,     false], // Токтобек уулу Намыс
            [20,      false], // Куватбек Адил
            [134,     false], // Азамат уулу Ильгиз
            [25,      false], // Ашуров Сыймык
            [26,      false], // Жаанбаев Актан
            [21,      false], // Ильясов Бектур
            [28,      false], // Канатбеков Аймен
            [90,      false], // Таштанов Актай
            [$smanov, false], // Сманов
            [270,     false], // Карыбеков
        ]);

        $this->lineup($m5->id, 8, [
            [269,false], // Абдувалиев
            [168,        false], // Алмазбеков Омурбек
            [170,        false], // Жакыпов Даулес
            [172,        false], // Казакбаев Умар
            [184,        false], // Эргашев Диёрбек
            [165,        false], // Эркинбаев Даниел
            [167,        false], // Абышев Элмар
            [175,        true],  // Маматкасымов Давранбек — MVP
            [180,        false], // Султанали уулу Алымбек
            [183,   false], // Хакимов
            [185,        false], // Эшмамбет уулу Медербек
            [251, false], // Сыдыков
            [268,    false], // Арапов
            [$abdrasulU, false], // Абдрасул уулу
        ]);

        $this->goal($m5->id, 2, 27,  11); // Иманалиев (11')
        $this->goal($m5->id, 8, 175, 18); // Маматкасымов (18')
        $this->goal($m5->id, 2, 28,  36); // Канатбеков (36')
        $this->goal($m5->id, 8, 175, 40); // Маматкасымов (40')

        // ── Match 6: Кант 3-1 Талас  (02.03.2025 21:00, СК КФБ, Бишкек) ──
        // Goals — Кант: Кадырбек уулу(2'), Айдаркул уулу(15'), Салымбеков(37')
        //         Талас: Сабырбек уулу(29')
        $m6 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 7,  // Кант
            'away_team_id' => 1,  // Талас
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2025-03-02 21:00:00',
            'status'       => 'completed',
            'home_score'   => 3,
            'away_score'   => 1,
        ]);

        $this->lineup($m6->id, 7, [
            [145,           true],  // Пензаев Чынгыз — MVP
            [151,           false], // Исроилов Кутбидин
            [152,           false], // Кадырбек уулу Ислам
            [157,           false], // Рахманкулов Азамат
            [162,           false], // Шапданбек уулу Жолдошбек
            [146,           false], // Хамидов Акжол
            [147,           false], // Айдаркул уулу Эрмек
            [154,           false], // Мамытов Эльдияр
            [155,           false], // Мелисбек уулу Азамат
            [$sayakbevKant, false], // Саякбаев Кыяз
            [$nurdolotov,   false], // Нурдолотов
            [3,             false], // Замирбеков Женишбек
            [2,             false], // Салымбеков Нурсултан
        ]);

        $this->lineup($m6->id, 1, [
            [6,           false], // Курманбеков Бектур
            [13,          false], // Алымжанов
            [140,         false], // Батырбек уулу Улан
            [8,           false], // Болтобаев Темирлан
            [4,           false], // Жакыпов Руслан
            [141,         false], // Виктор уулу Сабит
            [33,          false], // Кочконов Бекжан
            [11,          false], // Мыктыбеков Аскат
            [34,          false], // Орунбеков Камбар
            [143,         false], // Сабырбек уулу Майрамбек
            [10,          false], // Сатыбалдиев Айдар
            [281,         false], // Саякбаев Кудайберген
            [5,           false], // Торобеков Бакдоолот
            [$dzhumaliev, false], // Жумалиев
        ]);

        $this->goal($m6->id, 7, 152, 2);  // Кадырбек уулу (2')
        $this->goal($m6->id, 7, 147, 15); // Айдаркул уулу (15')
        $this->goal($m6->id, 1, 143, 29); // Сабырбек уулу (29')
        $this->goal($m6->id, 7, 2,   37); // Салымбеков (37')
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