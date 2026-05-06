<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Fixture;
use App\Models\FixtureLineup;
use App\Models\Player;
use App\Models\Round;
use Illuminate\Database\Seeder;

// Суперлига 2025-26 — Matchweek 20 / 2-АЙЛАМПА (28–29 Mar 2026)
// Source: futsal_kgz Instagram posts
class Matchweek20Season2Seeder extends Seeder
{
    public function run(): void
    {
        $round = Round::firstOrCreate(
            ['stage_id' => 4, 'name' => 'Matchweek 20'],
            ['order' => 20],
        );

        $topTogolok = 2;
        $vivat      = 3;
        $naryn      = 4;
        $karakol    = 5;
        $kant       = 7;
        $artBlast   = 10;
        $alay       = 11;
        $toyota     = 15;

        $kultaev       = Player::firstOrCreate(['name' => 'Култаев Адилет'])->id;
        $sharshenbekov = Player::firstOrCreate(['name' => 'Шаршенбеков Алибек'])->id;
        $sultangazievA = Player::firstOrCreate(['name' => 'Султангазиев А'])->id;

        // ── Match 1: Топ Тоголок 3-14 Toyota  (28.03.2026 13:00, СК КФБ, Бишкек) ──
        $m1 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $topTogolok,
            'away_team_id' => $toyota,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2026-03-28 13:00:00',
            'status'       => 'completed',
            'home_score'   => 3,
            'away_score'   => 14,
        ]);

        $this->lineup($m1->id, $topTogolok, [
            [15,  false], // Азатов Амир
            [107, false], // Азамат уулу Айдар
            [24,  false], // Абдымамытов Адахан
            [405, false], // Калбаев Абдулазиз
            [411, false], // Исамидинов Темирлан
            [133, false], // Мухтар уулу Байэл
            [25,  false], // Ашуров Сыймык
            [334, false], // Абдирасулов Актилек
            [62,  false], // Лиров Равил
            [407, false], // Жолдошалиев Ринат
            [408, false], // Токтосунов Дастан
            [409, false], // Нуланбек уулу Нурсултан
        ]);
        $this->lineup($m1->id, $toyota, [
            [233, false], // Джунушалиев Азирет
            [242, true],  // Исабеков Азат (MVP)
            [376, false], // Амандык уулу Денисбек
            [425, false], // Оливейра Веллингтон
            [426, false], // Мориньо Маркос
            [234, false], // Мурзаев Бекболсун
            [240, false], // Долоткелдиев Азамат
            [90,  false], // Таштанов Актай
            [247, false], // Турсунов Арстанбек
            [238, false], // Данияр уулу Абдурахим
            [221, false], // Туратбеков Ислам
            [377, false], // Оруналиев Ильгиз
            [379, false], // Рашанбеков Элдар
            [424, false], // Карыпбеков Дастан
        ]);
        // Топ Тоголок: Калбаев(34'), Ашуров(35'), Абдирасулов(35')
        $this->goal($m1->id, $topTogolok, 405, 34);
        $this->goal($m1->id, $topTogolok, 25,  35);
        $this->goal($m1->id, $topTogolok, 334, 35);
        // Toyota: Амандык у(4'23'39'), Туратбеков(4'35'), Оливейро(8'), Долоткелдиев(8'16'39'),
        //         Данияр у(20'), Исабеков(21'21'22') — note: 13 goals identified, score=14
        $this->goal($m1->id, $toyota, 376, 4);
        $this->goal($m1->id, $toyota, 221, 4);
        $this->goal($m1->id, $toyota, 425, 8);
        $this->goal($m1->id, $toyota, 240, 8);
        $this->goal($m1->id, $toyota, 240, 16);
        $this->goal($m1->id, $toyota, 238, 20);
        $this->goal($m1->id, $toyota, 242, 21);
        $this->goal($m1->id, $toyota, 242, 21);
        $this->goal($m1->id, $toyota, 242, 22);
        $this->goal($m1->id, $toyota, 376, 23);
        $this->goal($m1->id, $toyota, 221, 35);
        $this->goal($m1->id, $toyota, 240, 39);
        $this->goal($m1->id, $toyota, 376, 39);

        // ── Match 2: Алай 3-1 Виват  (28.03.2026 15:00, СК КФБ, Бишкек) ──
        $m2 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $alay,
            'away_team_id' => $vivat,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2026-03-28 15:00:00',
            'status'       => 'completed',
            'home_score'   => 3,
            'away_score'   => 1,
        ]);

        $this->lineup($m2->id, $alay, [
            [295, false],          // Суйорбеков Сагынбек
            [257, false],          // Мурзакарим уулу Асан
            [237, false],          // Бабажанов Саид
            [$kultaev, false],     // Култаев
            [394, false],          // Ишенбек уулу Бакытбек
            [45,  false],          // Султангазиев Илимбек
            [259, false],          // Дурусбеков Таалайнур
            [291, false],          // Бактыбеков Арстанбек
            [89,  true],           // Талантбек уулу Жыргалбек (MVP)
            [292, false],          // Бейшенбеков Максат
            [10,  false],          // Сатыбалдиев Айдар
            [358, false],          // Сатыбалдиев Эльдар
            [$sultangazievA, false], // Султангазиев А
        ]);
        $this->lineup($m2->id, $vivat, [
            [47,  false], // Маликжанов Нурэл
            [57,  false], // Искендербеков
            [60,  false], // Кошонов Канкелди
            [68,  false], // Чиркин Кирилл
            [352, false], // Игольников Илья
            [353, false], // Яфаров Султан
            [52,  false], // Вильямов Бахридин
            [56,  false], // Зажигаев Данил
            [59,  false], // Керимбаев Эмирлан
            [67,  false], // Хамраев Ибрахим
            [69,  false], // Юлдашев Набижан
        ]);
        // Алай: Культаев(10'), Талантбек у(11'38')
        $this->goal($m2->id, $alay, $kultaev, 10);
        $this->goal($m2->id, $alay, 89, 11);
        $this->goal($m2->id, $alay, 89, 38);
        // Виват: Керимбаев(22')
        $this->goal($m2->id, $vivat, 59, 22);

        // ── Match 3: Каракол 4-6 Арт Бласт Групп  (28.03.2026 20:00, ФОК «Каракол», Каракол) ──
        $m3 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $karakol,
            'away_team_id' => $artBlast,
            'venue'        => 'ФОК «Каракол», Каракол',
            'scheduled_at' => '2026-03-28 20:00:00',
            'status'       => 'completed',
            'home_score'   => 4,
            'away_score'   => 6,
        ]);

        $this->lineup($m3->id, $karakol, [
            [396, false],          // Токтобеков Амир
            [105, false],          // Усупов Эрлан
            [326, false],          // Шакилов Ийгилик
            [$sharshenbekov, false], // Шаршенбеков Алибек
            [327, false],          // Дюшебаев
            [94,  false],          // Авазбеков Эрлан
            [100, false],          // Орозбеков Улукбек
            [98,  false],          // Нурбеков Нурсултан
        ]);
        $this->lineup($m3->id, $artBlast, [
            [212, false], // Насирдинов
            [21,  true],  // Ильясов Бектур (MVP)
            [219, false], // Эралиев Мухаммедмуса
            [150, false], // Джанат уулу Самат
            [236, false], // Алимов
            [213, false], // Абдурашит уулу Арген
            [220, false], // Эралиев Мухаммедиса
            [226, false], // Жумадилов Баатырхан
            [227, false], // Мендибаев Нурдин
            [230, false], // Анарбек уулу Акылбек
        ]);
        // Каракол: Орозбеков(9'), Шаршенбеков(19'32'), Авазбеков(27')
        $this->goal($m3->id, $karakol, 100,            9);
        $this->goal($m3->id, $karakol, $sharshenbekov, 19);
        $this->goal($m3->id, $karakol, 94,             27);
        $this->goal($m3->id, $karakol, $sharshenbekov, 32);
        // Арт Бласт: Жумадилов(16'), Ильясов(8'10'), Алимов(20'), Джанат у(27'), Абдурашит у(38')
        $this->goal($m3->id, $artBlast, 21,  8);
        $this->goal($m3->id, $artBlast, 21,  10);
        $this->goal($m3->id, $artBlast, 226, 16);
        $this->goal($m3->id, $artBlast, 236, 20);
        $this->goal($m3->id, $artBlast, 150, 27);
        $this->goal($m3->id, $artBlast, 213, 38);

        // ── Match 4: Кант 3-3 ДС Групп Нарын  (29.03.2026 20:00, ФОК «Кант», Кант) ──
        $m4 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $kant,
            'away_team_id' => $naryn,
            'venue'        => 'ФОК «Кант», Кант',
            'scheduled_at' => '2026-03-29 20:00:00',
            'status'       => 'completed',
            'home_score'   => 3,
            'away_score'   => 3,
        ]);

        $this->lineup($m4->id, $kant, [
            [145, false], // Пензаев Чынгыз
            [152, false], // Кадырбек уулу Ислам
            [151, false], // Исроилов Кутбидин
            [157, false], // Рахманкулов Азамат
            [3,   false], // Замирбеков Женишбек
            [422, false], // Кенешбеков Айбек
            [147, false], // Айдаркул уулу Эрмек
            [162, false], // Шапданбек уулу Жолдошбек
            [155, false], // Мелисбек уулу Азамат
            [222, true],  // Бейшеналиев Урмат (MVP)
            [281, false], // Саякбаев Кудайберген
            [315, false], // Эсенгелдиев Калысбек
            [217, false], // Андабеков Аман
            [159, false], // Султанбеков Бекзат
        ]);
        $this->lineup($m4->id, $naryn, [
            [387, false], // Жабаров Нуриддин
            [75,  false], // Байгазы уулу Уланбек
            [364, false], // Абдыбеков Эржан
            [243, false], // Кубанычов Кайрат
            [385, false], // Данрлей Винаес
            [20,  false], // Куватбек Адил
            [73,  false], // Айтокторов Нурберген
            [91,  false], // Турсунбеков Уран
            [249, false], // Аскеров Бахтияр
            [153, false], // Карыпбеков Бекмат
        ]);
        // Кант: Замирбеков(20'), Султанбеков(28'), Бейшеналиев(30')
        $this->goal($m4->id, $kant, 3,   20);
        $this->goal($m4->id, $kant, 159, 28);
        $this->goal($m4->id, $kant, 222, 30);
        // ДС Групп Нарын: Винхаес(5'), Аскеров(11'), Кубанычов(37')
        $this->goal($m4->id, $naryn, 385, 5);
        $this->goal($m4->id, $naryn, 249, 11);
        $this->goal($m4->id, $naryn, 243, 37);
    }

    private function lineup(int $fixtureId, int $teamId, array $players): void
    {
        foreach ($players as [$playerId, $isMvp]) {
            FixtureLineup::firstOrCreate(
                ['fixture_id' => $fixtureId, 'player_id' => $playerId],
                ['team_id' => $teamId, 'is_mvp' => $isMvp],
            );
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
