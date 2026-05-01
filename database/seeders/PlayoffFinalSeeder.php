<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Fixture;
use App\Models\FixtureLineup;
use App\Models\Round;
use App\Models\Stage;
use App\Models\Tie;
use Illuminate\Database\Seeder;

// Суперлига 2024-25 — Финальная серия (до 3 побед), игры 1-4 (30.05–08.06.2025)
// Алай выиграл серию 3-1, стал чемпионом.
// Source: futsal_kgz Instagram posts
class PlayoffFinalSeeder extends Seeder
{
    public function run(): void
    {
        $stage = Stage::firstOrCreate(
            ['season_id' => 1, 'name' => 'Финальная серия'],
            ['type' => 'knockout', 'order' => 3, 'wins_required' => 3, 'home_away' => true],
        );

        $round = Round::firstOrCreate(
            ['stage_id' => $stage->id, 'name' => 'Финал'],
            ['order' => 1],
        );

        $tie = Tie::create([
            'round_id'     => $round->id,
            'home_team_id' => 10, // Art Blast Group (home games 1-2)
            'away_team_id' => 11, // Алай (home games 3-4)
            'status'       => 'in_progress',
        ]);

        // ── ABG lineup used in games 1, 2, 4 ─────────────────────────────────────
        $abgMain = [
            [210, false], // Жусупов Абдуазим
            [213, false], // Абдурашит уулу Арген
            [218, false], // Кенешбеков Жанарбек
            [231, false], // Самат уулу Алмазбек
            [250, false], // Талайбеков Данияр
            [212, false], // Насирдинов Султан
            [230, false], // Анарбек уулу Акылбек
            [217, false], // Андабеков Аман
            [226, false], // Жумадилов Баатырхан
            [229, false], // Канетов Эмил
            [227, false], // Мендибаев Нурдин
            [232, false], // Муктарбеков Эльдар
            [221, false], // Туратбеков Ислам
            [219, false], // Эралиев Мухаммедмуса
        ];

        // ── Game 1: ABG 2-2 Алай  (30.05.2025 21:00, ФОК "Газпром", Бишкек) ──
        // Алай выигрывает серию послематчевых пенальти. Series 1-0 to Алай.
        // Goals — ABG:  Кенешбеков(28'), Эралиев Муса(47')
        //         Алай: Долоткелдиев(32'), Кубанычов(47')
        $m1 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => $stage->id,
            'round_id'     => $round->id,
            'tie_id'       => $tie->id,
            'home_team_id' => 10, // ABG
            'away_team_id' => 11, // Алай
            'venue'        => 'ФОК "Газпром", Бишкек',
            'scheduled_at' => '2025-05-30 21:00:00',
            'status'       => 'completed',
            'home_score'   => 2,
            'away_score'   => 2,
            'leg'          => 1,
        ]);

        $abgMain[0] = [210, false]; // reset MVP flag
        $this->lineup($m1->id, 10, $abgMain);

        $this->lineup($m1->id, 11, [
            [233, true],  // Жунушалиев Азирет — MVP
            [236, false], // Алимов Максат
            [240, false], // Долоткелдиев Азамат
            [244, false], // Мамбеталиев Саламат
            [246, false], // Салимбаев Юлдашбай
            [234, false], // Мурзаев Бекболсун
            [235, false], // Акматов Калдуубай
            [237, false], // Бабажанов Саид
            [238, false], // Данияр уулу Абдурахим
            [242, false], // Исабеков Азат
            [241, false], // Исабеков Азамат
            [243, false], // Кубанычов Кайрат
            [245, false], // Сакенов Илимбек
            [247, false], // Турсунов Арстанбек
        ]);

        $this->goal($m1->id, 10, 218, 28); // Кенешбеков (28')
        $this->goal($m1->id, 11, 240, 32); // Долоткелдиев (32')
        $this->goal($m1->id, 11, 243, 47); // Кубанычов (47')
        $this->goal($m1->id, 10, 219, 47); // Эралиев Муса (47')

        // ── Game 2: ABG 6-5 Алай  (01.06.2025 20:00, СК КФБ, Бишкек) ──
        // Series 1-1.
        // Goals — ABG:  Жусупов(9'), Анарбек уулу(10',15'), Туратбеков(10'),
        //               Муктарбеков(17'), Талайбеков(36')
        //         Алай: Мамбеталиев(3',39'), Алимов(10'), Турсунов(27'), Кубанычов(34')
        $m2 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => $stage->id,
            'round_id'     => $round->id,
            'tie_id'       => $tie->id,
            'home_team_id' => 10, // ABG
            'away_team_id' => 11, // Алай
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2025-06-01 20:00:00',
            'status'       => 'completed',
            'home_score'   => 6,
            'away_score'   => 5,
            'leg'          => 2,
        ]);

        $abgG2 = $abgMain;
        $abgG2[4] = [250, true]; // Талайбеков — MVP
        $this->lineup($m2->id, 10, $abgG2);

        $this->lineup($m2->id, 11, [
            [233, false], // Жунушалиев Азирет
            [236, false], // Алимов Максат
            [242, false], // Исабеков Азат
            [244, false], // Мамбеталиев Саламат
            [246, false], // Салимбаев Юлдашбай
            [234, false], // Мурзаев Бекболсун
            [235, false], // Акматов Калдуубай
            [237, false], // Бабажанов Саид
            [238, false], // Данияр уулу Абдурахим
            [240, false], // Долоткелдиев Азамат
            [241, false], // Исабеков Азамат
            [243, false], // Кубанычов Кайрат
            [245, false], // Сакенов Илимбек
            [247, false], // Турсунов Арстанбек
        ]);

        $this->goal($m2->id, 11, 244, 3);  // Мамбеталиев (3')
        $this->goal($m2->id, 10, 210, 9);  // Жусупов (9')
        $this->goal($m2->id, 10, 230, 10); // Анарбек уулу (10')
        $this->goal($m2->id, 10, 221, 10); // Туратбеков (10')
        $this->goal($m2->id, 11, 236, 10); // Алимов (10')
        $this->goal($m2->id, 10, 230, 15); // Анарбек уулу (15')
        $this->goal($m2->id, 10, 232, 17); // Муктарбеков (17')
        $this->goal($m2->id, 11, 247, 27); // Турсунов (27')
        $this->goal($m2->id, 11, 243, 34); // Кубанычов (34')
        $this->goal($m2->id, 10, 250, 36); // Талайбеков (36')
        $this->goal($m2->id, 11, 244, 39); // Мамбеталиев (39')

        // ── Game 3: Алай 8-5 ABG  (06.06.2025 21:10, ФОК "Газпром", Бишкек) ──
        // Series 2-1 to Алай.
        // Goals — Алай: Алимов(14',40'), Мамбеталиев(19'), Салимбаев(20',22',38'),
        //               Долоткелдиев(27'), Кубанычов(35')
        //         ABG:  Жумадилов(5'), Салимбаев АГ(10'), Абдурашит уулу(32'),
        //               Самат уулу(37',39')
        $m3 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => $stage->id,
            'round_id'     => $round->id,
            'tie_id'       => $tie->id,
            'home_team_id' => 11, // Алай
            'away_team_id' => 10, // ABG
            'venue'        => 'ФОК "Газпром", Бишкек',
            'scheduled_at' => '2025-06-06 21:10:00',
            'status'       => 'completed',
            'home_score'   => 8,
            'away_score'   => 5,
            'leg'          => 3,
        ]);

        // ABG starts Насирдинов in goal instead of Жусупов
        $abgG3 = $abgMain;
        $abgG3[0] = [212, false]; // Насирдинов starts
        $abgG3[5] = [210, false]; // Жусупов to bench
        $this->lineup($m3->id, 10, $abgG3);

        $this->lineup($m3->id, 11, [
            [233, false], // Жунушалиев Азирет
            [240, false], // Долоткелдиев Азамат
            [243, false], // Кубанычов Кайрат
            [244, false], // Мамбеталиев Саламат
            [247, false], // Турсунов Арстанбек
            [234, false], // Мурзаев Бекболсун
            [235, false], // Акматов Калдуубай
            [236, false], // Алимов Максат
            [237, false], // Бабажанов Саид
            [238, false], // Данияр уулу Абдурахим
            [241, false], // Исабеков Азамат
            [242, false], // Исабеков Азат
            [245, false], // Сакенов Илимбек
            [246, true],  // Салимбаев Юлдашбай — MVP
        ]);

        $this->goal($m3->id,    10, 226, 5);  // Жумадилов (5')
        $this->ownGoal($m3->id, 11, 246, 10); // Салимбаев АГ (10')
        $this->goal($m3->id,    11, 236, 14); // Алимов (14')
        $this->goal($m3->id,    11, 244, 19); // Мамбеталиев (19')
        $this->goal($m3->id,    11, 246, 20); // Салимбаев (20')
        $this->goal($m3->id,    11, 246, 22); // Салимбаев (22')
        $this->goal($m3->id,    11, 240, 27); // Долоткелдиев (27')
        $this->goal($m3->id,    10, 213, 32); // Абдурашит уулу (32')
        $this->goal($m3->id,    11, 243, 35); // Кубанычов (35')
        $this->goal($m3->id,    10, 231, 37); // Самат уулу (37')
        $this->goal($m3->id,    11, 246, 38); // Салимбаев (38')
        $this->goal($m3->id,    10, 231, 39); // Самат уулу (39')
        $this->goal($m3->id,    11, 236, 40); // Алимов (40')

        // ── Game 4: Алай 1-0 ABG  (08.06.2025 21:00, ФОК "Газпром", Бишкек) ──
        // Алай выигрывает серию 3-1. АЛАЙ — ЧЕМПИОН!
        // Goal — Акматов (минута не опубликована)
        $m4 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => $stage->id,
            'round_id'     => $round->id,
            'tie_id'       => $tie->id,
            'home_team_id' => 11, // Алай
            'away_team_id' => 10, // ABG
            'venue'        => 'ФОК "Газпром", Бишкек',
            'scheduled_at' => '2025-06-08 21:00:00',
            'status'       => 'completed',
            'home_score'   => 1,
            'away_score'   => 0,
            'leg'          => 4,
        ]);

        $abgG4 = $abgMain;
        $this->lineup($m4->id, 10, $abgG4);

        $this->lineup($m4->id, 11, [
            [234, true],  // Мурзаев Бекболсун — MVP
            [240, false], // Долоткелдиев Азамат
            [243, false], // Кубанычов Кайрат
            [244, false], // Мамбеталиев Саламат
            [247, false], // Турсунов Арстанбек
            [233, false], // Жунушалиев Азирет
            [235, false], // Акматов Калдуубай
            [236, false], // Алимов Максат
            [237, false], // Бабажанов Саид
            [238, false], // Данияр уулу Абдурахим
            [241, false], // Исабеков Азамат
            [242, false], // Исабеков Азат
            [245, false], // Сакенов Илимбек
            [246, false], // Салимбаев Юлдашбай
        ]);

        Event::create([
            'fixture_id' => $m4->id,
            'team_id'    => 11,
            'player_id'  => 235, // Акматов Калдуубай
            'type'       => 'goal',
            'minute'     => null,
        ]);

        $tie->update(['status' => 'completed', 'winner_id' => 11]);
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