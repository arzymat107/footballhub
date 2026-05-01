<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Fixture;
use App\Models\FixtureLineup;
use App\Models\Round;
use App\Models\Tie;
use Illuminate\Database\Seeder;

// Суперлига 2024-25 — Плей-офф 1/4 финал, 2-е матчи (26–27 апреля 2025)
// Source: futsal_kgz Instagram posts
class PlayoffQFLeg2Seeder extends Seeder
{
    public function run(): void
    {
        $round = Round::where('stage_id', 2)->where('name', '1/4 финал')->firstOrFail();

        // ── Lookup existing ties ──────────────────────────────────────────────────
        $tie1 = Tie::where('round_id', $round->id)->where('home_team_id', 3)->where('away_team_id', 10)->firstOrFail(); // Виват vs ABG
        $tie2 = Tie::where('round_id', $round->id)->where('home_team_id', 7)->where('away_team_id', 9)->firstOrFail();  // Кант vs ОшМУ
        $tie3 = Tie::where('round_id', $round->id)->where('home_team_id', 1)->where('away_team_id', 11)->firstOrFail(); // Талас vs Алай
        $tie4 = Tie::where('round_id', $round->id)->where('home_team_id', 4)->where('away_team_id', 2)->firstOrFail();  // Нарын vs Топ Тоголок

        // ── Match 1: Art Blast Group 4-4 Виват  (26.04.2025 19:00, СК КФБ, Бишкек) ──
        // ABG wins 4-2 on penalties. Series 2-0 to ABG.
        // Goals — ABG: Канетов(3',8'), Кенешбеков(15',31')
        //         Виват: Кадыров(17'), Лиров(15',28'), Эсенгелдиев(22')
        $m1 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 2,
            'round_id'     => $round->id,
            'tie_id'       => $tie1->id,
            'home_team_id' => 10, // ABG
            'away_team_id' => 3,  // Виват
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2025-04-26 19:00:00',
            'status'       => 'completed',
            'home_score'   => 4,
            'away_score'   => 4,
            'leg'          => 2,
        ]);

        $this->lineup($m1->id, 10, [
            [210, false], // Жусупов Абдуазим
            [213, false], // Абдурашит уулу Арген
            [229, false], // Канетов Эмил
            [218, true],  // Кенешбеков Жанарбек — MVP
            [250, false], // Талайбеков Данияр
            [212, false], // Насирдинов Султан
            [230, false], // Анарбек уулу Акылбек
            [217, false], // Андабеков Аман
            [222, false], // Бейшеналиев Урмат
            [226, false], // Жумадилов Баатырхан
            [227, false], // Мендибаев Нурдин
            [225, false], // Сулайманбеков Данияр
            [221, false], // Туратбеков Ислам
        ]);

        $this->lineup($m1->id, 3, [
            [132, false], // Тургунбеков Адыл
            [50,  false], // Анарбеков Нурадил
            [58,  false], // Кадыров Дильшат
            [62,  false], // Лиров Равил
            [64,  false], // Минкеев Ильзат
            [46,  false], // Кыргызов Айбек
            [53,  false], // Вильямов Сухраб
            [52,  false], // Вильямов Бахридин
            [54,  false], // Джумабеков Тариэл
            [63,  false], // Маликов Абдурасул
            [65,  false], // Назаралиев Урмат
            [223, false], // Эсенгелдиев Асылбек
            [68,  false], // Чиркин Кирилл
            [69,  false], // Юлдашев Набижан
        ]);

        $this->goal($m1->id, 10, 229, 3);  // Канетов (3')
        $this->goal($m1->id, 10, 229, 8);  // Канетов (8')
        $this->goal($m1->id, 3,  58,  17); // Кадыров (17')
        $this->goal($m1->id, 3,  62,  15); // Лиров (15')
        $this->goal($m1->id, 10, 218, 15); // Кенешбеков (15')
        $this->goal($m1->id, 3,  223, 22); // Эсенгелдиев (22')
        $this->goal($m1->id, 3,  62,  28); // Лиров (28')
        $this->goal($m1->id, 10, 218, 31); // Кенешбеков (31')

        $tie1->update(['status' => 'completed', 'winner_id' => 10]);

        // ── Match 2: ОшМУ 2-3 Кант  (26.04.2025 20:30, ФОК "Газпром", Кызыл-Кыя) ──
        // Series 2-0 to Кант.
        // Goals — ОшМУ: Абдыжалил уулу(10',20')
        //         Кант: Шапданбек уулу(7',32'), Салымбеков(40')
        $m2 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 2,
            'round_id'     => $round->id,
            'tie_id'       => $tie2->id,
            'home_team_id' => 9,  // ОшМУ
            'away_team_id' => 7,  // Кант
            'venue'        => 'ФОК "Газпром", Кызыл-Кыя',
            'scheduled_at' => '2025-04-26 20:30:00',
            'status'       => 'completed',
            'home_score'   => 2,
            'away_score'   => 3,
            'leg'          => 2,
        ]);

        $this->lineup($m2->id, 9, [
            [186, false], // Кудайбердиев Сыймыкбек
            [191, false], // Абдыжалил уулу Айдарбек
            [192, false], // Абылдаев Нурсултан
            [248, false], // Мурзакулов Семетей
            [283, false], // Омурсултанов
            [188, false], // Ураимов Урмат
            [197, false], // Исламов Алымбек
            [199, false], // Муктарали уулу Уланбек
            [201, false], // Ражапов Сыймык
            [207, false], // Эркаев Акылбек
            [249, false], // Аскеров Бахтияр
        ]);

        $this->lineup($m2->id, 7, [
            [145, false], // Пензаев Чынгыз
            [151, false], // Исроилов Кутбидин
            [152, false], // Кадырбек уулу Ислам
            [157, false], // Рахманкулов Азамат
            [162, false], // Шапданбек уулу Жолдошбек
            [146, false], // Хамидов Акжол
            [147, false], // Айдаркул уулу Эрмек
            [154, false], // Мамытов Эльдияр
            [159, false], // Султанбеков Бекзат
            [161, false], // Туткучев Кайрат
            [281, false], // Саякбаев Кудайберген
            [3,   false], // Замирбеков Женишбек
            [2,   true],  // Салымбеков Нурсултан — MVP
        ]);

        $this->goal($m2->id, 7,  162, 7);  // Шапданбек уулу (7')
        $this->goal($m2->id, 9,  191, 10); // Абдыжалил уулу (10')
        $this->goal($m2->id, 9,  191, 20); // Абдыжалил уулу (20')
        $this->goal($m2->id, 7,  162, 32); // Шапданбек уулу (32')
        $this->goal($m2->id, 7,  2,   40); // Салымбеков (40')

        $tie2->update(['status' => 'completed', 'winner_id' => 7]);

        // ── Match 3: Топ Тоголок 4-7 Нарын  (26.04.2025 21:30, СК КФБ, Бишкек) ──
        // Series 2-0 to Нарын.
        // Goals — ТТ: Азамат уулу(1'), Азатов(14'), Карыбеков(15'), Канатбеков(29')
        //         Нарын: Сыдыков(12'), Аянбаев(12',50'), Исаков(16',50'),
        //                Талантбек уулу(30'), Карыпбеков(46')
        $m3 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 2,
            'round_id'     => $round->id,
            'tie_id'       => $tie4->id,
            'home_team_id' => 2,  // Топ Тоголок
            'away_team_id' => 4,  // Нарын
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2025-04-26 21:30:00',
            'status'       => 'completed',
            'home_score'   => 4,
            'away_score'   => 7,
            'leg'          => 2,
        ]);

        $this->lineup($m3->id, 2, [
            [15,  false], // Азатов Амир
            [134, false], // Азамат уулу Ильгиз
            [18,  false], // Доолотов Эрбол
            [21,  false], // Ильясов Бектур
            [28,  false], // Канатбеков Аймен
            [20,  false], // Куватбек Адил
            [24,  false], // Абдымамытов Адахан
            [25,  false], // Ашуров Сыймык
            [26,  false], // Жаанбаев Актан
            [27,  false], // Иманалиев Элбек
            [19,  false], // Касмакунов Элдияр
            [136, false], // Токтобек уулу Намыс
            [90,  false], // Таштанов Актай
            [270, false], // Карыбеков
        ]);

        $this->lineup($m3->id, 4, [
            [253, false], // Жылкайдар
            [75,  false], // Байгазы уулу Уланбек
            [149, false], // Аянбаев Адил
            [153, false], // Карыпбеков Бекмат
            [71,  false], // Айылчиев Алманбет
            [73,  false], // Айтокторов Нурберген
            [78,  false], // Жумабеков Султан
            [82,  true],  // Исаков Данияр — MVP
            [83,  false], // Кубанычбеков Марат
            [88,  false], // Сыдыков Нурслан
            [89,  false], // Талантбек уулу Жыргалбек
            [91,  false], // Турсунбеков Уран
            [279, false], // Султаналиев
        ]);

        $this->goal($m3->id, 2,  134, 1);  // Азамат уулу (1')
        $this->goal($m3->id, 4,  88,  12); // Сыдыков (12')
        $this->goal($m3->id, 4,  149, 12); // Аянбаев (12')
        $this->goal($m3->id, 2,  15,  14); // Азатов (14')
        $this->goal($m3->id, 2,  270, 15); // Карыбеков (15')
        $this->goal($m3->id, 4,  82,  16); // Исаков (16')
        $this->goal($m3->id, 2,  28,  29); // Канатбеков (29')
        $this->goal($m3->id, 4,  89,  30); // Талантбек уулу (30')
        $this->goal($m3->id, 4,  153, 46); // Карыпбеков (46')
        $this->goal($m3->id, 4,  149, 50); // Аянбаев (50')
        $this->goal($m3->id, 4,  82,  50); // Исаков (50')

        $tie4->update(['status' => 'completed', 'winner_id' => 4]);

        // ── Match 4: Алай 5-4 Талас  (27.04.2025 19:00, СК КФБ, Бишкек) ──
        // Series 2-0 to Алай.
        // Goals — Алай: Алимов(6',15'), Долоткелдиев(7'), Салимбаев(20'), Исабеков Азат(27')
        //         Талас: Батырбек уулу(5'), Мыктыбеков(19'), Болтобаев(24'), Саякбаев(34')
        $m4 = Fixture::create([
            'season_id'    => 1,
            'stage_id'     => 2,
            'round_id'     => $round->id,
            'tie_id'       => $tie3->id,
            'home_team_id' => 11, // Алай
            'away_team_id' => 1,  // Талас
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2025-04-27 19:00:00',
            'status'       => 'completed',
            'home_score'   => 5,
            'away_score'   => 4,
            'leg'          => 2,
        ]);

        $this->lineup($m4->id, 11, [
            [233, false], // Джунушалиев Азирет
            [235, false], // Акматов Калдуубай
            [238, false], // Данияр уулу Абдурахим
            [240, false], // Долоткелдиев Азамат
            [243, false], // Кубанычов Кайрат
            [234, false], // Мурзаев Бекболсун
            [236, true],  // Алимов Максат — MVP
            [237, false], // Бабажанов Саид
            [241, false], // Исабеков Азамат
            [242, false], // Исабеков Азат
            [245, false], // Сакенов Илимбек
            [246, false], // Салимбаев Юлдашбай
        ]);

        $this->lineup($m4->id, 1, [
            [6,   false], // Курманбеков Бектур
            [13,  false], // Алымжанов Дастан
            [140, false], // Батырбек уулу Улан
            [4,   false], // Жакыпов Руслан
            [35,  false], // Саякбаев Кыяз
            [137, false], // Уланбек уулу Тилек
            [139, false], // Бактыбек уулу Талас
            [8,   false], // Болтобаев Темирлан
            [142, false], // Куттубек уулу Акылбек
            [11,  false], // Мыктыбеков Аскат
            [34,  false], // Орунбеков Камбар
            [143, false], // Сабырбек уулу Майрамбек
            [10,  false], // Сатыбалдиев Айдар
            [5,   false], // Торобеков Бакдоолот
        ]);

        $this->goal($m4->id, 1,  140, 5);  // Батырбек уулу (5')
        $this->goal($m4->id, 11, 236, 6);  // Алимов (6')
        $this->goal($m4->id, 11, 240, 7);  // Долоткелдиев (7')
        $this->goal($m4->id, 1,  11,  19); // Мыктыбеков (19')
        $this->goal($m4->id, 11, 246, 20); // Салимбаев (20')
        $this->goal($m4->id, 11, 236, 15); // Алимов (15')
        $this->goal($m4->id, 1,  8,   24); // Болтобаев (24')
        $this->goal($m4->id, 11, 242, 27); // Исабеков Азат (27')
        $this->goal($m4->id, 1,  35,  34); // Саякбаев (34')

        $tie3->update(['status' => 'completed', 'winner_id' => 11]);
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
