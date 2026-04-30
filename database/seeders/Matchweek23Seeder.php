<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Fixture;
use App\Models\FixtureLineup;
use App\Models\Round;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

// Суперлига 2024-25 — Matchweek 23 (2–6 April 2025)
// Source: futsal_kgz Instagram posts
class Matchweek23Seeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        // ── New players ───────────────────────────────────────────────────────────

        // ОшМУ (team 9)
        $tashiev      = 187;
        $tashbaltaev  = 203;
        // Спорткомитет (team 8)
        $abdullaev    = 166;
        $saidaliev    = 178;
        // Шам (team 6)
        $ayipov       = 112;
        // Art Blast Group (team 10)
        $sulaymanbekovA = 214;
        $sydykbekov   = 211;
        // Топ Тоголок (team 2)
        $kasmаkunov   = 19;
        // ── Look up players added in earlier seeders ──────────────────────────────
        $toktobayev   = DB::table('players')->where('name', 'Токтобаев')->value('id');
        $sayakbevKant = DB::table('players')->where('name', 'Саякбаев Кыяз')->value('id');
        $dzhumaliev   = DB::table('players')->where('name', 'Жумалиев')->value('id');
        $smanov       = DB::table('players')->where('name', 'Сманов')->value('id');

        // ── Round ─────────────────────────────────────────────────────────────────
        $round = Round::firstOrCreate(
            ['stage_id' => 1, 'name' => 'Matchweek 23'],
            ['order' => 23],
        );

        // ── Match 1: ОшМУ 4-5 Спорткомитет  (02.04.2025 16:00, СК "Шавкат", Ош) ──
        // Goals — ОшМУ: Абдыжалил уулу(12',39'), Мурзакулов(19'), Алмазбеков(35'АГ)
        //         СК: Хакимов(5'), Сыдыков(7'), Султанали уулу(27'), Маматкасымов(29',39')
        $m1 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 9,  // ОшМУ
            'away_team_id' => 8,  // Спорткомитет
            'venue'        => 'СК "Шавкат", Ош',
            'scheduled_at' => '2025-04-02 16:00:00',
            'status'       => 'completed',
            'home_score'   => 4,
            'away_score'   => 5,
        ]);

        $this->lineup($m1->id, 9, [
            [188,          false], // Ураимов Урмат
            [191,          false], // Абдыжалил уулу Айдарбек
            [192,          false], // Абылдаев Нурсултан
            [249,          false], // Аскеров Бахтияр
            [248,          false], // Мурзакулов
            [$tashiev,     false], // Ташиев
            [197,          false], // Исламов Алымбек
            [198,          false], // Культаев Адилет
            [199,          false], // Муктарали уулу
            [201,          false], // Ражапов Сыймык
            [$tashbaltaev, false], // Ташбалтаев
            [207,          false], // Эркаев
        ]);

        $this->lineup($m1->id, 8, [
            [269,         false], // Абдувалиев
            [170,         false], // Жакыпов Даулес
            [172,         false], // Казакбаев Умар
            [175,         true],  // Маматкасымов Давранбек — MVP
            [251,         false], // Сыдыков Нурмухамед
            [$abdullaev,  false], // Абдуллаев
            [167,         false], // Абышев Элмар
            [168,         false], // Алмазбеков Омурбек
            [$saidaliev,  false], // Сайдалиев
            [180,         false], // Султанали уулу Алымбек
            [183,         false], // Хакимов
            [184,         false], // Эргашев Диёрбек
            [185,         false], // Эшмамбет уулу Медербек
        ]);

        $this->goal($m1->id, 8, 183, 5);  // Хакимов (5')
        $this->goal($m1->id, 8, 251, 7);  // Сыдыков (7')
        $this->goal($m1->id, 9, 191, 12); // Абдыжалил уулу (12')
        $this->goal($m1->id, 9, 248, 19); // Мурзакулов (19')
        $this->goal($m1->id, 8, 180, 27); // Султанали уулу (27')
        $this->goal($m1->id, 8, 175, 29); // Маматкасымов (29')
        $this->ownGoal($m1->id, 8, 168, 35); // Алмазбеков АГ (35') — counted for ОшМУ
        $this->goal($m1->id, 9, 191, 39); // Абдыжалил уулу (39')
        $this->goal($m1->id, 8, 175, 39); // Маматкасымов (39')

        // ── Match 2: Каракол 2-5 Кант  (05.04.2025 18:00, ФОК "Каракол", Каракол) ──
        // Goals — Каракол: Токтобаев(9'), Орозбеков(15')
        //         Кант: Саякбаев(11'), Рахманкулов(15'), Замирбеков(18',37'), Султанбеков(27')
        $m2 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 5,  // Каракол
            'away_team_id' => 7,  // Кант
            'venue'        => 'ФОК "Каракол", Каракол',
            'scheduled_at' => '2025-04-05 18:00:00',
            'status'       => 'completed',
            'home_score'   => 2,
            'away_score'   => 5,
        ]);

        $this->lineup($m2->id, 7, [[3, true]]); // Замирбеков Женишбек — MVP

        $this->goal($m2->id, 5, $toktobayev,   9);  // Токтобаев (9')
        $this->goal($m2->id, 7, $sayakbevKant, 11); // Саякбаев (11')
        $this->goal($m2->id, 5, 100,           15); // Орозбеков (15')
        $this->goal($m2->id, 7, 157,           15); // Рахманкулов (15')
        $this->goal($m2->id, 7, 3,             18); // Замирбеков (18')
        $this->goal($m2->id, 7, 159,           27); // Султанбеков (27')
        $this->goal($m2->id, 7, 3,             37); // Замирбеков (37')

        // ── Match 3: Талас 2-1 Шам  (05.04.2025 20:00, СК КФБ, Бишкек) ──
        // Goals — Шам: Айыпов(19')
        //         Талас: Мыктыбеков(20'), Жакыпов(21')
        $m3 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 1,  // Талас
            'away_team_id' => 6,  // Шам
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2025-04-05 20:00:00',
            'status'       => 'completed',
            'home_score'   => 2,
            'away_score'   => 1,
        ]);

        $this->lineup($m3->id, 1, [[$dzhumaliev, true]]); // Жумалиев Нурсултан — MVP

        $this->goal($m3->id, 6, $ayipov, 19); // Айыпов (19')
        $this->goal($m3->id, 1, 11,      20); // Мыктыбеков (20')
        $this->goal($m3->id, 1, 4,       21); // Жакыпов (21')

        // ── Match 4: Виват 2-6 Art Blast Group  (06.04.2025 19:00, СК КФБ, Бишкек) ──
        // Goals — Виват: Кадыров(7') [+1 unrecorded]
        //         ABG: Талайбеков(12',19'), Сулайманбеков А(14'), Бейшеналиев(21'),
        //              Сулайманбеков Д(23'), Эралиев Муса(28')
        $m4 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 3,  // Виват
            'away_team_id' => 10, // Art Blast Group
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2025-04-06 19:00:00',
            'status'       => 'completed',
            'home_score'   => 2,
            'away_score'   => 6,
        ]);

        $this->lineup($m4->id, 3, [
            [46,  false], // Кыргызов Айбек
            [50,  false], // Анарбеков Нурадил
            [58,  false], // Кадыров Дильшат
            [68,  false], // Чиркин Кирилл
            [223, false], // Эсенгелдиев Асылбек
            [132, false], // Тургунбеков Адыл
            [52,  false], // Вильямов Бахридин
            [56,  false], // Зажигаев Данил
            [57,  false], // Искендербеков Талгат
            [59,  false], // Керимбаев Эмирлан
            [60,  false], // Кошонов
            [64,  false], // Минкеев Ильзат
            [66,  false], // Тимченко Артем
            [255, false], // Эрмеков
        ]);

        $this->lineup($m4->id, 10, [
            [212,             false], // Насирдинов Султан
            [218,             false], // Кенешбеков Жанарбек
            [213,             false], // Абдурашит уулу Арген
            [221,             false], // Туратбеков Ислам
            [250,             true],  // Талайбеков Данияр — MVP
            [$sydykbekov,     false], // Сыдыкбеков
            [217,             false], // Андабеков Аман
            [230,             false], // Анарбек уулу Акылбек
            [222,             false], // Бейшеналиев Урмат
            [216,             false], // Мелисов Нурсултан
            [232,             false], // Муктарбеков Эльдар
            [$sulaymanbekovA, false], // Сулайманбеков А
            [225,             false], // Сулайманбеков Данияр
            [219,             false], // Эралиев Мухаммедмуса
        ]);

        $this->goal($m4->id, 3,  58,              7);  // Кадыров (7')
        $this->goal($m4->id, 10, 250,             12); // Талайбеков (12')
        $this->goal($m4->id, 10, 250,             19); // Талайбеков (19')
        $this->goal($m4->id, 10, $sulaymanbekovA, 14); // Сулайманбеков А (14')
        $this->goal($m4->id, 10, 222,             21); // Бейшеналиев (21')
        $this->goal($m4->id, 10, 225,             23); // Сулайманбеков Д (23')
        $this->goal($m4->id, 10, 219,             28); // Эралиев Муса (28')

        // ── Match 5: Топ Тоголок 9-7 Алай  (06.04.2025 21:00, СК КФБ, Бишкек) ──
        // Goals — ТТ: Токтобек уулу(4'), Ильясов(11',13',17',21'), Таштанов(18',39'),
        //             Карыбеков(29'), Сманов(32')
        //         Алай: Алимов(8',15',16',20',40'), Турсунов(12'), Исабеков Азамат(37')
        $m5 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 2,  // Топ Тоголок
            'away_team_id' => 11, // Алай
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2025-04-06 21:00:00',
            'status'       => 'completed',
            'home_score'   => 9,
            'away_score'   => 7,
        ]);

        $this->lineup($m5->id, 2, [
            [45,           false], // Султангазиев Илимбек
            [18,           false], // Доолотов Эрбол
            [26,           false], // Жаанбаев Актан
            [$kasmаkunov,  false], // Касмакунов
            [90,           false], // Таштанов Актай
            [133,          false], // Мухтар уулу Байэл
            [24,           false], // Абдымамытов Адахан
            [25,           false], // Ашуров Сыймык
            [21,           true],  // Ильясов Бектур — MVP
            [27,           false], // Иманалиев Элбек
            [42,           false], // Рыстаев Калыбек
            [136,          false], // Токтобек уулу Намыс
            [$smanov,      false], // Сманов
            [270,          false], // Карыбеков
        ]);

        $this->lineup($m5->id, 11, [
            [234, false], // Мурзаев Бекболсун
            [236, false], // Алимов Максат
            [237, false], // Бабажанов Саид
            [241, false], // Исабеков Азамат
            [246, false], // Салимбаев Юлдашбай
            [233, false], // Жунушалиев Азирет
            [240, false], // Долоткелдиев Азамат
            [243, false], // Кубанычов Кайрат
            [245, false], // Сакенов Илимбек
            [247, false], // Турсунов Арстанбек
            [254, false], // Мамырбаев
        ]);

        $this->goal($m5->id, 11, 236, 8);  // Алимов (8')
        $this->goal($m5->id, 2,  136, 4);  // Токтобек уулу (4')
        $this->goal($m5->id, 2,  21,  11); // Ильясов (11')
        $this->goal($m5->id, 11, 247, 12); // Турсунов (12')
        $this->goal($m5->id, 2,  21,  13); // Ильясов (13')
        $this->goal($m5->id, 11, 236, 15); // Алимов (15')
        $this->goal($m5->id, 11, 236, 16); // Алимов (16')
        $this->goal($m5->id, 2,  90,  18); // Таштанов (18')
        $this->goal($m5->id, 2,  21,  17); // Ильясов (17')
        $this->goal($m5->id, 11, 236, 20); // Алимов (20')
        $this->goal($m5->id, 2,  21,  21); // Ильясов (21')
        $this->goal($m5->id, 2,  270, 29); // Карыбеков (29')
        $this->goal($m5->id, 2,  $smanov, 32); // Сманов (32')
        $this->goal($m5->id, 11, 241, 37); // Исабеков Азамат (37')
        $this->goal($m5->id, 2,  90,  39); // Таштанов (39')
        $this->goal($m5->id, 11, 236, 40); // Алимов (40')
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