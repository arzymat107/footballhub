<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Fixture;
use App\Models\FixtureLineup;
use App\Models\Round;
use Illuminate\Database\Seeder;

// Суперлига 2025-26 — Matchweek 15 / 2-АЙЛАМПА (20–22 February 2026)
// Source: futsal_kgz Instagram posts
class Matchweek15Season2Seeder extends Seeder
{
    public function run(): void
    {
        $round = Round::firstOrCreate(
            ['stage_id' => 4, 'name' => 'Matchweek 15'],
            ['order' => 15],
        );

        $alay       = 11;
        $zhashMuun  = 12;
        $dostuk     = 14;
        $karakol    = 5;
        $artBlast   = 10;
        $liderOshmu = 13;
        $kant       = 7;
        $toyota     = 15;
        $vivat      = 3;
        $naryn      = 4;
        $talas      = 1;
        $topTogolok = 2;

        // ── Match 1: Алай 5-2 Жаш Муун  (20.02.2026 21:00, СК КФБ, Бишкек) ──
        $m1 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $alay,
            'away_team_id' => $zhashMuun,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2026-02-20 21:00:00',
            'status'       => 'completed',
            'home_score'   => 5,
            'away_score'   => 2,
        ]);

        $this->lineup($m1->id, $alay, [
            [295, false], // Суйорбеков Сагынбек
            [257, false], // Мурзакарим уулу Асан
            [292, false], // Бейшенбеков Максат
            [10,  false], // Сатыбалдиев Айдар
            [5,   false], // Торобеков Бакдоолот
            [45,  false], // Султангазиев Илимбек
            [237, false], // Бабажанов Саид
            [259, false], // Дурусбеков Таалайнур
            [235, false], // Акматов Калдуубай
            [291, false], // Бактыбеков Арстанбек
            [89,  true],  // Талантбек уулу Жыргалбек (MVP)
            [358, false], // Сатыбалдиев Эльдар
        ]);
        $this->lineup($m1->id, $zhashMuun, [
            [269, false], // Абдувалиев Омурали
            [299, false], // Сайфуллаев Хожиакбар
            [300, false], // Жанторев Билал
            [302, false], // Пахридинов Гупронидин
            [304, false], // Абдурасулов Нурсултан
            [420, false], // Мамиров Зухридин
            [301, false], // Таштемиров Абдурофи
            [306, false], // Махаматкулов Мухаммадали
            [415, false], // Зульпиев Тиллабай
            [416, false], // Шахапов Элмырза
            [418, false], // Абдувалиев Аслидин
            [246, false], // Салимбаев Юлдашбай
        ]);
        // Алай: Мурзакарим у(6'), Акматов(12'), Торобеков(13'), Талантбек у(29'), Талантбек у(39')
        $this->goal($m1->id, $alay, 257, 6);
        $this->goal($m1->id, $alay, 235, 12);
        $this->goal($m1->id, $alay, 5,   13);
        $this->goal($m1->id, $alay, 89,  29);
        $this->goal($m1->id, $alay, 89,  39);
        // Жаш Муун: Абдувалиев(10'), Жантороев(40')
        $this->goal($m1->id, $zhashMuun, 269, 10);
        $this->goal($m1->id, $zhashMuun, 300, 40);

        // ── Match 2: Достук 4-3 Каракол  (21.02.2026 17:00, СК КФБ, Бишкек) ──
        $m2 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $dostuk,
            'away_team_id' => $karakol,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2026-02-21 17:00:00',
            'status'       => 'completed',
            'home_score'   => 4,
            'away_score'   => 3,
        ]);

        $this->lineup($m2->id, $dostuk, [
            [46,  false], // Кыргызов Айбек
            [178, false], // Сайдалиев Дамирбек
            [166, true],  // Абдуллаев Мухаммадсодик (MVP)
            [361, false], // Бакиев Али
            [78,  false], // Жумабеков Султан
            [49,  false], // Шамонин Станислав
            [362, false], // Абдумажидов Абдуллах
            [404, false], // Айтбаев Азамат
            [270, false], // Карыбеков Даниэл
            [359, false], // Токтогонов Улукман
            [335, false], // Бекбоев Кутман
        ]);
        $this->lineup($m2->id, $karakol, [
            [392, false], // Сайбеков Бахтияр
            [105, false], // Усупов Эрлан
            [104, false], // Усупов Адилет
            [289, false], // Садыков Канат
            [388, false], // Пулотов Шавкатчон
            [94,  false], // Авазбеков Эрлан
            [327, false], // Дюшембаев Жанарбек
            [100, false], // Орозбеков Улукбек
            [98,  false], // Нурбеков Нурсултан
            [390, false], // Алтынбек уулу Арген
        ]);
        // Достук: Абдуллаев(8'), Абдуллаев(28'), Карыбеков(29'), Абдуллаев(39')
        $this->goal($m2->id, $dostuk, 166, 8);
        $this->goal($m2->id, $dostuk, 166, 28);
        $this->goal($m2->id, $dostuk, 270, 29);
        $this->goal($m2->id, $dostuk, 166, 39);
        // Каракол: Усупов(18'), Пулотов(22'), Кыргызов(АГ 39')
        $this->goal($m2->id, $karakol, 105, 18);
        $this->goal($m2->id, $karakol, 388, 22);
        $this->ownGoal($m2->id, $karakol, 46, 39); // Кыргызов — автогол в ворота Достука

        // ── Match 3: Арт Бласт Групп 2-3 Лидер-ОШМУ  (21.02.2026 19:00, СК КФБ, Бишкек) ──
        $m3 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $artBlast,
            'away_team_id' => $liderOshmu,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2026-02-21 19:00:00',
            'status'       => 'completed',
            'home_score'   => 2,
            'away_score'   => 3,
        ]);

        $this->lineup($m3->id, $artBlast, [
            [212, false], // Насирдинов Султан
            [21,  false], // Ильясов Бектур
            [220, false], // Эралиев Мухаммедиса
            [226, false], // Жумадилов Баатырхан
            [236, false], // Алимов Максат
            [397, false], // Жузумалиев Ислам
            [213, false], // Абдурашит уулу Арген
            [218, false], // Кенешбеков Жанарбек
            [250, false], // Талайбеков Данияр
            [219, false], // Эралиев Мухаммедмуса
            [150, false], // Джанат уулу Самат
            [224, false], // Маматов Артур
            [357, false], // Талайбеков Арсен
            [16,  false], // Бактыбеков Эржан
        ]);
        $this->lineup($m3->id, $liderOshmu, [
            [186, false], // Кудайбердиев Сыймыкбек
            [317, false], // Токоев Арсланбек
            [320, false], // Турсунбаев Шумкар
            [248, true],  // Мурзакулов Семетей (MVP)
            [382, false], // Павлов Никита
            [384, false], // Кыялбеков Семетей
            [199, false], // Муктарали уулу Уланбек
            [316, false], // Базарбек уулу Байэл
            [201, false], // Ражапов Сыймык
            [197, false], // Исламов Алымбек
            [318, false], // Канназаров Нуркалый
            [321, false], // Абдурахманов Мухаммадали
            [323, false], // Эргешов Шахзодбек
            [383, false], // Мамазаир уулу Жусупбек
        ]);
        // Арт Бласт: Кенешбеков(22'), Эралиев(32')
        $this->goal($m3->id, $artBlast, 218, 22);
        $this->goal($m3->id, $artBlast, 220, 32);
        // Лидер-ОШМУ: Мурзакулов(4'), Мурзакулов(8'), Турсунбаев(24')
        $this->goal($m3->id, $liderOshmu, 248, 4);
        $this->goal($m3->id, $liderOshmu, 248, 8);
        $this->goal($m3->id, $liderOshmu, 320, 24);

        // ── Match 4: Кант 3-8 Тойота  (21.02.2026 19:00, ФОК «Кант», Кант) ──
        $m4 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $kant,
            'away_team_id' => $toyota,
            'venue'        => 'ФОК «Кант», Кант',
            'scheduled_at' => '2026-02-21 19:00:00',
            'status'       => 'completed',
            'home_score'   => 3,
            'away_score'   => 8,
        ]);

        $this->lineup($m4->id, $kant, [
            [145, false], // Пензаев Чынгыз
            [152, false], // Кадырбек уулу Ислам
            [162, false], // Шапданбек уулу Жолдошбек
            [232, false], // Муктарбеков Эльдар
            [217, false], // Андабеков Аман
            [422, false], // Кенешбеков Айбек
            [147, false], // Айдаркул уулу Эрмек
            [157, false], // Рахманкулов Азамат
            [155, false], // Мелисбек уулу Азамат
            [222, false], // Бейшеналиев Урмат
            [315, false], // Эсенгелдиев Калысбек
            [2,   false], // Салымбеков Нурсултан
            [159, false], // Султанбеков Бекзат
        ]);
        $this->lineup($m4->id, $toyota, [
            [234, false], // Мурзаев Бекболсун
            [240, false], // Долоткелдиев Азамат
            [247, false], // Турсунов Арстанбек
            [238, false], // Данияр уулу Абдурахим
            [221, false], // Туратбеков Ислам
            [233, false], // Джунушалиев Азирет
            [242, false], // Исабеков Азат
            [149, false], // Аянбаев Адил
            [142, false], // Куттубек уулу Акылбек
            [425, false], // Оливейра Веллингтон
            [426, true],  // Мориньо Маркос (MVP)
        ]);
        // Кант: Эсенгелдиев(7'), Салымбеков(35'), Кадырбек у(40')
        $this->goal($m4->id, $kant, 315, 7);
        $this->goal($m4->id, $kant, 2,   35);
        $this->goal($m4->id, $kant, 152, 40);
        // Тойота: Мориньо(5'), Исабеков(6'), Турсунов(2'), Туратбеков(16'), Оливейра(24'), Аянбаев(27'), Мориньо(30'), Мориньо(30')
        $this->goal($m4->id, $toyota, 247, 2);
        $this->goal($m4->id, $toyota, 426, 5);
        $this->goal($m4->id, $toyota, 242, 6);
        $this->goal($m4->id, $toyota, 221, 16);
        $this->goal($m4->id, $toyota, 425, 24);
        $this->goal($m4->id, $toyota, 149, 27);
        $this->goal($m4->id, $toyota, 426, 30);
        $this->goal($m4->id, $toyota, 426, 38);

        // ── Match 5: Виват 2-7 ДС Групп Нарын  (21.02.2026 21:00, СК КФБ, Бишкек) ──
        $m5 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $vivat,
            'away_team_id' => $naryn,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2026-02-21 21:00:00',
            'status'       => 'completed',
            'home_score'   => 2,
            'away_score'   => 7,
        ]);

        $this->lineup($m5->id, $vivat, [
            [353, false], // Яфаров Султан
            [50,  false], // Анарбеков Нурадил
            [58,  false], // Кадыров Дильшат
            [223, false], // Эсенгелдиев Асылбек
            [27,  false], // Иманалиев Элбек
            [132, false], // Тургунбеков Адыл
            [47,  false], // Маликжанов Нурэл
            [52,  false], // Вильямов Бахридин
            [56,  false], // Зажигаев Данил
            [59,  false], // Керимбаев Эмирлан
            [60,  false], // Кошонов Канкелди
            [64,  false], // Минкеев Ильзат
            [68,  false], // Чиркин Кирилл
            [352, false], // Игольников Илья
        ]);
        $this->lineup($m5->id, $naryn, [
            [20,  false], // Куватбек Адил (GK)
            [75,  false], // Байгазы уулу Уланбек
            [364, true],  // Абдыбеков Эржан (MVP)
            [118, false], // Аскеров Азамат
            [231, false], // Самат уулу Алмазбек
            [71,  false], // Айылчиев Алманбет
            [73,  false], // Айтокторов Нурберген
            [91,  false], // Турсунбеков Уран
            [153, false], // Карыпбеков Бекмат
            [28,  false], // Канатбеков Аймен
            [243, false], // Кубанычов Кайрат
            [244, false], // Мамбеталиев Саламат
            [385, false], // Данрлей Винаес
            [386, false], // Леандро Пелегрино
        ]);
        // Виват: Эсенгелдиев(9'), Кадыров(38')
        $this->goal($m5->id, $vivat, 223, 9);
        $this->goal($m5->id, $vivat, 58,  38);
        // Нарын: Винаес(27'), Байгазы у(25'), Абдыбеков(28'), Абдыбеков(31'), Пелегрино(30'), Кубанычов(38'), Карыпбеков(40')
        $this->goal($m5->id, $naryn, 75,  25);
        $this->goal($m5->id, $naryn, 385, 27);
        $this->goal($m5->id, $naryn, 364, 28);
        $this->goal($m5->id, $naryn, 386, 30);
        $this->goal($m5->id, $naryn, 364, 31);
        $this->goal($m5->id, $naryn, 243, 38);
        $this->goal($m5->id, $naryn, 153, 40);

        // ── Match 6: Алай 5-5 Лидер-ОШМУ  (22.02.2026 17:00, СК КФБ, Бишкек) ──
        $m6 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $alay,
            'away_team_id' => $liderOshmu,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2026-02-22 17:00:00',
            'status'       => 'completed',
            'home_score'   => 5,
            'away_score'   => 5,
        ]);

        $this->lineup($m6->id, $alay, [
            [45,  false], // Султангазиев Илимбек
            [237, false], // Бабажанов Саид
            [259, false], // Дурусбеков Таалайнур
            [89,  false], // Талантбек уулу Жыргалбек
            [198, true],  // Култаев Адилет (MVP)
            [295, false], // Суйорбеков Сагынбек
            [291, false], // Бактыбеков Арстанбек
            [292, false], // Бейшенбеков Максат
            [394, false], // Ишенбек уулу Бакытбек
            [10,  false], // Сатыбалдиев Айдар
            [358, false], // Сатыбалдиев Эльдар
            [5,   false], // Торобеков Бакдоолот
        ]);
        $this->lineup($m6->id, $liderOshmu, [
            [186, false], // Кудайбердиев Сыймыкбек
            [197, false], // Исламов Алымбек
            [201, false], // Ражапов Сыймык
            [321, false], // Абдурахманов Мухаммадали
            [323, false], // Эргешов Шахзодбек
            [384, false], // Кыялбеков Семетей
            [316, false], // Базарбек уулу Байэл
            [317, false], // Токоев Арсланбек
            [318, false], // Канназаров Нуркалый
            [320, false], // Турсунбаев Шумкар
            [248, false], // Мурзакулов Семетей
            [382, false], // Павлов Никита
            [383, false], // Мамазаир уулу Жусупбек
        ]);
        // Алай: Култаев(20'), Талантбек у(26'), Култаев(29'37'40')
        $this->goal($m6->id, $alay, 198, 20);
        $this->goal($m6->id, $alay, 89,  26);
        $this->goal($m6->id, $alay, 198, 29);
        $this->goal($m6->id, $alay, 198, 37);
        $this->goal($m6->id, $alay, 198, 40);
        // Лидер-ОШМУ: Мурзакулов(5'), Ражапов(6'), Токоев(12'20'), Абдурахманов(19')
        $this->goal($m6->id, $liderOshmu, 248, 5);
        $this->goal($m6->id, $liderOshmu, 201, 6);
        $this->goal($m6->id, $liderOshmu, 317, 12);
        $this->goal($m6->id, $liderOshmu, 321, 19);
        $this->goal($m6->id, $liderOshmu, 317, 20);

        // ── Match 7: Арт Бласт Групп 5-5 Жаш Муун  (22.02.2026 19:00, СК КФБ, Бишкек) ──
        $m7 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $artBlast,
            'away_team_id' => $zhashMuun,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2026-02-22 19:00:00',
            'status'       => 'completed',
            'home_score'   => 5,
            'away_score'   => 5,
        ]);

        $this->lineup($m7->id, $artBlast, [
            [212, false], // Насирдинов Султан
            [213, false], // Абдурашит уулу Арген
            [250, false], // Талайбеков Данияр
            [150, false], // Джанат уулу Самат
            [16,  false], // Бактыбеков Эржан
            [397, false], // Жузумалиев Ислам
            [21,  false], // Ильясов Бектур
            [220, false], // Эралиев Мухаммедиса
            [219, false], // Эралиев Мухаммедмуса
            [227, false], // Мендибаев Нурдин
            [224, false], // Маматов Артур
            [356, false], // Каныбеков Атайбек
            [357, false], // Талайбеков Арсен
            [236, true],  // Алимов Максат (MVP)
        ]);
        $this->lineup($m7->id, $zhashMuun, [
            [269, false], // Абдувалиев Омурали
            [299, false], // Сайфуллаев Хожиакбар
            [300, false], // Жанторев Билал
            [304, false], // Абдурасулов Нурсултан
            [306, false], // Махаматкулов Мухаммадали
            [420, false], // Мамиров Зухридин
            [301, false], // Таштемиров Абдурофи
            [415, false], // Зульпиев Тиллабай
            [416, false], // Шахапов Элмырза
            [418, false], // Абдувалиев Аслидин
            [246, false], // Салимбаев Юлдашбай
        ]);
        // Арт Бласт: Ильясов(12'), Алимов(16'), Джанат у(23'), Бактыбеков(30'), Алимов(35')
        $this->goal($m7->id, $artBlast, 21,  12);
        $this->goal($m7->id, $artBlast, 236, 16);
        $this->goal($m7->id, $artBlast, 150, 23);
        $this->goal($m7->id, $artBlast, 16,  30);
        $this->goal($m7->id, $artBlast, 236, 35);
        // Жаш Муун: Салимбаев(4'), Таштемиров(10'), Махаматкулов(27'28'), Салимбаев(24')
        $this->goal($m7->id, $zhashMuun, 246, 4);
        $this->goal($m7->id, $zhashMuun, 301, 10);
        $this->goal($m7->id, $zhashMuun, 246, 24);
        $this->goal($m7->id, $zhashMuun, 306, 27);
        $this->goal($m7->id, $zhashMuun, 306, 28);

        // ── Match 8: Талас 4-2 Топ Тоголок  (22.02.2026 21:00, СК КФБ, Бишкек) ──
        $m8 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $talas,
            'away_team_id' => $topTogolok,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2026-02-22 21:00:00',
            'status'       => 'completed',
            'home_score'   => 4,
            'away_score'   => 2,
        ]);

        $this->lineup($m8->id, $talas, [
            [285, false], // Жумалиев Нурсултан
            [139, false], // Бактыбек уулу Талас
            [11,  false], // Мыктыбеков Аскат
            [12,  false], // Мукушбеков Рамис
            [143, false], // Сабырбек уулу Майрамбек
            [6,   false], // Курманбеков Бектур
            [34,  false], // Орунбеков Камбар
            [35,  false], // Саякбаев Кыяз
            [345, false], // Айтмырзаев Нооруэбай
            [346, false], // Чолпонбаев Бийжан
            [140, false], // Батырбек уулу Улан
            [399, false], // Каныбек уулу Бактияр
            [400, false], // Суйутбеков Актан
            [402, true],  // Ниязбеков Ислам (MVP)
        ]);
        $this->lineup($m8->id, $topTogolok, [
            [15,  false], // Азатов Амир
            [107, false], // Азамат уулу Айдар
            [25,  false], // Ашуров Сыймык
            [336, false], // Султанов Нуралы
            [411, false], // Исамидинов Темирлан
            [133, false], // Мухтар уулу Байэл
            [334, false], // Абдирасулов Актилек
            [277, false], // Сманов Байэл
            [342, false], // Данияров Саян
            [62,  false], // Лиров Равил
            [405, false], // Калбаев Абдулазиз
            [408, false], // Токтосунов Дастан
            [410, false], // Макеев Рамазан
            [413, false], // Калиев Нуржигит
        ]);
        // Талас: Ниязбеков(24'30'40'), Бактыбек у(40')
        $this->goal($m8->id, $talas, 402, 24);
        $this->goal($m8->id, $talas, 402, 30);
        $this->goal($m8->id, $talas, 402, 40);
        $this->goal($m8->id, $talas, 139, 40);
        // Топ Тоголок: Токтосунов(19'36')
        $this->goal($m8->id, $topTogolok, 408, 19);
        $this->goal($m8->id, $topTogolok, 408, 36);
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
