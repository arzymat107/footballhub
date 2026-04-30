<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Fixture;
use App\Models\FixtureLineup;
use App\Models\Round;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

// Суперлига 2024-25 — Matchweek 20 (15–16 March 2025)
// Source: futsal_kgz Instagram posts
class Matchweek20Seeder extends Seeder
{
    public function run(): void
    {
        // ── Look up players added in earlier seeders ──────────────────────────────
        $djumashov    = DB::table('players')->where('name', 'Джумашов')->value('id');
        $toktobayev   = DB::table('players')->where('name', 'Токтобаев')->value('id');
        $kalbayev     = DB::table('players')->where('name', 'Калбаев')->value('id');
        $nazaraliev   = DB::table('players')->where('name', 'Назаралиев Урмат')->value('id');
        $sayakbevKant = DB::table('players')->where('name', 'Саякбаев Кыяз')->value('id');

        // ── Round ─────────────────────────────────────────────────────────────────
        $round = Round::firstOrCreate(
            ['stage_id' => 1, 'name' => 'Matchweek 20'],
            ['order' => 20],
        );

        // ── Match 1: Нарын 10-3 Каракол  (15.03.2025 16:00, ФОК "Газпром", Нарын) ──
        // Goals — Нарын: Джумашов(17',32',33'), Сыдыков(23',24',38'),
        //                Карыпбеков(26',31'), Талантбек уулу(39',40')
        //         Каракол: Жумабеков(25'АГ), Токтобаев(32'), Орозбеков(36')
        $m1 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 4,  // Нарын
            'away_team_id' => 5,  // Каракол
            'venue'        => 'ФОК "Газпром", Нарын',
            'scheduled_at' => '2025-03-15 16:00:00',
            'status'       => 'completed',
            'home_score'   => 10,
            'away_score'   => 3,
        ]);

        $this->lineup($m1->id, 4, [[153, true]]); // Карыпбеков Бекмат — MVP

        $this->goal($m1->id, 4, $djumashov,  17); // Джумашов (17')
        $this->goal($m1->id, 4, 88,          23); // Сыдыков (23')
        $this->goal($m1->id, 4, 88,          24); // Сыдыков (24')
        $this->ownGoal($m1->id, 4, 78,       25); // Жумабеков АГ (25') — counted for Каракол
        $this->goal($m1->id, 4, 153,         26); // Карыпбеков (26')
        $this->goal($m1->id, 4, 153,         31); // Карыпбеков (31')
        $this->goal($m1->id, 4, $djumashov,  32); // Джумашов (32')
        $this->goal($m1->id, 5, $toktobayev, 32); // Токтобаев (32')
        $this->goal($m1->id, 4, $djumashov,  33); // Джумашов (33')
        $this->goal($m1->id, 5, 100,         36); // Орозбеков (36')
        $this->goal($m1->id, 4, 88,          38); // Сыдыков (38')
        $this->goal($m1->id, 4, 89,          39); // Талантбек уулу (39')
        $this->goal($m1->id, 4, 89,          40); // Талантбек уулу (40')

        // ── Match 2: Талас 3-4 Топ Тоголок  (15.03.2025 20:00, СК КФБ, Бишкек) ──
        // Goals — Талас: Мыктыбеков(4'), Жакыпов(32'), Саякбаев(32')
        //         Топ Тоголок: Канатбеков(14',20'), Ильясов(15'), Калбаев(34')
        $m2 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 1,  // Талас
            'away_team_id' => 2,  // Топ Тоголок
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2025-03-15 20:00:00',
            'status'       => 'completed',
            'home_score'   => 3,
            'away_score'   => 4,
        ]);

        $this->lineup($m2->id, 1, [
            [6,   false], // Курманбеков Бектур
            [13,  false], // Алымжанов
            [140, false], // Батырбек уулу Улан
            [8,   false], // Болтобаев Темирлан
            [4,   false], // Жакыпов Руслан
            [137, false], // Уланбек уулу Тилек
            [141, false], // Виктор уулу Сабит
            [33,  false], // Кочконов Бекжан
            [12,  false], // Мукушбеков Рамис
            [11,  false], // Мыктыбеков Аскат
            [34,  false], // Орунбеков Камбар
            [143, false], // Сабырбек уулу Майрамбек
            [10,  false], // Сатыбалдиев Айдар
            [281, false], // Саякбаев Кудайберген
        ]);

        $this->lineup($m2->id, 2, [
            [20,        true],  // Куватбек Адил — MVP
            [134,       false], // Азамат уулу Ильгиз
            [18,        false], // Доолотов Эрбол
            [21,        false], // Ильясов Бектур
            [28,        false], // Канатбеков Аймен
            [45,        false], // Султангазиев Илимбек
            [24,        false], // Абдымамытов Адахан
            [37,        false], // Ахметов Арлан
            [25,        false], // Ашуров Сыймык
            [26,        false], // Жаанбаев Актан
            [42,        false], // Рыстаев Калыбек
            [136,       false], // Токтобек уулу Намыс
            [90,        false], // Таштанов Актай
            [$kalbayev, false], // Калбаев
        ]);

        $this->goal($m2->id, 1, 11,        4);  // Мыктыбеков (4')
        $this->goal($m2->id, 2, 28,        14); // Канатбеков (14')
        $this->goal($m2->id, 2, 21,        15); // Ильясов (15')
        $this->goal($m2->id, 2, 28,        20); // Канатбеков (20')
        $this->goal($m2->id, 1, 4,         32); // Жакыпов (32')
        $this->goal($m2->id, 1, 281,       32); // Саякбаев (32')
        $this->goal($m2->id, 2, $kalbayev, 34); // Калбаев (34')

        // ── Match 3: Алай 6-3 Виват  (16.03.2025 19:30, СК КФБ, Бишкек) ──
        // Goals — Алай: Акматов(8'), Алимов(10',11',14'), Исабеков(20'), Турсунов(21')
        //         Виват: Джумабеков(28'), Эсенгелдиев(32',39')
        $m3 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 11, // Алай
            'away_team_id' => 3,  // Виват
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2025-03-16 19:30:00',
            'status'       => 'completed',
            'home_score'   => 6,
            'away_score'   => 3,
        ]);

        $this->lineup($m3->id, 11, [
            [233, false], // Жунушалиев Азирет
            [235, false], // Акматов Калдуубай
            [238, false], // Данияр уулу Абдурахим
            [243, false], // Кубанычов Кайрат
            [247, false], // Турсунов Арстанбек
            [234, false], // Мурзаев Бекболсун
            [236, true],  // Алимов Максат — MVP
            [237, false], // Бабажанов Саид
            [240, false], // Долоткелдиев Азамат
            [245, false], // Сакенов Илимбек
            [241, false], // Исабеков Азамат
            [254, false], // Мамырбаев
        ]);

        $this->lineup($m3->id, 3, [
            [132,         false], // Тургунбеков Адыл
            [50,          false], // Анарбеков Нурадил
            [63,          false], // Маликов Абдурасул
            [$nazaraliev, false], // Назаралиев
            [223,         false], // Эсенгелдиев Асылбек
            [46,          false], // Кыргызов Айбек
            [52,          false], // Вильямов Бахридин
            [54,          false], // Джумабеков Тариэл
            [56,          false], // Зажигаев Данил
            [57,          false], // Искендербеков Талгат
            [59,          false], // Керимбаев Эмирлан
            [61,          false], // Кытайбеков Даниэль
            [69,          false], // Юлдашев Набижан
            [255,         false], // Эрмеков
        ]);

        $this->goal($m3->id, 11, 235, 8);  // Акматов (8')
        $this->goal($m3->id, 11, 236, 10); // Алимов (10')
        $this->goal($m3->id, 11, 236, 11); // Алимов (11')
        $this->goal($m3->id, 11, 236, 14); // Алимов (14')
        $this->goal($m3->id, 11, 241, 20); // Исабеков Азамат (20')
        $this->goal($m3->id, 11, 247, 21); // Турсунов (21')
        $this->goal($m3->id, 3,  54,  28); // Джумабеков (28')
        $this->goal($m3->id, 3,  223, 32); // Эсенгелдиев (32')
        $this->goal($m3->id, 3,  223, 39); // Эсенгелдиев (39')

        // ── Match 4: Кант 2-4 Art Blast Group  (16.03.2025 21:30, СК КФБ, Бишкек) ──
        // Goals — Кант: Исроилов(20'), Салымбеков(39')
        //         ABG: Самат уулу(3',11',22'), Талайбеков(26')
        $m4 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 7,  // Кант
            'away_team_id' => 10, // Art Blast Group
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2025-03-16 21:30:00',
            'status'       => 'completed',
            'home_score'   => 2,
            'away_score'   => 4,
        ]);

        $this->lineup($m4->id, 7, [
            [145,          false], // Пензаев Чынгыз
            [151,          false], // Исроилов Кутбидин
            [152,          false], // Кадырбек уулу Ислам
            [157,          false], // Рахманкулов Азамат
            [162,          false], // Шапданбек уулу Жолдошбек
            [146,          false], // Хамидов Акжол
            [147,          false], // Айдаркул уулу Эрмек
            [154,          false], // Мамытов Эльдияр
            [155,          false], // Мелисбек уулу Азамат
            [$sayakbevKant,false], // Саякбаев Кыяз
            [2,            false], // Салымбеков Нурсултан
        ]);

        $this->lineup($m4->id, 10, [
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

        $this->goal($m4->id, 10, 231, 3);  // Самат уулу (3')
        $this->goal($m4->id, 10, 231, 11); // Самат уулу (11')
        $this->goal($m4->id, 7,  151, 20); // Исроилов (20')
        $this->goal($m4->id, 10, 231, 22); // Самат уулу (22')
        $this->goal($m4->id, 10, 250, 26); // Талайбеков (26')
        $this->goal($m4->id, 7,  2,   39); // Салымбеков (39')
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
