<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Fixture;
use App\Models\FixtureLineup;
use App\Models\Round;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

// Суперлига 2024-25 — Matchweek 18 (19–24 February 2025)
// Source: futsal_kgz Instagram posts
class Matchweek18Seeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        // ── New players ───────────────────────────────────────────────────────────
        // Топ Тоголок (team 2)
        $kylychbek = DB::table('players')->insertGetId(['name' => 'Кылычбек уулу', 'created_at' => $now, 'updated_at' => $now]);
        DB::table('player_team_seasons')->insert(['player_id' => $kylychbek, 'team_id' => 2, 'season_id' => 1, 'joined_at' => '2025-02-19', 'created_at' => $now, 'updated_at' => $now]);

        $kalbayev = DB::table('players')->insertGetId(['name' => 'Калбаев', 'created_at' => $now, 'updated_at' => $now]);
        DB::table('player_team_seasons')->insert(['player_id' => $kalbayev, 'team_id' => 2, 'season_id' => 1, 'joined_at' => '2025-02-19', 'created_at' => $now, 'updated_at' => $now]);

        $smanov = DB::table('players')->insertGetId(['name' => 'Сманов', 'created_at' => $now, 'updated_at' => $now]);
        DB::table('player_team_seasons')->insert(['player_id' => $smanov, 'team_id' => 2, 'season_id' => 1, 'joined_at' => '2025-02-19', 'created_at' => $now, 'updated_at' => $now]);

        // Нарын (team 4)
        $ashymaliev = DB::table('players')->insertGetId(['name' => 'Ашымалиев', 'created_at' => $now, 'updated_at' => $now]);
        DB::table('player_team_seasons')->insert(['player_id' => $ashymaliev, 'team_id' => 4, 'season_id' => 1, 'joined_at' => '2025-02-23', 'created_at' => $now, 'updated_at' => $now]);

        $sultanалiev = DB::table('players')->insertGetId(['name' => 'Султаналиев', 'created_at' => $now, 'updated_at' => $now]);
        DB::table('player_team_seasons')->insert(['player_id' => $sultanалiev, 'team_id' => 4, 'season_id' => 1, 'joined_at' => '2025-02-23', 'created_at' => $now, 'updated_at' => $now]);

        // Каракол (team 5)
        $amanturu = DB::table('players')->insertGetId(['name' => 'Амантур уулу', 'created_at' => $now, 'updated_at' => $now]);
        DB::table('player_team_seasons')->insert(['player_id' => $amanturu, 'team_id' => 5, 'season_id' => 1, 'joined_at' => '2025-02-23', 'created_at' => $now, 'updated_at' => $now]);

        // ── Round ─────────────────────────────────────────────────────────────────
        $round = Round::firstOrCreate(
            ['stage_id' => 1, 'name' => 'Matchweek 18'],
            ['order' => 18],
        );

        // ── Match 1: Art Blast Group 7-3 Топ Тоголок  (19.02.2025 19:00, СК КФБ, Бишкек) ──
        // Goals — ABG: Канетов(3'), Андабеков(4'), Самат уулу(18',39'), Анарбек уулу(29'),
        //               Талайбеков(30'), Туратбеков(36')
        //         ТТ:  Канатбеков(5'), Доолотов(36'), Мендибаев(39'АГ)
        $m1 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 10, // Art Blast Group
            'away_team_id' => 2,  // Топ Тоголок
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2025-02-19 19:00:00',
            'status'       => 'completed',
            'home_score'   => 7,
            'away_score'   => 3,
        ]);

        $this->lineup($m1->id, 10, [
            [210, false], // Жусупов Абдуазим
            [229, false], // Канетов Эмил
            [218, false], // Кенешбеков Жанарбек
            [231, true],  // Самат уулу Алмазбек — MVP
            [250, false], // Талайбеков Данияр
            [212, false], // Насирдинов Султан
            [230, false], // Анарбек уулу Акылбек
            [217, false], // Андабеков Аман
            [222, false], // Бейшеналиев Урмат
            [227, false], // Мендибаев Нурдин
            [232, false], // Муктарбеков Эльдар
            [225, false], // Сулайманбеков Данияр
            [221, false], // Туратбеков Ислам
            [219, false], // Эралиев Мухаммедмуса
        ]);

        $this->lineup($m1->id, 2, [
            [20,         false], // Куватбек Адил
            [24,         false], // Абдымамытов Адахан
            [27,         false], // Иманалиев Элбек
            [42,         false], // Рыстаев Калыбек
            [136,        false], // Токтобек уулу Намыс
            [15,         false], // Азатов Амир
            [18,         false], // Доолотов Эрбол
            [26,         false], // Жаанбаев Актан
            [21,         false], // Ильясов Бектур
            [28,         false], // Канатбеков Аймен
            [90,         false], // Таштанов Актай
            [$kylychbek, false], // Кылычбек уулу
            [$kalbayev,  false], // Калбаев
            [270,        false], // Карыбеков
        ]);

        $this->goal($m1->id, 10, 229, 3);     // Канетов (3')
        $this->goal($m1->id, 10, 217, 4);     // Андабеков (4')
        $this->goal($m1->id, 2,  28,  5);     // Канатбеков (5')
        $this->goal($m1->id, 10, 231, 18);    // Самат уулу (18')
        $this->goal($m1->id, 10, 230, 29);    // Анарбек уулу (29')
        $this->goal($m1->id, 10, 250, 30);    // Талайбеков (30')
        $this->goal($m1->id, 2,  18,  36);    // Доолотов (36')
        $this->goal($m1->id, 10, 221, 36);    // Туратбеков (36')
        $this->goal($m1->id, 10, 231, 39);    // Самат уулу (39')
        $this->ownGoal($m1->id, 10, 227, 39); // Мендибаев АГ (39')

        // ── Match 2: Алай 7-2 Талас  (22.02.2025 19:00, СК КФБ, Бишкек) ────────────
        // Goals — Алай: Салимбаев(2'), Турсунов(27',34'), Данияр уулу(32'),
        //               Акматов(34',39'), Мамбеталиев(36')
        //         Талас: Мыктыбеков(23'), Мукушбеков(31')
        $m2 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 11, // Алай
            'away_team_id' => 1,  // Талас
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2025-02-22 19:00:00',
            'status'       => 'completed',
            'home_score'   => 7,
            'away_score'   => 2,
        ]);

        $this->lineup($m2->id, 11, [
            [234, false], // Мурзаев Бекболсун
            [237, false], // Бабажанов Саид
            [240, false], // Долоткелдиев Азамат
            [244, false], // Мамбеталиев Саламат
            [246, false], // Салимбаев Юлдашбай
            [233, false], // Джунушалиев Азирет
            [235, false], // Акматов Калдуубай
            [236, false], // Алимов Максат
            [238, true],  // Данияр уулу Абдурахим — MVP
            [241, false], // Исабеков Азамат
            [245, false], // Сакенов Илимбек
            [242, false], // Исабеков Азат
            [247, false], // Турсунов Арстанбек
            [254, false], // Мамырбаев
        ]);

        $this->lineup($m2->id, 1, [
            [137, false], // Уланбек уулу Тилек
            [8,   false], // Болтобаев Темирлан
            [11,  false], // Мыктыбеков Аскат
            [143, false], // Сабырбек уулу Майрамбек
            [10,  false], // Сатыбалдиев Айдар
            [6,   false], // Курманбеков Бектур
            [141, false], // Виктор уулу Сабит
            [4,   false], // Жакыпов Руслан
            [33,  false], // Кочконов Бекжан
            [12,  false], // Мукушбеков Рамис
            [34,  false], // Орунбеков Камбар
            [281,  false], // Саякбаев Кудайберген
            [5,   false], // Торобеков Бакдоолот
            [36,  false], // Шабданов Дастан
        ]);

        $this->goal($m2->id, 11, 246, 2);  // Салимбаев (2')
        $this->goal($m2->id, 1,  11,  23); // Мыктыбеков (23')
        $this->goal($m2->id, 11, 247, 27); // Турсунов (27')
        $this->goal($m2->id, 1,  12,  31); // Мукушбеков (31')
        $this->goal($m2->id, 11, 238, 32); // Данияр уулу (32')
        $this->goal($m2->id, 11, 247, 34); // Турсунов (34')
        $this->goal($m2->id, 11, 235, 34); // Акматов (34')
        $this->goal($m2->id, 11, 244, 36); // Мамбеталиев (36')
        $this->goal($m2->id, 11, 235, 39); // Акматов (39')

        // ── Match 3: Нарын 4-6 Топ Тоголок  (23.02.2025 16:00, ФОК "Газпром", Нарын) ──
        $m3 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 4,  // Нарын
            'away_team_id' => 2,  // Топ Тоголок
            'venue'        => 'ФОК "Газпром", Нарын',
            'scheduled_at' => '2025-02-23 16:00:00',
            'status'       => 'completed',
            'home_score'   => 4,
            'away_score'   => 6,
        ]);

        $this->lineup($m3->id, 4, [
            [71,          false], // Айылчиев Алманбет
            [87,          false], // Нурлан уулу Эрбол
            [91,          false], // Турсунбеков Уран
            [149,         false], // Аянбаев Адил
            [153,         false], // Карыпбеков Бекмат
            [72,          false], // Кубанычбеков Айбек
            [73,          false], // Айтокторов Нурберген
            [78,          false], // Жумабеков Султан
            [81,          false], // Ибраев Ислам
            [86,          false], // Мухтарбек уулу Бакыт
            [89,          false], // Талантбек уулу Жыргалбек
            [$ashymaliev, false], // Ашымалиев
            [$sultanалiev,false], // Султаналиев
        ]);

        $this->lineup($m3->id, 2, [
            [15,        false], // Азатов Амир
            [134,       true],  // Азамат уулу Ильгиз — MVP
            [18,        false], // Доолотов Эрбол
            [28,        false], // Канатбеков Аймен
            [90,        false], // Таштанов Актай
            [133,       false], // Мухтар уулу Байэл
            [24,        false], // Абдымамытов Адахан
            [37,        false], // Ахметов Арлан
            [27,        false], // Иманалиев Элбек
            [42,        false], // Рыстаев Калыбек
            [136,       false], // Токтобек уулу Намыс
            [$kalbayev, false], // Калбаев
            [$smanov,   false], // Сманов
            [270,       false], // Карыбеков
        ]);

        // ── Match 4: Каракол 3-8 Art Blast Group  (23.02.2025 20:00, ФОК "Каракол", Каракол) ──
        $m4 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 5,  // Каракол
            'away_team_id' => 10, // Art Blast Group
            'venue'        => 'ФОК "Каракол", Каракол',
            'scheduled_at' => '2025-02-23 20:00:00',
            'status'       => 'completed',
            'home_score'   => 3,
            'away_score'   => 8,
        ]);

        $this->lineup($m4->id, 5, [
            [93,       false], // Дюшебаев Ислам
            [94,       false], // Авазбеков Эрлан
            [103,      false], // Усенбаев Бексултан
            [264,      false], // Кайыпбеков
            [265,      false], // Базаркулов
            [97,       false], // Конушбеков Кутман
            [99,       false], // Орозакун уулу Султан
            [100,      false], // Орозбеков Улукбек
            [106,      false], // Шаршенбиев Ринат
            [101,      false], // Токтобеков Темирлан
            [$amanturu,false], // Амантур уулу
        ]);

        $this->lineup($m4->id, 10, [
            [210, false], // Жусупов Абдуазим
            [213, true],  // Абдурашит уулу Арген — MVP
            [218, false], // Кенешбеков Жанарбек
            [231, false], // Самат уулу Алмазбек
            [250, false], // Талайбеков Данияр
            [212, false], // Насирдинов Султан
            [217, false], // Андабеков Аман
            [222, false], // Бейшеналиев Урмат
            [227, false], // Мендибаев Нурдин
            [232, false], // Муктарбеков Эльдар
            [221, false], // Туратбеков Ислам
            [219, false], // Эралиев Мухаммедмуса
        ]);

        // ── Match 5: Шам 1-7 Art Blast Group  (24.02.2025 16:00, ФОК "Газпром", Чолпон-Ата) ──
        $m5 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 6,  // Шам
            'away_team_id' => 10, // Art Blast Group
            'venue'        => 'ФОК "Газпром", Чолпон-Ата',
            'scheduled_at' => '2025-02-24 16:00:00',
            'status'       => 'completed',
            'home_score'   => 1,
            'away_score'   => 7,
        ]);

        $this->lineup($m5->id, 10, [
            [217, true], // Андабеков Аман — MVP
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
