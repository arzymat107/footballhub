<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Fixture;
use App\Models\FixtureLineup;
use App\Models\Round;
use Illuminate\Database\Seeder;

// Суперлига 2024-25 — Matchweek 8 (7–10 November 2024)
// Source: futsal_kgz Instagram posts
class Matchweek8Seeder extends Seeder
{
    public function run(): void
    {
        $round = Round::firstOrCreate(
            ['stage_id' => 1, 'name' => 'Matchweek 8'],
            ['order' => 8],
        );

        // ── Match 1: Дордой 1-1 Каракол  (07.11.2024 20:00, ФОК "Газпром", Бишкек) ──
        $m1 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 10, // Дордой
            'away_team_id' => 5,  // Каракол
            'venue'        => 'ФОК "Газпром", Бишкек',
            'scheduled_at' => '2024-11-07 20:00:00',
            'status'       => 'completed',
            'home_score'   => 1,
            'away_score'   => 1,
        ]);

        // Дордой lineup
        $this->lineup($m1->id, 10, [
            [210, false], // Жусупов Абдуазим
            [213, false], // Абдурашит уулу Арген
            [218, false], // Кенешбеков Жанарбек
            [232, false], // Муктарбеков Эльдар
            [221, false], // Туратбеков Ислам
            [212, false], // Насирдинов Султан
            [230, false], // Анарбек уулу Акылбек
            [217, false], // Андабеков Аман
            [222, false], // Бейшеналиев Урмат
            [229, false], // Канетов Эмил
            [227, false], // Мендибаев Нурдин
            [214, false], // Сулайманбеков Айдар
            [219, false], // Эралиев Мухаммедмуса
            [223, false], // Эсенгелдиев Асылбек
        ]);

        // Каракол lineup
        $this->lineup($m1->id, 5, [
            [93,  false], // Дюшебаев Ислам
            [97,  false], // Конушбеков Кутман
            [100, false], // Орозбеков Улукбек
            [103, false], // Усенбаев Бексултан
            [106, true],  // Шаршенбиев Ринат — MVP
            [92,  false], // Дамирбеков Белек
            [96,  false], // Бейшекеев Бекмырза
            [98,  false], // Нурбеков Нурсултан
        ]);

        // Goals not available from photos for this match

        // ── Match 2: Виват 3-4 ОшМУ  (08.11.2024 19:00, ФОК "Газпром", Бишкек) ──
        $m2 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 3,  // Виват
            'away_team_id' => 9,  // ОшМУ
            'venue'        => 'ФОК "Газпром", Бишкек',
            'scheduled_at' => '2024-11-08 19:00:00',
            'status'       => 'completed',
            'home_score'   => 3,
            'away_score'   => 4,
        ]);

        // Виват lineup
        $this->lineup($m2->id, 3, [
            [132, false], // Тургунбеков Адыл
            [54,  false], // Джумабеков Тариэл
            [64,  false], // Минкеев Ильзат
            [66,  false], // Тимченко Артем
            [68,  false], // Чиркин Кирилл
            [46,  false], // Кыргызов Айбек
            [50,  false], // Анарбеков Нурадил
            [51,  false], // Ачилов Канымет
            [52,  false], // Вильямов Бахридин
            [56,  false], // Зажигаев Данил
            [57,  false], // Искендербеков Талгат
            [62,  false], // Лиров Равил
            [65,  false], // Назаралиев Урмат
            [69,  false], // Юлдашев Набижан
        ]);

        // ОшМУ lineup
        $this->lineup($m2->id, 9, [
            [186, false], // Кудайбердиев Сыймыкбек
            [191, true],  // Абдыжалил уулу Айдарбек — MVP
            [192, false], // Абдылдаев Нурсултан
            [198, false], // Култаев Адилет
            [208, false], // Дос Сантос Барбоса Жерлан
            [188, false], // Ураимов Урмат
            [189, false], // Абдималик уулу Максатбек
            [197, false], // Исламов Алымбек
            [199, false], // Муктарали уулу Уланбек
            [201, false], // Ражапов Сыймык
            [207, false], // Эркаев Акылбек
        ]);

        // Goals — Виват (3): Лиров 16',21'; Анарбеков 35'
        //         ОшМУ (4): Джумабеков 1' АГ; Абдылдаев 2'; Абдыжалил уулу 7',26'
        Event::create(['fixture_id' => $m2->id, 'team_id' => 3,  'player_id' => 54,  'type' => 'own_goal', 'minute' => 1]);
        $this->goal($m2->id, 9,  192, 2);  // Абдылдаев (2')
        $this->goal($m2->id, 9,  191, 7);  // Абдыжалил уулу (7')
        $this->goal($m2->id, 3,  62,  16); // Лиров (16')
        $this->goal($m2->id, 3,  62,  21); // Лиров (21')
        $this->goal($m2->id, 9,  191, 26); // Абдыжалил уулу (26')
        $this->goal($m2->id, 3,  50,  35); // Анарбеков (35')

        // ── Match 3: Кант 4-4 Спорткомитет  (08.11.2024 21:00, ФОК "Газпром", Бишкек) ──
        $m3 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 7,  // Кант
            'away_team_id' => 8,  // Спорткомитет
            'venue'        => 'ФОК "Газпром", Бишкек',
            'scheduled_at' => '2024-11-08 21:00:00',
            'status'       => 'completed',
            'home_score'   => 4,
            'away_score'   => 4,
        ]);

        // Кант lineup
        $this->lineup($m3->id, 7, [
            [145, false], // Пензаев Чынгыз
            [149, false], // Аянбаев Адил
            [152, false], // Кадырбек уулу Ислам
            [157, false], // Рахманкулов Азамат
            [162, false], // Шапданбек уулу Жолдошбек
            [146, false], // Хамидов Акжол
            [148, false], // Аманбеков Мейирхан
            [151, false], // Исроилов Кутбидин
            [153, false], // Карыпбеков Бекмат
            [155, false], // Мелисбек уулу Азамат
            [156, false], // Муратбеков Айдарбек
            [159, false], // Султанбеков Бекзат
            [160, false], // Султанов Эрлан
            [161, false], // Туткучев Кайрат
        ]);

        // Спорткомитет lineup
        $this->lineup($m3->id, 8, [
            [163, false], // Камбар уулу Женишбек
            [167, false], // Абышев Элмар
            [168, false], // Алмазбеков Омурбек
            [173, false], // Максатбеков Айдар
            [175, true],  // Маматкаксымов Давранбек — MVP
            [164, false], // Таджибаев Алижон
            [165, false], // Эркинбаев Даниел
            [166, false], // Абдуллаев Мухаммадсодик
            [169, false], // Бийжанов Шергазы
            [170, false], // Жакыпов Даулес
            [172, false], // Казакбаев Умар
            [182, false], // Тажибаев Шерзод
            [184, false], // Эргашев Диёрбек
            [185, false], // Эшмамбет уулу Медербек
        ]);

        // Goals — Кант (4): Аянбаев 18'; Кадырбек уулу 32',35'; Рахманкулов 40'
        //         Спорткомитет (4): Эргашев 3'; Маматкасымов 26',35'; Максатбеков 33'
        $this->goal($m3->id, 8,  184, 3);  // Эргашев (3')
        $this->goal($m3->id, 7,  149, 18); // Аянбаев (18')
        $this->goal($m3->id, 8,  175, 26); // Маматкасымов (26')
        $this->goal($m3->id, 7,  152, 32); // Кадырбек уулу (32')
        $this->goal($m3->id, 8,  173, 33); // Максатбеков (33')
        $this->goal($m3->id, 7,  152, 35); // Кадырбек уулу (35')
        $this->goal($m3->id, 8,  175, 35); // Маматкасымов (35')
        $this->goal($m3->id, 7,  157, 40); // Рахманкулов (40')

        // ── Match 4: Шам 3-4 Топ Тоголок  (09.11.2024 16:00, ФОК "Газпром", Чолпон-Ата) ──
        $m4 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 6,  // Шам
            'away_team_id' => 2,  // Топ Тоголок
            'venue'        => 'ФОК "Газпром", Чолпон-Ата',
            'scheduled_at' => '2024-11-09 16:00:00',
            'status'       => 'completed',
            'home_score'   => 3,
            'away_score'   => 4,
        ]);

        // Шам lineup
        $this->lineup($m4->id, 6, [
            [108, false], // Джамгырчиев Азат
            [119, false], // Галиев Мелис
            [120, false], // Джумабек уулу Эрнст
            [123, false], // Майрамбеков Султан
            [125, false], // Оморов Бексултан
            [110, false], // Абакиров Акжолтой
            [112, false], // Айыпов Марсбек
            [115, false], // Асанбеков Азирет
            [124, false], // Мукаев Келдибек
            [128, false], // Туратбек уулу Эрназар
            [129, false], // Чотбаев Ильяс
        ]);

        // Топ Тоголок lineup
        $this->lineup($m4->id, 2, [
            [15,  false], // Азатов Амир
            [24,  false], // Абдымамытов Адахан
            [134, false], // Азамат уулу Ильгиз
            [28,  true],  // Канатбеков Аймен — MVP
            [136, false], // Токтобек уулу Намыс
            [20,  false], // Куватбек Адил
            [45,  false], // Султангазиев Илимбек
            [37,  false], // Ахметов Арлан
            [25,  false], // Ашуров Сыймык
            [16,  false], // Бактыбеков Эржан
            [18,  false], // Доолотов Эрбол
            [26,  false], // Жаанбаев Актан
            [27,  false], // Иманалиев Элбек
            [42,  false], // Рыстаев Калыбек
        ]);

        // Goals — Топ Тоголок (4): Абдымамытов 1'; Ахметов 4'; Бактыбеков 4'; Канатбеков 32'
        //         Шам (3): Айыпов 12'; Мукаев 27'; Чотбаев 31'
        $this->goal($m4->id, 2,  24,  1);  // Абдымамытов (1')
        $this->goal($m4->id, 2,  37,  4);  // Ахметов (4')
        $this->goal($m4->id, 2,  16,  4);  // Бактыбеков (4')
        $this->goal($m4->id, 6,  112, 12); // Айыпов (12')
        $this->goal($m4->id, 6,  124, 27); // Мукаев (27')
        $this->goal($m4->id, 6,  129, 31); // Чотбаев (31')
        $this->goal($m4->id, 2,  28,  32); // Канатбеков (32')

        // ── Match 5: Нарын 5-1 Спорткомитет  (09.11.2024 16:00, ФОК "Газпром", Нарын) ──
        $m5 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 4,  // Нарын
            'away_team_id' => 8,  // Спорткомитет
            'venue'        => 'ФОК "Газпром", Нарын',
            'scheduled_at' => '2024-11-09 16:00:00',
            'status'       => 'completed',
            'home_score'   => 5,
            'away_score'   => 1,
        ]);

        // MVP only (no lineup photo available)
        FixtureLineup::create(['fixture_id' => $m5->id, 'team_id' => 4, 'player_id' => 90, 'is_mvp' => true]);

        // Goals — Нарын (5): Исаков 1'; Таштанов 4',8'; Турсунбеков 19'; Нурлан уулу 28'
        //         Спорткомитет (1): Жакыпов 12'
        $this->goal($m5->id, 4, 82,  1);  // Исаков (1')
        $this->goal($m5->id, 8, 170, 12); // Жакыпов (12')  — Спорткомитет
        $this->goal($m5->id, 4, 90,  4);  // Таштанов (4')
        $this->goal($m5->id, 4, 90,  8);  // Таштанов (8')
        $this->goal($m5->id, 4, 91,  19); // Турсунбеков (19')
        $this->goal($m5->id, 4, 87,  28); // Нурлан уулу (28')

        // ── Match 6: Талас 5-9 ОшМУ  (10.11.2024 16:00, ФОК "Газпром", Талас) ──
        $m6 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 1,  // Талас
            'away_team_id' => 9,  // ОшМУ
            'venue'        => 'ФОК "Газпром", Талас',
            'scheduled_at' => '2024-11-10 16:00:00',
            'status'       => 'completed',
            'home_score'   => 5,
            'away_score'   => 9,
        ]);

        // MVP only (no lineup photo available)
        FixtureLineup::create(['fixture_id' => $m6->id, 'team_id' => 9, 'player_id' => 191, 'is_mvp' => true]);

        // Goals — Талас (5): Сатыбалдиев 6',37'; Салымбеков 22'; Куттубек уулу 23'; Замирбеков 35'
        //         ОшМУ (9): Абдыжалил уулу 9',11',22',26',35'; Сабырбек уулу 15' АГ; Муктарали уулу 28',34'; Ражапов 36'
        $this->goal($m6->id, 1,  10,  6);  // Сатыбалдиев (6')
        $this->goal($m6->id, 9,  191, 9);  // Абдыжалил уулу (9')
        $this->goal($m6->id, 9,  191, 11); // Абдыжалил уулу (11')
        Event::create(['fixture_id' => $m6->id, 'team_id' => 1, 'player_id' => 143, 'type' => 'own_goal', 'minute' => 15]); // Сабырбек уулу АГ
        $this->goal($m6->id, 1,  2,   22); // Салымбеков (22')
        $this->goal($m6->id, 9,  191, 22); // Абдыжалил уулу (22')
        $this->goal($m6->id, 1,  142, 23); // Куттубек уулу (23')
        $this->goal($m6->id, 9,  191, 26); // Абдыжалил уулу (26')
        $this->goal($m6->id, 9,  199, 28); // Муктарали уулу (28')
        $this->goal($m6->id, 9,  199, 34); // Муктарали уулу (34')
        $this->goal($m6->id, 1,  3,   35); // Замирбеков (35')
        $this->goal($m6->id, 9,  191, 35); // Абдыжалил уулу (35')
        $this->goal($m6->id, 9,  201, 36); // Ражапов (36')
        $this->goal($m6->id, 1,  10,  37); // Сатыбалдиев (37')
    }

    private function lineup(int $fixtureId, int $teamId, array $players): void
    {
        foreach ($players as [$playerId, $isMvp]) {
            FixtureLineup::create([
                'fixture_id' => $fixtureId,
                'team_id'    => $teamId,
                'player_id'  => $playerId,
                'is_mvp'     => $isMvp,
            ]);
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
