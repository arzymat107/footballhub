<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Fixture;
use App\Models\FixtureLineup;
use App\Models\Player;
use App\Models\Round;
use Illuminate\Database\Seeder;

// Суперлига 2025-26 — Matchweek 18 / 2-АЙЛАМПА (14–15 Mar 2026)
// Source: futsal_kgz Instagram posts
class Matchweek18Season2Seeder extends Seeder
{
    public function run(): void
    {
        $round = Round::firstOrCreate(
            ['stage_id' => 4, 'name' => 'Matchweek 18'],
            ['order' => 18],
        );

        $talas      = 1;
        $topTogolok = 2;
        $naryn      = 4;
        $alay       = 11;
        $kant       = 7;
        $artBlast   = 10;
        $dostuk     = 14;
        $toyota     = 15;

        $ishenbekov  = Player::firstOrCreate(['name' => 'Ишенбеков'])->id;

        // ── Match 1: Достук 3-5 ДС Групп Нарын  (14.03.2026 20:00, СК КФБ, Бишкек) ──
        $m1 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $dostuk,
            'away_team_id' => $naryn,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2026-03-14 20:00:00',
            'status'       => 'completed',
            'home_score'   => 3,
            'away_score'   => 5,
        ]);

        $this->lineup($m1->id, $dostuk, [
            [46,  false], // Кыргызов Айбек
            [178, false], // Сайдалиев Дамирбек
            [166, false], // Абдуллаев Мухаммадсодик
            [170, false], // Жакыпов Даулес
            [19, false], // Касмакунов
            [49,  false], // Шамонин Станислав
            [360, false], // Бейшенов Бабур
            [362, false], // Абдумажидов Абдуллах
            [270, false], // Карыбеков Даниэл
            [361, false], // Бакиев Али
            [359, false], // Токтогонов Улукман
            [78,  false], // Жумабеков Султан
            [335, false], // Бекбоев Кутман
        ]);
        $this->lineup($m1->id, $naryn, [
            [387, false], // Жабаров Нуриддин
            [75,  false], // Байгазы уулу Уланбек
            [364, false], // Абдыбеков Эржан
            [369, false], // Замирбеков Марлен
            [385, true],  // Данрлей Винаес (MVP)
            [20,  false], // Куватбек Адил
            [73,  false], // Айтокторов Нурберген
            [91,  false], // Турсунбеков Уран
            [28,  false], // Канатбеков Аймен
            [243, false], // Кубанычов Кайрат
            [244, false], // Мамбеталиев Саламат
            [386, false], // Леандро Пелегрино
        ]);
        // Достук: Сайдалиев(7'), Абдумажидов(8'), Касмакунов(40')
        $this->goal($m1->id, $dostuk, 178, 7);
        $this->goal($m1->id, $dostuk, 362, 8);
        $this->goal($m1->id, $dostuk, 19, 40);
        // ДС Групп Нарын: Абдыбеков(1'), Канатбеков(12'), Винхаес(20'), Мамбеталиев(31'), Кубанычов(38')
        $this->goal($m1->id, $naryn, 364, 1);
        $this->goal($m1->id, $naryn, 28,  12);
        $this->goal($m1->id, $naryn, 385, 20);
        $this->goal($m1->id, $naryn, 244, 31);
        $this->goal($m1->id, $naryn, 243, 38);

        // ── Match 2: Талас 1-3 Toyota  (14.03.2026 22:00, СК КФБ, Бишкек) ──
        $m2 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $talas,
            'away_team_id' => $toyota,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2026-03-14 22:00:00',
            'status'       => 'completed',
            'home_score'   => 1,
            'away_score'   => 3,
        ]);

        $this->lineup($m2->id, $talas, [
            [285, false], // Жумалиев Нурсултан
            [139, false], // Бактыбек уулу Талас
            [11,  false], // Мыктыбеков Аскат
            [34,  false], // Орунбеков Камбар
            [143, false], // Сабырбек уулу Майрамбек
            [12,  false], // Мукушбеков Рамис
            [35,  false], // Саякбаев Кыяз
            [13,  false], // Алымжанов Дастан
            [346, false], // Чолпонбаев Бийжан
            [37,  false], // Ахметов Арлан
            [349, false], // Ануарбек уулу Адилет
            [399, false], // Каныбек уулу Бактияр
            [400, false], // Суйутбеков Актан
            [402, false], // Ниязбеков Ислам
        ]);
        $this->lineup($m2->id, $toyota, [
            [234, false], // Мурзаев Бекболсун
            [242, false], // Исабеков Азат
            [149, false], // Аянбаев Адил
            [425, true],  // Оливейра Веллингтон (MVP)
            [426, false], // Мориньо Маркос
            [233, false], // Джунушалиев Азирет
            [240, false], // Долоткелдиев Азамат
            [376, false], // Амандык уулу Денисбек
            [247, false], // Турсунов Арстанбек
            [142, false], // Куттубек уулу Акылбек
            [238, false], // Данияр уулу Абдурахим
            [221, false], // Туратбеков Ислам
            [424, false], // Карыпбеков Дастан
        ]);
        // Талас: Орунбеков(7')
        $this->goal($m2->id, $talas, 34, 7);
        // Toyota: Оливейра(11'36'), Амандык у(16')
        $this->goal($m2->id, $toyota, 425, 11);
        $this->goal($m2->id, $toyota, 376, 16);
        $this->goal($m2->id, $toyota, 425, 36);

        // ── Match 3: Арт Бласт 6-3 Топ Тоголок  (15.03.2026 20:00, СК КФБ, Бишкек) ──
        $m3 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $artBlast,
            'away_team_id' => $topTogolok,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2026-03-15 20:00:00',
            'status'       => 'completed',
            'home_score'   => 6,
            'away_score'   => 3,
        ]);

        $this->lineup($m3->id, $artBlast, [
            [212, false], // Насирдинов
            [213, true],  // Абдурашит уулу Арген (MVP scorer)
            [250, false], // Талайбеков Данияр (MVP)
            [150, false], // Джанат уулу
            [16,  false], // Бактыбеков Эржан
            [397, false], // Жузумалиев Ислам
            [21,  false], // Ильясов Бектур
            [219, false], // Эралиев Мухаммедмуса
            [220, false], // Эралиев Мухаммедиса
            [224, false], // Маматов Артур
            [356, false], // Каныбеков Атайбек
            [357, false], // Талайбеков Арсен
            [236, false], // Алимов
        ]);
        $this->lineup($m3->id, $topTogolok, [
            [15,  false], // Азатов Амир
            [107, false], // Азамат уулу Айдар
            [24,  false], // Абдымамытов Адахан
            [277, false], // Сманов Байэл
            [405, false], // Калбаев Абдулазиз
            [133, false], // Мухтар уулу Байэл
            [25,  false], // Ашуров Сыймык
            [334, false], // Абдирасулов Актилек
            [62,  false], // Лиров Равил
            [336, false], // Султанов Нуралы
            [407, false], // Жолдошалиев Ринат
            [410, false], // Макеев Рамазан
            [245, false], // Сакенов Илимбек
            [413, false], // Калиев Нуржигит
        ]);
        // Арт Бласт: Абдурашит(2'), Алимов(23'), Жузумалиев(27'), Бактыбеков(38'), Талайбеков(40'), Калбаев(АГ39')
        $this->goal($m3->id, $artBlast, 213, 2);
        $this->goal($m3->id, $artBlast, 236, 23);
        $this->goal($m3->id, $artBlast, 397, 27);
        $this->goal($m3->id, $artBlast, 16,  38);
        $this->goal($m3->id, $artBlast, 250, 40);
        $this->ownGoal($m3->id, $artBlast, 405, 39); // Калбаев (Топ Тоголок) own goal
        // Топ Тоголок: Азамат у(4'), Сманов(18'29')
        $this->goal($m3->id, $topTogolok, 107, 4);
        $this->goal($m3->id, $topTogolok, 277, 18);
        $this->goal($m3->id, $topTogolok, 277, 29);

        // ── Match 4: Алай 2-5 Кант  (15.03.2026 22:00, СК КФБ, Бишкек) ──
        $m4 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $alay,
            'away_team_id' => $kant,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2026-03-15 22:00:00',
            'status'       => 'completed',
            'home_score'   => 2,
            'away_score'   => 5,
        ]);

        $this->lineup($m4->id, $alay, [
            [295, false], // Суйорбеков Сагынбек
            [259, false], // Дурусбеков Таалайнур
            [291, false], // Бактыбеков Арстанбек
            [89,  false], // Талантбек уулу Жыргалбек
            [394, false], // Ишенбек уулу Бакытбек
            [45,  false], // Султангазиев Илимбек
            [257, false], // Мурзакарим уулу Асан
            [237, false], // Бабажанов Саид
            [235, false], // Акматов Калдуубай
            [$ishenbekov, false], // Ишенбеков
            [10,  false], // Сатыбалдиев Айдар
            [358, false], // Сатыбалдиев Эльдар
            [393, false], // Султаналиев Азат
            [5,   false], // Торобеков Бакдоолот
        ]);
        $this->lineup($m4->id, $kant, [
            [145, false], // Пензаев Чынгыз
            [155, false], // Мелисбек уулу Азамат
            [222, false], // Бейшеналиев Урмат
            [315, false], // Эсенгелдиев Калысбек
            [159, false], // Султанбеков Бекзат
            [422, false], // Кенешбеков Айбек
            [152, true],  // Кадырбек уулу Ислам (MVP)
            [147, false], // Айдаркул уулу Эрмек
            [157, false], // Рахманкулов Азамат
            [162, false], // Шапданбек уулу Жолдошбек
            [281, false], // Саякбаев Кудайберген
            [3,   false], // Замирбеков Женишбек
            [232, false], // Муктарбеков Эльдар
            [2,   false], // Салымбеков Нурсултан
        ]);
        // Алай: Бабажанов(33'), Дурусбеков(35')
        $this->goal($m4->id, $alay, 237, 33);
        $this->goal($m4->id, $alay, 259, 35);
        // Кант: Замирбеков(21'), Бейшеналиев(33'), Кадырбек у(18'25'38')
        $this->goal($m4->id, $kant, 3,   21);
        $this->goal($m4->id, $kant, 222, 33);
        $this->goal($m4->id, $kant, 152, 18);
        $this->goal($m4->id, $kant, 152, 25);
        $this->goal($m4->id, $kant, 152, 38);
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