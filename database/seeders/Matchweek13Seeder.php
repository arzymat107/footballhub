<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Fixture;
use App\Models\FixtureLineup;
use App\Models\Round;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

// Суперлига 2024-25 — Matchweek 13 (11–12 January 2025) — начало второго круга
// Source: futsal_kgz Instagram posts
// Notable: Дордой rebrand → Art Blast Group; mid-season transfers
class Matchweek13Seeder extends Seeder
{
    public function run(): void
    {
        // ── Rebrand: Дордой → Art Blast Group (8 January 2025) ──
        DB::table('teams')->where('id', 10)->update(['name' => 'Art Blast Group']);

        // ── New players ──────────────────────────────────────────────────────────
        $transferDate = '2025-01-01 00:00:00';

        // ОшМУ new players
        $murza = DB::table('players')->insertGetId(['name' => 'Мурзакулов', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('player_team_seasons')->insert(['player_id' => $murza,  'team_id' => 9, 'season_id' => 1, 'joined_at' => $transferDate, 'created_at' => now(), 'updated_at' => now()]);

        $askOsh = DB::table('players')->insertGetId(['name' => 'Аскеров Бахтияр', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('player_team_seasons')->insert(['player_id' => $askOsh, 'team_id' => 9, 'season_id' => 1, 'joined_at' => $transferDate, 'created_at' => now(), 'updated_at' => now()]);

        // Art Blast Group new player
        $talaibek = DB::table('players')->insertGetId(['name' => 'Талайбеков Данияр', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('player_team_seasons')->insert(['player_id' => $talaibek, 'team_id' => 10, 'season_id' => 1, 'joined_at' => $transferDate, 'created_at' => now(), 'updated_at' => now()]);

        // Спорткомитет new players
        $sydSport = DB::table('players')->insertGetId(['name' => 'Сыдыков Алтынбек', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('player_team_seasons')->insert(['player_id' => $sydSport, 'team_id' => 8, 'season_id' => 1, 'joined_at' => $transferDate, 'created_at' => now(), 'updated_at' => now()]);

        $abdrasul = DB::table('players')->insertGetId(['name' => 'Абдурасул уулу', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('player_team_seasons')->insert(['player_id' => $abdrasul, 'team_id' => 8, 'season_id' => 1, 'joined_at' => $transferDate, 'created_at' => now(), 'updated_at' => now()]);

        // Lineup-only new players
        $zhylk = DB::table('players')->insertGetId(['name' => 'Жылкайдар', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('player_team_seasons')->insert(['player_id' => $zhylk, 'team_id' => 4, 'season_id' => 1, 'joined_at' => $transferDate, 'created_at' => now(), 'updated_at' => now()]);

        $mamyr = DB::table('players')->insertGetId(['name' => 'Мамырбаев', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('player_team_seasons')->insert(['player_id' => $mamyr, 'team_id' => 11, 'season_id' => 1, 'joined_at' => $transferDate, 'created_at' => now(), 'updated_at' => now()]);

        $ermekov = DB::table('players')->insertGetId(['name' => 'Эрмеков', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('player_team_seasons')->insert(['player_id' => $ermekov, 'team_id' => 3, 'season_id' => 1, 'joined_at' => $transferDate, 'created_at' => now(), 'updated_at' => now()]);

        // ── Transfers (set left_at on old record, insert new player_team_seasons) ──
        $now = now();

        // Замирбеков (3) Талас → Кант
        DB::table('player_team_seasons')->where('player_id', 3)->where('team_id', 1)->where('season_id', 1)->update(['left_at' => $transferDate, 'updated_at' => $now]);
        DB::table('player_team_seasons')->insert(['player_id' => 3,   'team_id' => 7, 'season_id' => 1, 'joined_at' => $transferDate, 'created_at' => $now, 'updated_at' => $now]);
        // Салымбеков (2) Талас → Кант
        DB::table('player_team_seasons')->where('player_id', 2)->where('team_id', 1)->where('season_id', 1)->update(['left_at' => $transferDate, 'updated_at' => $now]);
        DB::table('player_team_seasons')->insert(['player_id' => 2,   'team_id' => 7, 'season_id' => 1, 'joined_at' => $transferDate, 'created_at' => $now, 'updated_at' => $now]);
        // Аянбаев (149) Кант → Нарын
        DB::table('player_team_seasons')->where('player_id', 149)->where('team_id', 7)->where('season_id', 1)->update(['left_at' => $transferDate, 'updated_at' => $now]);
        DB::table('player_team_seasons')->insert(['player_id' => 149, 'team_id' => 4, 'season_id' => 1, 'joined_at' => $transferDate, 'created_at' => $now, 'updated_at' => $now]);
        // Карыпбеков (153) Кант → Нарын
        DB::table('player_team_seasons')->where('player_id', 153)->where('team_id', 7)->where('season_id', 1)->update(['left_at' => $transferDate, 'updated_at' => $now]);
        DB::table('player_team_seasons')->insert(['player_id' => 153, 'team_id' => 4, 'season_id' => 1, 'joined_at' => $transferDate, 'created_at' => $now, 'updated_at' => $now]);
        // Эсенгелдиев (223) Art Blast Group → Виват
        DB::table('player_team_seasons')->where('player_id', 223)->where('team_id', 10)->where('season_id', 1)->update(['left_at' => $transferDate, 'updated_at' => $now]);
        DB::table('player_team_seasons')->insert(['player_id' => 223, 'team_id' => 3, 'season_id' => 1, 'joined_at' => $transferDate, 'created_at' => $now, 'updated_at' => $now]);
        // Сардарбеков (48) Виват → Шам
        DB::table('player_team_seasons')->where('player_id', 48)->where('team_id', 3)->where('season_id', 1)->update(['left_at' => $transferDate, 'updated_at' => $now]);
        DB::table('player_team_seasons')->insert(['player_id' => 48,  'team_id' => 6, 'season_id' => 1, 'joined_at' => $transferDate, 'created_at' => $now, 'updated_at' => $now]);
        // Таштанов (90) Нарын → Топ Тоголок
        DB::table('player_team_seasons')->where('player_id', 90)->where('team_id', 4)->where('season_id', 1)->update(['left_at' => $transferDate, 'updated_at' => $now]);
        DB::table('player_team_seasons')->insert(['player_id' => 90,  'team_id' => 2, 'season_id' => 1, 'joined_at' => $transferDate, 'created_at' => $now, 'updated_at' => $now]);

        // ── Matchweek 13 fixtures ─────────────────────────────────────────────────
        $round = Round::firstOrCreate(
            ['stage_id' => 1, 'name' => 'Matchweek 13'],
            ['order' => 13],
        );

        // ── Match 1: Спорткомитет 2-10 Алай  (11.01.2025 16:00, СК "Шавкат", Ош) ──
        $m1 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 8,  // Спорткомитет
            'away_team_id' => 11, // Алай
            'venue'        => 'СК "Шавкат", Ош',
            'scheduled_at' => '2025-01-11 16:00:00',
            'status'       => 'completed',
            'home_score'   => 2,
            'away_score'   => 10,
        ]);

        $this->lineup($m1->id, 8, [
            [163, false], // Камбар уулу Женишбек
            [167, false], // Абышев Элмар
            [168, false], // Алмазбеков Омурбек
            [173, false], // Максатбеков Айдар
            [175, false], // Маматкасымов Давранбек
            [164, false], // Таджибаев Алижон
            [166, false], // Абдуллаев Мухаммадсодик
            [170, false], // Жакыпов Даулес
            [172, false], // Казакбаев Умар
            [178, false], // Сайдалиев Дамирбек
            [180, false], // Султанали уулу Алымбек
            [184, false], // Эргашев Диёрбек
            [$sydSport, false], // Сыдыков Алтынбек
            [$abdrasul, false], // Абдурасул уулу
        ]);

        $this->lineup($m1->id, 11, [
            [233, false], // Джунушалиев Азирет
            [236, true],  // Алимов Максат — MVP
            [237, false], // Бабажанов Саид
            [242, false], // Исабеков Азат
            [246, false], // Салимбаев Юлдашбай
            [234, false], // Мурзаев Бекболсун
            [235, false], // Акматов Калдуубай
            [240, false], // Долоткелдиев Азамат
            [243, false], // Кубанычов Кайрат
            [244, false], // Мамбеталиев Саламат
            [$mamyr, false], // Мамырбаев
        ]);

        // Goals — Спорткомитет (2): Сыдыков 15'; Абышев 30'
        //         Алай (10): Долоткелдиев 7'; Алимов 9',27',37',38'; Мамбеталиев 10',11'; Кубанычов 22'; Исабеков 25',32'
        $this->goal($m1->id, 11, 240, 7);      // Долоткелдиев (7')
        $this->goal($m1->id, 11, 236, 9);      // Алимов (9')
        $this->goal($m1->id, 11, 244, 10);     // Мамбеталиев (10')
        $this->goal($m1->id, 11, 244, 11);     // Мамбеталиев (11')
        $this->goal($m1->id, 8,  $sydSport, 15); // Сыдыков (15')
        $this->goal($m1->id, 11, 243, 22);     // Кубанычов (22')
        $this->goal($m1->id, 11, 242, 25);     // Исабеков Азат (25')
        $this->goal($m1->id, 11, 236, 27);     // Алимов (27')
        $this->goal($m1->id, 8,  167, 30);     // Абышев (30')
        $this->goal($m1->id, 11, 242, 32);     // Исабеков Азат (32')
        $this->goal($m1->id, 11, 236, 37);     // Алимов (37')
        $this->goal($m1->id, 11, 236, 38);     // Алимов (38')

        // ── Match 2: ОшМУ 2-5 Кант  (11.01.2025 18:00, СК "Шавкат", Ош) ──
        $m2 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 9,  // ОшМУ
            'away_team_id' => 7,  // Кант
            'venue'        => 'СК "Шавкат", Ош',
            'scheduled_at' => '2025-01-11 18:00:00',
            'status'       => 'completed',
            'home_score'   => 2,
            'away_score'   => 5,
        ]);

        $this->lineup($m2->id, 9, [
            [186, false], // Кудайбердиев Сыймыкбек
            [191, false], // Абдыжалил уулу Айдарбек
            [192, false], // Абдылдаев Нурсултан
            [208, false], // Дос Сантос Барбоса Жерлан
            [209, false], // Да Силва Леонардо Витор
            [188, false], // Ураимов Урмат
            [197, false], // Исламов Алымбек
            [198, false], // Култаев Адилет
            [199, false], // Муктарали уулу Уланбек
            [201, false], // Ражапов Сыймык
            [203, false], // Ташбалтаев Абдыкадыр
            [207, false], // Эркаев Акылбек
            [$murza,  false], // Мурзакулов
            [$askOsh, false], // Аскеров Бахтияр
        ]);

        $this->lineup($m2->id, 7, [
            [145, true],  // Пензаев Чынгыз — MVP
            [151, false], // Исроилов Кутбидин
            [152, false], // Кадырбек уулу Ислам
            [157, false], // Рахманкулов Азамат
            [162, false], // Шапданбек уулу Жолдошбек
            [146, false], // Хамидов Акжол
            [147, false], // Айдаркул уулу Эрмек
            [155, false], // Мелисбек уулу Азамат
            [159, false], // Султанбеков Бекзат
            [3,   false], // Замирбеков Женишбек (transferred from Талас)
            [2,   false], // Салымбеков Нурсултан (transferred from Талас)
        ]);

        // Goals — ОшМУ (2): Абдыжалил уулу 3'; Мурзакулов 33'
        //         Кант (5): Султанбеков 3'; Замирбеков 4',40'; Мелисбек уулу 7'; Кадырбек уулу 25'
        $this->goal($m2->id, 9, 191,   3);  // Абдыжалил уулу (3')
        $this->goal($m2->id, 7, 159,   3);  // Султанбеков (3')
        $this->goal($m2->id, 7, 3,     4);  // Замирбеков (4')
        $this->goal($m2->id, 7, 155,   7);  // Мелисбек уулу (7')
        $this->goal($m2->id, 7, 152,   25); // Кадырбек уулу (25')
        $this->goal($m2->id, 9, $murza, 33); // Мурзакулов (33')
        $this->goal($m2->id, 7, 3,     40); // Замирбеков (40')

        // ── Match 3: Спорткомитет 5-6 Кант  (12.01.2025 16:00, СК "Шавкат", Ош) ──
        $m3 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 8,  // Спорткомитет
            'away_team_id' => 7,  // Кант
            'venue'        => 'СК "Шавкат", Ош',
            'scheduled_at' => '2025-01-12 16:00:00',
            'status'       => 'completed',
            'home_score'   => 5,
            'away_score'   => 6,
        ]);

        $this->lineup($m3->id, 8, [
            [165, false], // Эркинбаев Даниел
            [167, false], // Абышев Элмар
            [168, false], // Алмазбеков Омурбек
            [170, false], // Жакыпов Даулес
            [175, false], // Маматкасымов Давранбек
            [163, false], // Камбар уулу Женишбек
            [166, false], // Абдуллаев Мухаммадсодик
            [172, false], // Казакбаев Умар
            [178, false], // Сайдалиев Дамирбек
            [180, false], // Султанали уулу Алымбек
            [184, false], // Эргашев Диёрбек
            [185, false], // Эшмамбет уулу Медербек
            [$abdrasul, false], // Абдурасул уулу
        ]);

        $this->lineup($m3->id, 7, [
            [146, false], // Хамидов Акжол
            [151, false], // Исроилов Кутбидин
            [152, false], // Кадырбек уулу Ислам
            [159, false], // Султанбеков Бекзат
            [162, false], // Шапданбек уулу Жолдошбек
            [145, false], // Пензаев Чынгыз
            [147, false], // Айдаркул уулу Эрмек
            [155, false], // Мелисбек уулу Азамат
            [157, false], // Рахманкулов Азамат
            [2,   true],  // Салымбеков Нурсултан — MVP (transferred from Талас)
            [3,   false], // Замирбеков Женишбек (transferred from Талас)
        ]);

        // Goals — Спорткомитет (5): Казакбаев 13',32'; Алмазбеков 16'; Жакыпов 22'; Абдурасул уулу 31'
        //         Кант (6): Салымбеков 19',24',26',34'; Кадырбек уулу 28',36'
        $this->goal($m3->id, 8, 172,     13); // Казакбаев (13')
        $this->goal($m3->id, 7, 2,       19); // Салымбеков (19')
        $this->goal($m3->id, 8, 168,     16); // Алмазбеков (16')
        $this->goal($m3->id, 8, 170,     22); // Жакыпов (22')
        $this->goal($m3->id, 7, 2,       24); // Салымбеков (24')
        $this->goal($m3->id, 7, 2,       26); // Салымбеков (26')
        $this->goal($m3->id, 7, 152,     28); // Кадырбек уулу (28')
        $this->goal($m3->id, 8, $abdrasul, 31); // Абдурасул уулу (31')
        $this->goal($m3->id, 8, 172,     32); // Казакбаев (32')
        $this->goal($m3->id, 7, 2,       34); // Салымбеков (34')
        $this->goal($m3->id, 7, 152,     36); // Кадырбек уулу (36')

        // ── Match 4: ОшМУ 5-3 Алай  (12.01.2025 18:00, СК "Шавкат", Ош) ──
        $m4 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 9,  // ОшМУ
            'away_team_id' => 11, // Алай
            'venue'        => 'СК "Шавкат", Ош',
            'scheduled_at' => '2025-01-12 18:00:00',
            'status'       => 'completed',
            'home_score'   => 5,
            'away_score'   => 3,
        ]);

        $this->lineup($m4->id, 9, [
            [186, false], // Кудайбердиев Сыймыкбек
            [197, false], // Исламов Алымбек
            [199, false], // Муктарали уулу Уланбек
            [201, false], // Ражапов Сыймык
            [207, false], // Эркаев Акылбек
            [188, false], // Ураимов Урмат
            [191, true],  // Абдыжалил уулу Айдарбек — MVP
            [198, false], // Култаев Адилет
            [208, false], // Дос Сантос Барбоса Жерлан
            [209, false], // Да Силва Леонардо Витор
            [$murza,  false], // Мурзакулов
            [$askOsh, false], // Аскеров Бахтияр
        ]);

        $this->lineup($m4->id, 11, [
            [233, false], // Джунушалиев Азирет
            [236, false], // Алимов Максат
            [241, false], // Исабеков Азамат
            [242, false], // Исабеков Азат
            [246, false], // Салимбаев Юлдашбай
            [234, false], // Мурзаев Бекболсун
            [235, false], // Акматов Калдуубай
            [237, false], // Бабажанов Саид
            [240, false], // Долоткелдиев Азамат
            [243, false], // Кубанычов Кайрат
            [244, false], // Мамбеталиев Саламат
            [247, false], // Турсунов Арстанбек
            [$mamyr, false], // Мамырбаев
        ]);

        // Goals — ОшМУ (5): Муктарали уулу 3'; Абдыжалил уулу 5',40'; Мурзакулов 17'; Аскеров 27'
        //         Алай (3): Исабеков 2'; Салимбаев 8'; Кубанычов 9'
        $this->goal($m4->id, 11, 241,     2);  // Исабеков Азамат (2')
        $this->goal($m4->id, 9,  199,     3);  // Муктарали уулу (3')
        $this->goal($m4->id, 9,  191,     5);  // Абдыжалил уулу (5')
        $this->goal($m4->id, 11, 246,     8);  // Салимбаев (8')
        $this->goal($m4->id, 11, 243,     9);  // Кубанычов (9')
        $this->goal($m4->id, 9,  $murza,  17); // Мурзакулов (17')
        $this->goal($m4->id, 9,  $askOsh, 27); // Аскеров (27')
        $this->goal($m4->id, 9,  191,     40); // Абдыжалил уулу (40')

        // ── Match 5: Нарын 2-4 Art Blast Group  (12.01.2025 16:30, ФОК "Газпром", Нарын) ──
        $m5 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 4,  // Нарын
            'away_team_id' => 10, // Art Blast Group
            'venue'        => 'ФОК "Газпром", Нарын',
            'scheduled_at' => '2025-01-12 16:30:00',
            'status'       => 'completed',
            'home_score'   => 2,
            'away_score'   => 4,
        ]);

        $this->lineup($m5->id, 4, [
            [$zhylk, false], // Жылкайдар
            [149,    false], // Аянбаев Адил (transferred from Кант)
            [87,     false], // Нурлан уулу Эрбол
            [153,    false], // Карыпбеков Бекмат (transferred from Кант)
            [75,     false], // Байгазы уулу Уланбек
            [83,     false], // Кубанычбеков Марат
            [73,     false], // Айтокторов Нурберген
            [78,     false], // Жумабеков Султан
            [86,     false], // Мухтарбек уулу Бакыт
            [89,     false], // Талантбек уулу Жыргалбек
            [91,     false], // Турсунбеков Уран
        ]);

        $this->lineup($m5->id, 10, [
            [210, false], // Жусупов Абдуазим
            [213, false], // Абдурашит уулу Арген
            [222, false], // Бейшеналиев Урмат
            [218, false], // Кенешбеков Жанарбек
            [$talaibek, true], // Талайбеков Данияр — MVP
            [212, false], // Насирдинов Султан
            [217, false], // Андабеков Аман
            [216, false], // Мелисов Нурсултан
            [232, false], // Муктарбеков Эльдар
            [221, false], // Туратбеков Ислам
            [219, false], // Эралиев Мухаммедмуса
        ]);

        // Goals — Нарын (2): Байгазы уулу 8'; Аянбаев 39'
        //         Art Blast (4): Байгазы уулу(ОГ) 19'; Кенешбеков 23'; Талайбеков 39',40'
        $this->goal($m5->id, 4, 75,       8);  // Байгазы уулу (8')
        Event::create(['fixture_id' => $m5->id, 'team_id' => 4, 'player_id' => 75, 'type' => 'own_goal', 'minute' => 19]); // Байгазы уулу OG (19')
        $this->goal($m5->id, 10, 218,     23); // Кенешбеков (23')
        $this->goal($m5->id, 4,  149,     39); // Аянбаев (39')
        $this->goal($m5->id, 10, $talaibek, 39); // Талайбеков (39')
        $this->goal($m5->id, 10, $talaibek, 40); // Талайбеков (40')

        // ── Match 6: Виват 7-2 Каракол  (12.01.2025 19:00, СК НФА, Бишкек) ──
        $m6 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 3,  // Виват
            'away_team_id' => 5,  // Каракол
            'venue'        => 'СК НФА, Бишкек',
            'scheduled_at' => '2025-01-12 19:00:00',
            'status'       => 'completed',
            'home_score'   => 7,
            'away_score'   => 2,
        ]);

        $this->lineup($m6->id, 3, [
            [132,      false], // Тургунбеков Адыл
            [50,       false], // Анарбеков Нурадил
            [68,       false], // Чиркин Кирилл
            [223,      false], // Эсенгелдиев Асылбек (transferred from Art Blast)
            [$ermekov, false], // Эрмеков
            [46,       false], // Кыргызов Айбек
            [51,       false], // Ачилов Канымет
            [56,       false], // Зажигаев Данил
            [57,       false], // Искендербеков Талгат
            [60,       false], // Кошонов Канкелди
            [62,       false], // Лиров Равил
            [63,       true],  // Маликов Абдурасул — MVP
            [65,       false], // Назаралиев Урмат
            [66,       false], // Тимченко Артем
        ]);

        $this->lineup($m6->id, 5, [
            [93,  false], // Дюшебаев Ислам
            [99,  false], // Орозакун уулу Султан
            [100, false], // Орозбеков Улукбек
            [103, false], // Усенбаев Бексултан
            [105, false], // Усупов Эрлан
            [94,  false], // Авазбеков Эрлан
            [101, false], // Токтобеков Темирлан
        ]);

        // Goals not available from photos

        // ── Match 7: Топ Тоголок 4-1 Шам  (12.01.2025 21:00, СК НФА, Бишкек) ──
        $m7 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 2,  // Топ Тоголок
            'away_team_id' => 6,  // Шам
            'venue'        => 'СК НФА, Бишкек',
            'scheduled_at' => '2025-01-12 21:00:00',
            'status'       => 'completed',
            'home_score'   => 4,
            'away_score'   => 1,
        ]);

        $this->lineup($m7->id, 2, [
            [15,  false], // Азатов Амир
            [37,  false], // Ахметов Арлан
            [18,  false], // Доолотов Эрбол
            [19,  false], // Касмакунов Элдияр
            [90,  false], // Таштанов Актай (transferred from Нарын)
            [20,  false], // Куватбек Адил
            [24,  false], // Абдымамытов Адахан
            [134, false], // Азамат уулу Ильгиз
            [26,  false], // Жаанбаев Актан
            [21,  false], // Ильясов Бектур
            [27,  false], // Иманалиев Элбек
            [28,  false], // Канатбеков Аймен
            [42,  true],  // Рыстаев Калыбек — MVP
            [136, false], // Токтобек уулу Намыс
        ]);

        $this->lineup($m7->id, 6, [
            [48,  false], // Сардарбеков Белек (transferred from Виват)
            [125, false], // Оморов Бексултан
            [121, false], // Жениш уулу Уланбек
            [120, false], // Джумабек уулу Эрнст
            [124, false], // Мукаев Келдибек
            [128, false], // Туратбек уулу Эрназар
            [115, false], // Асанбеков Азирет
            [122, false], // Кубатбеков Белек
            [113, false], // Акылбек уулу Улан
            [126, false], // Самудин уулу Заманбек
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
