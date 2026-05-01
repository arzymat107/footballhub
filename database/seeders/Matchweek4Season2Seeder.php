<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Fixture;
use App\Models\FixtureLineup;
use App\Models\Round;
use App\Models\Team;
use Illuminate\Database\Seeder;

// Суперлига 2025-26 — Matchweek 4 (3–5 October 2025)
// Source: futsal_kgz Instagram posts
// Full Starting V lineups available for matches 3–8; partial for matches 1–2
class Matchweek4Season2Seeder extends Seeder
{
    public function run(): void
    {
        $round = Round::firstOrCreate(
            ['stage_id' => 4, 'name' => 'Matchweek 4'],
            ['order' => 4],
        );

        $vivat      = 3;
        $topTogolok = 2;
        $karakol    = 5;
        $naryn      = 4;
        $talas      = 1;
        $kant       = 7;
        $artBlast   = 10;
        $alay       = 11;
        $jashMuun   = Team::where('name', 'Жаш Муун')->value('id');
        $liderOshmu = Team::where('name', 'Лидер-ОШМУ')->value('id');
        $dostuk     = Team::where('name', 'Достук')->value('id');
        $toyota     = Team::where('name', 'Toyota')->value('id');

        // ── Match 1: Каракол 4-8 Жаш Муун  (03.10.2025 20:00, ФОК «Каракол», Каракол) ──
        $m1 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $karakol,
            'away_team_id' => $jashMuun,
            'venue'        => 'ФОК «Каракол», Каракол',
            'scheduled_at' => '2025-10-03 20:00:00',
            'status'       => 'completed',
            'home_score'   => 4,
            'away_score'   => 8,
        ]);

        // Partial lineup (MVP + scorers only)
        $this->lineup($m1->id, $karakol,  [[100, false], [331, false]]); // Орозбеков, Дамиров Бежжан
        $this->lineup($m1->id, $jashMuun, [[302, false], [268, true], [314, false]]); // Пахридинов, Арапов (MVP), Октомбеков

        $this->goal($m1->id,    $jashMuun, 302, 1);   // Пахридинов
        $this->goal($m1->id,    $jashMuun, 302, 8);   // Пахридинов
        $this->goal($m1->id,    $karakol,  100, 11);  // Орозбеков
        $this->goal($m1->id,    $jashMuun, 268, 7);   // Арапов
        $this->goal($m1->id,    $jashMuun, 268, 10);  // Арапов
        $this->goal($m1->id,    $karakol,  331, 14);  // Дамиров Бежжан
        $this->goal($m1->id,    $jashMuun, 268, 20);  // Арапов
        $this->goal($m1->id,    $jashMuun, 268, 27);  // Арапов
        $this->goal($m1->id,    $jashMuun, 268, 34);  // Арапов
        $this->goal($m1->id,    $jashMuun, 268, 35);  // Арапов
        $this->goal($m1->id,    $karakol,  100, 37);  // Орозбеков
        // Октомбеков Кантенир (314) own goal → benefits Каракол
        $this->ownGoal($m1->id, $karakol,  314, 38);

        // ── Match 2: Нарын 3-2 Алай  (04.10.2025 18:00, ФОК «Газпром», Нарын) ──
        $m2 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $naryn,
            'away_team_id' => $alay,
            'venue'        => 'ФОК «Газпром», Нарын',
            'scheduled_at' => '2025-10-04 18:00:00',
            'status'       => 'completed',
            'home_score'   => 3,
            'away_score'   => 2,
        ]);

        // Partial lineup (MVP + scorers only)
        $this->lineup($m2->id, $naryn, [[118, true], [87, false]]);  // Аскеров (MVP), Нурлан уулу
        $this->lineup($m2->id, $alay,  [[89, false], [246, false]]); // Талантбек уулу, Салимбаев

        $this->goal($m2->id, $alay,  89,  8);   // Талантбек уулу
        $this->goal($m2->id, $naryn, 118, 3);   // Аскеров
        $this->goal($m2->id, $naryn, 87,  18);  // Нурлан уулу
        $this->goal($m2->id, $alay,  246, 26);  // Салимбаев
        $this->goal($m2->id, $naryn, 118, 35);  // Аскеров

        // ── Match 3: Виват 7-2 Лидер-ОШМУ  (04.10.2025 18:00, СК КФБ, Бишкек) ──
        $m3 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $vivat,
            'away_team_id' => $liderOshmu,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2025-10-04 18:00:00',
            'status'       => 'completed',
            'home_score'   => 7,
            'away_score'   => 2,
        ]);

        $this->lineup($m3->id, $vivat, [
            [47,  true],  // Маликжанов Нурэл (MVP)
            [223, false], // Эсенгелдиев Асылбек
            [52,  false], // Вильямов Бахридин
            [60,  false], // Кошонов Канкелди
            [68,  false], // Чиркин Кирилл
            [132, false], // Тургунбеков Адыл
            [50,  false], // Анарбеков Нурадил
            [58,  false], // Кадыров Дильшат
            [57,  false], // Искендербеков Талгат
            [63,  false], // Маликов Абдурасул
            [67,  false], // Хамраев Ибрахим
            [352, false], // Игольников Илья
            [288, false], // Ашималиев Данияр
            [27,  false], // Иманалиев Элбек
        ]);
        $this->lineup($m3->id, $liderOshmu, [
            [186, false], // Кудайбердиев Сыймыкбек
            [201, false], // Ражапов Сыймык
            [320, false], // Турсунбаев Шумкар
            [206, false], // Худайбердиев Исломбек
            [323, false], // Эргешов Шахзодбек
            [187, false], // Ташиев Мусабек
            [199, false], // Муктарали уулу Уланбек
            [317, false], // Токоев Арсланбек
            [65,  false], // Назаралиев Урмат
            [168, false], // Алмазбеков Омурбек
            [167, false], // Абышев Элмар
            [205, false], // Умаров Таалайбек
            [184, false], // Эргашев Диёрбек
        ]);

        $this->goal($m3->id, $liderOshmu, 320, 7);   // Турсунбаев
        $this->goal($m3->id, $vivat,      57,  9);   // Искендербеков
        $this->goal($m3->id, $vivat,      50,  12);  // Анарбеков
        $this->goal($m3->id, $vivat,      223, 22);  // Эсенгелдиев
        $this->goal($m3->id, $vivat,      57,  26);  // Искендербеков
        $this->goal($m3->id, $vivat,      27,  28);  // Иманалиев
        $this->goal($m3->id, $vivat,      352, 29);  // Игольников
        $this->goal($m3->id, $liderOshmu, 206, 30);  // Худайбердиев
        $this->goal($m3->id, $vivat,      27,  37);  // Иманалиев

        // ── Match 4: Art Blast Group 7-5 Toyota  (04.10.2025 20:00, СК КФБ, Бишкек) ──
        $m4 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $artBlast,
            'away_team_id' => $toyota,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2025-10-04 20:00:00',
            'status'       => 'completed',
            'home_score'   => 7,
            'away_score'   => 5,
        ]);

        $this->lineup($m4->id, $artBlast, [
            [210, false], // Жусупов Абдуазим
            [213, true],  // Абдурашит уулу Арген (MVP)
            [218, false], // Кенешбеков Жанарбек
            [250, false], // Талайбеков Данияр
            [150, false], // Джанат уулу Самат
            [212, false], // Насирдинов Султан
            [219, false], // Эралиев Мухаммедмуса
            [226, false], // Жумадилов Баатырхан
            [227, false], // Мендибаев Нурдин
            [229, false], // Канетов Эмил
            [230, false], // Анарбек уулу Акылбек
            [216, false], // Мелисов Нурсултан
            [224, false], // Маматов Артур
            [159, false], // Султанбеков Бекзат
        ]);
        $this->lineup($m4->id, $toyota, [
            [234, false], // Мурзаев Бекболсун
            [149, false], // Аянбаев Адил
            [247, false], // Турсунов Арстанбек
            [238, false], // Данияр уулу Абдурахим
            [221, false], // Туратбеков Ислам
            [233, false], // Джунушалиев Азирет
            [90,  false], // Таштанов Актай
            [242, false], // Исабеков Азат
            [241, false], // Исабеков Азамат
            [378, false], // Абитов Шухрат
            [244, false], // Мамбеталиев Саламат
            [377, false], // Оруналиев Ильгиз
            [376, false], // Амандык уулу Денисбек
            [375, false], // Муратбеков Айдар
        ]);

        // Мурзаев (Toyota, 234) own goal → benefits ABG
        $this->ownGoal($m4->id, $artBlast, 234, 8);
        $this->goal($m4->id, $toyota,   221, 18);  // Туратбеков
        $this->goal($m4->id, $toyota,   244, 23);  // Мамбеталиев
        $this->goal($m4->id, $artBlast, 150, 26);  // Джанат уулу
        $this->goal($m4->id, $artBlast, 230, 27);  // Анарбек уулу
        $this->goal($m4->id, $artBlast, 213, 27);  // Абдурашит уулу
        $this->goal($m4->id, $toyota,   244, 27);  // Мамбеталиев
        $this->goal($m4->id, $toyota,   376, 28);  // Амандык уулу
        $this->goal($m4->id, $artBlast, 250, 30);  // Талайбеков
        $this->goal($m4->id, $artBlast, 250, 37);  // Талайбеков
        $this->goal($m4->id, $toyota,   90,  38);  // Таштанов
        $this->goal($m4->id, $artBlast, 226, 39);  // Жумадилов

        // ── Match 5: Кант 5-4 Топ Тоголок  (04.10.2025 19:00, ФОК «Кант», Кант) ──
        $m5 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $kant,
            'away_team_id' => $topTogolok,
            'venue'        => 'ФОК «Кант», Кант',
            'scheduled_at' => '2025-10-04 19:00:00',
            'status'       => 'completed',
            'home_score'   => 5,
            'away_score'   => 4,
        ]);

        $this->lineup($m5->id, $kant, [
            [145, false], // Пензаев Чынгыз
            [152, true],  // Кадырбек уулу Ислам (MVP)
            [157, false], // Рахманкулов Азамат
            [3,   false], // Замирбеков Женишбек
            [232, false], // Муктарбеков Эльдар
            [146, false], // Хамидов Акжол
            [151, false], // Исроилов Кутбидин
            [147, false], // Айдаркул уулу Эрмек
            [162, false], // Шапданбек уулу Жолдошбек
            [155, false], // Мелисбек уулу Азамат
            [8,   false], // Болтобаев Темирлан
            [2,   false], // Салымбеков Нурсултан
            [217, false], // Андабеков Аман
        ]);
        $this->lineup($m5->id, $topTogolok, [
            [15,  false], // Азатов Амир
            [334, false], // Абдирасулов Актилек
            [28,  false], // Канатбеков Аймен
            [160, false], // Султанов Эрлан
            [82,  false], // Исаков Данияр
            [20,  false], // Куватбек Адил
            [21,  false], // Ильясов Бектур
            [134, false], // Азамат уулу Ильгиз
            [25,  false], // Ашуров Сыймык
            [277, false], // Сманов Байэл
            [341, false], // Черикбаев Арлен
            [342, false], // Данияров Саян
            [343, false], // Колопов Достук
        ]);

        $this->goal($m5->id, $kant,       152, 2);   // Кадырбек уулу
        $this->goal($m5->id, $kant,       152, 6);   // Кадырбек уулу
        $this->goal($m5->id, $topTogolok, 82,  10);  // Исаков
        $this->goal($m5->id, $kant,       2,   13);  // Салымбеков
        $this->goal($m5->id, $kant,       162, 14);  // Шапданбек уулу
        $this->goal($m5->id, $topTogolok, 21,  35);  // Ильясов
        $this->goal($m5->id, $kant,       152, 38);  // Кадырбек уулу
        $this->goal($m5->id, $topTogolok, 334, 38);  // Абдирасулов
        $this->goal($m5->id, $topTogolok, 28,  38);  // Канатбеков

        // ── Match 6: Достук 2-0 Талас  (05.10.2025 18:00, СК КФБ, Бишкек) ──
        $m6 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $dostuk,
            'away_team_id' => $talas,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2025-10-05 18:00:00',
            'status'       => 'completed',
            'home_score'   => 2,
            'away_score'   => 0,
        ]);

        $this->lineup($m6->id, $dostuk, [
            [46,  true],  // Кыргызов Айбек (MVP)
            [360, false], // Бейшенов Бабур
            [78,  false], // Жумабеков Султан
            [166, false], // Абдуллаев Мухаммадсодик
            [178, false], // Сайдалиев Дамирбек
            [363, false], // Бейшенкулов Арлен
            [270, false], // Карыбеков Даниэл
            [359, false], // Токтогонов Улукман
            [54,  false], // Джумабеков Тариэл
            [361, false], // Бакиев Али
            [170, false], // Жакыпов Даулес
            [19,  false], // Касмакунов Элдияр
            [66,  false], // Тимченко Артем
        ]);
        $this->lineup($m6->id, $talas, [
            [285, false], // Жумалиев Нурсултан
            [143, false], // Сабырбек уулу Майрамбек
            [4,   false], // Жакыпов Руслан
            [11,  false], // Мыктыбеков Аскат
            [26,  false], // Жаанбаев Актан
            [139, false], // Бактыбек уулу Талас
            [34,  false], // Орунбеков Камбар
            [12,  false], // Мукушбеков Рамис
            [13,  false], // Алымжанов Дастан
            [345, false], // Айтмырзаев Нооруэбай
            [346, false], // Чолпонбаев Бийжан
            [37,  false], // Ахметов Арлан
            [348, false], // Раманкулов Абдурахим
            [349, false], // Ануарбек уулу Адилет
        ]);

        $this->goal($m6->id, $dostuk, 178, 22); // Сайдалиев
        $this->goal($m6->id, $dostuk, 78,  35); // Жумабеков

        // ── Match 7: Виват 4-9 Жаш Муун  (05.10.2025 20:00, СК КФБ, Бишкек) ──
        $m7 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $vivat,
            'away_team_id' => $jashMuun,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2025-10-05 20:00:00',
            'status'       => 'completed',
            'home_score'   => 4,
            'away_score'   => 9,
        ]);

        $this->lineup($m7->id, $vivat, [
            [132, false], // Тургунбеков Адыл
            [60,  false], // Кошонов Канкелди
            [223, false], // Эсенгелдиев Асылбек
            [27,  false], // Иманалиев Элбек
            [351, false], // Саралаев Ислам
            [47,  false], // Маликжанов Нурэл
            [50,  false], // Анарбеков Нурадил
            [58,  false], // Кадыров Дильшат
            [56,  false], // Зажигаев Данил
            [57,  false], // Искендербеков Талгат
            [59,  false], // Керимбаев Эмирлан
            [63,  false], // Маликов Абдурасул
            [69,  false], // Юлдашев Набижан
            [288, false], // Ашималиев Данияр
        ]);
        $this->lineup($m7->id, $jashMuun, [
            [313, false], // Карабаев Муслимбек
            [298, false], // Акимбаев Сагындык
            [302, false], // Пахридинов Гупронидин
            [303, true],  // Маматкасымов Давронбек (MVP)
            [268, false], // Арапов Кубатбек
            [269, false], // Абдувалиев Омурали
            [314, false], // Октомбеков Кантенир
            [299, false], // Сайфуллаев Хожиакбар
            [300, false], // Жанторев Билал
            [301, false], // Таштемиров Абдурофи
            [304, false], // Абдурасулов Нурсултан
            [306, false], // Махаматкулов Мухаммадали
            [310, false], // Мойдинов Мухаммадали
            [308, false], // Толонмирзаев Арген
        ]);

        $this->goal($m7->id,    $jashMuun, 303, 2);   // Маматкасымов
        // Тургунбеков (Виват, 132) own goal → benefits Жаш Муун
        $this->ownGoal($m7->id, $jashMuun, 132, 5);
        $this->goal($m7->id,    $vivat,    58,  13);  // Кадыров
        $this->goal($m7->id,    $vivat,    58,  16);  // Кадыров
        $this->goal($m7->id,    $jashMuun, 300, 16);  // Жанторев
        $this->goal($m7->id,    $jashMuun, 310, 17);  // Мойдинов
        $this->goal($m7->id,    $jashMuun, 299, 20);  // Сайфуллаев
        $this->goal($m7->id,    $jashMuun, 303, 25);  // Маматкасымов
        $this->goal($m7->id,    $jashMuun, 310, 32);  // Мойдинов
        $this->goal($m7->id,    $jashMuun, 268, 33);  // Арапов
        $this->goal($m7->id,    $vivat,    27,  35);  // Иманалиев
        $this->goal($m7->id,    $vivat,    27,  40);  // Иманалиев
        $this->goal($m7->id,    $jashMuun, 298, 40);  // Акимбаев

        // ── Match 8: Каракол 3-3 Лидер-ОШМУ  (05.10.2025 20:00, ФОК «Каракол», Каракол) ──
        $m8 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $karakol,
            'away_team_id' => $liderOshmu,
            'venue'        => 'ФОК «Каракол», Каракол',
            'scheduled_at' => '2025-10-05 20:00:00',
            'status'       => 'completed',
            'home_score'   => 3,
            'away_score'   => 3,
        ]);

        $this->lineup($m8->id, $karakol, [
            [332, false], // Рахманов Бакыт
            [326, false], // Шакилов Ийгилик
            [331, false], // Дамиров Бежжан
            [100, true],  // Орозбеков Улукбек (MVP)
            [88,  false], // Сыдыков Нурслан
            [333, false], // Дамиров Белек
            [105, false], // Усупов Эрлан
            [106, false], // Шаршенбиев Ринат
            [103, false], // Усенбаев Бексултан
            [104, false], // Усупов Адилет
            [327, false], // Дюшембаев Жанарбек
            [94,  false], // Авазбеков Эрлан
            [93,  false], // Дюшенбаев Ислам
        ]);
        $this->lineup($m8->id, $liderOshmu, [
            [186, false], // Кудайбердиев Сыймыкбек
            [201, false], // Ражапов Сыймык
            [320, false], // Турсунбаев Шумкар
            [206, false], // Худайбердиев Исломбек
            [323, false], // Эргешов Шахзодбек
            [187, false], // Ташиев Мусабек
            [199, false], // Муктарали уулу Уланбек
            [317, false], // Токоев Арсланбек
            [65,  false], // Назаралиев Урмат
            [168, false], // Алмазбеков Омурбек
            [167, false], // Абышев Элмар
            [318, false], // Канназаров Нуркалый
            [205, false], // Умаров Таалайбек
            [184, false], // Эргашев Диёрбек
        ]);

        $this->goal($m8->id, $karakol,    100, 3);   // Орозбеков
        $this->goal($m8->id, $liderOshmu, 317, 6);   // Токоев
        $this->goal($m8->id, $liderOshmu, 317, 33);  // Токоев
        $this->goal($m8->id, $liderOshmu, 323, 34);  // Эргешов Ш.
        $this->goal($m8->id, $karakol,    88,  35);  // Сыдыков
        $this->goal($m8->id, $karakol,    100, 39);  // Орозбеков
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