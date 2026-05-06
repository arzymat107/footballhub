<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Fixture;
use App\Models\FixtureLineup;
use App\Models\Player;
use App\Models\Round;
use Illuminate\Database\Seeder;

// Суперлига 2025-26 — Matchweek 21 / 2-АЙЛАМПА (3 Apr 2026)
// Source: futsal_kgz Instagram posts
class Matchweek21Season2Seeder extends Seeder
{
    public function run(): void
    {
        $round = Round::firstOrCreate(
            ['stage_id' => 4, 'name' => 'Matchweek 21'],
            ['order' => 21],
        );

        $topTogolok = 2;
        $naryn      = 4;
        $karakol    = 5;
        $kant       = 7;
        $jashMuun   = 12;
        $liderOshmu = 13;

        $sharshenbekov = Player::firstOrCreate(['name' => 'Шаршенбиев Ринат'])->id;
        $dyushembiev   = Player::firstOrCreate(['name' => 'Дюшенбаев Ислам'])->id;

        // ── Match 1: Лидер-ОШМУ 3-3 Кант  (03.04.2026 18:00, ФОК «Газпром», Кызыл Кыя) ──
        $m1 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $liderOshmu,
            'away_team_id' => $kant,
            'venue'        => 'ФОК «Газпром», Кызыл Кыя',
            'scheduled_at' => '2026-04-03 18:00:00',
            'status'       => 'completed',
            'home_score'   => 3,
            'away_score'   => 3,
        ]);

        $this->lineup($m1->id, $liderOshmu, [
            [186, false], // Кудайбердиев
            [197, false], // Исламов
            [321, false], // Абдурахманов
            [248, false], // Мурзакулов Семетей
            [382, false], // Павлов Никита
            [384, false], // Кыялбеков Семетей
            [316, false], // Базарбек уулу
            [317, false], // Токоев А
            [65,  false], // Назаралиев
            [168, false], // Алмазбеков
            [320, false], // Турсунбаев
            [323, true],  // Эргешов Шахзодбек (MVP)
        ]);
        $this->lineup($m1->id, $kant, [
            [145, false], // Пензаев Чынгыз
            [152, false], // Кадырбек уулу Ислам
            [151, false], // Исроилов Кутбидин
            [157, false], // Рахманкулов Азамат
            [3,   false], // Замирбеков Женишбек
            [422, false], // Кенешбеков Айбек
            [162, false], // Шапданбек уулу Жолдошбек
            [222, false], // Бейшеналиев Урмат
            [281, false], // Саякбаев Кудайберген
            [315, false], // Эсенгелдиев Калысбек
            [2,   false], // Салымбеков Нурсултан
            [232, false], // Муктарбеков Эльдар
            [217, false], // Андабеков Аман
            [159, false], // Султанбеков Бекзат
        ]);
        // Лидер-ОШМУ: Токоев(17'), Эргешов(36'), Павлов(38')
        $this->goal($m1->id, $liderOshmu, 317, 17);
        $this->goal($m1->id, $liderOshmu, 323, 36);
        $this->goal($m1->id, $liderOshmu, 382, 38);
        // Кант: Кадырбек у(2'), Замирбеков(9'), Муктарбеков(28')
        $this->goal($m1->id, $kant, 152, 2);
        $this->goal($m1->id, $kant, 3,   9);
        $this->goal($m1->id, $kant, 232, 28);

        // ── Match 2: Жаш Муун 1-4 ДС Групп Нарын  (03.04.2026 20:00, СК «Акматалы Ажы», Жалал-Абад) ──
        $m2 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $jashMuun,
            'away_team_id' => $naryn,
            'venue'        => 'СК «Акматалы Ажы», Жалал-Абад',
            'scheduled_at' => '2026-04-03 20:00:00',
            'status'       => 'completed',
            'home_score'   => 1,
            'away_score'   => 4,
        ]);

        $this->lineup($m2->id, $jashMuun, [
            [269, false], // Абдувалиев Омурали
            [299, false], // Сайфуллаев
            [302, false], // Пахридинов
            [304, false], // Абдурасулов
            [246, false], // Салимбаев Юлдашбай
            [300, false], // Жантороев
            [268, false], // Арапов
            [306, false], // Махаматкулов
            [308, false], // Толонмирзаев
            [416, false], // Шахапов Элмырза
            [418, false], // Абдувалиев Аслидин
        ]);
        $this->lineup($m2->id, $naryn, [
            [387, false], // Жабаров Нуриддин
            [75,  false], // Байгазы уулу Уланбек
            [364, false], // Абдыбеков Эржан
            [28,  false], // Канатбеков Аймен
            [243, false], // Кубанычов Кайрат
            [20,  false], // Куватбек Адил
            [73,  false], // Айтокторов Нурберген
            [153, false], // Карыпбеков Бекмат
            [231, false], // Самат уулу Алмазбек
            [244, true],  // Мамбеталиев Саламат (MVP)
        ]);
        // Goal details not reported

        // ── Match 3: Каракол 2-5 Топ Тоголок  (03.04.2026 20:00, ФОК «Каракол», Каракол) ──
        $m3 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $karakol,
            'away_team_id' => $topTogolok,
            'venue'        => 'ФОК «Каракол», Каракол',
            'scheduled_at' => '2026-04-03 20:00:00',
            'status'       => 'completed',
            'home_score'   => 2,
            'away_score'   => 5,
        ]);

        $this->lineup($m3->id, $karakol, [
            [396, false],          // Токтобеков Амир
            [105, false],          // Усупов Эрлан
            [326, false],          // Шакилов Ийгилик
            [$sharshenbekov, false], // Шаршенбеков Алибек
            [327, false],          // Дюшембаев Жанарбек
            [$dyushembiev, false], // Дюшенбаев Ислам
            [94,  false],          // Авазбеков Эрлан
            [98,  false],          // Нурбеков Нурсултан
        ]);
        $this->lineup($m3->id, $topTogolok, [
            [414, false], // Асанов Даниел
            [107, false], // Азамат уулу Айдар
            [334, false], // Абдирасулов Актилек
            [277, true],  // Сманов Байэл (MVP)
            [405, false], // Калбаев Абдулазиз
            [15,  false], // Азатов Амир
            [342, false], // Данияров Саян
            [407, false], // Жолдошалиев Ринат
            [409, false], // Нуланбек уулу Нурсултан
            [245, false], // Сакенов Илимбек
            [411, false], // Исамидинов Темирлан
            [412, false], // Жапаров Кайрат
        ]);
        // Каракол: Шаршенбеков(16'), Авазбеков(39')
        $this->goal($m3->id, $karakol, $sharshenbekov, 16);
        $this->goal($m3->id, $karakol, 94,             39);
        // Топ Тоголок: Сманов(19'23'36'), Азамат у(27'38')
        $this->goal($m3->id, $topTogolok, 277, 19);
        $this->goal($m3->id, $topTogolok, 277, 23);
        $this->goal($m3->id, $topTogolok, 107, 27);
        $this->goal($m3->id, $topTogolok, 107, 38);
        $this->goal($m3->id, $topTogolok, 277, 36);
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