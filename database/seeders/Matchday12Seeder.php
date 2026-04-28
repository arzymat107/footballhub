<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Fixture;
use App\Models\FixtureLineup;
use App\Models\Round;
use Illuminate\Database\Seeder;

// Суперлига 2024-25 — Matchday 12 (30 November – 1 December 2024)
// Source: futsal_kgz Instagram posts
class Matchday12Seeder extends Seeder
{
    public function run(): void
    {
        $round = Round::firstOrCreate(
            ['stage_id' => 1, 'name' => 'Matchday 12'],
            ['order' => 12],
        );

        // ── Match 1: Алай 4-2 Шам  (30.11.2024 20:00, СК КФБ, Бишкек) ──
        $m1 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 11, // Алай
            'away_team_id' => 6,  // Шам
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2024-11-30 20:00:00',
            'status'       => 'completed',
            'home_score'   => 4,
            'away_score'   => 2,
        ]);

        // Алай lineup
        $this->lineup($m1->id, 11, [
            [234, false], // Мурзаев Бекболсун
            [236, false], // Алимов Максат
            [237, false], // Бабажанов Саид
            [242, false], // Исабеков Азат
            [246, false], // Салимбаев Юлдашбай
            [233, false], // Жунушалиев Азирет
            [235, false], // Акматов Калдуубай
            [239, false], // Джумашев Тилек
            [243, false], // Кубанычов Кайрат
            [245, false], // Сакенов Илимбек
            [247, true],  // Турсунов Арстанбек — MVP
        ]);

        // Шам lineup
        $this->lineup($m1->id, 6, [
            [108, false], // Джамгырчиев Азат
            [112, false], // Айыпов
            [124, false], // Мукаев Келдибек
            [125, false], // Оморов Бексултан
            [129, false], // Чотбаев Ильяс
            [107, false], // Азамат уулу Айдар
            [110, false], // Абакиров Акжолтой
            [111, false], // Абдыбеков Эдил
            [113, false], // Акылбек уулу
            [116, false], // Асанбеков Эмир
            [119, false], // Галиев Мелис
            [120, false], // Джумабек уулу Эрнст
            [123, false], // Майрамбеков Султан
            [126, false], // Самудин уулу Заманбек
        ]);

        // Goals — Алай (4): Алимов 25', Турсунов 30',32',39'
        //         Шам (2): Мукаев 24', Оморов 24'
        $this->goal($m1->id, 6,  124, 24); // Мукаев (24')
        $this->goal($m1->id, 6,  125, 24); // Оморов (24')
        $this->goal($m1->id, 11, 236, 25); // Алимов (25')
        $this->goal($m1->id, 11, 247, 30); // Турсунов (30')
        $this->goal($m1->id, 11, 247, 32); // Турсунов (32')
        $this->goal($m1->id, 11, 247, 39); // Турсунов (39')

        // ── Match 2: Каракол 2-4 Талас  (01.12.2024 18:00, ФОК "Каракол", Каракол) ──
        $m2 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 5,  // Каракол
            'away_team_id' => 1,  // Талас
            'venue'        => 'ФОК "Каракол", Каракол',
            'scheduled_at' => '2024-12-01 18:00:00',
            'status'       => 'completed',
            'home_score'   => 2,
            'away_score'   => 4,
        ]);

        // Каракол lineup
        $this->lineup($m2->id, 5, [
            [93,  false], // Дюшебаев Ислам
            [97,  false], // Конушбеков Кутман
            [100, false], // Орозбеков Улукбек
            [104, false], // Усупов Адилет
            [106, false], // Шаршенбиев Ринат
            [94,  false], // Авазбеков Эрлан
            [96,  false], // Бейшекеев Бекмырза
            [98,  false], // Нурбеков
            [99,  false], // Орозакун уулу Султан
            [101, false], // Токтобеков Темирлан
            [102, false], // Турсунбеков Муратбек
            [103, false], // Усенбаев Бексултан
        ]);

        // Талас lineup
        $this->lineup($m2->id, 1, [
            [6,   false], // Курманбеков
            [13,  false], // Алымжанов
            [4,   true],  // Жакыпов Руслан — MVP
            [3,   false], // Замирбеков
            [2,   false], // Салымбеков
            [139, false], // Бактыбек уулу
            [140, false], // Батырбек уулу
            [8,   false], // Болтобаев
            [142, false], // Куттубек уулу
            [11,  false], // Мыктыбеков
            [143, false], // Сабырбек уулу
            [35,  false], // Саякбаев Кыяз
            [10,  false], // Сатыбалдиев
            [36,  false], // Шабданов
        ]);

        // Goals not available from photos

        // ── Match 3: Кант 5-2 Виват  (01.12.2024 19:00, СК КФБ, Бишкек) ──
        $m3 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 7,  // Кант
            'away_team_id' => 3,  // Виват
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2024-12-01 19:00:00',
            'status'       => 'completed',
            'home_score'   => 5,
            'away_score'   => 2,
        ]);

        // Кант lineup
        $this->lineup($m3->id, 7, [
            [146, false], // Хамидов Акжол
            [149, true],  // Аянбаев Адил — MVP
            [152, false], // Кадырбек уулу Ислам
            [153, false], // Карыпбеков Бекмат
            [157, false], // Рахманкулов Азамат
            [145, false], // Пензаев Чынгыз
            [147, false], // Айдаркул уулу Эрмек
            [148, false], // Аманбеков Мейирхан
            [151, false], // Исроилов Кутбидин
            [154, false], // Мамытов Эльдияр
            [155, false], // Мелисбек уулу Азамат
            [159, false], // Султанбеков Бекзат
            [160, false], // Султанов Эрлан
            [162, false], // Шапданбек уулу Жолдошбек
        ]);

        // Виват lineup
        $this->lineup($m3->id, 3, [
            [46,  false], // Кыргызов Айбек
            [58,  false], // Кадыров Дильшат
            [62,  false], // Лиров Равил
            [64,  false], // Минкеев Ильзат
            [68,  false], // Чиркин Кирилл
            [48,  false], // Сардарбеков Белек
            [50,  false], // Анарбеков Нурадил
            [53,  false], // Вильямов Сухраб
            [54,  false], // Джумабеков Тариэл
            [57,  false], // Искендербеков Талгат
            [63,  false], // Маликов Абдурасул
            [65,  false], // Назаралиев Урмат
            [66,  false], // Тимченко Артем
            [67,  false], // Хамраев Ибрахим
        ]);

        // Goals — Кант (5): Султанов 13',30', Аянбаев 14', Кадырбек уулу 16', Исроилов 40'
        //         Виват (2): Анарбеков 29',36'
        $this->goal($m3->id, 7, 160, 13); // Султанов (13')
        $this->goal($m3->id, 7, 149, 14); // Аянбаев (14')
        $this->goal($m3->id, 7, 152, 16); // Кадырбек уулу (16')
        $this->goal($m3->id, 3, 50,  29); // Анарбеков (29')
        $this->goal($m3->id, 7, 160, 30); // Султанов (30')
        $this->goal($m3->id, 3, 50,  36); // Анарбеков (36')
        $this->goal($m3->id, 7, 151, 40); // Исроилов (40')

        // ── Match 4: Топ Тоголок 2-6 Дордой  (01.12.2024 21:00, СК КФБ, Бишкек) ──
        $m4 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 2,  // Топ Тоголок
            'away_team_id' => 10, // Дордой
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2024-12-01 21:00:00',
            'status'       => 'completed',
            'home_score'   => 2,
            'away_score'   => 6,
        ]);

        // Топ Тоголок lineup
        $this->lineup($m4->id, 2, [
            [15,  false], // Азатов Амир
            [24,  false], // Абдымамытов Адахан
            [134, false], // Азамат уулу Ильгиз
            [21,  false], // Ильясов Бектур
            [28,  false], // Канатбеков Аймен
            [20,  false], // Куватбек Адил
            [37,  false], // Ахметов Арлан
            [25,  false], // Ашуров Сыймык
            [16,  false], // Бактыбеков Эржан
            [18,  false], // Доолотов Эрбол
            [26,  false], // Жаанбаев Актан
            [27,  false], // Иманалиев Элбек
            [19,  false], // Касмакунов Элдияр
            [42,  false], // Рыстаев Калыбек
        ]);

        // Дордой lineup
        $this->lineup($m4->id, 10, [
            [210, false], // Жусупов Абдуазим
            [213, false], // Абдурашит уулу Арген
            [218, false], // Кенешбеков Жанарбек
            [231, true],  // Самат уулу Алмазбек — MVP
            [221, false], // Туратбеков Ислам
            [212, false], // Насирдинов Султан
            [230, false], // Анарбек уулу Акылбек
            [217, false], // Андабеков Аман
            [222, false], // Бейшеналиев Урмат
            [227, false], // Мендибаев Нурдин
            [232, false], // Муктарбеков Эльдар
            [214, false], // Сулайманбеков Айдар
            [223, false], // Эсенгелдиев Асылбек
            [219, false], // Эралиев Мухаммедмуса
        ]);

        // Goals — Топ Тоголок (2): Касмакунов 5', Азамат уулу 22'
        //         Дордой (6): Самат уулу 14',14',19',36'; Абдурашит уулу 21'; Анарбек уулу 32'
        $this->goal($m4->id, 2,  19,  5);  // Касмакунов (5')
        $this->goal($m4->id, 10, 231, 14); // Самат уулу (14')
        $this->goal($m4->id, 10, 231, 14); // Самат уулу (14')
        $this->goal($m4->id, 10, 231, 19); // Самат уулу (19')
        $this->goal($m4->id, 10, 213, 21); // Абдурашит уулу (21')
        $this->goal($m4->id, 2,  134, 22); // Азамат уулу (22')
        $this->goal($m4->id, 10, 230, 32); // Анарбек уулу (32')
        $this->goal($m4->id, 10, 231, 36); // Самат уулу (36')
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