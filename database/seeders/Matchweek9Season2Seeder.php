<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Fixture;
use App\Models\FixtureLineup;
use App\Models\Round;
use Illuminate\Database\Seeder;

// Суперлига 2025-26 — Matchweek 9 (14–16 November 2025)
// Source: futsal_kgz Instagram posts
class Matchweek9Season2Seeder extends Seeder
{
    public function run(): void
    {
        $round = Round::firstOrCreate(
            ['stage_id' => 4, 'name' => 'Matchweek 9'],
            ['order' => 9],
        );

        $naryn      = 4;
        $jashMuun   = 12;
        $artBlast   = 10;
        $dostuk     = 14;
        $toyota     = 15;
        $alay       = 11;
        $topTogolok = 2;
        $karakol    = 5;
        $kant       = 7;
        $liderOshmu = 13;
        $talas      = 1;
        $vivat      = 3;

        // ── Match 1: Нарын 9-6 Жаш Муун  (14.11.2025 18:00, ФОК «Газпром», Нарын) ──
        $m1 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $naryn,
            'away_team_id' => $jashMuun,
            'venue'        => 'ФОК «Газпром», Нарын',
            'scheduled_at' => '2025-11-14 18:00:00',
            'status'       => 'completed',
            'home_score'   => 9,
            'away_score'   => 6,
        ]);

        $this->lineup($m1->id, $naryn, [
            [71,  false], // Айылчиев Алманбет
            [75,  false], // Байгазы уулу Уланбек
            [364, true],  // Абдыбеков Эржан (MVP)
            [118, false], // Аскеров Азамат
            [153, false], // Карыпбеков Бекмат
            [73,  false], // Айтокторов Нурберген
            [83,  false], // Кубанычбеков Марат
            [91,  false], // Турсунбеков Уран
            [87,  false], // Нурлан уулу Эрбол
            [374, false], // Аскербеков Актан
            [76,  false], // Бакаев Даниэль
            [370, false], // Эстебесов Амир
            [369, false], // Замирбеков Марлен
        ]);
        $this->lineup($m1->id, $jashMuun, [
            [313, false], // Карабаев Муслимбек
            [298, false], // Акимбаев Сагындык
            [302, false], // Пахридинов Гупронидин
            [303, false], // Маматкасымов Давронбек
            [268, false], // Арапов Кубатбек
            [314, false], // Октомбеков Кантенир
            [299, false], // Сайфуллаев Хожиакбар
            [300, false], // Жанторев Билал
            [301, false], // Таштемиров Абдурофи
            [304, false], // Абдурасулов Нурсултан
            [306, false], // Махаматкулов Мухаммадали
            [308, false], // Толонмирзаев Арген
            [310, false], // Мойдинов Мухаммадали
        ]);
        // Нарын: Абдыбеков(22'31'34'), Карыпбеков(22'34'36'37'), Турсунбеков(13'), Нурлан У(32')
        $this->goal($m1->id, $naryn, 364, 22);
        $this->goal($m1->id, $naryn, 364, 31);
        $this->goal($m1->id, $naryn, 364, 34);
        $this->goal($m1->id, $naryn, 153, 22);
        $this->goal($m1->id, $naryn, 153, 34);
        $this->goal($m1->id, $naryn, 153, 36);
        $this->goal($m1->id, $naryn, 153, 37);
        $this->goal($m1->id, $naryn, 91,  13);
        $this->goal($m1->id, $naryn, 87,  32);
        // Жаш Муун: Акимбаев(12'19'34'), Маматкасымов(17'25'), Арапов(37')
        $this->goal($m1->id, $jashMuun, 298, 12);
        $this->goal($m1->id, $jashMuun, 298, 19);
        $this->goal($m1->id, $jashMuun, 298, 34);
        $this->goal($m1->id, $jashMuun, 303, 17);
        $this->goal($m1->id, $jashMuun, 303, 25);
        $this->goal($m1->id, $jashMuun, 268, 37);

        // ── Match 2: Арт Бласт Групп 2-3 Достук  (15.11.2025 17:00, СК КФБ, Бишкек) ──
        $m2 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $artBlast,
            'away_team_id' => $dostuk,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2025-11-15 17:00:00',
            'status'       => 'completed',
            'home_score'   => 2,
            'away_score'   => 3,
        ]);

        $this->lineup($m2->id, $artBlast, [
            [210, false], // Жусупов Абдуазим
            [213, false], // Абдурашит уулу Арген
            [250, false], // Талайбеков Данияр
            [220, false], // Эралиев Мухаммедиса
            [227, false], // Мендибаев Нурдин
            [212, false], // Насирдинов Султан
            [150, false], // Джанат уулу Самат
            [219, false], // Эралиев Мухаммедмуса
            [226, false], // Жумадилов Баатырхан
            [229, false], // Канетов Эмил
            [230, false], // Анарбек уулу Акылбек
            [216, false], // Мелисов Нурсултан
            [236, false], // Алимов Максат
            [214, false], // Сулайманбеков Айдар
        ]);
        $this->lineup($m2->id, $dostuk, [
            [46,  false], // Кыргызов Айбек
            [360, false], // Бейшенов Бабур
            [166, false], // Абдуллаев Мухаммадсодик
            [19,  false], // Касмакунов Элдияр
            [178, false], // Сайдалиев Дамирбек
            [363, false], // Бейшенкулов Арлен
            [49,  false], // Шамонин Станислав
            [270, false], // Карыбеков Даниэл
            [361, false], // Бакиев Али
            [170, false], // Жакыпов Даулес
            [78,  false], // Жумабеков Султан
            [362, true],  // Абдумажидов Абдуллах (MVP)
        ]);
        // Арт Бласт: Жумадилов(13'), Канетов(16')
        $this->goal($m2->id, $artBlast, 226, 13);
        $this->goal($m2->id, $artBlast, 229, 16);
        // Достук: Сайдалиев(14'), Карыбеков(37'), Абдумажидов(39')
        $this->goal($m2->id, $dostuk, 178, 14);
        $this->goal($m2->id, $dostuk, 270, 37);
        $this->goal($m2->id, $dostuk, 362, 39);

        // ── Match 3: Toyota 1-5 Алай  (15.11.2025 19:00, СК КФБ, Бишкек) ──
        $m3 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $toyota,
            'away_team_id' => $alay,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2025-11-15 19:00:00',
            'status'       => 'completed',
            'home_score'   => 1,
            'away_score'   => 5,
        ]);

        $this->lineup($m3->id, $toyota, [
            [233, false], // Жунушалиев Азирет
            [242, false], // Исабеков Азат
            [241, false], // Исабеков Азамат
            [244, false], // Мамбеталиев Саламат
            [221, false], // Туратбеков Ислам
            [234, false], // Мурзаев Бекболсун
            [90,  false], // Таштанов Актай
            [375, false], // Муратбеков Айдар
            [149, false], // Аянбаев Адил
            [376, false], // Амандык уулу Денисбек
            [142, false], // Куттубек уулу Акылбек
            [377, false], // Оруналиев Ильгиз
            [378, false], // Абитов Шухрат
            [379, false], // Рашанбеков Элдар
        ]);
        $this->lineup($m3->id, $alay, [
            [295, false], // Суйорбеков Сагынбек
            [257, false], // Мурзакарим уулу Асан
            [237, true],  // Бабажанов Саид (MVP)
            [259, false], // Дурусбеков Таалайнур
            [89,  false], // Талантбек уулу Жыргалбек
            [45,  false], // Султангазиев Илимбек
            [289, false], // Садыков Канат
            [240, false], // Долоткелдиев Азамат
            [235, false], // Акматов Калдуубай
            [246, false], // Салимбаев Юлдашбай
            [292, false], // Бейшенбеков Максат
            [243, false], // Кубанычов Кайрат
            [198, false], // Култаев Адилет
        ]);
        // Toyota: Исабеков(15')
        $this->goal($m3->id, $toyota, 242, 15);
        // Алай: Мурзакарим(21'), Доолоткелдиев(12'), Салимбаев(33'), Кубанычов(6'12')
        $this->goal($m3->id, $alay, 243, 6);
        $this->goal($m3->id, $alay, 240, 12);
        $this->goal($m3->id, $alay, 243, 12);
        $this->goal($m3->id, $alay, 257, 21);
        $this->goal($m3->id, $alay, 246, 33);

        // ── Match 4: Топ Тоголок 6-8 Каракол  (15.11.2025 21:00, СК КФБ, Бишкек) ──
        $m4 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $topTogolok,
            'away_team_id' => $karakol,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2025-11-15 21:00:00',
            'status'       => 'completed',
            'home_score'   => 6,
            'away_score'   => 8,
        ]);

        $this->lineup($m4->id, $topTogolok, [
            [20,  false], // Куватбек Адил
            [24,  false], // Абдымамытов Адахан
            [25,  false], // Ашуров Сыймык
            [277, false], // Сманов Байэл
            [342, false], // Данияров Саян
            [15,  false], // Азатов Амир
            [134, false], // Азамат уулу Ильгиз
            [334, false], // Абдирасулов Актилек
            [336, false], // Султанов Нуралы
            [341, false], // Черикбаев Арлен
        ]);
        $this->lineup($m4->id, $karakol, [
            [332, false], // Рахманов Бакыт
            [105, false], // Усупов Эрлан
            [326, false], // Шакилов Ийгилик
            [100, false], // Орозбеков Улукбек
            [88,  true],  // Сыдыков Нурслан (MVP)
            [106, false], // Шаршенбиев Ринат
            [327, false], // Дюшембаев Жанарбек
            [94,  false], // Авазбеков Эрлан
            [93,  false], // Дюшенбаев Ислам
            [331, false], // Дамиров Бежжан
        ]);
        // Топ Тоголок: Ашуров(8'), Сманов(40'), Азамат У(32'38'39'), Абдирасулов(20')
        $this->goal($m4->id, $topTogolok, 25,  8);
        $this->goal($m4->id, $topTogolok, 334, 20);
        $this->goal($m4->id, $topTogolok, 134, 32);
        $this->goal($m4->id, $topTogolok, 277, 40);
        $this->goal($m4->id, $topTogolok, 134, 38);
        $this->goal($m4->id, $topTogolok, 134, 39);
        // Каракол: Рахманов(30'), Шакилов(1'), Сыдыков(15'20'35'), Дюшебаев(10'), Авазбеков(32'), Дамиров(8')
        $this->goal($m4->id, $karakol, 326, 1);
        $this->goal($m4->id, $karakol, 331, 8);
        $this->goal($m4->id, $karakol, 93,  10);
        $this->goal($m4->id, $karakol, 88,  15);
        $this->goal($m4->id, $karakol, 88,  20);
        $this->goal($m4->id, $karakol, 332, 30);
        $this->goal($m4->id, $karakol, 94,  32);
        $this->goal($m4->id, $karakol, 88,  35);

        // ── Match 5: Кант 7-0 Жаш Муун  (15.11.2025 18:00, ФОК «Кант», Кант) ──
        $m5 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $kant,
            'away_team_id' => $jashMuun,
            'venue'        => 'ФОК «Кант», Кант',
            'scheduled_at' => '2025-11-15 18:00:00',
            'status'       => 'completed',
            'home_score'   => 7,
            'away_score'   => 0,
        ]);

        $this->lineup($m5->id, $kant, [
            [145, true],  // Пензаев Чынгыз (MVP)
            [152, false], // Кадырбек уулу Ислам
            [157, false], // Рахманкулов Азамат
            [232, false], // Муктарбеков Эльдар
            [217, false], // Андабеков Аман
            [146, false], // Хамидов Акжол
            [162, false], // Шапданбек уулу Жолдошбек
            [155, false], // Мелисбек уулу Азамат
            [8,   false], // Болтобаев Темирлан
            [222, false], // Бейшеналиев Урмат
            [35,  false], // Саякбаев Кыяз
            [315, false], // Эсенгелдиев Калысбек
            [3,   false], // Замирбеков Женишбек
            [2,   false], // Салымбеков Нурсултан
        ]);
        $this->lineup($m5->id, $jashMuun, [
            [314, false], // Октомбеков Кантенир
            [298, false], // Акимбаев Сагындык
            [302, false], // Пахридинов Гупронидин
            [303, false], // Маматкасымов Давронбек
            [268, false], // Арапов Кубатбек
            [313, false], // Карабаев Муслимбек
            [299, false], // Сайфуллаев Хожиакбар
            [300, false], // Жанторев Билал
            [304, false], // Абдурасулов Нурсултан
            [306, false], // Махаматкулов Мухаммадали
            [310, false], // Мойдинов Мухаммадали
            [308, false], // Толонмирзаев Арген
        ]);
        // Кант: Мелисбек У(4'), Замирбеков(9'), Муктарбеков(11'22'), Кадырбек У(17'), Шапданбек У(32'), Салымбеков(40')
        $this->goal($m5->id, $kant, 155, 4);
        $this->goal($m5->id, $kant, 3,   9);
        $this->goal($m5->id, $kant, 232, 11);
        $this->goal($m5->id, $kant, 152, 17);
        $this->goal($m5->id, $kant, 232, 22);
        $this->goal($m5->id, $kant, 162, 32);
        $this->goal($m5->id, $kant, 2,   40);

        // ── Match 6: Нарын 3-1 Лидер-ОШМУ  (15.11.2025 18:00, ФОК «Газпром», Нарын) ──
        $m6 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $naryn,
            'away_team_id' => $liderOshmu,
            'venue'        => 'ФОК «Газпром», Нарын',
            'scheduled_at' => '2025-11-15 18:00:00',
            'status'       => 'completed',
            'home_score'   => 3,
            'away_score'   => 1,
        ]);

        $this->lineup($m6->id, $naryn, [
            [71,  false], // Айылчиев Алманбет
            [75,  false], // Байгазы уулу Уланбек
            [364, false], // Абдыбеков Эржан
            [118, true],  // Аскеров Азамат (MVP)
            [153, false], // Карыпбеков Бекмат
            [374, false], // Аскербеков Актан
            [73,  false], // Айтокторов Нурберген
            [83,  false], // Кубанычбеков Марат
            [76,  false], // Бакаев Даниэль
            [91,  false], // Турсунбеков Уран
            [86,  false], // Мухтарбек уулу Бакыт
            [87,  false], // Нурлан уулу Эрбол
            [369, false], // Замирбеков Марлен
        ]);
        $this->lineup($m6->id, $liderOshmu, [
            [186, false], // Кудайбердиев Сыймыкбек
            [317, false], // Токоев Арсланбек
            [197, false], // Исламов Алымбек
            [320, false], // Турсунбаев Шумкар
            [323, false], // Эргешов Шахзодбек
            [165, false], // Эркинбаев Даниел
            [199, false], // Муктарали уулу Уланбек
            [65,  false], // Назаралиев Урмат
            [168, false], // Алмазбеков Омурбек
            [201, false], // Ражапов Сыймык
            [167, false], // Абышев Элмар
            [321, false], // Абдурахманов Мухаммадали
            [205, false], // Умаров Таалайбек
        ]);
        // Нарын: Абдыбеков(34'), Аскеров(32'), Нурлан У(7')
        $this->goal($m6->id, $naryn, 87,  7);
        $this->goal($m6->id, $naryn, 118, 32);
        $this->goal($m6->id, $naryn, 364, 34);
        // Лидер-ОШМУ: Алмазбеков(40')
        $this->goal($m6->id, $liderOshmu, 168, 40);

        // ── Match 7: Кант 6-2 Лидер-ОШМУ  (16.11.2025 18:00, ФОК «Кант», Кант) ──
        $m7 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $kant,
            'away_team_id' => $liderOshmu,
            'venue'        => 'ФОК «Кант», Кант',
            'scheduled_at' => '2025-11-16 18:00:00',
            'status'       => 'completed',
            'home_score'   => 6,
            'away_score'   => 2,
        ]);

        $this->lineup($m7->id, $kant, [
            [145, false], // Пензаев Чынгыз
            [152, false], // Кадырбек уулу Ислам
            [157, false], // Рахманкулов Азамат
            [232, true],  // Муктарбеков Эльдар (MVP)
            [217, false], // Андабеков Аман
            [146, false], // Хамидов Акжол
            [162, false], // Шапданбек уулу Жолдошбек
            [155, false], // Мелисбек уулу Азамат
            [8,   false], // Болтобаев Темирлан
            [222, false], // Бейшеналиев Урмат
            [35,  false], // Саякбаев Кыяз
            [315, false], // Эсенгелдиев Калысбек
            [3,   false], // Замирбеков Женишбек
            [2,   false], // Салымбеков Нурсултан
        ]);
        $this->lineup($m7->id, $liderOshmu, [
            [186, false], // Кудайбердиев Сыймыкбек
            [317, false], // Токоев Арсланбек
            [168, false], // Алмазбеков Омурбек
            [320, false], // Турсунбаев Шумкар
            [323, false], // Эргешов Шахзодбек
            [199, false], // Муктарали уулу Уланбек
            [65,  false], // Назаралиев Урмат
            [201, false], // Ражапов Сыймык
            [197, false], // Исламов Алымбек
            [167, false], // Абышев Элмар
            [318, false], // Канназаров Нуркалый
            [321, false], // Абдурахманов Мухаммадали
        ]);
        // Кант: Кадырбек У(31'), Муктарбеков(16'33'), Андабеков(13'31'), Салымбеков(18')
        $this->goal($m7->id, $kant, 217, 13);
        $this->goal($m7->id, $kant, 232, 16);
        $this->goal($m7->id, $kant, 2,   18);
        $this->goal($m7->id, $kant, 152, 31);
        $this->goal($m7->id, $kant, 217, 31);
        $this->goal($m7->id, $kant, 232, 33);
        // Лидер-ОШМУ: Токоев(39'), Турсунбаев(27')
        $this->goal($m7->id, $liderOshmu, 320, 27);
        $this->goal($m7->id, $liderOshmu, 317, 39);

        // ── Match 8: Талас 4-6 Виват  (16.11.2025 20:30, СК КФБ, Бишкек) ──
        $m8 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $talas,
            'away_team_id' => $vivat,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2025-11-16 20:30:00',
            'status'       => 'completed',
            'home_score'   => 4,
            'away_score'   => 6,
        ]);

        $this->lineup($m8->id, $talas, [
            [285, false], // Жумалиев Нурсултан
            [143, false], // Сабырбек уулу Майрамбек
            [4,   false], // Жакыпов Руслан
            [11,  false], // Мыктыбеков Аскат
            [26,  false], // Жаанбаев Актан
            [6,   false], // Курманбеков Бектур
            [34,  false], // Орунбеков Камбар
            [12,  false], // Мукушбеков Рамис
            [13,  false], // Алымжанов Дастан
            [345, false], // Айтмырзаев Нооруэбай
            [140, false], // Батырбек уулу Улан
            [37,  false], // Ахметов Арлан
            [348, false], // Раманкулов Абдурахим
            [349, false], // Ануарбек уулу Адилет
        ]);
        $this->lineup($m8->id, $vivat, [
            [353, false], // Яфаров Султан
            [58,  false], // Кадыров Дильшат
            [64,  false], // Минкеев Ильзат
            [352, false], // Игольников Илья
            [27,  true],  // Иманалиев Элбек (MVP)
            [132, false], // Тургунбеков Адыл
            [50,  false], // Анарбеков Нурадил
            [52,  false], // Вильямов Бахридин
            [56,  false], // Зажигаев Данил
            [59,  false], // Керимбаев Эмирлан
            [68,  false], // Чиркин Кирилл
            [223, false], // Эсенгелдиев Асылбек
            [255, false], // Эрмеков Ильгиз
            [288, false], // Ашималиев Данияр
        ]);
        // Талас: Сабырбек У(38'), Мыктыбеков(26'), Жаанбаев(33'), Мукушбеков(26')
        $this->goal($m8->id, $talas, 11,  26);
        $this->goal($m8->id, $talas, 12,  26);
        $this->goal($m8->id, $talas, 26,  33);
        $this->goal($m8->id, $talas, 143, 38);
        // Виват: Кадыров(17'37'), Иманалиев(19'27'), Эсенгелдиев(29'), Ашималиев(34')
        $this->goal($m8->id, $vivat, 58,  17);
        $this->goal($m8->id, $vivat, 27,  19);
        $this->goal($m8->id, $vivat, 27,  27);
        $this->goal($m8->id, $vivat, 223, 29);
        $this->goal($m8->id, $vivat, 288, 34);
        $this->goal($m8->id, $vivat, 58,  37);
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