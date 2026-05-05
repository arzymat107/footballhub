<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Fixture;
use App\Models\FixtureLineup;
use App\Models\Player;
use App\Models\Round;
use Illuminate\Database\Seeder;

// Суперлига 2025-26 — Matchweek 17 / 2-АЙЛАМПА (8 Mar 2026, second day)
// Source: futsal_kgz Instagram posts
class Matchweek17bSeason2Seeder extends Seeder
{
    public function run(): void
    {
        $round = Round::firstOrCreate(
            ['stage_id' => 4, 'name' => 'Matchweek 17'],
            ['order' => 17],
        );

        $talas      = 1;
        $vivat      = 3;
        $karakol    = 5;
        $artBlast   = 10;
        $jashMuun   = 12;
        $liderOshmu = 13;
        $dostuk     = 14;
        $toyota     = 15;

        $sharshenbekov = Player::firstOrCreate(['name' => 'Шаршенбеков Алибек'])->id;

        // ── Match 1: Лидер-ОШМУ 6-3 Каракол  (08.03.2026 16:00, СК «Шавкат», Ош) ──
        $m1 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $liderOshmu,
            'away_team_id' => $karakol,
            'venue'        => 'СК «Шавкат», Ош',
            'scheduled_at' => '2026-03-08 16:00:00',
            'status'       => 'completed',
            'home_score'   => 6,
            'away_score'   => 3,
        ]);

        $this->lineup($m1->id, $liderOshmu, [
            [186, false], // Кудайбердиев
            [317, false], // Токоев А
            [197, false], // Исламов
            [321, false], // Абдурахманов
            [248, true],  // Мурзакулов Семетей (MVP)
            [384, false], // Кыялбеков Семетей
            [199, false], // Муктарали уулу
            [316, false], // Базарбек уулу
            [65,  false], // Назаралиев
            [168, false], // Алмазбеков
            [201, false], // Ражапов
            [320, false], // Турсунбаев
            [323, false], // Эргешов Ш
            [184, false], // Эргашов Д
        ]);
        $this->lineup($m1->id, $karakol, [
            [392, false], // Сайбеков Бахтияр
            [105, false], // Усупов Эрлан
            [326, false], // Шакилов Ийгилик
            [88,  false], // Сыдыков Нурслан
            [289, false], // Садыков Канат
            [$sharshenbekov, false], // Шаршенбеков Алибек
            [104, false], // Усупов Адилет
            [390, false], // Алтынбек уулу Арген
        ]);
        // Лидер-ОШМУ: Кудайбердиев(9'), Абдурахманов(11'), Мурзакулов(18'19'), Исламов(21'), Ражапов(33')
        $this->goal($m1->id, $liderOshmu, 186, 9);
        $this->goal($m1->id, $liderOshmu, 321, 11);
        $this->goal($m1->id, $liderOshmu, 248, 18);
        $this->goal($m1->id, $liderOshmu, 248, 19);
        $this->goal($m1->id, $liderOshmu, 197, 21);
        $this->goal($m1->id, $liderOshmu, 201, 33);
        // Каракол: Шакилов(16'), Сыдыков(23'), Шаршенбеков(26')
        $this->goal($m1->id, $karakol, 326, 16);
        $this->goal($m1->id, $karakol, 88,  23);
        $this->goal($m1->id, $karakol, $sharshenbekov, 26);

        // ── Match 2: Жаш Муун 4-3 Виват  (08.03.2026 19:00, СК «Акматалы Ажы», Жалал-Абад) ──
        $m2 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $jashMuun,
            'away_team_id' => $vivat,
            'venue'        => 'СК «Акматалы Ажы», Жалал-Абад',
            'scheduled_at' => '2026-03-08 19:00:00',
            'status'       => 'completed',
            'home_score'   => 4,
            'away_score'   => 3,
        ]);

        $this->lineup($m2->id, $jashMuun, [
            [269, true],  // Абдувалиев Омурали (MVP)
            [268, false], // Арапов
            [306, false], // Махаматкулов
            [418, false], // Абдувалиев Аслидин
            [246, false], // Салимбаев
            [420, false], // Мамиров
            [299, false], // Сайфуллаев
            [300, false], // Жантороев
            [302, false], // Пахридинов
            [304, false], // Абдурасулов
            [308, false], // Толонмирзаев
            [415, false], // Зульпиев
            [417, false], // Шералиев
        ]);
        $this->lineup($m2->id, $vivat, [
            [47,  false], // Маликжанов Нурэл
            [57,  false], // Искендербеков
            [60,  false], // Кошонов Канкелди
            [352, false], // Игольников Илья
            [27,  false], // Иманалиев Элбек
            [132, false], // Тургунбеков Адыл
            [50,  false], // Анарбеков Нурадил
            [52,  false], // Вильямов Бахридин
            [58,  false], // Кадыров Дильшат
            [56,  false], // Зажигаев Данил
            [59,  false], // Керимбаев Эмирлан
            [64,  false], // Минкеев Ильзат
            [223, false], // Эсенгелдиев
        ]);
        // Жаш Муун: Арапов(8'13'23'), Сайфуллаев(23')
        $this->goal($m2->id, $jashMuun, 268, 8);
        $this->goal($m2->id, $jashMuun, 268, 13);
        $this->goal($m2->id, $jashMuun, 268, 23);
        $this->goal($m2->id, $jashMuun, 299, 23);
        // Виват: Кадыров(3'), Анарбеков(5'), Искендербеков(31')
        $this->goal($m2->id, $vivat, 58,  3);
        $this->goal($m2->id, $vivat, 50,  5);
        $this->goal($m2->id, $vivat, 57,  31);

        // ── Match 3: Toyota 4-2 Арт Бласт  (08.03.2026 19:30, СК КФБ, Бишкек) ──
        $m3 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $toyota,
            'away_team_id' => $artBlast,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2026-03-08 19:30:00',
            'status'       => 'completed',
            'home_score'   => 4,
            'away_score'   => 2,
        ]);

        $this->lineup($m3->id, $toyota, [
            [233, false], // Джунушалиев Азирет
            [240, false], // Долоткелдиев Азамат
            [247, false], // Турсунов Арстанбек
            [238, false], // Данияр уулу Абдурахим
            [221, false], // Туратбеков Ислам
            [234, false], // Мурзаев Бекболсун
            [149, false], // Аянбаев Адил
            [376, false], // Амандык уулу Денисбек
            [377, false], // Оруналиев Ильгиз
            [425, true],  // Оливейра Веллингтон (MVP)
            [426, false], // Мориньо Маркос
            [424, false], // Карыпбеков Дастан
        ]);
        $this->lineup($m3->id, $artBlast, [
            [212, false], // Насирдинов
            [218, false], // Кенешбеков
            [250, false], // Талайбеков
            [236, false], // Алимов
            [16,  false], // Бактыбеков
            [397, false], // Жузумалиев
            [21,  false], // Ильясов Бектур
            [220, false], // Эралиев Мухаммедиса
            [219, false], // Эралиев Мухаммедмуса
            [227, false], // Мендибаев
            [230, false], // Анарбек уулу Акылбек
            [150, false], // Джанат уулу
            [357, false], // Талайбеков Арсен
            [214, false], // Сулайманбеков Айдар
        ]);
        // Goal details not reported

        // ── Match 4: Талас 3-9 Достук  (08.03.2026 21:30, СК КФБ, Бишкек) ──
        $m4 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $talas,
            'away_team_id' => $dostuk,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2026-03-08 21:30:00',
            'status'       => 'completed',
            'home_score'   => 3,
            'away_score'   => 9,
        ]);

        $this->lineup($m4->id, $talas, [
            [285, false], // Жумалиев Нурсултан
            [139, false], // Бактыбек уулу Талас
            [11,  false], // Мыктыбеков Аскат
            [12,  false], // Мукушбеков Рамис
            [35,  false], // Саякбаев Кыяз
            [34,  false], // Орунбеков Камбар
            [143, false], // Сабырбек уулу Майрамбек
            [345, false], // Айтмырзаев Нооруэбай
            [140, false], // Батырбек уулу Улан
            [4,   false], // Жакыпов Руслан
            [349, false], // Ануарбек уулу Адилет
            [399, false], // Каныбек уулу Бактияр
            [400, false], // Суйутбеков Актан
            [402, false], // Ниязбеков Ислам
        ]);
        $this->lineup($m4->id, $dostuk, [
            [46,  true],  // Кыргызов Айбек (MVP)
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
        // Талас: Ниязбеков(16'), Жакыпов(17'), Мыктыбеков(38')
        $this->goal($m4->id, $talas, 402, 16);
        $this->goal($m4->id, $talas, 4,   17);
        $this->goal($m4->id, $talas, 11,  38);
        // Достук: Абдуллаев(6'14'), Жакыпов(7'), Абдумажидов(8'14'), Касымакунов(20'33'), Карыбеков(36'), Кыргызов(36')
        $this->goal($m4->id, $dostuk, 166, 6);
        $this->goal($m4->id, $dostuk, 170, 7);
        $this->goal($m4->id, $dostuk, 362, 8);
        $this->goal($m4->id, $dostuk, 166, 14);
        $this->goal($m4->id, $dostuk, 362, 14);
        $this->goal($m4->id, $dostuk, 19, 20);
        $this->goal($m4->id, $dostuk, 19, 33);
        $this->goal($m4->id, $dostuk, 270, 36);
        $this->goal($m4->id, $dostuk, 46,  36);
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