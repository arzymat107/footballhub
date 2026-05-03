<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Fixture;
use App\Models\FixtureLineup;
use App\Models\Round;
use Illuminate\Database\Seeder;

// Суперлига 2025-26 — Matchweek 11 (29–30 November 2025)
// Source: futsal_kgz Instagram posts
class Matchweek11Season2Seeder extends Seeder
{
    public function run(): void
    {
        $round = Round::firstOrCreate(
            ['stage_id' => 4, 'name' => 'Matchweek 11'],
            ['order' => 11],
        );

        $naryn      = 4;
        $talas      = 1;
        $dostuk     = 14;
        $alay       = 11;
        $kant       = 7;
        $karakol    = 5;
        $liderOshmu = 13;
        $toyota     = 15;
        $jashMuun   = 12;
        $topTogolok = 2;

        // ── Match 1: Нарын 5-1 Талас  (29.11.2025 18:00, ФОК «Газпром», Нарын) ──
        $m1 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $naryn,
            'away_team_id' => $talas,
            'venue'        => 'ФОК «Газпром», Нарын',
            'scheduled_at' => '2025-11-29 18:00:00',
            'status'       => 'completed',
            'home_score'   => 5,
            'away_score'   => 1,
        ]);

        $this->lineup($m1->id, $naryn, [
            [71,  true],  // Айылчиев Алманбет (MVP)
            [75,  false], // Байгазы уулу Уланбек
            [364, false], // Абдыбеков Эржан
            [118, false], // Аскеров Азамат
            [153, false], // Карыпбеков Бекмат
            [374, false], // Аскербеков Актан
            [83,  false], // Кубанычбеков Марат
            [91,  false], // Турсунбеков Уран
            [367, false], // Турсунбаев Бексултан
            [369, false], // Замирбеков Марлен
            [76,  false], // Бакаев Даниэль
        ]);
        $this->lineup($m1->id, $talas, [
            [285, false], // Жумалиев Нурсултан
            [143, false], // Сабырбек уулу Майрамбек
            [4,   false], // Жакыпов Руслан
            [11,  false], // Мыктыбеков Аскат
            [26,  false], // Жаанбаев Актан
            [139, false], // Бактыбек уулу Талас
            [34,  false], // Орунбеков Камбар
            [12,  false], // Мукушбеков Рамис
            [281, false], // Саякбаев Кудайберген
            [13,  false], // Алымжанов Дастан
            [345, false], // Айтмырзаев Нооруэбай
            [346, false], // Чолпонбаев Бийжан
            [140, false], // Батырбек уулу Улан
            [349, false], // Ануарбек уулу Адилет
        ]);
        // Goal details not published for this match

        // ── Match 2: Достук 7-6 Алай  (29.11.2025 18:00, СК КФБ, Бишкек) ──
        $m2 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $dostuk,
            'away_team_id' => $alay,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2025-11-29 18:00:00',
            'status'       => 'completed',
            'home_score'   => 7,
            'away_score'   => 6,
        ]);

        $this->lineup($m2->id, $dostuk, [
            [46,  false], // Кыргызов Айбек
            [361, false], // Бакиев Али
            [166, false], // Абдуллаев Мухаммадсодик
            [19,  false], // Касмакунов Элдияр
            [178, false], // Сайдалиев Дамирбек
            [363, false], // Бейшенкулов Арлен
            [49,  false], // Шамонин Станислав
            [359, false], // Токтогонов Улукман
            [170, true],  // Жакыпов Даулес (MVP)
            [78,  false], // Жумабеков Султан
            [362, false], // Абдумажидов Абдуллах
            [66,  false], // Тимченко Артем
        ]);
        $this->lineup($m2->id, $alay, [
            [45,  false], // Султангазиев Илимбек
            [240, false], // Долоткелдиев Азамат
            [235, false], // Акматов Калдуубай
            [246, false], // Салимбаев Юлдашбай
            [243, false], // Кубанычов Кайрат
            [257, false], // Мурзакарим уулу Асан
            [237, false], // Бабажанов Саид
            [259, false], // Дурусбеков Таалайнур
            [289, false], // Садыков Канат
            [292, false], // Бейшенбеков Максат
            [89,  false], // Талантбек уулу Жыргалбек
        ]);
        // Достук: Кыргызов(28'), Абдуллаев(30'), Касмакунов(13'28'), Жакыпов(40'), Жумабеков(14'), Абдумажидов(14')
        $this->goal($m2->id, $dostuk, 19,  13);
        $this->goal($m2->id, $dostuk, 78,  14);
        $this->goal($m2->id, $dostuk, 362, 14);
        $this->goal($m2->id, $dostuk, 46,  28);
        $this->goal($m2->id, $dostuk, 19,  28);
        $this->goal($m2->id, $dostuk, 166, 30);
        $this->goal($m2->id, $dostuk, 170, 40);
        // Алай: Салимбаев(22'), Садыков(35'), Бабажанов(37'38'), Кубанычов(39'), Долоткелдиев(40')
        $this->goal($m2->id, $alay, 246, 22);
        $this->goal($m2->id, $alay, 289, 35);
        $this->goal($m2->id, $alay, 237, 37);
        $this->goal($m2->id, $alay, 237, 38);
        $this->goal($m2->id, $alay, 243, 39);
        $this->goal($m2->id, $alay, 240, 40);

        // ── Match 3: Кант 7-3 Каракол  (29.11.2025 18:00, ФОК «Кант», Кант) ──
        $m3 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $kant,
            'away_team_id' => $karakol,
            'venue'        => 'ФОК «Кант», Кант',
            'scheduled_at' => '2025-11-29 18:00:00',
            'status'       => 'completed',
            'home_score'   => 7,
            'away_score'   => 3,
        ]);

        $this->lineup($m3->id, $kant, [
            [145, false], // Пензаев Чынгыз
            [152, true],  // Кадырбек уулу Ислам (MVP)
            [151, false], // Исроилов Кутбидин
            [157, false], // Рахманкулов Азамат
            [315, false], // Эсенгелдиев Калысбек
            [146, false], // Хамидов Акжол
            [147, false], // Айдаркул уулу Эрмек
            [162, false], // Шапданбек уулу Жолдошбек
            [155, false], // Мелисбек уулу Азамат
            [222, false], // Бейшеналиев Урмат
            [35,  false], // Саякбаев Кыяз
            [3,   false], // Замирбеков Женишбек
            [217, false], // Андабеков Аман
        ]);
        $this->lineup($m3->id, $karakol, [
            [332, false], // Рахманов Бакыт
            [105, false], // Усупов Эрлан
            [326, false], // Шакилов Ийгилик
            [100, false], // Орозбеков Улукбек
            [88,  false], // Сыдыков Нурслан
            [106, false], // Шаршенбиев Ринат
            [327, false], // Дюшембаев Жанарбек
            [94,  false], // Авазбеков Эрлан
            [93,  false], // Дюшенбаев Ислам
            [331, false], // Дамиров Бежжан
        ]);
        // Кант: Кадырбек У(2'26'33'), Эсенгелдиев(5'), Саякбаев(7'11'), Замирбеков(40')
        $this->goal($m3->id, $kant, 152, 2);
        $this->goal($m3->id, $kant, 315, 5);
        $this->goal($m3->id, $kant, 35,  7);
        $this->goal($m3->id, $kant, 35,  11);
        $this->goal($m3->id, $kant, 152, 26);
        $this->goal($m3->id, $kant, 152, 33);
        $this->goal($m3->id, $kant, 3,   40);
        // Каракол: Усупов(18'19'), Шакилов(30')
        $this->goal($m3->id, $karakol, 105, 18);
        $this->goal($m3->id, $karakol, 105, 19);
        $this->goal($m3->id, $karakol, 326, 30);

        // ── Match 4: Лидер-ОШМУ 0-3 Toyota  (29.11.2025 18:30, Ош СК «Шавкат») ──
        $m4 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $liderOshmu,
            'away_team_id' => $toyota,
            'venue'        => 'Ош СК «Шавкат»',
            'scheduled_at' => '2025-11-29 18:30:00',
            'status'       => 'completed',
            'home_score'   => 0,
            'away_score'   => 3,
        ]);

        // Lineup not published — goal scorers + MVP only
        $this->lineup($m4->id, $toyota, [
            [149, false], // Аянбаев Адил
            [221, true],  // Туратбеков Ислам (MVP)
            [377, false], // Оруналиев Ильгиз
        ]);
        // Toyota: Оруналиев(2'), Аянбаев(3'), Туратбеков(36')
        $this->goal($m4->id, $toyota, 377, 2);
        $this->goal($m4->id, $toyota, 149, 3);
        $this->goal($m4->id, $toyota, 221, 36);

        // ── Match 5: Жаш Муун 0-2 Топ Тоголок  (29.11.2025 20:00, Жалал-Абад СК «Акматалы Ажы») ──
        $m5 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $jashMuun,
            'away_team_id' => $topTogolok,
            'venue'        => 'Жалал-Абад СК «Акматалы Ажы»',
            'scheduled_at' => '2025-11-29 20:00:00',
            'status'       => 'completed',
            'home_score'   => 0,
            'away_score'   => 2,
        ]);

        $this->lineup($m5->id, $jashMuun, [
            [269, false], // Абдувалиев Омурали
            [299, false], // Сайфуллаев Хожиакбар
            [300, false], // Жанторев Билал
            [304, false], // Абдурасулов Нурсултан
            [310, false], // Мойдинов Мухаммадали
            [313, false], // Карабаев Муслимбек
            [314, false], // Октомбеков Кантенир
            [298, false], // Акимбаев Сагындык
            [301, false], // Таштемиров Абдурофи
            [302, false], // Пахридинов Гупронидин
            [303, false], // Маматкасымов Давронбек
            [268, false], // Арапов Кубатбек
            [306, false], // Махаматкулов Мухаммадали
            [308, false], // Толонмирзаев Арген
        ]);
        $this->lineup($m5->id, $topTogolok, [
            [20,  true],  // Куватбек Адил (MVP)
            [134, false], // Азамат уулу Ильгиз
            [24,  false], // Абдымамытов Адахан
            [334, false], // Абдирасулов Актилек
            [277, false], // Сманов Байэл
            [15,  false], // Азатов Амир
            [25,  false], // Ашуров Сыймык
            [28,  false], // Канатбеков Аймен
            [337, false], // Бектуров Эльхан
            [336, false], // Султанов Нуралы
            [341, false], // Черикбаев Арлен
            [342, false], // Данияров Саян
        ]);
        // Топ Тоголок: Сманов(18'), Канатбеков(32')
        $this->goal($m5->id, $topTogolok, 277, 18);
        $this->goal($m5->id, $topTogolok, 28,  32);

        // ── Match 6: Лидер-ОШМУ 7-4 Топ Тоголок  (30.11.2025 18:30, Ош СК «Шавкат») ──
        $m6 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $liderOshmu,
            'away_team_id' => $topTogolok,
            'venue'        => 'Ош СК «Шавкат»',
            'scheduled_at' => '2025-11-30 18:30:00',
            'status'       => 'completed',
            'home_score'   => 7,
            'away_score'   => 4,
        ]);

        // Lineup not published — MVP only
        $this->lineup($m6->id, $liderOshmu, [
            [320, true],  // Турсунбаев Шумкар (MVP)
        ]);
        // Goal details not published for this match

        // ── Match 7: Жаш Муун 1-3 Toyota  (30.11.2025 20:00, Жалал-Абад СК «Акматалы Ажы») ──
        $m7 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $jashMuun,
            'away_team_id' => $toyota,
            'venue'        => 'Жалал-Абад СК «Акматалы Ажы»',
            'scheduled_at' => '2025-11-30 20:00:00',
            'status'       => 'completed',
            'home_score'   => 1,
            'away_score'   => 3,
        ]);

        $this->lineup($m7->id, $jashMuun, [
            [313, false], // Карабаев Муслимбек
            [298, false], // Акимбаев Сагындык
            [302, false], // Пахридинов Гупронидин
            [303, false], // Маматкасымов Давронбек
            [268, false], // Арапов Кубатбек
            [269, false], // Абдувалиев Омурали
            [314, false], // Октомбеков Кантенир
            [300, false], // Жанторев Билал
            [299, false], // Сайфуллаев Хожиакбар
            [301, false], // Таштемиров Абдурофи
            [304, false], // Абдурасулов Нурсултан
            [306, false], // Махаматкулов Мухаммадали
            [308, false], // Толонмирзаев Арген
            [310, false], // Мойдинов Мухаммадали
        ]);
        $this->lineup($m7->id, $toyota, [
            [234, false], // Мурзаев Бекболсун
            [149, false], // Аянбаев Адил
            [376, false], // Амандык уулу Денисбек
            [221, false], // Туратбеков Ислам
            [377, false], // Оруналиев Ильгиз
            [233, false], // Жунушалиев Азирет
            [241, false], // Исабеков Азамат
            [242, false], // Исабеков Азат
            [90,  true],  // Таштанов Актай (MVP)
            [142, false], // Куттубек уулу Акылбек
            [378, false], // Абитов Шухрат
        ]);
        // Toyota: Туратбеков(3'), Исабеков Азамат(18'), Таштанов(31')
        $this->goal($m7->id, $toyota, 221, 3);
        $this->goal($m7->id, $toyota, 241, 18);
        $this->goal($m7->id, $toyota, 90,  31);
        // Жаш Муун: Жанторев(38')
        $this->goal($m7->id, $jashMuun, 300, 38);
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