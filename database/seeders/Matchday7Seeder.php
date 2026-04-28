<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Fixture;
use App\Models\FixtureLineup;
use App\Models\Round;
use Illuminate\Database\Seeder;

// Суперлига 2024-25 — Matchday 7 (1–2 November 2024)
// Source: futsal_kgz Instagram posts
class Matchday7Seeder extends Seeder
{
    public function run(): void
    {
        $round = Round::firstOrCreate(
            ['stage_id' => 1, 'name' => 'Matchday 7'],
            ['order' => 7],
        );

        // ── Match 1: Кант 2-3 Алай  (01.11.2024 20:00, ФОК "Газпром", Бишкек) ──
        $m1 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 7,  // Кант
            'away_team_id' => 11, // Алай
            'venue'        => 'ФОК "Газпром", Бишкек',
            'scheduled_at' => '2024-11-01 20:00:00',
            'status'       => 'completed',
            'home_score'   => 2,
            'away_score'   => 3,
        ]);

        // Кант lineup
        $this->lineup($m1->id, 7, [
            [145, false], // Пензаев Чынгыз
            [149, false], // Аянбаев Адил
            [152, false], // Кадырбек уулу Ислам
            [157, false], // Рахманкулов Азамат
            [162, false], // Шапданбек уулу Жолдошбек
            [146, false], // Хамидов Акжол
            [147, false], // Айдаркул уулу Эрмек
            [148, false], // Аманбеков Мейирхан
            [153, false], // Карыпбеков Бекмат
            [156, false], // Муратбеков Айдарбек
            [159, false], // Султанбеков Бекзат
            [160, false], // Султанов Эрлан
        ]);

        // Алай lineup
        $this->lineup($m1->id, 11, [
            [234, false], // Мурзаев Бекболсун
            [236, true],  // Алимов Максат — MVP
            [242, false], // Исабеков Азат
            [244, false], // Мамбеталиев Саламат
            [246, false], // Салимбаев Юлдашбай
            [235, false], // Акматов Калдуубай
            [237, false], // Бабажанов Саид
            [239, false], // Джумашев Тилек
            [240, false], // Долоткелдиев Азамат
            [243, false], // Кубанычов Кайрат
            [247, false], // Турсунов Арстанбек
        ]);

        // Goals — Кант (2): Аманбеков 10', Рахманкулов 40'
        //         Алай (3): Салимбаев 17', Алимов 26', Салимбаев 33'
        $this->goal($m1->id, 7,  148, 10); // Аманбеков (10')
        $this->goal($m1->id, 11, 246, 17); // Салимбаев (17')
        $this->goal($m1->id, 11, 236, 26); // Алимов (26')
        $this->goal($m1->id, 11, 246, 33); // Салимбаев (33')
        $this->goal($m1->id, 7,  157, 40); // Рахманкулов (40')

        // ── Match 2: Каракол 4-6 Нарын  (02.11.2024 15:00, ФОК "Газпром", Чолпон-Ата) ──
        $m2 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 5,  // Каракол
            'away_team_id' => 4,  // Нарын
            'venue'        => 'ФОК "Газпром", Чолпон-Ата',
            'scheduled_at' => '2024-11-02 15:00:00',
            'status'       => 'completed',
            'home_score'   => 4,
            'away_score'   => 6,
        ]);

        // Каракол lineup
        $this->lineup($m2->id, 5, [
            [93,  false], // Дюшебаев Ислам
            [99,  false], // Орозакун уулу Султан
            [100, false], // Орозбеков Улукбек
            [103, false], // Усенбаев Бексултан
            [104, false], // Усупов Адилет
            [96,  false], // Бейшекеев Бекмырза
            [97,  false], // Конушбеков Кутман
            [101, false], // Токтобеков Темирлан
            [102, false], // Турсунбеков Муратбек
            [106, false], // Шаршенбиев Ринат
        ]);

        // Нарын lineup
        $this->lineup($m2->id, 4, [
            [71,  false], // Айылчиев Алманбет
            [75,  false], // Байгазы уулу Уланбек
            [78,  false], // Жумабеков Султан
            [88,  false], // Сыдыков Нурслан
            [89,  true],  // Талантбек уулу Жыргалбек — MVP
            [70,  false], // Азат уулу Данияр
            [72,  false], // Кубанычбеков Айбек
            [79,  false], // Жыргалбеков Бактияр
            [81,  false], // Ибраев Ислам
            [83,  false], // Кубанычбеков Марат
            [85,  false], // Марат уулу Эржан
            [86,  false], // Мухтарбек уулу Бакыт
            [87,  false], // Нурлан уулу Эрбол
        ]);

        // Goals — Каракол (4): Орозбеков 2',28',36',40'
        //         Нарын (6): Жумабеков 8', Талантбек уулу 10', Сыдыков 20',28', Нурлан уулу 27',38'
        $this->goal($m2->id, 5,  100, 2);  // Орозбеков (2')
        $this->goal($m2->id, 4,  78,  8);  // Жумабеков (8')
        $this->goal($m2->id, 4,  89,  10); // Талантбек уулу (10')
        $this->goal($m2->id, 4,  88,  20); // Сыдыков (20')
        $this->goal($m2->id, 4,  87,  27); // Нурлан уулу (27')
        $this->goal($m2->id, 5,  100, 28); // Орозбеков (28')
        $this->goal($m2->id, 4,  88,  28); // Сыдыков (28')
        $this->goal($m2->id, 5,  100, 36); // Орозбеков (36')
        $this->goal($m2->id, 4,  87,  38); // Нурлан уулу (38')
        $this->goal($m2->id, 5,  100, 40); // Орозбеков (40')
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