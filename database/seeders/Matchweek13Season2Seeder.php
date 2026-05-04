<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Fixture;
use App\Models\FixtureLineup;
use App\Models\Round;
use Illuminate\Database\Seeder;

// Суперлига 2025-26 — Matchweek 13 (11–14 December 2025)
// Source: futsal_kgz Instagram posts
class Matchweek13Season2Seeder extends Seeder
{
    public function run(): void
    {
        $round = Round::firstOrCreate(
            ['stage_id' => 4, 'name' => 'Matchweek 13'],
            ['order' => 13],
        );

        $artBlast   = 10;
        $vivat      = 3;
        $toyota     = 15;
        $naryn      = 4;
        $kant       = 7;
        $alay       = 11;
        $topTogolok = 2;
        $karakol    = 5;

        // ── Match 1: Артбласт Групп 2-3 Виват  (11.12.2025 17:00, СК КФБ, Бишкек) ──
        $m1 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $artBlast,
            'away_team_id' => $vivat,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2025-12-11 17:00:00',
            'status'       => 'completed',
            'home_score'   => 2,
            'away_score'   => 3,
        ]);

        $this->lineup($m1->id, $artBlast, [
            [210, false], // Жусупов Абдуазим
            [213, false], // Абдурашит уулу Арген
            [218, false], // Кенешбеков Жанарбек
            [250, false], // Талайбеков Данияр
            [227, false], // Мендибаев Нурдин
            [212, false], // Насирдинов Султан
            [150, false], // Джанат уулу Самат
            [220, false], // Эралиев Мухаммедиса
            [226, false], // Жумадилов Баатырхан
            [224, false], // Маматов Артур
            [355, false], // Эгенбергенов Нурдоолот
            [356, false], // Каныбеков Атайбек
            [159, false], // Султанбеков Бекзат
            [236, false], // Алимов Максат
            [231, false], // Самат уулу Алмазбек
        ]);
        $this->lineup($m1->id, $vivat, [
            [353, true],  // Яфаров Султан (MVP)
            [57,  false], // Искендербеков Талгат
            [68,  false], // Чиркин Кирилл
            [352, false], // Игольников Илья
            [27,  false], // Иманалиев Элбек
            [132, false], // Тургунбеков Адыл
            [50,  false], // Анарбеков Нурадил
            [52,  false], // Вильямов Бахридин
            [58,  false], // Кадыров Дильшат
            [59,  false], // Керимбеков Эмирлан
            [63,  false], // Маликов Абдурасул
            [64,  false], // Минкеев Ильзат
            [223, false], // Эсенгелдиев Асылбек
            [147, false], // Айдаркул уулу Эрмек
        ]);
        // Goal breakdown not published

        // ── Match 2: Тойота 3-4 Нарын  (11.12.2025 19:00, СК КФБ, Бишкек) ──
        $m2 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $toyota,
            'away_team_id' => $naryn,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2025-12-11 19:00:00',
            'status'       => 'completed',
            'home_score'   => 3,
            'away_score'   => 4,
        ]);

        $this->lineup($m2->id, $toyota, [
            [234, false], // Мурзаев Бекболсун
            [149, false], // Аянбаев Адил
            [376, false], // Амандык уулу Денисбек
            [238, false], // Данияр уулу Абдурахим
            [221, false], // Туратбеков Ислам
            [233, false], // Джунушалиев Азирет
            [242, false], // Исабеков Азат
            [241, false], // Исабеков Азамат
            [244, false], // Мамбеталиев Саламат
            [90,  false], // Таштанов Актай
            [375, false], // Муратбеков Айдар
            [142, false], // Куттубек уулу Акылбек
            [377, false], // Оруналиев Ильгиз
            [379, false], // Рашанбеков Элдар
        ]);
        $this->lineup($m2->id, $naryn, [
            [75,  false], // Байгазы уулу Уланбек
            [71,  false], // Айылчиев Алманбет
            [364, false], // Абдыбеков Эржан
            [118, true],  // Аскеров Азамат (MVP)
            [153, false], // Карыпбеков Бекмат
            [73,  false], // Айтокторов Нурберген
            [79,  false], // Жыргалбеков Бактияр
            [83,  false], // Кубанычбеков Марат
            [91,  false], // Турсунбеков Уран
            [87,  false], // Нурлан уулу Эрбол
            [365, false], // Рахатбеков Бектен
            [374, false], // Аскербеков Актан
            [369, false], // Замирбеков Марлен
            [370, false], // Эстебесов Амир
        ]);
        // Тойота: Мамбеталиев(10', 14'), Исабеков(23')
        $this->goal($m2->id, $toyota, 244, 10);
        $this->goal($m2->id, $toyota, 244, 14);
        $this->goal($m2->id, $toyota, 242, 23);
        // Нарын: Абдыбеков(26', 33'), Аскеров(29', 39')
        $this->goal($m2->id, $naryn, 364, 26);
        $this->goal($m2->id, $naryn, 118, 29);
        $this->goal($m2->id, $naryn, 364, 33);
        $this->goal($m2->id, $naryn, 118, 39);

        // ── Match 3: Нарын 7-5 Кант  (13.12.2025 18:00, Нарын ФОК «Газпром») ──
        $m3 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $naryn,
            'away_team_id' => $kant,
            'venue'        => 'Нарын ФОК «Газпром»',
            'scheduled_at' => '2025-12-13 18:00:00',
            'status'       => 'completed',
            'home_score'   => 7,
            'away_score'   => 5,
        ]);

        $this->lineup($m3->id, $naryn, [
            [75,  true],  // Байгазы уулу Уланбек (MVP)
            [71,  false], // Айылчиев Алманбет
            [91,  false], // Турсунбеков Уран
            [364, false], // Абдыбеков Эржан
            [153, false], // Карыпбеков Бекмат
            [73,  false], // Айтокторов Нурберген
            [83,  false], // Кубанычбеков Марат
            [86,  false], // Мухтарбек уулу Бакыт
            [87,  false], // Нурлан уулу Эрбол
            [374, false], // Аскербеков Актан
            [165, false], // Эркинбеков Даниел
        ]);
        $this->lineup($m3->id, $kant, [
            [145, false], // Пензаев Чынгыз
            [152, false], // Кадырбек уулу Ислам
            [3,   false], // Замирбеков Женишбек
            [2,   false], // Салымбеков Нурсултан
            [232, false], // Муктарбеков Эльдар
            [151, false], // Исроилов Кутбидин
            [147, false], // Айдаркул уулу Эрмек
            [157, false], // Рахманкулов Азамат
            [162, false], // Шапданбек уулу Жолдошбек
            [155, false], // Мелисбек уулу Азамат
            [222, false], // Бейшеналиев Урмат
            [35,  false], // Саякбаев Кыяз
            [315, false], // Эсенгелдиев Калысбек
            [217, false], // Андабеков Аман
        ]);
        // Нарын: Байгазы У(14'), Абдыбеков(14', 24'), Кубанычбеков(15', 21'), Турсунбеков(29'), Карыпбеков(30')
        $this->goal($m3->id, $naryn, 75,  14);
        $this->goal($m3->id, $naryn, 364, 14);
        $this->goal($m3->id, $naryn, 83,  15);
        $this->goal($m3->id, $naryn, 83,  21);
        $this->goal($m3->id, $naryn, 364, 24);
        $this->goal($m3->id, $naryn, 91,  29);
        $this->goal($m3->id, $naryn, 153, 30);
        // Кант: Замирбеков(2', 18'), Салымбеков(4'), Кадырбек У(8', 17')
        $this->goal($m3->id, $kant, 3,   2);
        $this->goal($m3->id, $kant, 2,   4);
        $this->goal($m3->id, $kant, 152, 8);
        $this->goal($m3->id, $kant, 152, 17);
        $this->goal($m3->id, $kant, 3,   18);

        // ── Match 4: Виват 4-11 Алай  (13.12.2025 19:00, Бишкек ФОК «Газпром») ──
        $m4 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $vivat,
            'away_team_id' => $alay,
            'venue'        => 'Бишкек ФОК «Газпром»',
            'scheduled_at' => '2025-12-13 19:00:00',
            'status'       => 'completed',
            'home_score'   => 4,
            'away_score'   => 11,
        ]);

        $this->lineup($m4->id, $vivat, [
            [132, false], // Тургунбеков Адыл
            [57,  false], // Искендербеков Талгат
            [68,  false], // Чиркин Кирилл
            [352, false], // Игольников Илья
            [27,  false], // Иманалиев Элбек
            [50,  false], // Анарбеков Нурадил
            [52,  false], // Вильямов Бахридин
            [58,  false], // Кадыров Дильшат
            [60,  false], // Кошонов Канкелди
            [63,  false], // Маликов Абдурасул
            [64,  false], // Минкеев Ильзат
            [69,  false], // Юлдашев Набижан
            [223, false], // Эсенгелдиев Асылбек
            [147, false], // Айдаркул уулу Эрмек
        ]);
        $this->lineup($m4->id, $alay, [
            [295, false], // Суйорбеков Сагынбек
            [240, false], // Долоткелдиев Азамат
            [235, false], // Акматов Калдуубай
            [246, false], // Салимбаев Юлдашбай
            [243, false], // Кубанычов Кайрат
            [45,  false], // Султангазиев Илимбек
            [257, true],  // Мурзакарим уулу Асан (MVP)
            [237, false], // Бабажанов Саид
            [259, false], // Дурусбеков Таалайнур
            [289, false], // Садыков Канат
            [292, false], // Бейшенбеков Максат
            [89,  false], // Талантбек уулу Жыргалбек
            [198, false], // Култаев Адилет
        ]);
        // Goal breakdown not published

        // ── Match 5: Тойота 5-4 Топ Тоголок  (14.12.2025 18:00, СК КФБ, Бишкек) ──
        $m5 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $toyota,
            'away_team_id' => $topTogolok,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2025-12-14 18:00:00',
            'status'       => 'completed',
            'home_score'   => 5,
            'away_score'   => 4,
        ]);

        $this->lineup($m5->id, $toyota, [
            [233, false], // Джунушалиев Азирет
            [242, false], // Исабеков Азат
            [244, false], // Мамбеталиев Саламат
            [90,  false], // Таштанов Актай
            [377, false], // Оруналиев Ильгиз
            [234, false], // Мурзаев Бекболсун
            [241, false], // Исабеков Азамат
            [375, false], // Муратбеков Айдар
            [149, true],  // Аянбаев Адил (MVP)
            [376, false], // Амандык уулу Денисбек
            [142, false], // Куттубек уулу Акылбек
            [238, false], // Данияр уулу Абдурахим
            [221, false], // Туратбеков Ислам
            [379, false], // Рашанбеков Элдар
        ]);
        $this->lineup($m5->id, $topTogolok, [
            [15,  false], // Азатов Амир
            [134, false], // Азамат уулу Ильгиз
            [21,  false], // Ильясов Бектур
            [277, false], // Сманов Байэл
            [336, false], // Султанов Нуралы
            [337, false], // Бектуров Эльхан
            [341, false], // Черикбаев Арлен
            [342, false], // Данияров Саян
            [334, false], // Абдирасулов Актилек
            [25,  false], // Ашуров Сыймык
            [24,  false], // Абдымамытов Адахан
            [122, false], // Кубатбеков Белек
        ]);
        // Тойота: Исабеков Азат(19'), Амандык У(30'), + 3 own goals by ТТ players
        $this->goal($m5->id, $toyota, 242, 19);
        $this->goal($m5->id, $toyota, 376, 30);
        $this->ownGoal($m5->id, $toyota, 336, 16); // Султанов АГ → Toyota
        $this->ownGoal($m5->id, $toyota, 21,  22); // Ильясов АГ → Toyota
        $this->ownGoal($m5->id, $toyota, 24,  29); // Абдымамытов АГ → Toyota
        // Топ Тоголок: Азамат У(27', 40'), Сманов(28'), Ашуров(31')
        $this->goal($m5->id, $topTogolok, 134, 27);
        $this->goal($m5->id, $topTogolok, 277, 28);
        $this->goal($m5->id, $topTogolok, 25,  31);
        $this->goal($m5->id, $topTogolok, 134, 40);

        // ── Match 6: Артбласт Групп 6-2 Каракол  (14.12.2025 20:00, СК КФБ, Бишкек) ──
        $m6 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $artBlast,
            'away_team_id' => $karakol,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2025-12-14 20:00:00',
            'status'       => 'completed',
            'home_score'   => 6,
            'away_score'   => 2,
        ]);

        $this->lineup($m6->id, $artBlast, [
            [212, true],  // Насирдинов Султан (MVP)
            [231, false], // Самат уулу Алмазбек
            [220, false], // Эралиев Мухаммедиса
            [226, false], // Жумадилов Баатырхан
            [236, false], // Алимов Максат
            [210, false], // Жусупов Абдуазим
            [213, false], // Абдурашит уулу Арген
            [218, false], // Кенешбеков Жанарбек
            [250, false], // Талайбеков Данияр
            [227, false], // Мендибаев Нурдин
            [150, false], // Джанат уулу Самат
            [224, false], // Маматов Артур
            [355, false], // Эгенбергенов Нурдоолот
            [159, false], // Султанбеков Бекзат
        ]);
        $this->lineup($m6->id, $karakol, [
            [105, false], // Усупов Эрлан
            [326, false], // Шакилов Ийгилик
            [327, false], // Дюшембаев Жанарбек
            [100, false], // Орозбеков Улукбек
            [88,  false], // Сыдыков Нурслан
            [106, false], // Шаршенбиев Ринат
            [94,  false], // Авазбеков Эрлан
            [331, false], // Дамиров Бежжан
        ]);
        // Артбласт: Жумадилов(2'), Султанбеков(4'), Джанат(6'), Алимов(25', 35'), Мендибаев(30')
        $this->goal($m6->id, $artBlast, 226, 2);
        $this->goal($m6->id, $artBlast, 159, 4);
        $this->goal($m6->id, $artBlast, 150, 6);
        $this->goal($m6->id, $artBlast, 236, 25);
        $this->goal($m6->id, $artBlast, 227, 30);
        $this->goal($m6->id, $artBlast, 236, 35);
        // Каракол: Шаршенбиев(7'), Сыдыков(29')
        $this->goal($m6->id, $karakol, 106, 7);
        $this->goal($m6->id, $karakol, 88,  29);
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