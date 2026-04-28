<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Fixture;
use App\Models\FixtureLineup;
use App\Models\Round;
use Illuminate\Database\Seeder;

// Суперлига 2024-25 — Matchday 9 (16–17 November 2024)
// Source: futsal_kgz Instagram posts
class Matchday9Seeder extends Seeder
{
    public function run(): void
    {
        $round = Round::firstOrCreate(
            ['stage_id' => 1, 'name' => 'Matchday 9'],
            ['order' => 9],
        );

        // ── Match 1: Шам 4-4 Каракол  (16.11.2024 16:00, ФОК "Газпром", Чолпон-Ата) ──
        $m1 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 6,  // Шам
            'away_team_id' => 5,  // Каракол
            'venue'        => 'ФОК "Газпром", Чолпон-Ата',
            'scheduled_at' => '2024-11-16 16:00:00',
            'status'       => 'completed',
            'home_score'   => 4,
            'away_score'   => 4,
        ]);

        // Шам lineup
        $this->lineup($m1->id, 6, [
            [108, false], // Джамгырчиев Азат
            [112, false], // Айыпов
            [118, true],  // Аскеров Азамат — MVP
            [125, false], // Оморов Бексултан
            [129, false], // Чотбаев Ильяс
            [107, false], // Азамат уулу Айдар
            [110, false], // Абакиров
            [113, false], // Акылбек уулу
            [120, false], // Джумабек уулу Эрнст
            [123, false], // Майрамбеков Султан
            [124, false], // Мукаев Келдибек
            [131, false], // Эсенбаев
        ]);

        // Каракол lineup
        $this->lineup($m1->id, 5, [
            [92,  false], // Дамирбеков Белек
            [97,  false], // Конушбеков Кутман
            [100, false], // Орозбеков Улукбек
            [103, false], // Усенбаев Бексултан
            [106, false], // Шаршенбиев Ринат
            [94,  false], // Авазбеков Эрлан
            [96,  false], // Бейшекеев Бекмырза
            [98,  false], // Нурбеков
            [99,  false], // Орозакун уулу Султан
            [102, false], // Турсунбеков Муратбек
        ]);

        // Goals — Шам (4): Орозбеков 4', Аскеров 10',10',27', Оморов 22'  — wait: 4 goals
        // Шам: Аскеров(10',10',27'), Оморов(22') = 4 goals
        // Каракол: Орозбеков(4',29'), Шаршенбиев(26',31') = 4 goals
        $this->goal($m1->id, 5,  100, 4);  // Орозбеков (4')
        $this->goal($m1->id, 6,  118, 10); // Аскеров (10')
        $this->goal($m1->id, 6,  118, 10); // Аскеров (10')
        $this->goal($m1->id, 6,  125, 22); // Оморов (22')
        $this->goal($m1->id, 6,  118, 27); // Аскеров (27')
        $this->goal($m1->id, 5,  106, 26); // Шаршенбиев (26')
        $this->goal($m1->id, 5,  100, 29); // Орозбеков (29')
        $this->goal($m1->id, 5,  106, 31); // Шаршенбиев (31')

        // ── Match 2: Нарын 4-5 Кант  (16.11.2024 16:20, ФОК "Газпром", Нарын) ──
        $m2 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 4,  // Нарын
            'away_team_id' => 7,  // Кант
            'venue'        => 'ФОК "Газпром", Нарын',
            'scheduled_at' => '2024-11-16 16:20:00',
            'status'       => 'completed',
            'home_score'   => 4,
            'away_score'   => 5,
        ]);

        // Нарын lineup
        $this->lineup($m2->id, 4, [
            [71,  false], // Айылчиев Алманбет
            [75,  false], // Байгазы уулу Уланбек
            [78,  false], // Жумабеков Султан
            [86,  false], // Мухтарбек уулу Бакыт
            [91,  false], // Турсунбеков
            [70,  false], // Азат уулу Данияр
            [74,  false], // Афзунов
            [76,  false], // Бакаев Даниэль
            [79,  false], // Жыргалбеков Бактияр
            [81,  false], // Ибраев Ислам
            [87,  false], // Нурлан уулу Эрбол
            [89,  false], // Талантбек уулу Жыргалбек
            [90,  false], // Таштанов Актай
        ]);

        // Кант lineup
        $this->lineup($m2->id, 7, [
            [145, false], // Пензаев Чынгыз
            [149, false], // Аянбаев Адил
            [152, true],  // Кадырбек уулу Ислам — MVP
            [157, false], // Рахманкулов Азамат
            [162, false], // Шапданбек уулу Жолдошбек
            [146, false], // Хамидов Акжол
            [147, false], // Айдаркул уулу Эрмек
            [151, false], // Исроилов Кутбидин
            [153, false], // Карыпбеков Бекмат
            [155, false], // Мелисбек уулу Азамат
            [156, false], // Муратбеков Айдарбек
            [159, false], // Султанбеков Бекзат
            [161, false], // Туткучев Кайрат
        ]);

        // Goals not captured from photos — no events added

        // ── Match 3: Виват 3-4 Топ Тоголок  (17.11.2024 19:00, СК КФБ, Бишкек) ──
        $m3 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 3,  // Виват
            'away_team_id' => 2,  // Топ Тоголок
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2024-11-17 19:00:00',
            'status'       => 'completed',
            'home_score'   => 3,
            'away_score'   => 4,
        ]);

        // Виват lineup
        $this->lineup($m3->id, 3, [
            [132, false], // Тургунбеков Адыл
            [50,  false], // Анарбеков Нурадил
            [58,  false], // Кадыров Дильшат
            [62,  false], // Лиров Равил
            [63,  false], // Маликов Абдурасул
            [46,  false], // Кыргызов Айбек
            [52,  false], // Вильямов Бахридин
            [54,  false], // Джумабеков Тариэл
            [56,  false], // Зажигаев
            [57,  false], // Искендербеков Талгат
            [60,  false], // Кошонов
            [64,  false], // Минкеев Ильзат
            [65,  false], // Назаралиев
            [68,  false], // Чиркин Кирилл
        ]);

        // Топ Тоголок lineup
        $this->lineup($m3->id, 2, [
            [20,  true],  // Куватбек Адил — MVP
            [134, false], // Азамат уулу Ильгиз
            [16,  false], // Бактыбеков Эржан
            [18,  false], // Доолотов Эрбол
            [19,  false], // Касмакунов
            [15,  false], // Азатов Амир
            [24,  false], // Абдымамытов Адахан
            [37,  false], // Ахметов Арлан
            [25,  false], // Ашуров Сыймык
            [26,  false], // Жаанбаев Актан
            [27,  false], // Иманалиев Элбек
            [28,  false], // Канатбеков Аймен
            [42,  false], // Рыстаев Калыбек
        ]);

        // Goals — Виват (3): Джумабеков 14', Анарбеков 32', Кадыров 40'
        //         Топ Тоголок (4): Канатбеков 5', Ахметов 13', Касмакунов 18', Рыстаев 33'
        $this->goal($m3->id, 2,  28,  5);  // Канатбеков (5')
        $this->goal($m3->id, 2,  37,  13); // Ахметов (13')
        $this->goal($m3->id, 3,  54,  14); // Джумабеков (14')
        $this->goal($m3->id, 2,  19,  18); // Касмакунов (18')
        $this->goal($m3->id, 3,  50,  32); // Анарбеков (32')
        $this->goal($m3->id, 2,  42,  33); // Рыстаев (33')
        $this->goal($m3->id, 3,  58,  40); // Кадыров (40')

        // ── Match 4: Талас 3-3 Алай  (17.11.2024 21:00, СК КФБ, Бишкек) ──
        $m4 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 1,  // Талас
            'away_team_id' => 11, // Алай
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2024-11-17 21:00:00',
            'status'       => 'completed',
            'home_score'   => 3,
            'away_score'   => 3,
        ]);

        // Талас lineup
        $this->lineup($m4->id, 1, [
            [6,   false], // Курманбеков
            [140, true],  // Батырбек уулу Улан — MVP
            [4,   false], // Жакыпов
            [3,   false], // Замирбеков
            [2,   false], // Салымбеков
            [13,  false], // Алымжанов
            [139, false], // Бактыбек уулу
            [8,   false], // Болтобаев
            [141, false], // Виктор уулу
            [12,  false], // Мукушбеков
            [143, false], // Сабырбек уулу
            [11,  false], // Мыктыбеков
            [10,  false], // Сатыбалдиев
            [36,  false], // Шабданов
        ]);

        // Алай lineup
        $this->lineup($m4->id, 11, [
            [233, false], // Джунушалиев Азирет
            [235, false], // Акматов Калдуубай
            [240, false], // Долоткелдиев Азамат
            [243, false], // Кубанычов Кайрат
            [244, false], // Мамбеталиев Саламат
            [234, false], // Мурзаев Бекболсун
            [237, false], // Бабажанов Саид
            [241, false], // Исабеков Азамат
            [245, false], // Сакенов Илимбек
            [242, false], // Исабеков Азат
        ]);

        // Goals — Талас (3): Жакыпов 1',32', Мукушбеков 13'
        //         Алай (3): Исабеков Азамат 15', Акматов 20', Кубанычов 35'
        $this->goal($m4->id, 1,  4,   1);  // Жакыпов (1')
        $this->goal($m4->id, 11, 241, 15); // Исабеков Азамат (15')
        $this->goal($m4->id, 1,  12,  13); // Мукушбеков (13')
        $this->goal($m4->id, 11, 235, 20); // Акматов (20')
        $this->goal($m4->id, 1,  4,   32); // Жакыпов (32')
        $this->goal($m4->id, 11, 243, 35); // Кубанычов (35')
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