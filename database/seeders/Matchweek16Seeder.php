<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Fixture;
use App\Models\FixtureLineup;
use App\Models\Round;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

// Суперлига 2024-25 — Matchweek 16 (8–9 February 2025)
// Source: futsal_kgz Instagram posts
// Venue: СК КФБ, Бишкек
class Matchweek16Seeder extends Seeder
{
    public function run(): void
    {
        $transferDate = '2025-02-08';
        $now = now();

        // ── New player registrations / transfers ─────────────────────────────────
        // Карыбеков — Топ Тоголок (debut this matchweek)
        $karybekov = DB::table('players')->insertGetId(['name' => 'Карыбеков', 'created_at' => $now, 'updated_at' => $now]);
        DB::table('player_team_seasons')->insert(['player_id' => $karybekov, 'team_id' => 2, 'season_id' => 1, 'joined_at' => $transferDate, 'created_at' => $now, 'updated_at' => $now]);

        // Исаков Данияр — Нарын (debut this matchweek)
        $isakDan = DB::table('players')->insertGetId(['name' => 'Исаков Данияр', 'created_at' => $now, 'updated_at' => $now]);
        DB::table('player_team_seasons')->insert(['player_id' => $isakDan, 'team_id' => 4, 'season_id' => 1, 'joined_at' => $transferDate, 'created_at' => $now, 'updated_at' => $now]);

        // ── Look up late-added players by name ───────────────────────────────────
        $melisovKar   = DB::table('players')->where('name', 'Мелисов')->value('id');
        $kayypbekov   = DB::table('players')->where('name', 'Кайыпбеков')->value('id');
        $bazarkulov   = DB::table('players')->where('name', 'Базаркулов')->value('id');
        $sayakbevKant = DB::table('players')->where('name', 'Саякбаев Кыяз')->value('id'); // Кант (≠ player 35 «Саякбаев Кыяз» of Талас)
        $nurdolotov   = DB::table('players')->where('name', 'Нурдолотов')->value('id');
        $ermekov      = DB::table('players')->where('name', 'Эрмеков')->value('id');
        $shamSharsh   = DB::table('players')->where('name', 'Шаршенбаев')->value('id');
        $shamSapar    = DB::table('players')->where('name', 'Сапарбеков')->value('id');
        $shamDurus    = DB::table('players')->where('name', 'Дурусбеков')->value('id');
        $mamyrbayev   = DB::table('players')->where('name', 'Мамырбаев')->value('id');

        // ── Round ────────────────────────────────────────────────────────────────
        $round = Round::firstOrCreate(
            ['stage_id' => 1, 'name' => 'Matchweek 16'],
            ['order' => 16],
        );

        // ── Match 1: Талас 7-2 Каракол  (08.02.2025 19:00, СК КФБ, Бишкек) ──────
        $m1 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 1,  // Талас
            'away_team_id' => 5,  // Каракол
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2025-02-08 19:00:00',
            'status'       => 'completed',
            'home_score'   => 7,
            'away_score'   => 2,
        ]);

        $this->lineup($m1->id, 1, [
            [137, false], // Уланбек уулу Тилек
            [139, false], // Бактыбек уулу Талас
            [140, true],  // Батырбек уулу Улан — MVP
            [4,   false], // Жакыпов Руслан
            [5,   false], // Торобеков Бакдоолот
            [6,   false], // Курманбеков Бектур
            [11,  false], // Мыктыбеков Аскат
            [12,  false], // Мукушбеков Рамис
            [34,  false], // Орунбеков Камбар
            [281,  false], // Саякбаев Кудайберген
            [141, false], // Виктор уулу Сабит
            [143, false], // Сабырбек уулу Майрамбек
        ]);

        $this->lineup($m1->id, 5, [
            [93,          false], // Дюшебаев Ислам
            [94,          false], // Авазбеков Эрлан
            [97,          false], // Конушбеков Кутман
            [100,         false], // Орозбеков Улукбек
            [103,         false], // Усенбаев Бексултан
            [104,         false], // Усупов Адилет
            [106,         false], // Шаршенбиев Ринат
            [$melisovKar, false], // Мелисов
            [$kayypbekov, false], // Кайыпбеков
            [$bazarkulov, false], // Базаркулов
        ]);

        // ── Match 2: Кант 9-4 Шам  (08.02.2025 21:00, СК КФБ, Бишкек) ──────────
        $m2 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 7,  // Кант
            'away_team_id' => 6,  // Шам
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2025-02-08 21:00:00',
            'status'       => 'completed',
            'home_score'   => 9,
            'away_score'   => 4,
        ]);

        $this->lineup($m2->id, 7, [
            [145,          false], // Пензаев Чынгыз
            [146,          false], // Хамидов Акжол
            [147,          false], // Айдаркул уулу Эрмек
            [151,          false], // Исроилов Кутбидин
            [152,          true],  // Кадырбек уулу Ислам — MVP
            [154,          false], // Мамытов Эльдияр
            [155,          false], // Мелисбек уулу Азамат
            [157,          false], // Рахманкулов Азамат
            [159,          false], // Султанбеков Бекзат
            [161,          false], // Туткучев Кайрат
            [162,          false], // Шапданбек уулу Жолдошбек
            [2,            false], // Салымбеков Нурсултан
            [3,            false], // Замирбеков Женишбек
            [$sayakbevKant,false], // Саякбаев Кыяз
            [$nurdolotov,  false], // Нурдолотов
        ]);

        $this->lineup($m2->id, 6, [
            [107,        false], // Азамат уулу Айдар
            [110,        false], // Абакиров Акжолтой
            [111,        false], // Абдыбеков Эдил
            [115,        false], // Асанбеков Азирет
            [120,        false], // Джумабек уулу Эрнст
            [122,        false], // Кубатбеков Белек
            [125,        false], // Оморов Бексултан
            [$shamSharsh,false], // Шаршенбаев
            [$shamSapar, false], // Сапарбеков
            [$shamDurus, false], // Дурусбеков
        ]);

        // ── Match 3: Топ Тоголок 9-5 Виват  (09.02.2025 19:00, СК КФБ, Бишкек) ──
        // Goals — ТТ: Канатбеков 7',32'; Карыбеков 10'; Иманалиев 15',37';
        //             Абдымамытов 21'; Токтобек уулу 21',22'; Рыстаев 40'
        //         Виват: Кадыров 10',30'; Анарбеков 13'; Эсенгелдиев 15'; Вильямов С. 17'
        $m3 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 2,  // Топ Тоголок
            'away_team_id' => 3,  // Виват
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2025-02-09 19:00:00',
            'status'       => 'completed',
            'home_score'   => 9,
            'away_score'   => 5,
        ]);

        $this->lineup($m3->id, 2, [
            [15,         false], // Азатов Амир
            [21,         false], // Ильясов Бектур
            [24,         false], // Абдымамытов Адахан
            [25,         false], // Ашуров Сыймык
            [26,         false], // Жаанбаев Актан
            [27,         false], // Иманалиев Элбек
            [28,         false], // Канатбеков Аймен
            [37,         false], // Ахметов Арлан
            [42,         false], // Рыстаев Калыбек
            [45,         false], // Султангазиев Илимбек
            [90,         false], // Таштанов Актай
            [134,        false], // Азамат уулу Ильгиз
            [136,        true],  // Токтобек уулу Намыс — MVP
            [$karybekov, false], // Карыбеков
        ]);

        $this->lineup($m3->id, 3, [
            [46,       false], // Кыргызов Айбек
            [50,       false], // Анарбеков Нурадил
            [53,       false], // Вильямов Сухраб
            [57,       false], // Искендербеков Талгат
            [58,       false], // Кадыров Дильшат
            [62,       false], // Лиров Равил
            [64,       false], // Минкеев Ильзат
            [68,       false], // Чиркин Кирилл
            [132,      false], // Тургунбеков Адыл
            [223,      false], // Эсенгелдиев Асылбек
            [$ermekov, false], // Эрмеков
        ]);

        $this->goal($m3->id, 2, 28,         7);  // Канатбеков (7')
        $this->goal($m3->id, 3, 58,         10); // Кадыров (10')
        $this->goal($m3->id, 2, $karybekov, 10); // Карыбеков (10')
        $this->goal($m3->id, 3, 50,         13); // Анарбеков (13')
        $this->goal($m3->id, 2, 27,         15); // Иманалиев (15')
        $this->goal($m3->id, 3, 223,        15); // Эсенгелдиев (15')
        $this->goal($m3->id, 3, 53,         17); // Вильямов С. (17')
        $this->goal($m3->id, 2, 24,         21); // Абдымамытов (21')
        $this->goal($m3->id, 2, 136,        21); // Токтобек уулу (21')
        $this->goal($m3->id, 2, 136,        22); // Токтобек уулу (22')
        $this->goal($m3->id, 3, 58,         30); // Кадыров (30')
        $this->goal($m3->id, 2, 28,         32); // Канатбеков (32')
        $this->goal($m3->id, 2, 27,         37); // Иманалиев (37')
        $this->goal($m3->id, 2, 42,         40); // Рыстаев (40')

        // ── Match 4: Алай 2-2 Нарын  (09.02.2025 21:00, СК КФБ, Бишкек) ──────────
        // Goals — Алай: Алимов 23',34' / Нарын: Исаков 14',39'
        $m4 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 11, // Алай
            'away_team_id' => 4,  // Нарын
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2025-02-09 21:00:00',
            'status'       => 'completed',
            'home_score'   => 2,
            'away_score'   => 2,
        ]);

        $this->lineup($m4->id, 11, [
            [233,        false], // Джунушалиев Азирет
            [234,        false], // Мурзаев Бекболсун
            [235,        false], // Акматов Калдуубай
            [236,        true],  // Алимов Максат — MVP
            [237,        false], // Бабажанов Саид
            [240,        false], // Долоткелдиев Азамат
            [241,        false], // Исабеков Азамат
            [242,        false], // Исабеков Азат
            [243,        false], // Кубанычов Кайрат
            [244,        false], // Мамбеталиев Саламат
            [245,        false], // Сакенов Илимбек
            [246,        false], // Салимбаев Юлдашбай
            [247,        false], // Турсунов Арстанбек
            [$mamyrbayev,false], // Мамырбаев
        ]);

        $this->lineup($m4->id, 4, [
            [70,       false], // Азат уулу Данияр
            [71,       false], // Айылчиев Алманбет
            [72,       false], // Кубанычбеков Айбек
            [73,       false], // Айтокторов Нурберген
            [75,       false], // Байгазы уулу Уланбек
            [76,       false], // Бакаев Даниэль
            [79,       false], // Жыргалбеков Бактияр
            [83,       false], // Кубанычбеков Марат
            [85,       false], // Марат уулу Эржан
            [86,       false], // Мухтарбек уулу Бакыт
            [87,       false], // Нурлан уулу Эрбол
            [149,      false], // Аянбаев Адил (transferred from Кант)
            [153,      false], // Карыпбеков Бекмат (transferred from Кант)
            [$isakDan, false], // Исаков Данияр
        ]);

        $this->goal($m4->id, 4,  $isakDan, 14); // Исаков (14')
        $this->goal($m4->id, 11, 236,      23); // Алимов (23')
        $this->goal($m4->id, 11, 236,      34); // Алимов (34')
        $this->goal($m4->id, 4,  $isakDan, 39); // Исаков (39')
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
