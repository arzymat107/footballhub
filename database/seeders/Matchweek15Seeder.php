<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Fixture;
use App\Models\FixtureLineup;
use App\Models\Round;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

// Суперлига 2024-25 — Matchweek 15 (25–26 January 2025)
// Source: futsal_kgz Instagram posts
class Matchweek15Seeder extends Seeder
{
    public function run(): void
    {
        // ── New players ──────────────────────────────────────────────────────────
        $joinedAt = '2025-01-25 00:00:00';

        // ОшМУ new players
        $nasimento = DB::table('players')->insertGetId(['name' => 'Насименто', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('player_team_seasons')->insert(['player_id' => $nasimento, 'team_id' => 9, 'season_id' => 1, 'joined_at' => $joinedAt, 'created_at' => now(), 'updated_at' => now()]);

        $antunes = DB::table('players')->insertGetId(['name' => 'Антунес', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('player_team_seasons')->insert(['player_id' => $antunes, 'team_id' => 9, 'season_id' => 1, 'joined_at' => $joinedAt, 'created_at' => now(), 'updated_at' => now()]);

        // Каракол new players
        $melisovKar = DB::table('players')->insertGetId(['name' => 'Мелисов', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('player_team_seasons')->insert(['player_id' => $melisovKar, 'team_id' => 5, 'season_id' => 1, 'joined_at' => $joinedAt, 'created_at' => now(), 'updated_at' => now()]);

        $kayypbekov = DB::table('players')->insertGetId(['name' => 'Кайыпбеков', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('player_team_seasons')->insert(['player_id' => $kayypbekov, 'team_id' => 5, 'season_id' => 1, 'joined_at' => $joinedAt, 'created_at' => now(), 'updated_at' => now()]);

        $bazarkulov = DB::table('players')->insertGetId(['name' => 'Базаркулов', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('player_team_seasons')->insert(['player_id' => $bazarkulov, 'team_id' => 5, 'season_id' => 1, 'joined_at' => $joinedAt, 'created_at' => now(), 'updated_at' => now()]);

        // Кант new players
        $sayakbevKant = DB::table('players')->insertGetId(['name' => 'Саякбаев', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('player_team_seasons')->insert(['player_id' => $sayakbevKant, 'team_id' => 7, 'season_id' => 1, 'joined_at' => $joinedAt, 'created_at' => now(), 'updated_at' => now()]);

        $nurdolotov = DB::table('players')->insertGetId(['name' => 'Нурдолотов', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('player_team_seasons')->insert(['player_id' => $nurdolotov, 'team_id' => 7, 'season_id' => 1, 'joined_at' => $joinedAt, 'created_at' => now(), 'updated_at' => now()]);

        // Спорткомитет new players
        $arapov = DB::table('players')->insertGetId(['name' => 'Арапов', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('player_team_seasons')->insert(['player_id' => $arapov, 'team_id' => 8, 'season_id' => 1, 'joined_at' => $joinedAt, 'created_at' => now(), 'updated_at' => now()]);

        $abduvali = DB::table('players')->insertGetId(['name' => 'Абдувалиев', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('player_team_seasons')->insert(['player_id' => $abduvali, 'team_id' => 8, 'season_id' => 1, 'joined_at' => $joinedAt, 'created_at' => now(), 'updated_at' => now()]);

        // ── Matchweek 15 fixtures ─────────────────────────────────────────────────
        $round = Round::firstOrCreate(
            ['stage_id' => 1, 'name' => 'Matchweek 15'],
            ['order' => 15],
        );

        // ── Match 1: ОшМУ 6-5 Виват  (25.01.2025 18:00, ФОК "Газпром", Кызыл-Кия) ──
        $m1 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 9,  // ОшМУ
            'away_team_id' => 3,  // Виват
            'venue'        => 'ФОК "Газпром", Кызыл-Кия',
            'scheduled_at' => '2025-01-25 18:00:00',
            'status'       => 'completed',
            'home_score'   => 6,
            'away_score'   => 5,
        ]);

        // ОшМУ lineup
        $this->lineup($m1->id, 9, [
            [186,       false], // Кудайбердиев Сыймыкбек
            [191,       false], // Абдыжалил уулу Айдарбек
            [192,       true],  // Абдылдаев Нурсултан — MVP
            [208,       false], // Дос Сантос Барбоса Жерлан
            [$nasimento,false], // Насименто
            [188,       false], // Ураимов Урмат
            [197,       false], // Исламов Алымбек
            [198,       false], // Култаев Адилет
            [199,       false], // Муктарали уулу Уланбек
            [201,       false], // Ражапов Сыймык
            [207,       false], // Эркаев Акылбек
            [249,       false], // Аскеров Бахтияр
            [248,       false], // Мурзакулов
            [$antunes,  false], // Антунес
        ]);

        // Виват lineup
        $this->lineup($m1->id, 3, [
            [46,  false], // Кыргызов Айбек
            [50,  false], // Анарбеков Нурадил
            [68,  false], // Чиркин Кирилл
            [223, false], // Эсенгелдиев Асылбек
            [255, false], // Эрмеков
            [132, false], // Тургунбеков Адыл
            [53,  false], // Вильямов Сухраб
            [57,  false], // Искендербеков Талгат
            [58,  false], // Кадыров Дильшат
            [62,  false], // Лиров Равил
            [64,  false], // Минкеев Ильзат
        ]);

        // Goals — ОшМУ (6): Абдылдаев 2',40'; Насименто 3',36'; Мурзакулов 23'; Барбоса 27'
        //         Виват (5): Эсенгелдиев 8'; Кадыров 8',15',40'; Искендербеков 24'
        $this->goal($m1->id, 9, 192,        2);  // Абдылдаев (2')
        $this->goal($m1->id, 9, $nasimento, 3);  // Насименто (3')
        $this->goal($m1->id, 3, 223,        8);  // Эсенгелдиев (8')
        $this->goal($m1->id, 3, 58,         8);  // Кадыров (8')
        $this->goal($m1->id, 3, 58,         15); // Кадыров (15')
        $this->goal($m1->id, 3, 57,         24); // Искендербеков (24')
        $this->goal($m1->id, 9, 248,        23); // Мурзакулов (23')
        $this->goal($m1->id, 9, 208,        27); // Барбоса (27')
        $this->goal($m1->id, 9, $nasimento, 36); // Насименто (36')
        $this->goal($m1->id, 9, 192,        40); // Абдылдаев (40')
        $this->goal($m1->id, 3, 58,         40); // Кадыров (40')

        // ── Match 2: Спорткомитет 4-5 Талас  (25.01.2025 18:00, СК "Шавкат", Ош) ──
        $m2 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 8,  // Спорткомитет
            'away_team_id' => 1,  // Талас
            'venue'        => 'СК "Шавкат", Ош',
            'scheduled_at' => '2025-01-25 18:00:00',
            'status'       => 'completed',
            'home_score'   => 4,
            'away_score'   => 5,
        ]);

        // Спорткомитет lineup
        $this->lineup($m2->id, 8, [
            [165,       false], // Эркинбаев Даниел
            [167,       false], // Абышев Элмар
            [168,       false], // Алмазбеков Омурбек
            [173,       false], // Максатбеков Айдар
            [175,       false], // Маматкасымов Давранбек
            [170,       false], // Жакыпов Даулес
            [172,       false], // Казакбаев Умар
            [178,       false], // Сайдалиев Дамирбек
            [180,       false], // Султанали уулу Алымбек
            [185,       false], // Эшмамбет уулу Медербек
            [251,       false], // Сыдыков Алтынбек
            [$arapov,   false], // Арапов
            [$abduvali, false], // Абдувалиев
            [252,       false], // Абдурасул уулу
        ]);

        // Талас lineup
        $this->lineup($m2->id, 1, [
            [137, false], // Уланбек уулу Тилек
            [139, false], // Бактыбек уулу Талас
            [140, true],  // Батырбек уулу Улан — MVP
            [4,   false], // Жакыпов Руслан
            [12,  false], // Мукушбеков Рамис
            [143, false], // Сабырбек уулу Майрамбек
            [6,   false], // Курманбеков Бектур
            [141, false], // Виктор уулу Сабит
            [11,  false], // Мыктыбеков Аскат
            [34,  false], // Орунбеков Камбар
            [35,  false], // Саякбаев Кыяз
            [5,   false], // Торобеков Бакдоолот
        ]);

        // Goals — Спорткомитет (4): Султанали у 13'; Максатбеков 23'; Алмазбеков 25'; Маматкасымов 36'
        //         Талас (5): Жакыпов 8',34'; Торобеков 18',27'; Мыктыбеков 28'
        $this->goal($m2->id, 1, 4,   8);  // Жакыпов (8')
        $this->goal($m2->id, 8, 180, 13); // Султанали уулу (13')
        $this->goal($m2->id, 1, 5,   18); // Торобеков (18')
        $this->goal($m2->id, 8, 173, 23); // Максатбеков (23')
        $this->goal($m2->id, 8, 168, 25); // Алмазбеков (25')
        $this->goal($m2->id, 1, 5,   27); // Торобеков (27')
        $this->goal($m2->id, 1, 11,  28); // Мыктыбеков (28')
        $this->goal($m2->id, 1, 4,   34); // Жакыпов (34')
        $this->goal($m2->id, 8, 175, 36); // Маматкасымов (36')

        // ── Match 3: Каракол 6-3 Шам  (25.01.2025 20:00, ФОК "Каракол", Каракол) ──
        $m3 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 5,  // Каракол
            'away_team_id' => 6,  // Шам
            'venue'        => 'ФОК "Каракол", Каракол',
            'scheduled_at' => '2025-01-25 20:00:00',
            'status'       => 'completed',
            'home_score'   => 6,
            'away_score'   => 3,
        ]);

        // Каракол lineup
        $this->lineup($m3->id, 5, [
            [93,          false], // Дюшебаев Ислам
            [97,          false], // Конушбеков Кутман
            [100,         true],  // Орозбеков Улукбек — MVP
            [106,         false], // Шаршенбиев Ринат
            [$melisovKar, false], // Мелисов
            [94,          false], // Авазбеков Эрлан
            [103,         false], // Усенбаев Бексултан
            [104,         false], // Усупов Адилет
            [$kayypbekov, false], // Кайыпбеков
            [$bazarkulov, false], // Базаркулов
        ]);

        // Шам lineup — IDs from MW14 seeder
        $shamSharshenbaev = DB::table('players')->where('name', 'Шаршенбаев')->value('id');
        $shamSapar        = DB::table('players')->where('name', 'Сапарбеков')->value('id');
        $shamDurus        = DB::table('players')->where('name', 'Дурусбеков')->value('id');

        $this->lineup($m3->id, 6, [
            [107,              false], // Азамат уулу Айдар
            [125,              false], // Оморов Бексултан
            [120,              false], // Джумабек уулу Эрнст
            [110,              false], // Абакиров Акжолтой
            [122,              false], // Кубатбеков Белек
            [111,              false], // Абдыбеков Эдил
            [115,              false], // Асанбеков Азирет
            [$shamSharshenbaev,false], // Шаршенбаев
            [$shamSapar,       false], // Сапарбеков
            [$shamDurus,       false], // Дурусбеков
        ]);

        // Goals — Каракол (6): Шаршенбиев 2',20'; Кайыпбеков 15'; Мелисов 18'; Орозбеков 26'; Авазбеков 36'
        //         Шам (3): Шаршенбаев 18'; Оморов 31'; Усупов А (39'ОГ)
        $this->goal($m3->id, 5, 106,          2);  // Шаршенбиев (2')
        $this->goal($m3->id, 5, $kayypbekov,  15); // Кайыпбеков (15')
        $this->goal($m3->id, 5, $melisovKar,  18); // Мелисов (18')
        $this->goal($m3->id, 6, $shamSharshenbaev, 18); // Шаршенбаев (18')
        $this->goal($m3->id, 5, 106,          20); // Шаршенбиев (20')
        $this->goal($m3->id, 5, 100,          26); // Орозбеков (26')
        $this->goal($m3->id, 6, 125,          31); // Оморов (31')
        $this->goal($m3->id, 5, 94,           36); // Авазбеков (36')
        Event::create(['fixture_id' => $m3->id, 'team_id' => 5, 'player_id' => 104, 'type' => 'own_goal', 'minute' => 39]); // Усупов А OG (39')

        // ── Match 4: Спорткомитет 3-6 Виват  (26.01.2025 16:00, СК "Шавкат", Ош) ──
        $m4 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 8,  // Спорткомитет
            'away_team_id' => 3,  // Виват
            'venue'        => 'СК "Шавкат", Ош',
            'scheduled_at' => '2025-01-26 16:00:00',
            'status'       => 'completed',
            'home_score'   => 3,
            'away_score'   => 6,
        ]);

        // Спорткомитет lineup
        $this->lineup($m4->id, 8, [
            [165,       false], // Эркинбаев Даниел
            [168,       false], // Алмазбеков Омурбек
            [170,       false], // Жакыпов Даулес
            [172,       false], // Казакбаев Умар
            [175,       false], // Маматкасымов Давранбек
            [167,       false], // Абышев Элмар
            [173,       false], // Максатбеков Айдар
            [178,       false], // Сайдалиев Дамирбек
            [180,       false], // Султанали уулу Алымбек
            [185,       false], // Эшмамбет уулу Медербек
            [251,       false], // Сыдыков Алтынбек
            [$arapov,   false], // Арапов
            [$abduvali, false], // Абдувалиев
            [252,       false], // Абдурасул уулу
        ]);

        // Виват lineup
        $this->lineup($m4->id, 3, [
            [132, false], // Тургунбеков Адыл
            [50,  false], // Анарбеков Нурадил
            [62,  false], // Лиров Равил
            [68,  false], // Чиркин Кирилл
            [255, false], // Эрмеков
            [46,  false], // Кыргызов Айбек
            [53,  false], // Вильямов Сухраб
            [57,  true],  // Искендербеков Талгат — MVP
            [58,  false], // Кадыров Дильшат
            [63,  false], // Маликов Абдурасул
            [64,  false], // Минкеев Ильзат
            [223, false], // Эсенгелдиев Асылбек
        ]);

        // Goals not available from photos

        // ── Match 5: Алай 5-2 Кант  (26.01.2025 19:00, СК КФБ, Бишкек) ──
        $m5 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 11, // Алай
            'away_team_id' => 7,  // Кант
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2025-01-26 19:00:00',
            'status'       => 'completed',
            'home_score'   => 5,
            'away_score'   => 2,
        ]);

        // Алай lineup
        $this->lineup($m5->id, 11, [
            [234, false], // Мурзаев Бекболсун
            [236, false], // Алимов Максат
            [240, false], // Долоткелдиев Азамат
            [246, false], // Салимбаев Юлдашбай
            [247, false], // Турсунов Арстанбек
            [233, false], // Джунушалиев Азирет
            [235, false], // Акматов Калдуубай
            [237, false], // Бабажанов Саид
            [241, false], // Исабеков Азамат
            [242, false], // Исабеков Азат
            [243, false], // Кубанычов Кайрат
            [244, true],  // Мамбеталиев Саламат — MVP
            [245, false], // Сакенов Илимбек
            [254, false], // Мамырбаев
        ]);

        // Кант lineup
        $this->lineup($m5->id, 7, [
            [145,          false], // Пензаев Чынгыз
            [157,          false], // Рахманкулов Азамат
            [162,          false], // Шапданбек уулу Жолдошбек
            [3,            false], // Замирбеков Женишбек
            [2,            false], // Салымбеков Нурсултан
            [146,          false], // Хамидов Акжол
            [147,          false], // Айдаркул уулу Эрмек
            [151,          false], // Исроилов Кутбидин
            [154,          false], // Мамытов Эльдияр
            [155,          false], // Мелисбек уулу Азамат
            [159,          false], // Султанбеков Бекзат
            [161,          false], // Туткучев Кайрат
            [$sayakbevKant,false], // Саякбаев (Кант)
            [$nurdolotov,  false], // Нурдолотов
        ]);

        // Goals — Алай (5): Мамбеталиев 6',18',38'; Салимбаев 8'; Алимов 18'
        //         Кант (2): Рахманкулов 14'; Шапданбек уулу 40'
        $this->goal($m5->id, 11, 244, 6);  // Мамбеталиев (6')
        $this->goal($m5->id, 7,  157, 14); // Рахманкулов (14')
        $this->goal($m5->id, 11, 246, 8);  // Салимбаев (8')
        $this->goal($m5->id, 11, 236, 18); // Алимов (18')
        $this->goal($m5->id, 11, 244, 18); // Мамбеталиев (18')
        $this->goal($m5->id, 11, 244, 38); // Мамбеталиев (38')
        $this->goal($m5->id, 7,  162, 40); // Шапданбек уулу (40')

        // ── Match 6: ОшМУ 5-3 Талас  (26.01.2025 21:30, ФОК "Газпром", Жалал-Абад) ──
        $m6 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 9,  // ОшМУ
            'away_team_id' => 1,  // Талас
            'venue'        => 'ФОК "Газпром", Жалал-Абад',
            'scheduled_at' => '2025-01-26 21:30:00',
            'status'       => 'completed',
            'home_score'   => 5,
            'away_score'   => 3,
        ]);

        // ОшМУ lineup
        $this->lineup($m6->id, 9, [
            [188,       false], // Ураимов Урмат
            [197,       false], // Исламов Алымбек
            [199,       false], // Муктарали уулу Уланбек
            [207,       false], // Эркаев Акылбек
            [249,       false], // Аскеров Бахтияр
            [186,       false], // Кудайбердиев Сыймыкбек
            [191,       false], // Абдыжалил уулу Айдарбек
            [192,       false], // Абдылдаев Нурсултан
            [198,       false], // Култаев Адилет
            [208,       true],  // Дос Сантос Барбоса Жерлан — MVP
            [$nasimento,false], // Насименто
            [248,       false], // Мурзакулов
            [$antunes,  false], // Антунес
        ]);

        // Талас lineup
        $this->lineup($m6->id, 1, [
            [137, false], // Уланбек уулу Тилек
            [140, false], // Батырбек уулу Улан
            [4,   false], // Жакыпов Руслан
            [11,  false], // Мыктыбеков Аскат
            [143, false], // Сабырбек уулу Майрамбек
            [6,   false], // Курманбеков Бектур
            [139, false], // Бактыбек уулу Талас
            [141, false], // Виктор уулу Сабит
            [12,  false], // Мукушбеков Рамис
            [34,  false], // Орунбеков Камбар
            [35,  false], // Саякбаев Кыяз
            [5,   false], // Торобеков Бакдоолот
        ]);

        // Goals not available from photos
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