<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Fixture;
use App\Models\FixtureLineup;
use App\Models\Round;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

// Суперлига 2024-25 — Matchweek 14 (18–19 January 2025)
// Source: futsal_kgz Instagram posts
class Matchweek14Seeder extends Seeder
{
    public function run(): void
    {
        // ── New Шам players ──────────────────────────────────────────────────────
        $joinedAt = '2025-01-18 00:00:00';

        $sapar   = DB::table('players')->insertGetId(['name' => 'Сапарбеков', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('player_team_seasons')->insert(['player_id' => $sapar,   'team_id' => 6, 'season_id' => 1, 'joined_at' => $joinedAt, 'created_at' => now(), 'updated_at' => now()]);

        $murzakar = DB::table('players')->insertGetId(['name' => 'Мурзакарим уулу', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('player_team_seasons')->insert(['player_id' => $murzakar, 'team_id' => 6, 'season_id' => 1, 'joined_at' => $joinedAt, 'created_at' => now(), 'updated_at' => now()]);

        $sharsh  = DB::table('players')->insertGetId(['name' => 'Шаршенбаев', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('player_team_seasons')->insert(['player_id' => $sharsh,  'team_id' => 6, 'season_id' => 1, 'joined_at' => $joinedAt, 'created_at' => now(), 'updated_at' => now()]);

        $durus   = DB::table('players')->insertGetId(['name' => 'Дурусбеков', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('player_team_seasons')->insert(['player_id' => $durus,   'team_id' => 6, 'season_id' => 1, 'joined_at' => $joinedAt, 'created_at' => now(), 'updated_at' => now()]);

        $tokt    = DB::table('players')->insertGetId(['name' => 'Токтогунов', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('player_team_seasons')->insert(['player_id' => $tokt,    'team_id' => 6, 'season_id' => 1, 'joined_at' => $joinedAt, 'created_at' => now(), 'updated_at' => now()]);

        // ── Matchweek 14 fixtures ─────────────────────────────────────────────────
        $round = Round::firstOrCreate(
            ['stage_id' => 1, 'name' => 'Matchweek 14'],
            ['order' => 14],
        );

        // ── Match 1: Виват 8-4 Шам  (18.01.2025 19:00, СК НФА, Бишкек) ──
        $m1 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 3,  // Виват
            'away_team_id' => 6,  // Шам
            'venue'        => 'СК НФА, Бишкек',
            'scheduled_at' => '2025-01-18 19:00:00',
            'status'       => 'completed',
            'home_score'   => 8,
            'away_score'   => 4,
        ]);

        // Виват lineup
        $this->lineup($m1->id, 3, [
            [132, false], // Тургунбеков Адыл
            [50,  true],  // Анарбеков Нурадил — MVP
            [64,  false], // Минкеев Ильзат
            [223, false], // Эсенгелдиев Асылбек
            [255, false], // Эрмеков
            [46,  false], // Кыргызов Айбек
            [51,  false], // Ачилов Канымет
            [56,  false], // Зажигаев Данил
            [52,  false], // Вильямов Бахридин
            [54,  false], // Джумабеков Тариэл
            [63,  false], // Маликов Абдурасул
            [60,  false], // Кошонов Канкелди
            [57,  false], // Искендербеков Талгат
            [67,  false], // Хамраев Ибрахим
        ]);

        // Шам lineup
        $this->lineup($m1->id, 6, [
            [$sapar,    false], // Сапарбеков
            [120,       false], // Джумабек уулу Эрнст
            [122,       false], // Кубатбеков Белек
            [110,       false], // Абакиров Акжолтой
            [124,       false], // Мукаев Келдибек
            [48,        false], // Сардарбеков Белек
            [119,       false], // Галиев Мелис
            [111,       false], // Абдыбеков Эдил
            [$murzakar, false], // Мурзакарим уулу
            [123,       false], // Майрамбеков Султан
            [126,       false], // Самудин уулу Заманбек
            [$sharsh,   false], // Шаршенбаев
            [$durus,    false], // Дурусбеков
            [$tokt,     false], // Токтогунов
        ]);

        // Goals not available from photos

        // ── Match 2: Art Blast Group 1-0 Алай  (18.01.2025 21:00, СК НФА, Бишкек) ──
        $m2 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 10, // Art Blast Group
            'away_team_id' => 11, // Алай
            'venue'        => 'СК НФА, Бишкек',
            'scheduled_at' => '2025-01-18 21:00:00',
            'status'       => 'completed',
            'home_score'   => 1,
            'away_score'   => 0,
        ]);

        // Art Blast Group lineup
        $this->lineup($m2->id, 10, [
            [210, false], // Жусупов Абдуазим
            [213, false], // Абдурашит уулу Арген
            [218, false], // Кенешбеков Жанарбек
            [231, false], // Самат уулу Алмазбек
            [250, true],  // Талайбеков Данияр — MVP
            [212, false], // Насирдинов Султан
            [230, false], // Анарбек уулу Акылбек
            [217, false], // Андабеков Аман
            [222, false], // Бейшеналиев Урмат
            [216, false], // Мелисов Нурсултан
            [232, false], // Муктарбеков Эльдар
            [225, false], // Сулайманбеков Данияр
            [221, false], // Туратбеков Ислам
            [219, false], // Эралиев Мухаммедмуса
        ]);

        // Алай lineup
        $this->lineup($m2->id, 11, [
            [233, false], // Джунушалиев Азирет
            [236, false], // Алимов Максат
            [242, false], // Исабеков Азат
            [244, false], // Мамбеталиев Саламат
            [246, false], // Салимбаев Юлдашбай
            [234, false], // Мурзаев Бекболсун
            [235, false], // Акматов Калдуубай
            [237, false], // Бабажанов Саид
            [240, false], // Долоткелдиев Азамат
            [241, false], // Исабеков Азамат
            [243, false], // Кубанычов Кайрат
            [245, false], // Сакенов Илимбек
            [247, false], // Турсунов Арстанбек
            [254, false], // Мамырбаев
        ]);

        // Goals not available from photos

        // ── Match 3: Топ Тоголок 2-4 Кант  (19.01.2025 19:00, СК КФБ, Бишкек) ──
        $m3 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 2,  // Топ Тоголок
            'away_team_id' => 7,  // Кант
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2025-01-19 19:00:00',
            'status'       => 'completed',
            'home_score'   => 2,
            'away_score'   => 4,
        ]);

        // MVP: Салымбеков Нурсултан (Кант)
        $this->lineup($m3->id, 7, [[2, true]]);

        // ── Match 4: Нарын 6-2 Талас  (19.01.2025 21:00, СК КФБ, Бишкек) ──
        $m4 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 4,  // Нарын
            'away_team_id' => 1,  // Талас
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2025-01-19 21:00:00',
            'status'       => 'completed',
            'home_score'   => 6,
            'away_score'   => 2,
        ]);

        // MVP: Байгазы уулу Уланбек (Нарын)
        $this->lineup($m4->id, 4, [[75, true]]);
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
