<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Fixture;
use App\Models\FixtureLineup;
use App\Models\Round;
use Illuminate\Database\Seeder;

// Суперлига 2025-26 — Matchweek 19 / 2-АЙЛАМПА (22 Mar 2026, second day)
// Source: futsal_kgz Instagram posts
class Matchweek19bSeason2Seeder extends Seeder
{
    public function run(): void
    {
        $round = Round::firstOrCreate(
            ['stage_id' => 4, 'name' => 'Matchweek 19'],
            ['order' => 19],
        );

        $talas      = 1;
        $karakol    = 5;
        $liderOshmu = 13;
        $dostuk     = 14;
        $jashMuun   = 12;
        $toyota     = 15;

        // ── Match 1: Toyota 18-2 Каракол  (22.03.2026 17:00, СК КФБ, Бишкек) ──
        $m1 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $toyota,
            'away_team_id' => $karakol,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2026-03-22 17:00:00',
            'status'       => 'completed',
            'home_score'   => 18,
            'away_score'   => 2,
        ]);

        $this->lineup($m1->id, $toyota, [
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
            [425, false], // Оливейра Веллингтон
            [426, false], // Мориньо Маркос
            [424, false], // Карыпбеков Дастан
        ]);
        $this->lineup($m1->id, $karakol, [
            [392, false], // Сайбеков Бахтияр
            [105, false], // Усупов Эрлан
            [326, false], // Шакилов Ийгилик
            [327, false], // Дюшебаев
            [88,  false], // Сыдыков Нурслан
            [325, false], // Айбеков Нурсултан
            [94,  false], // Авазбеков Эрлан
        ]);
        // Toyota: Оливейро(4'5'16'), Амандык у(5'29'30'35'), Аянбаев(11'19'24'26'), Данияр у(14'16'), Долоткелдиев(20'), Исабеков(31'33'), Жунушалиев(32'), Таштанов(34')
        $this->goal($m1->id, $toyota, 425, 4);
        $this->goal($m1->id, $toyota, 425, 5);
        $this->goal($m1->id, $toyota, 376, 5);
        $this->goal($m1->id, $toyota, 149, 11);
        $this->goal($m1->id, $toyota, 238, 14);
        $this->goal($m1->id, $toyota, 425, 16);
        $this->goal($m1->id, $toyota, 238, 16);
        $this->goal($m1->id, $toyota, 149, 19);
        $this->goal($m1->id, $toyota, 240, 20);
        $this->goal($m1->id, $toyota, 149, 24);
        $this->goal($m1->id, $toyota, 149, 26);
        $this->goal($m1->id, $toyota, 376, 29);
        $this->goal($m1->id, $toyota, 376, 30);
        $this->goal($m1->id, $toyota, 242, 31);
        $this->goal($m1->id, $toyota, 233, 32);
        $this->goal($m1->id, $toyota, 242, 33);
        $this->goal($m1->id, $toyota, 90,  34);
        $this->goal($m1->id, $toyota, 376, 35);
        // Каракол: Шакилов(7'), Усупов(13')
        $this->goal($m1->id, $karakol, 326, 7);
        $this->goal($m1->id, $karakol, 105, 13);

        // ── Match 2: Достук 3-3 Жаш Муун  (22.03.2026 19:00, СК КФБ, Бишкек) ──
        $m2 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $dostuk,
            'away_team_id' => $jashMuun,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2026-03-22 19:00:00',
            'status'       => 'completed',
            'home_score'   => 3,
            'away_score'   => 3,
        ]);

        $this->lineup($m2->id, $dostuk, [
            [46,  true],  // Кыргызов Айбек (MVP)
            [178, false], // Сайдалиев Дамирбек
            [166, false], // Абдуллаев Мухаммадсодик
            [170, false], // Жакыпов Даулес
            [19,  false], // Касмакунов Элдияр
            [49,  false], // Шамонин Станислав
            [360, false], // Бейшенов Бабур
            [362, false], // Абдумажидов Абдуллах
            [270, false], // Карыбеков Даниэл
            [361, false], // Бакиев Али
            [78,  false], // Жумабеков Султан
            [335, false], // Бекбоев Кутман
        ]);
        $this->lineup($m2->id, $jashMuun, [
            [269, false], // Абдувалиев Омурали
            [268, false], // Арапов
            [306, false], // Махаматкулов
            [308, false], // Толонмирзаев
            [246, false], // Салимбаев Юлдашбай
            [420, false], // Мамиров
            [299, false], // Сайфуллаев
            [300, false], // Жантороев
            [302, false], // Пахридинов
            [304, false], // Абдурасулов
            [415, false], // Зульпиев
            [418, false], // Абдувалиев Аслидин
        ]);
        // Достук: Жумабеков(10'), Жакыпов(16'), Абдуллаев(33')
        $this->goal($m2->id, $dostuk, 78,  10);
        $this->goal($m2->id, $dostuk, 170, 16);
        $this->goal($m2->id, $dostuk, 166, 33);
        // Жаш Муун: Пахридинов(5'25'), Салимбаев(21')
        $this->goal($m2->id, $jashMuun, 302, 5);
        $this->goal($m2->id, $jashMuun, 246, 21);
        $this->goal($m2->id, $jashMuun, 302, 25);

        // ── Match 3: Талас 4-3 Лидер-ОШМУ  (22.03.2026 21:00, СК КФБ, Бишкек) ──
        $m3 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $talas,
            'away_team_id' => $liderOshmu,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2026-03-22 21:00:00',
            'status'       => 'completed',
            'home_score'   => 4,
            'away_score'   => 3,
        ]);

        $this->lineup($m3->id, $talas, [
            [285, false], // Жумалиев Нурсултан
            [139, false], // Бактыбек уулу Талас
            [11,  false], // Мыктыбеков Аскат
            [12,  false], // Мукушбеков Рамис
            [143, true],  // Сабырбек уулу Майрамбек (MVP)
            [6,   false], // Курманбеков Бектур
            [35,  false], // Саякбаев Кыяз
            [13,  false], // Алымжанов Дастан
            [346, false], // Чолпонбаев Бийжан
            [349, false], // Ануарбек уулу Адилет
            [399, false], // Каныбек уулу Бактияр
            [400, false], // Суйутбеков Актан
            [402, false], // Ниязбеков Ислам
            [403, false], // Айтбаев Бексултан
        ]);
        $this->lineup($m3->id, $liderOshmu, [
            [186, false], // Кудайбердиев
            [168, false], // Алмазбеков
            [201, false], // Ражапов
            [197, false], // Исламов
            [323, false], // Эргешов Ш
            [316, false], // Базарбек уулу
            [317, false], // Токоев А
            [65,  false], // Назаралиев
            [318, false], // Канназаров Нуркалый
            [320, false], // Турсунбаев
            [321, false], // Абдурахманов
            [184, false], // Эргашов Д
            [248, false], // Мурзакулов Семетей
            [382, false], // Павлов Никита
        ]);
        // Талас: Мукушбеков(9'), Мыктыбеков(20'), Сабырбек у(20'), Алымжанов(24')
        $this->goal($m3->id, $talas, 12,  9);
        $this->goal($m3->id, $talas, 11,  20);
        $this->goal($m3->id, $talas, 143, 20);
        $this->goal($m3->id, $talas, 13,  24);
        // Лидер-ОШМУ: Каныбек у(АГ6'), Павлов(23'35')
        $this->ownGoal($m3->id, $liderOshmu, 399, 6); // Каныбек уулу (Талас) own goal
        $this->goal($m3->id, $liderOshmu, 382, 23);
        $this->goal($m3->id, $liderOshmu, 382, 35);
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