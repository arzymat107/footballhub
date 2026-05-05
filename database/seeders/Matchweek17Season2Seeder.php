<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Fixture;
use App\Models\FixtureLineup;
use App\Models\Player;
use App\Models\Round;
use Illuminate\Database\Seeder;

// Суперлига 2025-26 — Matchweek 17 / 2-АЙЛАМПА (7 March 2026)
// Source: futsal_kgz Instagram posts
class Matchweek17Season2Seeder extends Seeder
{
    public function run(): void
    {
        $round = Round::firstOrCreate(
            ['stage_id' => 4, 'name' => 'Matchweek 17'],
            ['order' => 17],
        );

        $talas      = 1;
        $topTogolok = 2;
        $vivat      = 3;
        $naryn      = 4;
        $karakol    = 5;
        $kant       = 7;
        $zhashMuun  = 12;
        $liderOshmu = 13;
        $alay       = 11;

        $sharshenbekov = Player::firstOrCreate(['name' => 'Шаршенбеков Алибек'])->id;

        // ── Match 1: Лидер-ОШМУ 7-5 Виват  (07.03.2026 16:00, Ош СК «Шавкат», Ош) ──
        $m1 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $liderOshmu,
            'away_team_id' => $vivat,
            'venue'        => 'СК «Шавкат», Ош',
            'scheduled_at' => '2026-03-07 16:00:00',
            'status'       => 'completed',
            'home_score'   => 7,
            'away_score'   => 5,
        ]);

        $this->lineup($m1->id, $liderOshmu, [
            [186, false], // Кудайбердиев Сыймыкбек
            [197, false], // Исламов Алымбек
            [321, true],  // Абдурахманов Мухаммадали (MVP)
            [248, false], // Мурзакулов Семетей
            [382, false], // Павлов Никита
            [384, false], // Кыялбеков Семетей
            [199, false], // Муктарали уулу Уланбек
            [316, false], // Базарбек уулу Байэл
            [317, false], // Токоев Арсланбек
            [65,  false], // Назаралиев Урмат
            [168, false], // Алмазбеков Омурбек
            [201, false], // Ражапов Сыймык
            [320, false], // Турсунбаев Шумкар
            [184, false], // Эргашев Диёрбек
        ]);
        $this->lineup($m1->id, $vivat, [
            [132, false], // Тургунбеков Адыл
            [50,  false], // Анарбеков Нурадил
            [58,  false], // Кадыров Дильшат
            [352, false], // Игольников Илья
            [27,  false], // Иманалиев Элбек
            [47,  false], // Маликжанов Нурэл
            [52,  false], // Вильямов Бахридин
            [56,  false], // Зажигаев Данил
            [57,  false], // Искендербеков Талгат
            [59,  false], // Керимбаев Эмирлан
            [60,  false], // Кошонов Канкелди
            [64,  false], // Минкеев Ильзат
            [68,  false], // Чиркин Кирилл
            [223, false], // Эсенгелдиев Асылбек
        ]);
        // Лидер-ОШМУ: Абдурахманов(1'7'24'28'), Токоев(25'), Павлов(30'), Мурзакулов(36')
        $this->goal($m1->id, $liderOshmu, 321, 1);
        $this->goal($m1->id, $liderOshmu, 321, 7);
        $this->goal($m1->id, $liderOshmu, 317, 25);
        $this->goal($m1->id, $liderOshmu, 321, 24);
        $this->goal($m1->id, $liderOshmu, 382, 30);
        $this->goal($m1->id, $liderOshmu, 321, 28);
        $this->goal($m1->id, $liderOshmu, 248, 36);
        // Виват: Иманалиев(11'), Чиркин(31'33'36'), Кадыров(35')
        $this->goal($m1->id, $vivat, 27,  11);
        $this->goal($m1->id, $vivat, 68,  31);
        $this->goal($m1->id, $vivat, 68,  33);
        $this->goal($m1->id, $vivat, 68,  36);
        $this->goal($m1->id, $vivat, 58,  35);

        // ── Match 2: Жаш Муун 8-4 Каракол  (07.03.2026 19:00, СК «Акматалы Ажы», Жалал-Абад) ──
        $m2 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $zhashMuun,
            'away_team_id' => $karakol,
            'venue'        => 'СК «Акматалы Ажы», Жалал-Абад',
            'scheduled_at' => '2026-03-07 19:00:00',
            'status'       => 'completed',
            'home_score'   => 8,
            'away_score'   => 4,
        ]);

        $this->lineup($m2->id, $zhashMuun, [
            [269, false], // Абдувалиев Омурали
            [301, false], // Таштемиров Абдурофи
            [268, false], // Арапов Кубатбек
            [306, false], // Махаматкулов Мухаммадали
            [246, true],  // Салимбаев Юлдашбай (MVP)
            [420, false], // Мамиров Зухридин
            [299, false], // Сайфуллаев Хожиакбар
            [300, false], // Жанторев Билал
            [302, false], // Пахридинов Гупронидин
            [304, false], // Абдурасулов Нурсултан
            [308, false], // Толонмирзаев Арген
            [415, false], // Зульпиев Тиллабай
            [417, false], // Шералиев Билал
            [418, false], // Абдувалиев Аслидин
        ]);
        $this->lineup($m2->id, $karakol, [
            [392, false], // Сайбеков Бахтияр
            [326, false], // Шакилов Ийгилик
            [$sharshenbekov, false], // Шаршенбеков
            [88,  false], // Сыдыков Нурслан
            [289, false], // Садыков Канат
            [105, false], // Усупов Эрлан
            [98,  false], // Нурбеков Нурсултан
        ]);
        // Жаш Муун: Салимбаев(10'17'31'37'), Пахридинов(25'), Жанторев(29'32'), Сайфуллаев(32')
        $this->goal($m2->id, $zhashMuun, 246, 10);
        $this->goal($m2->id, $zhashMuun, 246, 17);
        $this->goal($m2->id, $zhashMuun, 302, 25);
        $this->goal($m2->id, $zhashMuun, 300, 29);
        $this->goal($m2->id, $zhashMuun, 246, 31);
        $this->goal($m2->id, $zhashMuun, 300, 32);
        $this->goal($m2->id, $zhashMuun, 299, 32);
        $this->goal($m2->id, $zhashMuun, 246, 37);
        // Каракол: Сыдыков(5'), Алтынбек у(15'), Садыков(13'23')
        $this->goal($m2->id, $karakol, 88,  5);
        $this->goal($m2->id, $karakol, 390, 15);
        $this->goal($m2->id, $karakol, 289, 13);
        $this->goal($m2->id, $karakol, 289, 23);

        // ── Match 3: Топ Тоголок 2-9 Кант  (07.03.2026 19:30, СК КФБ, Бишкек) ──
        $m3 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $topTogolok,
            'away_team_id' => $kant,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2026-03-07 19:30:00',
            'status'       => 'completed',
            'home_score'   => 2,
            'away_score'   => 9,
        ]);

        $this->lineup($m3->id, $topTogolok, [
            [15,  false], // Азатов Амир
            [107, false], // Азамат уулу Айдар
            [336, false], // Султанов Нуралы
            [62,  false], // Лиров Равил
            [405, false], // Калбаев Абдулазиз
            [133, false], // Мухтар уулу Байэл
            [25,  false], // Ашуров Сыймык
            [334, false], // Абдирасулов Актилек
            [277, false], // Сманов Байэл
            [407, false], // Жолдошалиев Ринат
            [245, false], // Сакенов Илимбек
            [411, false], // Исамидинов Темирлан
            [413, false], // Калиев Нуржигит
        ]);
        $this->lineup($m3->id, $kant, [
            [145, false], // Пензаев Чынгыз
            [152, true],  // Кадырбек уулу Ислам (MVP)
            [157, false], // Рахманкулов Азамат
            [3,   false], // Замирбеков Женишбек
            [232, false], // Муктарбеков Эльдар
            [422, false], // Кенешбеков Айбек
            [147, false], // Айдаркул уулу Эрмек
            [155, false], // Мелисбек уулу Азамат
            [222, false], // Бейшеналиев Урмат
            [281, false], // Саякбаев Кудайберген
            [315, false], // Эсенгелдиев Калысбек
            [2,   false], // Салымбеков Нурсултан
            [217, false], // Андабеков Аман
            [159, false], // Султанбеков Бекзат
        ]);
        // Топ Тоголок: Сманов(31'), Азатов(39')
        $this->goal($m3->id, $topTogolok, 277, 31);
        $this->goal($m3->id, $topTogolok, 15,  39);
        // Кант: Замирбеков(1'40'), Салымбеков(8'18'), Кадырбек(20'), Андабеков(21'),
        //        Султанбеков(26'29'), Эсенгелдиев(30')
        $this->goal($m3->id, $kant, 3,   1);
        $this->goal($m3->id, $kant, 2,   8);
        $this->goal($m3->id, $kant, 2,   18);
        $this->goal($m3->id, $kant, 152, 20);
        $this->goal($m3->id, $kant, 217, 21);
        $this->goal($m3->id, $kant, 159, 26);
        $this->goal($m3->id, $kant, 159, 29);
        $this->goal($m3->id, $kant, 315, 30);
        $this->goal($m3->id, $kant, 3,   40);

        // ── Match 4: Алай 5-7 ДС Групп Нарын  (07.03.2026 21:30, СК КФБ, Бишкек) ──
        $m4 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $alay,
            'away_team_id' => $naryn,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2026-03-07 21:30:00',
            'status'       => 'completed',
            'home_score'   => 5,
            'away_score'   => 7,
        ]);

        $this->lineup($m4->id, $alay, [
            [45,  false], // Султангазиев Илимбек
            [257, false], // Мурзакарим уулу Асан
            [237, false], // Бабажанов Саид
            [235, false], // Акматов Калдуубай
            [394, false], // Ишенбек уулу Бакытбек
            [295, false], // Суйорбеков Сагынбек
            [259, false], // Дурусбеков Таалайнур
            [291, false], // Бактыбеков Арстанбек
            [89,  false], // Талантбек уулу Жыргалбек
            [198, false], // Култаев Адилет
            [292, false], // Бейшенбеков Максат
            [10,  false], // Сатыбалдиев Айдар
            [358, false], // Сатыбалдиев Эльдар
        ]);
        $this->lineup($m4->id, $naryn, [
            [20,  false], // Куватбек Адил (GK)
            [75,  false], // Байгазы уулу Уланбек
            [364, false], // Абдыбеков Эржан
            [231, false], // Самат уулу Алмазбек
            [385, false], // Данрлей Винаес
            [71,  false], // Айылчиев Алманбет
            [73,  false], // Айтокторов Нурберген
            [91,  false], // Турсунбеков Уран
            [369, false], // Замирбеков Марлен
            [153, false], // Карыпбеков Бекмат
            [28,  true],  // Канатбеков Аймен (MVP)
            [243, false], // Кубанычов Кайрат
            [244, false], // Мамбеталиев Саламат
            [386, false], // Леандро Пелегрино
        ]);
        // Алай: Бабажанов(9'14'17'24'), Акматов(10')
        $this->goal($m4->id, $alay, 237, 9);
        $this->goal($m4->id, $alay, 235, 10);
        $this->goal($m4->id, $alay, 237, 14);
        $this->goal($m4->id, $alay, 237, 17);
        $this->goal($m4->id, $alay, 237, 24);
        // ДС Групп Нарын: Канатбеков(4'20'26'40'), Пелегрино(12'), Абдыбеков(15'), Винхаес(30')
        $this->goal($m4->id, $naryn, 28,  4);
        $this->goal($m4->id, $naryn, 386, 12);
        $this->goal($m4->id, $naryn, 364, 15);
        $this->goal($m4->id, $naryn, 28,  20);
        $this->goal($m4->id, $naryn, 28,  26);
        $this->goal($m4->id, $naryn, 385, 30);
        $this->goal($m4->id, $naryn, 28,  40);
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