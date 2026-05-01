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

// Суперлига 2024-25 — Плей-офф 1/2 финал, 2-е матчи (18 мая 2025)
// Source: futsal_kgz Instagram posts
class PlayoffSFLeg2Seeder extends Seeder
{
    public function run(): void
    {
        $round = Round::where('stage_id', 2)->where('name', '1/2 финал')->firstOrFail();

        // ── Lookup existing ties ──────────────────────────────────────────────────
        $tie1 = Tie::where('round_id', $round->id)->where('home_team_id', 4)->where('away_team_id', 11)->firstOrFail();  // Нарын vs Алай
        $tie2 = Tie::where('round_id', $round->id)->where('home_team_id', 7)->where('away_team_id', 10)->firstOrFail();  // Кант vs ABG

        // ── New players (not in prior lineups) ───────────────────────────────────
        $daribayev  = Player::firstOrCreate(['name' => 'Дарибаев']);
        $ashimaliev = Player::firstOrCreate(['name' => 'Ашималиев']);
        PlayerTeamSeason::firstOrCreate(
            ['player_id' => $daribayev->id,  'team_id' => 4, 'season_id' => 1],
        );
        PlayerTeamSeason::firstOrCreate(
            ['player_id' => $ashimaliev->id, 'team_id' => 4, 'season_id' => 1],
        );

        // ── Match 1: Алай 9-3 Нарын  (18.05.2025 19:00, ФОК "Газпром", Бишкек) ──
        // Алай wins series 2-0.
        // Goals — Алай: Кубанычов(1',7',22'), Сыдыков АГ(2'), Исабеков Азат(16',38'),
        //               Акматов(22'), Алимов(33'), Жунушалиев(37')
        //         Нарын: Талантбек уулу(14',34'), Салимбаев АГ(15')
        $m1 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 2,
            'round_id'     => $round->id,
            'tie_id'       => $tie1->id,
            'home_team_id' => 11, // Алай
            'away_team_id' => 4,  // Нарын
            'venue'        => 'ФОК "Газпром", Бишкек',
            'scheduled_at' => '2025-05-18 19:00:00',
            'status'       => 'completed',
            'home_score'   => 9,
            'away_score'   => 3,
            'leg'          => 2,
        ]);

        $this->lineup($m1->id, 11, [
            [233, false], // Жунушалиев Азирет
            [235, false], // Акматов Калдуубай
            [238, false], // Данияр уулу Абдурахим
            [243, true],  // Кубанычов Кайрат — MVP
            [247, false], // Турсунов Арстанбек
            [234, false], // Мурзаев Бекболсун
            [236, false], // Алимов Максат
            [237, false], // Бабажанов Саид
            [240, false], // Долоткелдиев Азамат
            [242, false], // Исабеков Азат
            [241, false], // Исабеков Азамат
            [245, false], // Сакенов Илимбек
            [244, false], // Мамбеталиев Саламат
            [246, false], // Салимбаев Юлдашбай
        ]);

        $this->lineup($m1->id, 4, [
            [71,                false], // Айылчиев Алманбет
            [75,                false], // Байгазы уулу Уланбек
            [82,                false], // Исаков Данияр
            [88,                false], // Сыдыков Нурслан
            [89,                false], // Талантбек уулу Жыргалбек
            [73,                false], // Айтокторов Нурберген
            [149,               false], // Аянбаев Адил
            [$ashimaliev->id,   false], // Ашималиев
            [274,               false], // Джумашов
            [153,               false], // Карыпбеков Бекмат
            [$daribayev->id,    false], // Дарибаев
        ]);

        $this->goal($m1->id,     11, 243, 1);  // Кубанычов (1')
        $this->ownGoal($m1->id,  4,  88,  2);  // Сыдыков АГ (2')
        $this->goal($m1->id,     11, 243, 7);  // Кубанычов (7')
        $this->goal($m1->id,     4,  89,  14); // Талантбек уулу (14')
        $this->ownGoal($m1->id,  11, 246, 15); // Салимбаев АГ (15')
        $this->goal($m1->id,     11, 242, 16); // Исабеков Азат (16')
        $this->goal($m1->id,     11, 243, 22); // Кубанычов (22')
        $this->goal($m1->id,     11, 235, 22); // Акматов (22')
        $this->goal($m1->id,     11, 236, 33); // Алимов (33')
        $this->goal($m1->id,     4,  89,  34); // Талантбек уулу (34')
        $this->goal($m1->id,     11, 233, 37); // Жунушалиев (37')
        $this->goal($m1->id,     11, 242, 38); // Исабеков Азат (38')

        $tie1->update(['status' => 'completed', 'winner_id' => 11]);

        // ── Match 2: Art Blast Group 6-4 Кант  (18.05.2025 21:30, ФОК "Газпром", Бишкек) ──
        // ABG wins series 2-0.
        // Goals — ABG:  Талайбеков(11',19',37'), Абдурашит уулу(28'), Туратбеков(37'),
        //               Андабеков(40')
        //         Кант: Салымбеков(35'), Кадырбек уулу(36',37'), Джанат уулу(38')
        $m2 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 2,
            'round_id'     => $round->id,
            'tie_id'       => $tie2->id,
            'home_team_id' => 10, // Art Blast Group
            'away_team_id' => 7,  // Кант
            'venue'        => 'ФОК "Газпром", Бишкек',
            'scheduled_at' => '2025-05-18 21:30:00',
            'status'       => 'completed',
            'home_score'   => 6,
            'away_score'   => 4,
            'leg'          => 2,
        ]);

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
            [226, false], // Жумадилов Баатырхан
            [227, false], // Мендибаев Нурдин
            [232, false], // Муктарбеков Эльдар
            [221, false], // Туратбеков Ислам
            [219, false], // Эралиев Мухаммедмуса
        ]);

        $this->lineup($m2->id, 7, [
            [145, false], // Пензаев Чынгыз
            [150, false], // Джанат уулу Самат
            [152, false], // Кадырбек уулу Ислам
            [157, false], // Рахманкулов Азамат
            [162, false], // Шапданбек уулу Жолдошбек
            [146, false], // Хамидов Акжол
            [147, false], // Айдаркул уулу Эрмек
            [154, false], // Мамытов Эльдияр
            [155, false], // Мелисбек уулу Азамат
            [159, false], // Султанбеков Бекзат
            [161, false], // Туткучев Кайрат
            [281, false], // Саякбаев Кудайберген
            [3,   false], // Замирбеков Женишбек
            [2,   false], // Салымбеков Нурсултан
        ]);

        $this->goal($m2->id, 10, 250, 11); // Талайбеков (11')
        $this->goal($m2->id, 10, 250, 19); // Талайбеков (19')
        $this->goal($m2->id, 10, 213, 28); // Абдурашит уулу (28')
        $this->goal($m2->id, 7,  2,   35); // Салымбеков (35')
        $this->goal($m2->id, 7,  152, 36); // Кадырбек уулу (36')
        $this->goal($m2->id, 10, 250, 37); // Талайбеков (37')
        $this->goal($m2->id, 10, 221, 37); // Туратбеков (37')
        $this->goal($m2->id, 7,  152, 37); // Кадырбек уулу (37')
        $this->goal($m2->id, 7,  150, 38); // Джанат уулу (38')
        $this->goal($m2->id, 10, 217, 40); // Андабеков (40')

        $tie2->update(['status' => 'completed', 'winner_id' => 10]);
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