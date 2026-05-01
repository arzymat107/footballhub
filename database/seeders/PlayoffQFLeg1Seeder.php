<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Fixture;
use App\Models\FixtureLineup;
use App\Models\Round;
use App\Models\Tie;
use Illuminate\Database\Seeder;

// Суперлига 2024-25 — Плей-офф 1/4 финал, 1-е матчи (19–20 апреля 2025)
// Source: futsal_kgz Instagram posts
class PlayoffQFLeg1Seeder extends Seeder
{
    public function run(): void
    {
        // ── Round ─────────────────────────────────────────────────────────────────
        $round = Round::firstOrCreate(
            ['stage_id' => 2, 'name' => '1/4 финал'],
            ['order' => 1],
        );

        // ── Match 1: Виват 3-7 Art Blast Group  (19.04.2025 19:00, СК КФБ, Бишкек) ──
        $tie1 = Tie::create([
            'round_id'     => $round->id,
            'home_team_id' => 3,  // Виват
            'away_team_id' => 10, // Art Blast Group
            'status'       => 'in_progress',
        ]);

        $m1 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 2,
            'round_id'     => $round->id,
            'tie_id'       => $tie1->id,
            'home_team_id' => 3,
            'away_team_id' => 10,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2025-04-19 19:00:00',
            'status'       => 'completed',
            'home_score'   => 3,
            'away_score'   => 7,
            'leg'          => 1,
        ]);

        $this->lineup($m1->id, 10, [[250, true]]); // Таалайбеков Данияр — MVP

        // ── Match 2: Кант 4-3 ОшМУ  (19.04.2025 21:30, СК КФБ, Бишкек) ──
        $tie2 = Tie::create([
            'round_id'     => $round->id,
            'home_team_id' => 7,  // Кант
            'away_team_id' => 9,  // ОшМУ
            'status'       => 'in_progress',
        ]);

        $m2 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 2,
            'round_id'     => $round->id,
            'tie_id'       => $tie2->id,
            'home_team_id' => 7,
            'away_team_id' => 9,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2025-04-19 21:30:00',
            'status'       => 'completed',
            'home_score'   => 4,
            'away_score'   => 3,
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
            [155, false], // Мелисбек уулу Азамат
            [159, false], // Султанбеков Бекзат
            [281, false], // Саякбаев Кудайберген
            [3,   true],  // Замирбеков Женишбек — MVP
            [2,   false], // Салымбеков Нурсултан
        ]);

        $this->lineup($m2->id, 9, [
            [186, false], // Кудайбердиев Сыймыкбек
            [191, false], // Абдыжалил уулу Айдарбек
            [192, false], // Абылдаев Нурсултан
            [248, false], // Мурзакулов Семетей
            [283, false], // Омурсултанов
            [188, false], // Ураимов Урмат
            [197, false], // Исламов Алымбек
            [199, false], // Муктарали уулу Уланбек
            [207, false], // Эркаев Акылбек
            [249, false], // Аскеров Бахтияр
        ]);

        // ── Match 3: Талас 3-9 Алай  (20.04.2025 19:30, СК КФБ, Бишкек) ──
        // Goals — Алай: Акматов(6'), Турсунов(8',33',35'), Исабеков Азамат(8',14'),
        //               Салимбаев(20'), Кубанычов(32'), Данияр уулу(39')
        //         Талас: Сабырбек уулу(15'), Бактыбек уулу(40'), Кочконов(40')
        $tie3 = Tie::create([
            'round_id'     => $round->id,
            'home_team_id' => 1,  // Талас
            'away_team_id' => 11, // Алай
            'status'       => 'in_progress',
        ]);

        $m3 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 2,
            'round_id'     => $round->id,
            'tie_id'       => $tie3->id,
            'home_team_id' => 1,
            'away_team_id' => 11,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2025-04-20 19:30:00',
            'status'       => 'completed',
            'home_score'   => 3,
            'away_score'   => 9,
            'leg'          => 1,
        ]);

        $this->lineup($m3->id, 1, [
            [6,   false], // Курманбеков Бектур
            [13,  false], // Алымжанов Дастан
            [140, false], // Батырбек уулу Улан
            [8,   false], // Болтобаев Темирлан
            [4,   false], // Жакыпов Руслан
            [137, false], // Уланбек уулу Тилек
            [139, false], // Бактыбек уулу Талас
            [141, false], // Виктор уулу Сабит
            [33,  false], // Кочконов Бекжан
            [11,  false], // Мыктыбеков Аскат
            [143, false], // Сабырбек уулу Майрамбек
            [10,  false], // Сатыбалдиев Айдар
            [35,  false], // Саякбаев Кыяз
        ]);

        $this->lineup($m3->id, 11, [
            [233, false], // Джунушалиев Азирет
            [236, false], // Алимов Максат
            [237, false], // Бабажанов Саид
            [241, false], // Исабеков Азамат
            [246, false], // Салимбаев Юлдашбай
            [235, false], // Акматов Калдуубай
            [238, false], // Данияр уулу Абдурахим
            [242, false], // Исабеков Азат
            [243, false], // Кубанычов Кайрат
            [244, false], // Мамбеталиев Саламат
            [245, false], // Сакенов Илимбек
            [247, true],  // Турсунов Арстанбек — MVP
        ]);

        $this->goal($m3->id, 11, 235, 6);  // Акматов (6')
        $this->goal($m3->id, 11, 247, 8);  // Турсунов (8')
        $this->goal($m3->id, 11, 241, 8);  // Исабеков Азамат (8')
        $this->goal($m3->id, 1,  143, 15); // Сабырбек уулу (15')
        $this->goal($m3->id, 11, 241, 14); // Исабеков Азамат (14')
        $this->goal($m3->id, 11, 246, 20); // Салимбаев (20')
        $this->goal($m3->id, 11, 243, 32); // Кубанычов (32')
        $this->goal($m3->id, 11, 247, 33); // Турсунов (33')
        $this->goal($m3->id, 11, 247, 35); // Турсунов (35')
        $this->goal($m3->id, 11, 238, 39); // Данияр уулу (39')
        $this->goal($m3->id, 1,  139, 40); // Бактыбек уулу (40')
        $this->goal($m3->id, 1,  33,  40); // Кочконов (40')

        // ── Match 4: Нарын 4-2 Топ Тоголок  (20.04.2025 20:00, ФОК "Газпром", Нарын) ──
        $tie4 = Tie::create([
            'round_id'     => $round->id,
            'home_team_id' => 4,  // Нарын
            'away_team_id' => 2,  // Топ Тоголок
            'status'       => 'in_progress',
        ]);

        $m4 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 2,
            'round_id'     => $round->id,
            'tie_id'       => $tie4->id,
            'home_team_id' => 4,
            'away_team_id' => 2,
            'venue'        => 'ФОК "Газпром", Нарын',
            'scheduled_at' => '2025-04-20 20:00:00',
            'status'       => 'completed',
            'home_score'   => 4,
            'away_score'   => 2,
            'leg'          => 1,
        ]);

        $this->lineup($m4->id, 4, [
            [253, false], // Жылкайдар
            [75,  false], // Байгазы уулу Уланбек
            [149, false], // Аянбаев Адил
            [153, false], // Карыпбеков Бекмат
            [71,  false], // Айылчиев Алманбет
            [73,  false], // Айтокторов Нурберген
            [88,  false], // Сыдыков Нурслан
            [89,  true],  // Талантбек уулу Жыргалбек — MVP
            [91,  false], // Турсунбеков Уран
            [274, false], // Джумашов
            [279, false], // Султаналиев
        ]);

        $this->lineup($m4->id, 2, [
            [20,  false], // Куватбек Адил
            [26,  false], // Жаанбаев Актан
            [27,  false], // Иманалиев Элбек
            [42,  false], // Рыстаев Калыбек
            [90,  false], // Таштанов Актай
            [15,  false], // Азатов Амир
            [37,  false], // Ахметов Арлан
            [25,  false], // Ашуров Сыймык
            [21,  false], // Ильясов Бектур
            [28,  false], // Канатбеков Аймен
            [19,  false], // Касмакунов Элдияр
            [136, false], // Токтобек уулу Намыс
            [276, false], // Калбаев
            [270, false], // Карыбеков
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
}