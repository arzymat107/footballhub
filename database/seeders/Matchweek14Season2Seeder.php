<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Fixture;
use App\Models\FixtureLineup;
use App\Models\Round;
use Illuminate\Database\Seeder;

// Суперлига 2025-26 — Matchweek 14 / 2-АЙЛАМПА (14–15 February 2026)
// Source: futsal_kgz Instagram posts
class Matchweek14Season2Seeder extends Seeder
{
    public function run(): void
    {
        $round = Round::firstOrCreate(
            ['stage_id' => 4, 'name' => 'Matchweek 14'],
            ['order' => 14],
        );

        $liderOshmu = 13;
        $zhashMuun  = 12;
        $dostuk     = 14;
        $vivat      = 3;
        $kant       = 7;
        $artBlast   = 10;
        $topTogolok = 2;
        $alay       = 11;
        $naryn      = 4;
        $toyota     = 15;
        $talas      = 1;
        $karakol    = 5;

        // ── Match 1: Лидер-ОШМУ 4-1 Жаш Муун  (14.02.2026 14:00, Ош СК «Шавкат») ──
        $m1 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $liderOshmu,
            'away_team_id' => $zhashMuun,
            'venue'        => 'Ош СК «Шавкат»',
            'scheduled_at' => '2026-02-14 14:00:00',
            'status'       => 'completed',
            'home_score'   => 4,
            'away_score'   => 1,
        ]);

        $this->lineup($m1->id, $liderOshmu, [
            [186, false], // Кудайбердиев Сыймыкбек
            [248, true],  // Мурзакулов Семетей (MVP)
            [317, false], // Токоев Арсланбек
            [323, false], // Эргешов Шахзодбек
            [65,  false], // Назаралиев Урмат
            [384, false], // Кыялбеков Семетей
            [199, false], // Муктарали уулу Уланбек
            [203, false], // Ташбалтаев Абдыкадыр
            [316, false], // Базарбек уулу Байэл
            [168, false], // Алмазбеков Омурбек
            [201, false], // Ражапов Сыймык
            [197, false], // Исламов Алымбек
            [321, false], // Абдурахманов Мухаммадали
            [184, false], // Эргашев Диёрбек
        ]);
        $this->lineup($m1->id, $zhashMuun, [
            [269, false], // Абдувалиев Омурали
            [302, false], // Пахридинов Гупронидин
            [416, false], // Шахапов Элмырза
            [418, false], // Абдувалиев Аслидин
            [246, false], // Салимбаев Юлдашбай
            [420, false], // Мамиров Зухридин
            [299, false], // Сайфуллаев Хожиакбар
            [300, false], // Жанторев Билал
            [301, false], // Таштемиров Абдурофи
            [268, false], // Арапов Кубатбек
            [306, false], // Махаматкулов Мухаммадали
            [415, false], // Зульпиев Тиллабай
            [311, false], // Далишов Абдуллох
        ]);
        // Лидер-ОШМУ: Абдурахманов(9'), Назаралиев(10'), Абдурахманов(17'), Мурзакулов(34')
        $this->goal($m1->id, $liderOshmu, 321, 9);
        $this->goal($m1->id, $liderOshmu, 65,  10);
        $this->goal($m1->id, $liderOshmu, 321, 17);
        $this->goal($m1->id, $liderOshmu, 248, 34);
        // Жаш Муун: Махаматкулов(19')
        $this->goal($m1->id, $zhashMuun, 306, 19);

        // ── Match 2: Достук 4-4 Виват  (14.02.2026 18:00, СК КФБ, Бишкек) ──
        $m2 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $dostuk,
            'away_team_id' => $vivat,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2026-02-14 18:00:00',
            'status'       => 'completed',
            'home_score'   => 4,
            'away_score'   => 4,
        ]);

        $this->lineup($m2->id, $dostuk, [
            [46,  false], // Кыргызов Айбек
            [178, false], // Сайдалиев Дамирбек
            [166, false], // Абдуллаев Мухаммадсодик
            [170, false], // Жакыпов Даулес
            [19,  false], // Касмакунов Элдияр
            [49,  false], // Шамонин Станислав
            [360, false], // Бейшенов Бабур
            [362, false], // Абдумажидов Абдуллах
            [404, false], // Айтбаев Азамат
            [270, false], // Карыбеков Даниэл
            [361, false], // Бакиев Али
            [359, false], // Токтогонов Улукман
            [335, false], // Бекбоев Кутман
        ]);
        $this->lineup($m2->id, $vivat, [
            [353, false], // Яфаров Султан
            [58,  false], // Кадыров Дильшат
            [223, true],  // Эсенгелдиев Асылбек (MVP)
            [352, false], // Игольников Илья
            [27,  false], // Иманалиев Элбек
            [132, false], // Тургунбеков Адыл
            [52,  false], // Вильямов Бахридин
            [56,  false], // Зажигаев Данил
            [57,  false], // Искендербеков Талгат
            [59,  false], // Керимбаев Эмирлан
            [60,  false], // Кошонов Канкелди
            [64,  false], // Минкеев Ильзат
            [68,  false], // Чиркин Кирилл
        ]);
        // Достук: Касмакунов(1'), Абдуллаев(19'), Айтбаев(20'), Касмакунов(32')
        $this->goal($m2->id, $dostuk, 19,  1);
        $this->goal($m2->id, $dostuk, 166, 19);
        $this->goal($m2->id, $dostuk, 404, 20);
        $this->goal($m2->id, $dostuk, 19,  32);
        // Виват: Игольников(2'), Кадыров(3'), Искендербеков(34'), Кадыров(40')
        $this->goal($m2->id, $vivat, 352, 2);
        $this->goal($m2->id, $vivat, 58,  3);
        $this->goal($m2->id, $vivat, 57,  34);
        $this->goal($m2->id, $vivat, 58,  40);

        // ── Match 3: Кант 3-3 Арт Бласт Групп  (14.02.2026 19:00, ФОК «Кант», Кант) ──
        $m3 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $kant,
            'away_team_id' => $artBlast,
            'venue'        => 'ФОК «Кант», Кант',
            'scheduled_at' => '2026-02-14 19:00:00',
            'status'       => 'completed',
            'home_score'   => 3,
            'away_score'   => 3,
        ]);

        $this->lineup($m3->id, $kant, [
            [145, false], // Пензаев Чынгыз
            [152, false], // Кадырбек уулу Ислам
            [162, false], // Шапданбек уулу Жолдошбек
            [3,   false], // Замирбеков Женишбек
            [232, false], // Муктарбеков Эльдар
            [422, false], // Кенешбеков Айбек
            [151, false], // Исроилов Кутбидин
            [157, false], // Рахманкулов Азамат
            [155, false], // Мелисбек уулу Азамат
            [222, false], // Бейшеналиев Урмат
            [2,   false], // Салымбеков Нурсултан
            [315, false], // Эсенгелдиев Калысбек
            [217, false], // Андабеков Аман
            [159, false], // Султанбеков Бекзат
        ]);
        $this->lineup($m3->id, $artBlast, [
            [210, false], // Жусупов Абдуазим
            [213, false], // Абдурашит уулу Арген
            [218, false], // Кенешбеков Жанарбек
            [250, false], // Талайбеков Данияр
            [16,  false], // Бактыбеков Эржан
            [212, false], // Насирдинов Султан
            [21,  false], // Ильясов Бектур
            [220, false], // Эралиев Мухаммедиса
            [226, false], // Жумадилов Баатырхан
            [219, false], // Эралиев Мухаммедмуса
            [230, false], // Анарбек уулу Акылбек
            [150, false], // Джанат уулу Самат
            [356, false], // Каныбеков Атайбек
            [236, true],  // Алимов Максат (MVP)
        ]);
        // Кант: Замирбеков(2'), Муктарбеков(10'), Муктарбеков(27')
        $this->goal($m3->id, $kant, 3,   2);
        $this->goal($m3->id, $kant, 232, 10);
        $this->goal($m3->id, $kant, 232, 27);
        // Арт Бласт: Бактыбеков(13'), Жумадилов(16'), Алимов(33')
        $this->goal($m3->id, $artBlast, 16,  13);
        $this->goal($m3->id, $artBlast, 226, 16);
        $this->goal($m3->id, $artBlast, 236, 33);

        // ── Match 4: Топ Тоголок 3-3 Алай  (14.02.2026 20:00, СК КФБ, Бишкек) ──
        $m4 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $topTogolok,
            'away_team_id' => $alay,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2026-02-14 20:00:00',
            'status'       => 'completed',
            'home_score'   => 3,
            'away_score'   => 3,
        ]);

        $this->lineup($m4->id, $topTogolok, [
            [15,  false], // Азатов Амир
            [134, false], // Азамат уулу Ильгиз
            [24,  false], // Абдымамытов Адахан
            [25,  false], // Ашуров Сыймык
            [411, false], // Исамидинов Темирлан
            [133, false], // Мухтар уулу Байэл
            [334, false], // Абдирасулов Актилек
            [277, true],  // Сманов Байэл (MVP)
            [342, false], // Данияров Саян
            [405, false], // Калбаев Абдулазиз
            [407, false], // Жолдошалиев Ринат
            [408, false], // Токтосунов Дастан
            [245, false], // Сакенов Илимбек
            [275, false], // Кылычбек уулу Урмат
        ]);
        $this->lineup($m4->id, $alay, [
            [45,  false], // Султангазиев Илимбек
            [237, false], // Бабажанов Саид
            [259, false], // Дурусбеков Таалайнур
            [235, false], // Акматов Калдуубай
            [198, false], // Култаев Адилет
            [295, false], // Суйорбеков Сагынбек
            [257, false], // Мурзакарим уулу Асан
            [291, false], // Бактыбеков Арстанбек
            [292, false], // Бейшенбеков Максат
            [394, false], // Ишенбек уулу Бакытбек
            [10,  false], // Сатыбалдиев Айдар
            [358, false], // Сатыбалдиев Эльдар
        ]);
        // Топ Тоголок: Калбаев(4'), Азамат У(19'), Сманов(39')
        $this->goal($m4->id, $topTogolok, 405, 4);
        $this->goal($m4->id, $topTogolok, 134, 19);
        $this->goal($m4->id, $topTogolok, 277, 39);
        // Алай: Акматов(1'), Бабажанов(8'), Мурзакарим У(21')
        $this->goal($m4->id, $alay, 235, 1);
        $this->goal($m4->id, $alay, 237, 8);
        $this->goal($m4->id, $alay, 257, 21);

        // ── Match 5: ДС Групп Нарын 6-3 Тойота  (15.02.2026 18:00, Нарын ФОК «Газпром») ──
        $m5 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $naryn,
            'away_team_id' => $toyota,
            'venue'        => 'Нарын ФОК «Газпром»',
            'scheduled_at' => '2026-02-15 18:00:00',
            'status'       => 'completed',
            'home_score'   => 6,
            'away_score'   => 3,
        ]);

        $this->lineup($m5->id, $naryn, [
            [20,  false], // Куватбек Адил (GK)
            [75,  false], // Байгазы уулу Уланбек
            [364, false], // Абдыбеков Эржан
            [118, false], // Аскеров Азамат
            [231, true],  // Самат уулу Алмазбек (MVP)
            [71,  false], // Айылчиев Алманбет
            [91,  false], // Турсунбеков Уран
            [86,  false], // Мухтарбек уулу Бакыт
            [153, false], // Карыпбеков Бекмат
            [28,  false], // Канатбеков Аймен
            [243, false], // Кубанычов Кайрат
            [244, false], // Мамбеталиев Саламат
        ]);
        $this->lineup($m5->id, $toyota, [
            [233, false], // Джунушалиев Азирет
            [240, false], // Долоткелдиев Азамат
            [90,  false], // Таштанов Актай
            [247, false], // Турсунов Арстанбек
            [238, false], // Данияр уулу Абдурахим
            [234, false], // Мурзаев Бекболсун
            [242, false], // Исабеков Азат
            [149, false], // Аянбаев Адил
            [376, false], // Амандык уулу Денисбек
            [142, false], // Куттубек уулу Акылбек
            [221, false], // Туратбеков Ислам
            [377, false], // Оруналиев Ильгиз
            [425, false], // Оливейра Веллингтон
            [426, false], // Мориньо Маркос
        ]);
        // Нарын: Аскеров(7'), Самат У(7'), Канатбеков(8'), Мамбеталиев(13'), Самат У(24'), Байгазы У(38')
        $this->goal($m5->id, $naryn, 118, 7);
        $this->goal($m5->id, $naryn, 231, 7);
        $this->goal($m5->id, $naryn, 28,  8);
        $this->goal($m5->id, $naryn, 244, 13);
        $this->goal($m5->id, $naryn, 231, 24);
        $this->goal($m5->id, $naryn, 75,  38);
        // Тойота: Талайбеков(3'), Аянбаев(26'), Туратбеков(40')
        // Талайбеков — scorer listed in result post but not in published lineup card
        $this->goal($m5->id, $toyota, 250, 3);  // Талайбеков Данияр
        $this->goal($m5->id, $toyota, 149, 26);
        $this->goal($m5->id, $toyota, 221, 40);

        // ── Match 6: Талас 6-2 Каракол  (15.02.2026 20:00, СК КФБ, Бишкек) ──
        $m6 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $talas,
            'away_team_id' => $karakol,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2026-02-15 20:00:00',
            'status'       => 'completed',
            'home_score'   => 6,
            'away_score'   => 2,
        ]);

        $this->lineup($m6->id, $talas, [
            [285, false], // Жумалиев Нурсултан
            [139, false], // Бактыбек уулу Талас
            [11,  true],  // Мыктыбеков Аскат (MVP)
            [12,  false], // Мукушбеков Рамис
            [143, false], // Сабырбек уулу Майрамбек
            [34,  false], // Орунбеков Камбар
            [281, false], // Саякбаев Кудайберген
            [345, false], // Айтмырзаев Нооруэбай
            [346, false], // Чолпонбаев Бийжан
            [349, false], // Ануарбек уулу Адилет
            [399, false], // Каныбек уулу Бактияр
            [400, false], // Суйутбеков Актан
            [401, false], // Бекенов Азим
            [402, false], // Ныязбеков Ислам
        ]);
        $this->lineup($m6->id, $karakol, [
            [332, false], // Рахманов Бакыт
            [88,  false], // Сыдыков Нурслан
            [390, false], // Алтынбек уулу Арген
            [251, false], // Сыдыков Алтынбек
            [388, false], // Пулотов Шавкатчон
            [392, false], // Сайбеков Бахтияр
            [105, false], // Усупов Эрлан
            [326, false], // Шакилов Ийгилик
            [94,  false], // Авазбеков Эрлан
            [98,  false], // Нурбеков Нурсултан
        ]);
        // Талас: Мыктыбеков(10'), Мыктыбеков(15'), Ануарбек(17'), Чолпонбаев(22'), Мукушбеков(29'), Бактыбек У(37')
        $this->goal($m6->id, $talas, 11,  10);
        $this->goal($m6->id, $talas, 11,  15);
        $this->goal($m6->id, $talas, 349, 17);
        $this->goal($m6->id, $talas, 346, 22);
        $this->goal($m6->id, $talas, 12,  29);
        $this->goal($m6->id, $talas, 139, 37);
        // Каракол: Сыдыков(8'), Пулотов(25')
        $this->goal($m6->id, $karakol, 88,  8);
        $this->goal($m6->id, $karakol, 388, 25);
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