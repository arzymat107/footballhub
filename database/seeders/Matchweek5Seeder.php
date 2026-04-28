<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Fixture;
use App\Models\FixtureLineup;
use App\Models\Round;
use Illuminate\Database\Seeder;

// Суперлига 2024-25 — Matchweek 5 (17–19 October 2024)
// Source: futsal_kgz Instagram posts
class Matchweek5Seeder extends Seeder
{
    public function run(): void
    {
        $round = Round::firstOrCreate(
            ['stage_id' => 1, 'name' => 'Matchweek 5'],
            ['order' => 5],
        );

        // ── Match 1: Дордой 3-0 Виват  (17.10.2024 20:00, ФОК "Газпром", Бишкек) ──
        $m1 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 10, // Дордой
            'away_team_id' => 3,  // Виват
            'venue'        => 'ФОК "Газпром", Бишкек',
            'scheduled_at' => '2024-10-17 20:00:00',
            'status'       => 'completed',
            'home_score'   => 3,
            'away_score'   => 0,
        ]);

        // Дордой lineup
        $this->lineup($m1->id, 10, [
            [210, false], // Жусупов Абдуазим
            [230, false], // Анарбек уулу Акылбек
            [226, false], // Жумадилов Баатырхан
            [221, true],  // Туратбеков Ислам — MVP
            [220, false], // Эралиев Мухаммедиса
            [212, false], // Насирдинов Султан
            [213, false], // Абдурашит уулу Арген
            [222, false], // Бейшеналиев Урмат
            [229, false], // Канетов Эмил
            [216, false], // Мелисов Нурсултан
            [227, false], // Мендибаев Нурдин
            [215, false], // Рысбеков Дастан
            [231, false], // Самат уулу Алмазбек
            [219, false], // Эралиев Мухаммедмуса
        ]);

        // Виват lineup
        $this->lineup($m1->id, 3, [
            [46, false],  // Кыргызов Айбек
            [58, false],  // Кадыров Дильшат
            [62, false],  // Лиров Равил
            [64, false],  // Минкеев Ильзат
            [68, false],  // Чиркин Кирилл
            [132, false], // Тургунбеков Адыл
            [50, false],  // Анарбеков Нурадил
            [51, false],  // Ачилов Канымет
            [52, false],  // Вильямов Бахридин
            [63, false],  // Маликов Абдурасул
            [54, false],  // Джумабеков Тариэл
            [57, false],  // Искендербеков Талгат
            [66, false],  // Тимченко Артем
            [69, false],  // Юлдашев Набижан
        ]);

        // Дордой goals
        $this->goal($m1->id, 10, 222, 10); // Бейшеналиев (10')
        $this->goal($m1->id, 10, 220, 18); // Эралиев Иса (18')
        $this->goal($m1->id, 10, 221, 31); // Туратбеков (31')

        // ── Match 2: Кант 3-4 Каракол  (18.10.2024 19:00, ФОК "Газпром", Бишкек) ──
        $m2 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 7,  // Кант
            'away_team_id' => 5,  // Каракол
            'venue'        => 'ФОК "Газпром", Бишкек',
            'scheduled_at' => '2024-10-18 19:00:00',
            'status'       => 'completed',
            'home_score'   => 3,
            'away_score'   => 4,
        ]);

        // Кант lineup
        $this->lineup($m2->id, 7, [
            [145, false], // Пензаев Чынгыз
            [148, false], // Аманбеков Мейирхан
            [149, false], // Аянбаев Адил
            [159, false], // Султанбеков Бекзат
            [161, false], // Туткучев Кайрат
            [146, false], // Хамидов Акжол
            [147, false], // Айдаркул уулу Эрмек
            [151, false], // Исроилов Кутбидин
            [152, false], // Кадырбек уулу Ислам
            [153, false], // Карыпбеков Бекмат
            [155, false], // Мелисбек уулу Азамат
            [157, false], // Рахманкулов Азамат
            [160, false], // Султанов Эрлан
            [162, false], // Шапданбек уулу Жолдошбек
        ]);

        // Каракол lineup
        $this->lineup($m2->id, 5, [
            [93, false],  // Дюшебаев Ислам
            [99, false],  // Орозакун уулу Султан
            [100, false], // Орозбеков Улукбек
            [103, false], // Усенбаев Бексултан
            [105, true],  // Усупов Эрлан — MVP
            [92, false],  // Дамирбеков Белек
            [94, false],  // Авазбеков Эрлан
            [96, false],  // Бейшекеев Бекмырза
            [102, false], // Турсунбеков Муратбек
            [104, false], // Усупов Адилет
        ]);

        // Goals
        $this->goal($m2->id, 5,  105, 3);  // Усупов Э (3')
        $this->goal($m2->id, 7,  152, 4);  // Кадырбек у (4')
        $this->goal($m2->id, 5,  105, 23); // Усупов Э (23')
        $this->goal($m2->id, 5,  100, 26); // Орозбеков (26')
        $this->goal($m2->id, 7,  157, 26); // Рахманкулов (26')
        $this->goal($m2->id, 5,  99,  27); // Орозакун у (27')
        $this->goal($m2->id, 7,  157, 32); // Рахманкулов (32')

        // ── Match 3: Алай 4-1 Топ Тоголок  (18.10.2024 21:00, ФОК "Газпром", Бишкек) ──
        $m3 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 11, // Алай
            'away_team_id' => 2,  // Топ Тоголок
            'venue'        => 'ФОК "Газпром", Бишкек',
            'scheduled_at' => '2024-10-18 21:00:00',
            'status'       => 'completed',
            'home_score'   => 4,
            'away_score'   => 1,
        ]);

        // Алай lineup
        $this->lineup($m3->id, 11, [
            [233, false], // Джунушалиев Азирет
            [236, true],  // Алимов Максат — MVP
            [242, false], // Исабеков Азат
            [244, false], // Мамбеталиев Саламат
            [246, false], // Салимбаев Юлдашбай
            [234, false], // Мурзаев Бекболсун
            [235, false], // Акматов Калдуубай
            [237, false], // Бабажанов Саид
            [239, false], // Джумашев Тилек
            [240, false], // Долоткелдиев Азамат
            [243, false], // Кубанычов Кайрат
            [245, false], // Сакенов Илимбек
            [247, false], // Турсунов Арстанбек
        ]);

        // Топ Тоголок lineup
        $this->lineup($m3->id, 2, [
            [15, false],  // Азатов Амир
            [134, false], // Азамат уулу Ильгиз
            [21, false],  // Ильясов Бектур
            [27, false],  // Иманалиев Элбек
            [28, false],  // Канатбеков Аймен
            [45, false],  // Султангазиев Илимбек
            [24, false],  // Абдымамытов Адахан
            [37, false],  // Ахметов Арлан
            [25, false],  // Ашуров Сыймык
            [18, false],  // Доолотов Эрбол
            [16, false],  // Бактыбеков Эржан
            [26, false],  // Жаанбаев Актан
            [42, false],  // Рыстаев Калыбек
            [136, false], // Токтобек уулу Намыс
        ]);

        // Goals
        $this->goal($m3->id, 11, 244, 2);  // Мамбеталиев (2')
        $this->goal($m3->id, 2,  16,  18); // Бактыбеков (18')
        $this->goal($m3->id, 11, 247, 25); // Турсунов (25')
        $this->goal($m3->id, 11, 244, 28); // Мамбеталиев (28')
        $this->goal($m3->id, 11, 236, 39); // Алимов (39')

        // ── Match 4: Шам 6-8 Нарын  (19.10.2024 16:00, ФОК "Газпром", Чолпон-Ата) ──
        $m4 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 6,  // Шам
            'away_team_id' => 4,  // Нарын
            'venue'        => 'ФОК "Газпром", Чолпон-Ата',
            'scheduled_at' => '2024-10-19 16:00:00',
            'status'       => 'completed',
            'home_score'   => 6,
            'away_score'   => 8,
        ]);

        // Шам lineup
        $this->lineup($m4->id, 6, [
            [108, false], // Джамгырчиев Азат
            [116, false], // Асанбеков Эмир
            [120, false], // Джумабек уулу Эрнст
            [122, false], // Кубатбеков Белек
            [125, false], // Оморов Бексултан
            [107, false], // Азамат уулу Айдар
            [115, false], // Асанбеков Азирет
            [117, false], // Аскаров Нурланбек
            [118, false], // Аскеров Азамат
            [119, false], // Галиев Мелис
            [129, false], // Чотбаев Ильяс
            [123, false], // Майрамбеков Султан
            [124, false], // Мукаев Келдибек
            [126, false], // Самудин уулу Заманбек
        ]);

        // Нарын lineup
        $this->lineup($m4->id, 4, [
            [71, false],  // Айылчиев Алманбет
            [73, false],  // Айтокторов Нурберген
            [75, false],  // Байгазы уулу Уланбек
            [83, false],  // Кубанычбеков Марат
            [90, true],   // Таштанов Актай — MVP
            [70, false],  // Азат уулу Данияр
            [72, false],  // Кубанычбеков Айбек
            [76, false],  // Бакаев Даниэль
            [79, false],  // Жыргалбеков Бактияр
            [85, false],  // Марат уулу Эржан
            [86, false],  // Мухтарбек уулу Бакыт
            [87, false],  // Нурлан уулу Эрбол
        ]);

        // Goals — Шам (6): Оморов 2',17',24'; Аскеров 6'; Кубатбеков 11'; Чотбаев 40'
        $this->goal($m4->id, 4, 90,  1);  // Таштанов (1')
        $this->goal($m4->id, 6, 125, 2);  // Оморов (2')
        $this->goal($m4->id, 6, 118, 6);  // Аскеров (6')
        $this->goal($m4->id, 4, 87,  9);  // Нурлан у (9')
        $this->goal($m4->id, 6, 122, 11); // Кубатбеков (11')
        $this->goal($m4->id, 4, 87,  12); // Нурлан у (12')
        $this->goal($m4->id, 4, 90,  13); // Таштанов (13')
        $this->goal($m4->id, 6, 125, 17); // Оморов (17')
        $this->goal($m4->id, 4, 83,  17); // Кубанычбеков М (17')
        $this->goal($m4->id, 4, 83,  23); // Кубанычбеков М (23')
        $this->goal($m4->id, 4, 90,  23); // Таштанов (23')
        $this->goal($m4->id, 6, 125, 24); // Оморов (24')
        $this->goal($m4->id, 4, 87,  36); // Нурлан у (36')
        $this->goal($m4->id, 6, 129, 40); // Чотбаев (40')
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
