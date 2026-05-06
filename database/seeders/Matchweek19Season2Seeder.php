<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Fixture;
use App\Models\FixtureLineup;
use App\Models\Round;
use Illuminate\Database\Seeder;

// Суперлига 2025-26 — Matchweek 19 / 2-АЙЛАМПА (20–21 Mar 2026)
// Source: futsal_kgz Instagram posts
class Matchweek19Season2Seeder extends Seeder
{
    public function run(): void
    {
        $round = Round::firstOrCreate(
            ['stage_id' => 4, 'name' => 'Matchweek 19'],
            ['order' => 19],
        );

        $talas      = 1;
        $topTogolok = 2;
        $vivat      = 3;
        $naryn      = 4;
        $kant       = 7;
        $artBlast   = 10;
        $alay       = 11;
        $jashMuun   = 12;
        $liderOshmu = 13;
        $dostuk     = 14;

        // ── Match 1: Достук 2-1 Лидер-ОШМУ  (20.03.2026 17:00, СК КФБ, Бишкек) ──
        $m1 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $dostuk,
            'away_team_id' => $liderOshmu,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2026-03-20 17:00:00',
            'status'       => 'completed',
            'home_score'   => 2,
            'away_score'   => 1,
        ]);

        $this->lineup($m1->id, $dostuk, [
            [46,  false], // Кыргызов Айбек
            [178, false], // Сайдалиев Дамирбек
            [166, false], // Абдуллаев Мухаммадсодик
            [170, false], // Жакыпов Даулес
            [19, false], // Касмакунов Элдияр
            [49,  false], // Шамонин Станислав
            [360, false], // Бейшенов Бабур
            [362, false], // Абдумажидов Абдуллах
            [270, true],  // Карыбеков Даниэл (MVP)
            [361, false], // Бакиев Али
            [78,  false], // Жумабеков Султан
            [335, false], // Бекбоев Кутман
        ]);
        $this->lineup($m1->id, $liderOshmu, [
            [186, false], // Кудайбердиев
            [197, false], // Исламов
            [321, false], // Абдурахманов
            [248, false], // Мурзакулов Семетей
            [382, false], // Павлов Никита
            [316, false], // Базарбек уулу
            [65,  false], // Назаралиев
            [168, false], // Алмазбеков
            [201, false], // Ражапов
            [318, false], // Канназаров Нуркалый
            [320, false], // Турсунбаев
            [323, false], // Эргешов Ш
            [184, false], // Эргашов Д
        ]);
        // Достук: Абдумажидов(28'), Карыбеков(34')
        $this->goal($m1->id, $dostuk, 362, 28);
        $this->goal($m1->id, $dostuk, 270, 34);
        // Лидер-ОШМУ: Ражапов(12')
        $this->goal($m1->id, $liderOshmu, 201, 12);

        // ── Match 2: Талас 2-6 Жаш Муун  (21.03.2026 17:00, СК КФБ, Бишкек) ──
        $m2 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $talas,
            'away_team_id' => $jashMuun,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2026-03-21 17:00:00',
            'status'       => 'completed',
            'home_score'   => 2,
            'away_score'   => 6,
        ]);

        $this->lineup($m2->id, $talas, [
            [285, false], // Жумалиев Нурсултан
            [11,  false], // Мыктыбеков Аскат
            [143, false], // Сабырбек уулу Майрамбек
            [346, false], // Чолпонбаев Бийжан
            [349, false], // Ануарбек уулу Адилет
            [139, false], // Бактыбек уулу Талас
            [12,  false], // Мукушбеков Рамис
            [35,  false], // Саякбаев Кыяз
            [13,  false], // Алымжанов Дастан
            [399, false], // Каныбек уулу Бактияр
            [400, false], // Суйутбеков Актан
            [401, false], // Бекенов Азим
            [402, false], // Ниязбеков Ислам
            [403, false], // Айтбаев Бексултан
        ]);
        $this->lineup($m2->id, $jashMuun, [
            [269, false], // Абдувалиев Омурали
            [268, false], // Арапов
            [306, false], // Махаматкулов
            [308, false], // Толонмирзаев
            [246, true],  // Салимбаев Юлдашбай (MVP)
            [420, false], // Мамиров
            [299, false], // Сайфуллаев
            [300, false], // Жантороев
            [302, false], // Пахридинов
            [304, false], // Абдурасулов
            [415, false], // Зульпиев
            [418, false], // Абдувалиев Аслидин
        ]);
        // Талас: Сабырбек у(2'), Чолпонбаев(14')
        $this->goal($m2->id, $talas, 143, 2);
        $this->goal($m2->id, $talas, 346, 14);
        // Жаш Муун: Сайфуллаев(4'), Салимбаев(9'32'), Толонмирзаев(21'), Абдурасулов(29'), Абдувалиев(34')
        $this->goal($m2->id, $jashMuun, 299, 4);
        $this->goal($m2->id, $jashMuun, 246, 9);
        $this->goal($m2->id, $jashMuun, 308, 21);
        $this->goal($m2->id, $jashMuun, 304, 29);
        $this->goal($m2->id, $jashMuun, 246, 32);
        $this->goal($m2->id, $jashMuun, 269, 34);

        // ── Match 3: Кант 4-3 Виват  (21.03.2026 19:00, ФОК «Кант», Кант) ──
        $m3 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $kant,
            'away_team_id' => $vivat,
            'venue'        => 'ФОК «Кант», Кант',
            'scheduled_at' => '2026-03-21 19:00:00',
            'status'       => 'completed',
            'home_score'   => 4,
            'away_score'   => 3,
        ]);

        $this->lineup($m3->id, $kant, [
            [145, false], // Пензаев Чынгыз
            [155, false], // Мелисбек уулу Азамат
            [222, false], // Бейшеналиев Урмат
            [281, false], // Саякбаев Кудайберген
            [315, false], // Эсенгелдиев Калысбек
            [422, false], // Кенешбеков Айбек
            [152, false], // Кадырбек уулу Ислам
            [157, true],  // Рахманкулов Азамат (MVP)
            [162, false], // Шапданбек уулу Жолдошбек
            [3,   false], // Замирбеков Женишбек
            [2,   false], // Салымбеков Нурсултан
            [232, false], // Муктарбеков Эльдар
            [217, false], // Андабеков Аман
            [159, false], // Султанбеков Бекзат
        ]);
        $this->lineup($m3->id, $vivat, [
            [353, false], // Яфаров Султан
            [57,  false], // Искендербеков
            [60,  false], // Кошонов Канкелди
            [68,  false], // Чиркин Кирилл
            [352, false], // Игольников Илья
            [132, false], // Тургунбеков Адыл
            [52,  false], // Вильямов Бахридин
            [58,  false], // Кадыров Дильшат
            [56,  false], // Зажигаев Данил
            [59,  false], // Керимбаев Эмирлан
            [64,  false], // Минкеев Ильзат
            [67,  false], // Хамраев Ибрахим
            [69,  false], // Юлдашев Набижан
            [223, false], // Эсенгелдиев
        ]);
        // Кант: Бейшеналиев(19'), Султанбеков(26'), Рахманкулов(39'40')
        $this->goal($m3->id, $kant, 222, 19);
        $this->goal($m3->id, $kant, 159, 26);
        $this->goal($m3->id, $kant, 157, 39);
        $this->goal($m3->id, $kant, 157, 40);
        // Виват: Кадыров(9'), Искендербеков(17'), Чиркин(28')
        $this->goal($m3->id, $vivat, 58,  9);
        $this->goal($m3->id, $vivat, 57,  17);
        $this->goal($m3->id, $vivat, 68,  28);

        // ── Match 4: Топ Тоголок 4-6 ДС Групп Нарын  (21.03.2026 19:00, СК КФБ, Бишкек) ──
        $m4 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $topTogolok,
            'away_team_id' => $naryn,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2026-03-21 19:00:00',
            'status'       => 'completed',
            'home_score'   => 4,
            'away_score'   => 6,
        ]);

        $this->lineup($m4->id, $topTogolok, [
            [15,  false], // Азатов Амир
            [107, false], // Азамат уулу Айдар
            [24,  false], // Абдымамытов Адахан
            [277, false], // Сманов Байэл
            [405, false], // Калбаев Абдулазиз
            [133, false], // Мухтар уулу Байэл
            [25,  false], // Ашуров Сыймык
            [334, false], // Абдирасулов Актилек
            [62,  false], // Лиров Равил
            [407, false], // Жолдошалиев Ринат
            [410, false], // Макеев Рамазан
            [245, false], // Сакенов Илимбек
            [413, false], // Калиев Нуржигит
        ]);
        $this->lineup($m4->id, $naryn, [
            [387, false], // Жабаров Нуриддин
            [75,  false], // Байгазы уулу Уланбек
            [364, true],  // Абдыбеков Эржан (MVP)
            [153, false], // Карыпбеков Бекмат
            [385, false], // Данрлей Винаес
            [20,  false], // Куватбек Адил
            [28,  false], // Канатбеков Аймен
            [243, false], // Кубанычов Кайрат
            [386, false], // Леандро Пелегрино
        ]);
        // Топ Тоголок: Сманов(2'), Калбаев(32'), Азамат у(30'33')
        $this->goal($m4->id, $topTogolok, 277, 2);
        $this->goal($m4->id, $topTogolok, 405, 32);
        $this->goal($m4->id, $topTogolok, 107, 30);
        $this->goal($m4->id, $topTogolok, 107, 33);
        // ДС Групп Нарын: Карыпбеков(7'10'), Канатбеков(18'), Абдыбеков(34'), Винхаес(35'), Байгазы у(40')
        $this->goal($m4->id, $naryn, 153, 7);
        $this->goal($m4->id, $naryn, 153, 10);
        $this->goal($m4->id, $naryn, 28,  18);
        $this->goal($m4->id, $naryn, 364, 34);
        $this->goal($m4->id, $naryn, 385, 35);
        $this->goal($m4->id, $naryn, 75,  40);

        // ── Match 5: Алай 2-5 Арт Бласт Групп  (21.03.2026 21:00, СК КФБ, Бишкек) ──
        $m5 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $alay,
            'away_team_id' => $artBlast,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2026-03-21 21:00:00',
            'status'       => 'completed',
            'home_score'   => 2,
            'away_score'   => 5,
        ]);

        $this->lineup($m5->id, $alay, [
            [295, false], // Суйорбеков Сагынбек
            [235, false], // Акматов Калдуубай
            [291, false], // Бактыбеков Арстанбек
            [394, false], // Ишенбек уулу Бакытбек
            [45,  false], // Султангазиев Илимбек
            [257, false], // Мурзакарим уулу Асан
            [237, false], // Бабажанов Саид
            [259, false], // Дурусбеков Таалайнур
            [292, false], // Бейшенбеков Максат
            [10,  false], // Сатыбалдиев Айдар
            [358, false], // Сатыбалдиев Эльдар
        ]);
        $this->lineup($m5->id, $artBlast, [
            [212, false], // Насирдинов
            [250, true],  // Талайбеков Данияр (MVP)
            [150, false], // Джанат уулу
            [236, false], // Алимов
            [16,  false], // Бактыбеков Эржан
            [213, false], // Абдурашит уулу Арген
            [219, false], // Эралиев Мухаммедмуса
            [220, false], // Эралиев Мухаммедиса
            [397, false], // Жузумалиев Ислам
            [227, false], // Мендибаев
            [230, false], // Анарбек уулу Акылбек
        ]);
        // Алай: Бабажанов(34'), Мурзакарим у(40')
        $this->goal($m5->id, $alay, 237, 34);
        $this->goal($m5->id, $alay, 257, 40);
        // Арт Бласт: Абдурашит у(12'), Алимов(27'), Талайбеков(35'), Бактыбеков(38'), Жузумалиев(40')
        $this->goal($m5->id, $artBlast, 213, 12);
        $this->goal($m5->id, $artBlast, 236, 27);
        $this->goal($m5->id, $artBlast, 250, 35);
        $this->goal($m5->id, $artBlast, 16,  38);
        $this->goal($m5->id, $artBlast, 397, 40);
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
