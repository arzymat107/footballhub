<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Fixture;
use App\Models\FixtureLineup;
use App\Models\Player;
use App\Models\PlayerTeamSeason;
use App\Models\Round;
use App\Models\Tie;
use Illuminate\Database\Seeder;

// Суперлига 2024-25 — Плей-офф 1/2 финал, 1-е матчи (3–4 мая 2025)
// Source: futsal_kgz Instagram posts
class PlayoffSFLeg1Seeder extends Seeder
{
    public function run(): void
    {
        $round = Round::firstOrCreate(
            ['stage_id' => 2, 'name' => '1/2 финал'],
            ['order' => 2],
        );

        // ── New players (not in prior lineups) ───────────────────────────────────
        $daribayev = Player::firstOrCreate(['name' => 'Дарибаев']);
        PlayerTeamSeason::firstOrCreate(
            ['player_id' => $daribayev->id, 'team_id' => 4, 'season_id' => 1]
        );

        // ── Match 1: Нарын 1-4 Алай  (03.05.2025 20:00, ФОК "Газпром", Нарын) ──
        // Series 1-0 to Алай.
        // Goals — Алай: Долоткелдиев(3'), Алимов(12'), Кубанычов(15'), Акматов(36')
        //         Нарын: Талантбек уулу(34')
        $tie1 = Tie::create([
            'round_id'     => $round->id,
            'home_team_id' => 4,  // Нарын
            'away_team_id' => 11, // Алай
            'status'       => 'in_progress',
        ]);

        $m1 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 2,
            'round_id'     => $round->id,
            'tie_id'       => $tie1->id,
            'home_team_id' => 4,  // Нарын
            'away_team_id' => 11, // Алай
            'venue'        => 'ФОК "Газпром", Нарын',
            'scheduled_at' => '2025-05-03 20:00:00',
            'status'       => 'completed',
            'home_score'   => 1,
            'away_score'   => 4,
            'leg'          => 1,
        ]);

        $this->lineup($m1->id, 4, [
            [71,                false], // Айылчиев Алманбет
            [75,                false], // Байгазы уулу Уланбек
            [149,               false], // Аянбаев Адил
            [153,               false], // Карыпбеков Бекмат
            [$daribayev->id,    false], // Дарибаев
            [82,                false], // Исаков Данияр
            [83,                false], // Кубанычбеков Марат
            [86,                false], // Мухтарбек уулу Бакыт
            [87,                false], // Нурлан уулу Эрбол
            [88,                false], // Сыдыков Нурслан
            [89,                false], // Талантбек уулу Жыргалбек
            [91,                false], // Турсунбеков Уран
            [274,               false], // Джумашов
            [279,               false], // Султаналиев
        ]);

        $this->lineup($m1->id, 11, [
            [233, false], // Жунушалиев Азирет
            [235, false], // Акматов Калдуубай
            [238, false], // Данияр уулу Абдурахим
            [243, false], // Кубанычов Кайрат
            [247, false], // Турсунов Арстанбек
            [234, false], // Мурзаев Бекболсун
            [236, false], // Алимов Максат
            [240, false], // Долоткелдиев Азамат
            [242, false], // Исабеков Азат
            [244, false], // Мамбеталиев Саламат
            [246, true],  // Салимбаев Юлдашбай — MVP
        ]);

        $this->goal($m1->id, 11, 240, 3);  // Долоткелдиев (3')
        $this->goal($m1->id, 11, 236, 12); // Алимов (12')
        $this->goal($m1->id, 11, 243, 15); // Кубанычов (15')
        $this->goal($m1->id, 4,  89,  34); // Талантбек уулу (34')
        $this->goal($m1->id, 11, 235, 36); // Акматов (36')

        // ── Match 2: Кант 3-5 Art Blast Group  (04.05.2025 20:00, СК КФБ, Бишкек) ──
        // Series 1-0 to ABG.
        // Goals — Кант: Султанбеков(8'), Замирбеков(17'), Кадырбек уулу(20')
        //         ABG:  Салымбеков(5'АГ), Туратбеков(12'), Самат уулу(22'),
        //               Андабеков(25'), Эралиев Муса(32')
        $tie2 = Tie::create([
            'round_id'     => $round->id,
            'home_team_id' => 7,  // Кант
            'away_team_id' => 10, // Art Blast Group
            'status'       => 'in_progress',
        ]);

        $m2 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 2,
            'round_id'     => $round->id,
            'tie_id'       => $tie2->id,
            'home_team_id' => 7,  // Кант
            'away_team_id' => 10, // ABG
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2025-05-04 20:00:00',
            'status'       => 'completed',
            'home_score'   => 3,
            'away_score'   => 5,
            'leg'          => 1,
        ]);

        $this->lineup($m2->id, 7, [
            [145, false], // Пензаев Чынгыз
            [151, false], // Исроилов Кутбидин
            [152, false], // Кадырбек уулу Ислам
            [157, false], // Рахманкулов Азамат
            [162, false], // Шапданбек уулу Жолдошбек
            [146, false], // Хамидов Акжол
            [147, false], // Айдаркул уулу Эрмек
            [150, false], // Джанат уулу Самат
            [154, false], // Мамытов Эльдияр
            [155, false], // Мелисбек уулу Азамат
            [159, false], // Султанбеков Бекзат
            [281, false], // Саякбаев Кудайберген
            [3,   false], // Замирбеков Женишбек
            [2,   false], // Салымбеков Нурсултан
        ]);

        $this->lineup($m2->id, 10, [
            [210, false], // Жусупов Абдуазим
            [213, false], // Абдурашит уулу Арген
            [218, false], // Кенешбеков Жанарбек
            [231, false], // Самат уулу Алмазбек
            [250, false], // Талайбеков Данияр
            [212, false], // Насирдинов Султан
            [230, false], // Анарбек уулу Акылбек
            [217, false], // Андабеков Аман
            [226, false], // Жумадилов Баатырхан
            [227, false], // Мендибаев Нурдин
            [232, false], // Муктарбеков Эльдар
            [225, false], // Сулайманбеков Данияр
            [221, true],  // Туратбеков Ислам — MVP
            [219, false], // Эралиев Мухаммедмуса
        ]);

        $this->ownGoal($m2->id, 7,  2,   5);  // Салымбеков АГ (5')
        $this->goal($m2->id,    10, 221, 12); // Туратбеков (12')
        $this->goal($m2->id,    7,  159, 8);  // Султанбеков (8')
        $this->goal($m2->id,    7,  3,   17); // Замирбеков (17')
        $this->goal($m2->id,    10, 231, 22); // Самат уулу (22')
        $this->goal($m2->id,    7,  152, 20); // Кадырбек уулу (20')
        $this->goal($m2->id,    10, 217, 25); // Андабеков (25')
        $this->goal($m2->id,    10, 219, 32); // Эралиев Муса (32')
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