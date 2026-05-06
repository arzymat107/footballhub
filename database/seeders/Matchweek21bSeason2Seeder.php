<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Fixture;
use App\Models\FixtureLineup;
use App\Models\Player;
use App\Models\Round;
use Illuminate\Database\Seeder;

// Суперлига 2025-26 — Matchweek 21 / 2-АЙЛАМПА (4 Apr 2026, second day)
// Source: futsal_kgz Instagram posts
class Matchweek21bSeason2Seeder extends Seeder
{
    public function run(): void
    {
        $round = Round::firstOrCreate(
            ['stage_id' => 4, 'name' => 'Matchweek 21'],
            ['order' => 21],
        );

        $talas      = 1;
        $vivat      = 3;
        $naryn      = 4;
        $kant       = 7;
        $artBlast   = 10;
        $alay       = 11;
        $jashMuun   = 12;
        $liderOshmu = 13;
        $dostuk     = 14;
        $toyota     = 15;

        $sultangazievA = Player::firstOrCreate(['name' => 'Султангазиев А'])->id;

        // ── Match 1: Достук 3-3 Арт Бласт Групп  (04.04.2026 17:00, СК КФБ, Бишкек) ──
        $m1 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $dostuk,
            'away_team_id' => $artBlast,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2026-04-04 17:00:00',
            'status'       => 'completed',
            'home_score'   => 3,
            'away_score'   => 3,
        ]);

        $this->lineup($m1->id, $dostuk, [
            [46,  false], // Кыргызов Айбек
            [360, false], // Бейшенов Бабур
            [362, false], // Абдумажидов Абдуллах
            [270, false], // Карыбеков Даниэл
            [78,  false], // Жумабеков Султан
            [49,  false], // Шамонин Станислав
            [178, false], // Сайдалиев Дамирбек
            [404, false], // Айтбаев Азамат
            [170, false], // Жакыпов Даулес
            [19,  false], // Касмакунов Элдияр
            [361, false], // Бакиев Али
            [359, false], // Токтогонов Улукман
        ]);
        $this->lineup($m1->id, $artBlast, [
            [212, false], // Насирдинов
            [213, false], // Абдурашит уулу Арген
            [250, false], // Талайбеков Данияр
            [226, false], // Жумадилов Баатырхан
            [16,  false], // Бактыбеков Эржан
            [21,  false], // Ильясов Бектур
            [220, false], // Эралиев Мухаммедиса
            [219, false], // Эралиев Мухаммедмуса
            [227, false], // Мендибаев Нурдин
            [230, false], // Анарбек уулу Акылбек
            [150, true],  // Джанат уулу Самат (MVP)
            [224, false], // Маматов Артур
            [236, false], // Алимов
        ]);
        // Достук: Карыбеков(2'38'), Касмакунов(9')
        $this->goal($m1->id, $dostuk, 270, 2);
        $this->goal($m1->id, $dostuk, 19,  9);
        $this->goal($m1->id, $dostuk, 270, 38);
        // Арт Бласт: Джанат у(12'16'), Таалайбеков(30')
        $this->goal($m1->id, $artBlast, 150, 12);
        $this->goal($m1->id, $artBlast, 150, 16);
        $this->goal($m1->id, $artBlast, 250, 30);

        // ── Match 2: Алай 1-5 Toyota  (04.04.2026 19:00, СК КФБ, Бишкек) ──
        $m2 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $alay,
            'away_team_id' => $toyota,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2026-04-04 19:00:00',
            'status'       => 'completed',
            'home_score'   => 1,
            'away_score'   => 5,
        ]);

        $this->lineup($m2->id, $alay, [
            [45,  false],          // Султангазиев Илимбек
            [237, false],          // Бабажанов Саид
            [235, false],          // Акматов Калдуубай
            [89,  false],          // Талантбек уулу Жыргалбек
            [5,   false],          // Торобеков Бакдоолот
            [295, false],          // Суйорбеков Сагынбек
            [257, false],          // Мурзакарим уулу Асан
            [259, false],          // Дурусбеков Таалайнур
            [291, false],          // Бактыбеков Арстанбек
            [292, false],          // Бейшенбеков Максат
            [394, false],          // Ишенбек уулу Бакытбек
            [10,  false],          // Сатыбалдиев Айдар
            [$sultangazievA, false], // Султангазиев А
        ]);
        $this->lineup($m2->id, $toyota, [
            [234, false], // Мурзаев Бекболсун
            [240, false], // Долоткелдиев Азамат
            [149, true],  // Аянбаев Адил (MVP)
            [247, false], // Турсунов Арстанбек
            [238, false], // Данияр уулу Абдурахим
            [233, false], // Джунушалиев Азирет
            [242, false], // Исабеков Азат
            [90,  false], // Таштанов Актай
            [376, false], // Амандык уулу Денисбек
            [377, false], // Оруналиев Ильгиз
            [379, false], // Рашанбеков Элдар
            [425, false], // Оливейра Веллингтон
            [426, false], // Мориньо Маркос
            [424, false], // Карыпбеков Дастан
        ]);
        // Алай: Талантбек у(27')
        $this->goal($m2->id, $alay, 89, 27);
        // Toyota: Аянбаев(29'29'), Оливейра(33'), Исабеков(38'), Амандык у(40')
        $this->goal($m2->id, $toyota, 149, 29);
        $this->goal($m2->id, $toyota, 149, 29);
        $this->goal($m2->id, $toyota, 425, 33);
        $this->goal($m2->id, $toyota, 242, 38);
        $this->goal($m2->id, $toyota, 376, 40);

        // ── Match 3: Жаш Муун 1-2 Кант  (04.04.2026 20:00, СК «Акматалы Ажы», Жалал-Абад) ──
        $m3 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $jashMuun,
            'away_team_id' => $kant,
            'venue'        => 'СК «Акматалы Ажы», Жалал-Абад',
            'scheduled_at' => '2026-04-04 20:00:00',
            'status'       => 'completed',
            'home_score'   => 1,
            'away_score'   => 2,
        ]);

        $this->lineup($m3->id, $jashMuun, [
            [269, false], // Абдувалиев Омурали
            [300, false], // Жантороев
            [302, false], // Пахридинов
            [268, false], // Арапов
            [246, false], // Салимбаев Юлдашбай
            [420, false], // Мамиров
            [299, false], // Сайфуллаев
            [306, false], // Махаматкулов
            [308, false], // Толонмирзаев
            [417, false], // Шералиев Билал
            [418, false], // Абдувалиев Аслидин
        ]);
        $this->lineup($m3->id, $kant, [
            [145, true],  // Пензаев Чынгыз (MVP)
            [152, false], // Кадырбек уулу Ислам
            [3,   false], // Замирбеков Женишбек
            [232, false], // Муктарбеков Эльдар
            [217, false], // Андабеков Аман
            [422, false], // Кенешбеков Айбек
            [151, false], // Исроилов Кутбидин
            [157, false], // Рахманкулов Азамат
            [162, false], // Шапданбек уулу Жолдошбек
            [222, false], // Бейшеналиев Урмат
            [315, false], // Эсенгелдиев Калысбек
            [2,   false], // Салымбеков Нурсултан
            [159, false], // Султанбеков Бекзат
        ]);
        // Жаш Муун: Жантороев(36')
        $this->goal($m3->id, $jashMuun, 300, 36);
        // Кант: Салымбеков(15'), Замирбеков(40')
        $this->goal($m3->id, $kant, 2,  15);
        $this->goal($m3->id, $kant, 3,  40);

        // ── Match 4: Лидер-ОШМУ 7-6 ДС Групп Нарын  (04.04.2026 20:30, ФОК «Газпром», Кызыл Кыя) ──
        $m4 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $liderOshmu,
            'away_team_id' => $naryn,
            'venue'        => 'ФОК «Газпром», Кызыл Кыя',
            'scheduled_at' => '2026-04-04 20:30:00',
            'status'       => 'completed',
            'home_score'   => 7,
            'away_score'   => 6,
        ]);

        $this->lineup($m4->id, $liderOshmu, [
            [186, false], // Кудайбердиев
            [317, false], // Токоев А
            [197, false], // Исламов
            [321, false], // Абдурахманов
            [248, true],  // Мурзакулов Семетей (MVP)
            [384, false], // Кыялбеков Семетей
            [316, false], // Базарбек уулу
            [65,  false], // Назаралиев
            [168, false], // Алмазбеков
            [320, false], // Турсунбаев
            [323, false], // Эргешов Шахзодбек
            [382, false], // Павлов Никита
        ]);
        $this->lineup($m4->id, $naryn, [
            [20,  false], // Куватбек Адил
            [153, false], // Карыпбеков Бекмат
            [243, false], // Кубанычов Кайрат
            [244, false], // Мамбеталиев Саламат
            [385, false], // Данрлей Винаес
            [387, false], // Жабаров Нуриддин
            [75,  false], // Байгазы уулу Уланбек
            [73,  false], // Айтокторов Нурберген
            [28,  false], // Канатбеков Аймен
            [231, false], // Самат уулу Алмазбек
        ]);
        // ЛО: Токоев(4'39'), Мурзакулов(7'40'), Павлов(29'39'), Абдурахманов(30')
        $this->goal($m4->id, $liderOshmu, 317, 4);
        $this->goal($m4->id, $liderOshmu, 248, 7);
        $this->goal($m4->id, $liderOshmu, 382, 29);
        $this->goal($m4->id, $liderOshmu, 321, 30);
        $this->goal($m4->id, $liderOshmu, 317, 39);
        $this->goal($m4->id, $liderOshmu, 382, 39);
        $this->goal($m4->id, $liderOshmu, 248, 40);
        // Нарын: Канатбеков(10'34'), Байгазы у(25'), Мамбеталиев(26'), Кубанычов(33'), Самат у(35')
        $this->goal($m4->id, $naryn, 28,  10);
        $this->goal($m4->id, $naryn, 75,  25);
        $this->goal($m4->id, $naryn, 244, 26);
        $this->goal($m4->id, $naryn, 243, 33);
        $this->goal($m4->id, $naryn, 28,  34);
        $this->goal($m4->id, $naryn, 231, 35);

        // ── Match 5: Виват 3-8 Талас  (04.04.2026 21:00, СК КФБ, Бишкек) ──
        // Lineup not reported
        $m5 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $vivat,
            'away_team_id' => $talas,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2026-04-04 21:00:00',
            'status'       => 'completed',
            'home_score'   => 3,
            'away_score'   => 8,
        ]);

        $this->lineup($m5->id, $liderOshmu, [
            [140, true],  // Батырбек у (MVP)
        ]);

        // Виват: Керимбаев(14'), Кадыров(24'), Искендербеков(30')
        $this->goal($m5->id, $vivat, 59,  14);
        $this->goal($m5->id, $vivat, 58,  24);
        $this->goal($m5->id, $vivat, 57,  30);
        // Талас: Ниязбеков(13'13'), Батырбек у(15'27'), Бактыбек у(16'), Алымжанов(39'40'), Чолпонбаев(40')
        $this->goal($m5->id, $talas, 402, 13);
        $this->goal($m5->id, $talas, 402, 13);
        $this->goal($m5->id, $talas, 140, 15);
        $this->goal($m5->id, $talas, 139, 16);
        $this->goal($m5->id, $talas, 140, 27);
        $this->goal($m5->id, $talas, 13,  39);
        $this->goal($m5->id, $talas, 13,  40);
        $this->goal($m5->id, $talas, 346, 40);
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