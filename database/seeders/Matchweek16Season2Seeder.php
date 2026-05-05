<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Fixture;
use App\Models\FixtureLineup;
use App\Models\Player;
use App\Models\Round;
use Illuminate\Database\Seeder;

// Суперлига 2025-26 — Matchweek 16 / 2-АЙЛАМПА (28 Feb – 1 Mar 2026)
// Source: futsal_kgz Instagram posts
class Matchweek16Season2Seeder extends Seeder
{
    public function run(): void
    {
        $round = Round::firstOrCreate(
            ['stage_id' => 4, 'name' => 'Matchweek 16'],
            ['order' => 16],
        );

        $talas      = 1;
        $topTogolok = 2;
        $vivat      = 3;
        $naryn      = 4;
        $karakol    = 5;
        $kant       = 7;
        $dostuk     = 14;
        $toyota     = 15;

        // ── Match 1: Топ Тоголок 6-5 Виват  (28.02.2026 19:30, СК КФБ, Бишкек) ──
        $m1 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $topTogolok,
            'away_team_id' => $vivat,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2026-02-28 19:30:00',
            'status'       => 'completed',
            'home_score'   => 6,
            'away_score'   => 5,
        ]);

        $this->lineup($m1->id, $topTogolok, [
            [15,  false], // Азатов Амир
            [107, false], // Азамат уулу Айдар
            [25,  true],  // Ашуров Сыймык (MVP)
            [336, false], // Султанов Нуралы
            [411, false], // Исамидинов Темирлан
            [133, false], // Мухтар уулу Байэл
            [334, false], // Абдирасулов Актилек
            [342, false], // Данияров Саян
            [62,  false], // Лиров Равил
            [405, false], // Калбаев Абдулазиз
            [407, false], // Жолдошалиев Ринат
            [410, false], // Макеев Рамазан
            [245, false], // Сакенов Илимбек
            [413, false], // Калиев Нуржигит
        ]);
        $this->lineup($m1->id, $vivat, [
            [47,  false], // Маликжанов Нурэл
            [50,  false], // Анарбеков Нурадил
            [52,  false], // Вильямов Бахридин
            [58,  false], // Кадыров Дильшат
            [27,  false], // Иманалиев Элбек
            [132, false], // Тургунбеков Адыл
            [56,  false], // Зажигаев Данил
            [59,  false], // Керимбаев Эмирлан
            [60,  false], // Кошонов Канкелди
            [64,  false], // Минкеев Ильзат
            [68,  false], // Чиркин Кирилл
            [352, false], // Игольников Илья
            [353, false], // Яфаров Султан
        ]);
        // Топ Тоголок: Азамат У(13'13'), Ашуров(15'39'), Исамидинов(23'), Калбаев(37')
        $this->goal($m1->id, $topTogolok, 107, 13);
        $this->goal($m1->id, $topTogolok, 107, 13);
        $this->goal($m1->id, $topTogolok, 25,  15);
        $this->goal($m1->id, $topTogolok, 411, 23);
        $this->goal($m1->id, $topTogolok, 405, 37);
        $this->goal($m1->id, $topTogolok, 25,  39);
        // Виват: Кадыров(13'), Анарбеков(28'29'35'), Иманалиев(38')
        $this->goal($m1->id, $vivat, 58,  13);
        $this->goal($m1->id, $vivat, 50,  28);
        $this->goal($m1->id, $vivat, 50,  29);
        $this->goal($m1->id, $vivat, 50,  35);
        $this->goal($m1->id, $vivat, 27,  38);

        // ── Match 2: Кант 4-4 Талас  (28.02.2026 19:00, ФОК «Кант», Кант) ──
        $m2 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $kant,
            'away_team_id' => $talas,
            'venue'        => 'ФОК «Кант», Кант',
            'scheduled_at' => '2026-02-28 19:00:00',
            'status'       => 'completed',
            'home_score'   => 4,
            'away_score'   => 4,
        ]);

        $this->lineup($m2->id, $kant, [
            [145, false], // Пензаев Чынгыз
            [155, false], // Мелисбек уулу Азамат
            [222, false], // Бейшеналиев Урмат
            [315, false], // Эсенгелдиев Калысбек
            [217, false], // Андабеков Аман
            [422, false], // Кенешбеков Айбек
            [147, false], // Айдаркул уулу Эрмек
            [281, false], // Саякбаев Кудайберген
            [2,   false], // Салымбеков Нурсултан
            [421, false], // Зубарев Артур
            [159, true],  // Султанбеков Бекзат (MVP)
        ]);
        $this->lineup($m2->id, $talas, [
            [6,   false], // Курманбеков Бектур
            [139, false], // Бактыбек уулу Талас
            [11,  false], // Мыктыбеков Аскат
            [12,  false], // Мукушбеков Рамис
            [143, false], // Сабырбек уулу Майрамбек
            [285, false], // Жумалиев Нурсултан
            [34,  false], // Орунбеков Камбар
            [35,  false], // Саякбаев Кыяз
            [345, false], // Айтмырзаев Нооруэбай
            [140, false], // Батырбек уулу Улан
            [349, false], // Ануарбек уулу Адилет
            [399, false], // Каныбек уулу Бактияр
            [400, false], // Суйутбеков Актан
            [402, false], // Ниязбеков Ислам
        ]);
        // Кант: Бейшеналиев(18'), Мелисбек(23'), Эсенгелдиев(26'), Султанбеков(40')
        $this->goal($m2->id, $kant, 222, 18);
        $this->goal($m2->id, $kant, 155, 23);
        $this->goal($m2->id, $kant, 315, 26);
        $this->goal($m2->id, $kant, 159, 40);
        // Талас: Сабырбек у(9'), Мыктыбеков(18'), Ниязбеков(20'39')
        $this->goal($m2->id, $talas, 143, 9);
        $this->goal($m2->id, $talas, 11,  18);
        $this->goal($m2->id, $talas, 402, 20);
        $this->goal($m2->id, $talas, 402, 39);

        // ── Match 3: Toyota 4-0 Достук  (28.02.2026 21:30, СК КФБ, Бишкек) ──
        $kasymakun = Player::firstOrCreate(['name' => 'Касымакунов Жаркын'])->id;

        $m3 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $toyota,
            'away_team_id' => $dostuk,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2026-02-28 21:30:00',
            'status'       => 'completed',
            'home_score'   => 4,
            'away_score'   => 0,
        ]);

        $this->lineup($m3->id, $toyota, [
            [234, false], // Мурзаев Бекболсун
            [242, false], // Исабеков Азат
            [376, false], // Амандык уулу Денисбек
            [425, false], // Оливейра Веллингтон
            [426, true],  // Мориньо Маркос (MVP)
            [233, false], // Джунушалиев Азирет
            [149, false], // Аянбаев Адил
            [240, false], // Долоткелдиев Азамат
            [247, false], // Турсунов Арстанбек
            [142, false], // Куттубек уулу Акылбек
            [238, false], // Данияр уулу Абдурахим
            [221, false], // Туратбеков Ислам
            [424, false], // Карыпбеков Дастан
        ]);
        $this->lineup($m3->id, $dostuk, [
            [46,  false], // Кыргызов Айбек
            [178, false], // Сайдалиев Дамирбек
            [166, false], // Абдуллаев Мухаммадсодик
            [4,   false], // Жакыпов Руслан
            [$kasymakun, false], // Касымакунов
            [49,  false], // Шамонин Станислав
            [360, false], // Бейшенов Бабур
            [362, false], // Абдумажидов Абдуллах
            [404, false], // Айтбаев Азамат
            [270, false], // Карыбеков Даниэл
            [361, false], // Бакиев Али
            [359, false], // Токтогонов Улукман
            [78,  false], // Жумабеков Султан
            [335, false], // Бекбоев Кутман
        ]);
        // Toyota: Маркос(19'34'), Данияр У(39'), Доолоткелдиев(40')
        $this->goal($m3->id, $toyota, 426, 19);
        $this->goal($m3->id, $toyota, 426, 34);
        $this->goal($m3->id, $toyota, 238, 39);
        $this->goal($m3->id, $toyota, 240, 40);

        // ── Match 4: Каракол 2-12 ДС Групп Нарын  (01.03.2026 20:00, ФОК «Каракол», Каракол) ──
        $m4 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $karakol,
            'away_team_id' => $naryn,
            'venue'        => 'ФОК «Каракол», Каракол',
            'scheduled_at' => '2026-03-01 20:00:00',
            'status'       => 'completed',
            'home_score'   => 2,
            'away_score'   => 12,
        ]);

        $this->lineup($m4->id, $karakol, [
            [392, false], // Сайбеков Бахтияр
            [105, false], // Усупов Эрлан
            [88,  false], // Сыдыков Нурслан
            [289, false], // Садыков Канат
            [388, false], // Пулотов Шавкатчон
            [326, false], // Шакилов Ийгилик
            [104, false], // Усупов Адилет
            [327, false], // Дюшембаев Жанарбек
            [94,  false], // Авазбеков Эрлан
            [100, false], // Орозбеков Улукбек
            [98,  false], // Нурбеков Нурсултан
        ]);
        $this->lineup($m4->id, $naryn, [
            [20,  false], // Куватбек Адил (GK)
            [75,  false], // Байгазы уулу Уланбек
            [364, true],  // Абдыбеков Эржан (MVP)
            [118, false], // Аскеров Азамат
            [231, false], // Самат уулу Алмазбек
            [71,  false], // Айылчиев Алманбет
            [73,  false], // Айтокторов Нурберген
            [153, false], // Карыпбеков Бекмат
            [243, false], // Кубанычов Кайрат
            [244, false], // Мамбеталиев Саламат
            [385, false], // Данрлей Винаес
            [386, false], // Леандро Пелегрино
        ]);
        // Каракол: Сыдыков(12')
        $this->goal($m4->id, $karakol, 88, 12);
        // Каракол: Усупов(18' АГ — автогол в пользу Нарына)
        $this->ownGoal($m4->id, $naryn, 105, 18);
        // ДС Групп Нарын: Пелегрина(14'), Байгазы у(13'24'), Кубанычов(18'), Мамбеталиев(20'37'),
        //                  Абдыбеков(29'), Аскеров(30'), Самат у(35'), Винхеас(32'33')
        $this->goal($m4->id, $naryn, 386, 14);
        $this->goal($m4->id, $naryn, 75,  13);
        $this->goal($m4->id, $naryn, 75,  24);
        $this->goal($m4->id, $naryn, 243, 18);
        $this->goal($m4->id, $naryn, 244, 20);
        $this->goal($m4->id, $naryn, 364, 29);
        $this->goal($m4->id, $naryn, 118, 30);
        $this->goal($m4->id, $naryn, 231, 35);
        $this->goal($m4->id, $naryn, 385, 32);
        $this->goal($m4->id, $naryn, 385, 33);
        $this->goal($m4->id, $naryn, 244, 37);
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