<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Fixture;
use App\Models\FixtureLineup;
use App\Models\Round;
use Illuminate\Database\Seeder;

// Суперлига 2024-25 — Matchday 6 (24–26 October 2024)
// Source: futsal_kgz Instagram posts
class Matchday6Seeder extends Seeder
{
    public function run(): void
    {
        $round = Round::firstOrCreate(
            ['stage_id' => 1, 'name' => 'Matchday 6'],
            ['order' => 6],
        );

        // ── Match 1: Топ Тоголок 5-4 Каракол  (24.10.2024 19:00, ФОК "Газпром", Бишкек) ──
        $m1 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 2,  // Топ Тоголок
            'away_team_id' => 5,  // Каракол
            'venue'        => 'ФОК "Газпром", Бишкек',
            'scheduled_at' => '2024-10-24 19:00:00',
            'status'       => 'completed',
            'home_score'   => 5,
            'away_score'   => 4,
        ]);

        // Топ Тоголок lineup
        $this->lineup($m1->id, 2, [
            [15,  false], // Азатов Амир
            [134, false], // Азамат уулу Ильгиз
            [16,  false], // Бактыбеков Эржан
            [27,  false], // Иманалиев Элбек
            [28,  false], // Канатбеков Аймен
            [45,  false], // Султангазиев Илимбек
            [24,  false], // Абдымамытов Адахан
            [37,  false], // Ахметов Арлан
            [25,  false], // Ашуров Сыймык
            [18,  false], // Доолотов Эрбол
            [26,  false], // Жаанбаев Актан
            [19,  false], // Касмакунов Элдияр
            [42,  false], // Рыстаев Калыбек
            [136, true],  // Токтобек уулу Намыс — MVP
        ]);

        // Каракол lineup
        $this->lineup($m1->id, 5, [
            [93,  false], // Дюшебаев Ислам
            [94,  false], // Авазбеков Эрлан
            [99,  false], // Орозакун уулу Султан
            [100, false], // Орозбеков Улукбек
            [105, false], // Усупов Эрлан
            [92,  false], // Дамирбеков Белек
            [96,  false], // Бейшекеев Бекмырза
            [101, false], // Токтобеков Темирлан
            [104, false], // Усупов Адилет
        ]);

        // Goals
        $this->goal($m1->id, 5,  99,  3);  // Орозакун у (3')
        $this->goal($m1->id, 2,  136, 6);  // Токтобек у (6')
        $this->goal($m1->id, 5,  100, 8);  // Орозбеков (8')
        $this->goal($m1->id, 2,  28,  12); // Канатбеков (12')
        $this->goal($m1->id, 2,  24,  26); // Абдымамытов (26')
        $this->goal($m1->id, 2,  37,  27); // Ахметов (27')
        $this->goal($m1->id, 5,  105, 28); // Усупов Э (28')
        $this->goal($m1->id, 2,  18,  29); // Доолотов (29')
        $this->goal($m1->id, 5,  104, 39); // Усупов А (39')

        // ── Match 2: Виват 0-5 Алай  (24.10.2024 21:00, ФОК "Газпром", Бишкек) ──
        $m2 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 3,  // Виват
            'away_team_id' => 11, // Алай
            'venue'        => 'ФОК "Газпром", Бишкек',
            'scheduled_at' => '2024-10-24 21:00:00',
            'status'       => 'completed',
            'home_score'   => 0,
            'away_score'   => 5,
        ]);

        // Виват lineup
        $this->lineup($m2->id, 3, [
            [132, false], // Тургунбеков Адыл
            [50,  false], // Анарбеков Нурадил
            [58,  false], // Кадыров Дильшат
            [64,  false], // Минкеев Ильзат
            [68,  false], // Чиркин Кирилл
            [46,  false], // Кыргызов Айбек
            [52,  false], // Вильямов Бахридин
            [55,  false], // Жуманов Азирет
            [56,  false], // Зажигаев Данил
            [60,  false], // Кошонов Канкелди
            [62,  false], // Лиров Равил
            [63,  false], // Маликов Абдурасул
            [65,  false], // Назаралиев Урмат
            [66,  false], // Тимченко Артем
        ]);

        // Алай lineup
        $this->lineup($m2->id, 11, [
            [234, false], // Мурзаев Бекболсун
            [236, false], // Алимов Максат
            [242, false], // Исабеков Азат
            [244, false], // Мамбеталиев Саламат
            [246, false], // Салимбаев Юлдашбай
            [233, false], // Джунушалиев Азирет
            [235, false], // Акматов Калдуубай
            [237, false], // Бабажанов Саид
            [239, false], // Джумашев Тилек
            [240, false], // Долоткелдиев Азамат
            [243, false], // Кубанычов Кайрат
            [245, false], // Сакенов Илимбек
            [247, true],  // Турсунов Арстанбек — MVP
        ]);

        // Goals
        $this->goal($m2->id, 11, 247, 14); // Турсунов (14')
        $this->goal($m2->id, 11, 247, 22); // Турсунов (22')
        $this->goal($m2->id, 11, 247, 23); // Турсунов (23')
        $this->goal($m2->id, 11, 236, 25); // Алимов (25')
        $this->goal($m2->id, 11, 240, 39); // Долоткелдиев (39')

        // ── Match 3: Спорткомитет 3-7 Шам  (25.10.2024 16:30, СК "Шавкат", Ош) ──
        $m3 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 8,  // Спорткомитет
            'away_team_id' => 6,  // Шам
            'venue'        => 'СК "Шавкат", Ош',
            'scheduled_at' => '2024-10-25 16:30:00',
            'status'       => 'completed',
            'home_score'   => 3,
            'away_score'   => 7,
        ]);

        // Спорткомитет lineup
        $this->lineup($m3->id, 8, [
            [164, false], // Таджибаев Алижон
            [168, false], // Алмазбеков Омурбек
            [173, false], // Максатбеков Айдар
            [175, false], // Маматкаксымов Давранбек
            [184, false], // Эргашев Диёрбек
            [165, false], // Эркинбаев Даниел
            [167, false], // Абышев Элмар
            [169, false], // Бийжанов Шергазы
            [170, false], // Жакыпов Даулес
            [172, false], // Казакбаев Умар
            [180, false], // Султанали уулу Алымбек
            [182, false], // Тажибаев Шерзод
            [183, false], // Хакимов Аброр
            [185, false], // Эшмамбет уулу Медербек
        ]);

        // Шам lineup
        $this->lineup($m3->id, 6, [
            [108, false], // Джамгырчиев Азат
            [118, true],  // Аскеров Азамат — MVP
            [120, false], // Джумабек уулу Эрнст
            [124, false], // Мукаев Келдибек
            [125, false], // Оморов Бексултан
            [107, false], // Азамат уулу Айдар
            [110, false], // Абакиров Акжолтой
            [115, false], // Асанбеков Азирет
            [119, false], // Галиев Мелис
            [122, false], // Кубатбеков Белек
            [126, false], // Самудин уулу Заманбек
            [128, false], // Туратбек уулу Эрназар
        ]);

        // Goals — Спорткомитет (3): Эргашев 4', Эшмамбет уулу 14',31'
        //         Шам (7): Аскеров 3',10',15',17',31'; Самудин уулу 3',5'
        $this->goal($m3->id, 6,  118, 3);  // Аскеров (3')
        $this->goal($m3->id, 6,  126, 3);  // Самудин уулу (3')
        $this->goal($m3->id, 8,  184, 4);  // Эргашев (4')
        $this->goal($m3->id, 6,  126, 5);  // Самудин уулу (5')
        $this->goal($m3->id, 6,  118, 10); // Аскеров (10')
        $this->goal($m3->id, 8,  185, 14); // Эшмамбет уулу (14')
        $this->goal($m3->id, 6,  118, 15); // Аскеров (15')
        $this->goal($m3->id, 6,  118, 17); // Аскеров (17')
        $this->goal($m3->id, 8,  185, 31); // Эшмамбет уулу (31')
        $this->goal($m3->id, 6,  118, 31); // Аскеров (31')

        // ── Match 4: ОшМУ 6-5 Дордой  (25.10.2024 18:30, СК "Шавкат", Ош) ──
        $m4 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 9,  // ОшМУ
            'away_team_id' => 10, // Дордой
            'venue'        => 'СК "Шавкат", Ош',
            'scheduled_at' => '2024-10-25 18:30:00',
            'status'       => 'completed',
            'home_score'   => 6,
            'away_score'   => 5,
        ]);

        // ОшМУ lineup
        $this->lineup($m4->id, 9, [
            [186, false], // Кудайбердиев Сыймыкбек
            [191, true],  // Абдыжалил уулу Айдарбек — MVP
            [192, false], // Абдылдаев Нурсултан
            [208, false], // Дос Сантос Барбоса Жерлан
            [209, false], // Да Силва Леонардо Витор
            [188, false], // Ураимов Урмат
            [193, false], // Баянас уулу Улукмырза
            [197, false], // Исламов Алымбек
            [198, false], // Култаев Адилет
            [199, false], // Муктарали уулу Уланбек
            [201, false], // Ражапов Сыймык
            [203, false], // Ташбалтаев Абдыкадыр
            [206, false], // Худайбердиев Исломбек
            [207, false], // Эркаев Акылбек
        ]);

        // Дордой lineup
        $this->lineup($m4->id, 10, [
            [210, false], // Жусупов Абдуазим
            [230, false], // Анарбек уулу Акылбек
            [226, false], // Жумадилов Баатырхан
            [221, false], // Туратбеков Ислам
            [220, false], // Эралиев Мухаммедиса
            [212, false], // Насирдинов Султан
            [213, false], // Абдурашит уулу Арген
            [217, false], // Андабеков Аман
            [222, false], // Бейшеналиев Урмат
            [218, false], // Кенешбеков Жанарбек
            [232, false], // Муктарбеков Эльдар
            [215, false], // Рысбеков Дастан
            [214, false], // Сулайманбеков Айдар
            [219, false], // Эралиев Мухаммедмуса
        ]);

        // Goals — ОшМУ (6): Эркаев 3', Абдыжалил уулу 3',10', Абдылдаев 17', Барбоса 21', Да Силва 32'
        //         Дордой (5): Сулайманбеков 3', Муктарбеков 12',14', Абдурашит уулу 27', Эралиев Муса 37'
        $this->goal($m4->id, 9,  207, 3);  // Эркаев (3')
        $this->goal($m4->id, 9,  191, 3);  // Абдыжалил уулу (3')
        $this->goal($m4->id, 10, 214, 3);  // Сулайманбеков (3')
        $this->goal($m4->id, 9,  191, 10); // Абдыжалил уулу (10')
        $this->goal($m4->id, 10, 232, 12); // Муктарбеков (12')
        $this->goal($m4->id, 10, 232, 14); // Муктарбеков (14')
        $this->goal($m4->id, 9,  192, 17); // Абдылдаев (17')
        $this->goal($m4->id, 9,  208, 21); // Барбоса (21')
        $this->goal($m4->id, 10, 213, 27); // Абдурашит уулу (27')
        $this->goal($m4->id, 9,  209, 32); // Да Силва (32')
        $this->goal($m4->id, 10, 219, 37); // Эралиев Муса (37')

        // ── Match 5: Спорткомитет 1-4 Дордой  (26.10.2024 14:00, СК "Шавкат", Ош) ──
        $m5 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 8,  // Спорткомитет
            'away_team_id' => 10, // Дордой
            'venue'        => 'СК "Шавкат", Ош',
            'scheduled_at' => '2024-10-26 14:00:00',
            'status'       => 'completed',
            'home_score'   => 1,
            'away_score'   => 4,
        ]);

        // MVP only (no lineup photo available)
        FixtureLineup::create([
            'fixture_id' => $m5->id,
            'team_id'    => 10,
            'player_id'  => 212, // Насирдинов Султан
            'is_mvp'     => true,
        ]);

        // Goals — Спорткомитет (1): Туратбеков 17' own goal
        //         Дордой (4): Кенешбеков 6', Бейшеналиев 7', Муктарбеков 21', Насирдинов 33'
        Event::create(['fixture_id' => $m5->id, 'team_id' => 10, 'player_id' => 221, 'type' => 'own_goal', 'minute' => 17]);
        $this->goal($m5->id, 10, 218, 6);  // Кенешбеков (6')
        $this->goal($m5->id, 10, 222, 7);  // Бейшеналиев (7')
        $this->goal($m5->id, 10, 232, 21); // Муктарбеков (21')
        $this->goal($m5->id, 10, 212, 33); // Насирдинов (33')

        // ── Match 6: ОшМУ 4-2 Шам  (26.10.2024 16:00, СК "Шавкат", Ош) ──
        $m6 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 1,
            'round_id'     => $round->id,
            'home_team_id' => 9,  // ОшМУ
            'away_team_id' => 6,  // Шам
            'venue'        => 'СК "Шавкат", Ош',
            'scheduled_at' => '2024-10-26 16:00:00',
            'status'       => 'completed',
            'home_score'   => 4,
            'away_score'   => 2,
        ]);

        // MVP only (no lineup photo available)
        FixtureLineup::create([
            'fixture_id' => $m6->id,
            'team_id'    => 9,
            'player_id'  => 208, // Дос Сантос Барбоса Жерлан
            'is_mvp'     => true,
        ]);

        // Goals — ОшМУ (4): Абдыжалил уулу 21',40'; Барбоса 35',38'
        //         Шам (2): Оморов 2',20'
        $this->goal($m6->id, 6,  125, 2);  // Оморов (2')
        $this->goal($m6->id, 6,  125, 20); // Оморов (20')
        $this->goal($m6->id, 9,  191, 21); // Абдыжалил уулу (21')
        $this->goal($m6->id, 9,  208, 35); // Барбоса (35')
        $this->goal($m6->id, 9,  208, 38); // Барбоса (38')
        $this->goal($m6->id, 9,  191, 40); // Абдыжалил уулу (40')
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