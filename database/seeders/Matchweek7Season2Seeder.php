<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Fixture;
use App\Models\FixtureLineup;
use App\Models\Round;
use App\Models\Team;
use Illuminate\Database\Seeder;

// Суперлига 2025-26 — Matchweek 7 (1–2 November 2025)
// Source: futsal_kgz Instagram posts
class Matchweek7Season2Seeder extends Seeder
{
    public function run(): void
    {
        $round = Round::firstOrCreate(
            ['stage_id' => 4, 'name' => 'Matchweek 7'],
            ['order' => 7],
        );

        $talas      = 1;
        $topTogolok = 2;
        $vivat      = 3;
        $naryn      = 4;
        $karakol    = 5;
        $kant       = 7;
        $artBlast   = 10;
        $alay       = 11;
        $liderOshmu = Team::where('name', 'Лидер-ОШМУ')->value('id');
        $dostuk     = Team::where('name', 'Достук')->value('id');
        $jashMuun   = Team::where('name', 'Жаш Муун')->value('id');
        $toyota     = Team::where('name', 'Toyota')->value('id');

        // ── Match 1: Нарын 5-0 Топ Тоголок  (01.11.2025 18:00, ФОК «Газпром», Нарын) ──
        $m1 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $naryn,
            'away_team_id' => $topTogolok,
            'venue'        => 'ФОК «Газпром», Нарын',
            'scheduled_at' => '2025-11-01 18:00:00',
            'status'       => 'completed',
            'home_score'   => 5,
            'away_score'   => 0,
        ]);

        // Lineup not published — goal scorers + MVP only
        $this->lineup($m1->id, $naryn, [
            [71,  true],  // Айылчиев Алманбет (MVP)
            [153, false], // Карыпбеков Бекмат
            [111, false], // Абдыбеков Эдил
            [83,  false], // Кубанычбеков Марат
            [86,  false], // Мухтарбек уулу Бакыт
        ]);

        $this->goal($m1->id, $naryn, 153, 21); // Карыпбеков
        $this->goal($m1->id, $naryn, 111, 24); // Абдыбеков
        $this->goal($m1->id, $naryn, 153, 28); // Карыпбеков
        $this->goal($m1->id, $naryn, 83,  39); // Кубанычбеков М
        $this->goal($m1->id, $naryn, 86,  40); // Мухтарбек у

        // ── Match 2: Art Blast Group 4-4 Алай  (01.11.2025 20:00, СК КФБ, Бишкек) ──
        $m2 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $artBlast,
            'away_team_id' => $alay,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2025-11-01 20:00:00',
            'status'       => 'completed',
            'home_score'   => 4,
            'away_score'   => 4,
        ]);

        $this->lineup($m2->id, $artBlast, [
            [210, false], // Жусупов Абдуазим
            [213, false], // Абдурашит уулу Арген
            [250, false], // Талайбеков Данияр
            [219, false], // Эралиев Мухаммедмуса
            [150, false], // Джанат уулу Самат
            [212, false], // Насирдинов Султан
            [231, false], // Самат уулу Алмазбек
            [226, false], // Жумадилов Баатырхан
            [227, false], // Мендибаев Нурдин
            [229, false], // Канетов Эмил
            [230, false], // Анарбек уулу Акылбек
            [224, false], // Маматов Артур
            [214, false], // Сулайманбеков Айдар
        ]);
        $this->lineup($m2->id, $alay, [
            [45,  false], // Султангазиев Илимбек
            [240, false], // Долоткелдиев Азамат
            [237, false], // Бабажанов Саид
            [235, true],  // Акматов Калдуубай (MVP)
            [243, false], // Кубанычов Кайрат
            [295, false], // Суйорбеков Сагынбек
            [257, false], // Мурзакарим уулу Асан
            [259, false], // Дурусбеков Таалайнур
            [246, false], // Салимбаев Юлдашбай
            [292, false], // Бейшенбеков Максат
            [294, false], // Акматалиев Эрназар
            [89,  false], // Талантбек уулу Жыргалбек
            [198, false], // Култаев Адилет
        ]);

        $this->goal($m2->id, $artBlast, 250, 8);  // Талайбеков
        $this->goal($m2->id, $artBlast, 226, 9);  // Жумадилов
        $this->goal($m2->id, $alay,     237, 16); // Бабажанов
        $this->goal($m2->id, $artBlast, 231, 20); // Самат уулу
        $this->goal($m2->id, $artBlast, 150, 21); // Джанат уулу
        $this->goal($m2->id, $alay,     246, 25); // Салимбаев
        $this->goal($m2->id, $alay,     237, 29); // Бабажанов
        $this->goal($m2->id, $alay,     235, 36); // Акматов

        // ── Match 3: Лидер-ОШМУ 5-0 Достук  (01.11.2025 19:00, СК Шавкат, Ош) ──
        $m3 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $liderOshmu,
            'away_team_id' => $dostuk,
            'venue'        => 'СК Шавкат, Ош',
            'scheduled_at' => '2025-11-01 19:00:00',
            'status'       => 'completed',
            'home_score'   => 5,
            'away_score'   => 0,
        ]);

        $this->lineup($m3->id, $liderOshmu, [
            [186, false], // Кудайбердиев Сыймыкбек
            [168, false], // Алмазбеков Омурбек
            [317, true],  // Токоев Арсланбек (MVP)
            [205, false], // Умаров Таалайбек
            [323, false], // Эргешов Шахзодбек
            [165, false], // Эркинбаев Даниел
            [199, false], // Муктарали уулу Уланбек
            [316, false], // Базарбек уулу Байэл
            [197, false], // Исламов Алымбек
            [167, false], // Абышев Элмар
            [320, false], // Турсунбаев Шумкар
            [184, false], // Эргашев Диёрбек
        ]);
        $this->lineup($m3->id, $dostuk, [
            [46,  false], // Кыргызов Айбек
            [178, false], // Сайдалиев Дамирбек
            [360, false], // Бейшенов Бабур
            [166, false], // Абдуллаев Мухаммадсодик
            [19,  false], // Касмакунов Элдияр
            [49,  false], // Шамонин Станислав
            [270, false], // Карыбеков Даниэл
            [359, false], // Токтогонов Улукман
            [361, false], // Бакиев Али
            [170, false], // Жакыпов Даулес
            [78,  false], // Жумабеков Султан
            [362, false], // Абдумажидов Абдуллах
            [66,  false], // Тимченко Артем
        ]);

        $this->goal($m3->id, $liderOshmu, 317, 2);  // Токоев
        $this->goal($m3->id, $liderOshmu, 317, 18); // Токоев
        $this->goal($m3->id, $liderOshmu, 320, 29); // Турсунбаев
        $this->goal($m3->id, $liderOshmu, 317, 36); // Токоев
        $this->goal($m3->id, $liderOshmu, 320, 37); // Турсунбаев

        // ── Match 4: Жаш Муун 3-3 Талас  (01.11.2025 20:00, СК «Акматаалы Ажы», Жалал-Абад) ──
        $m4 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $jashMuun,
            'away_team_id' => $talas,
            'venue'        => 'СК «Акматаалы Ажы», Жалал-Абад',
            'scheduled_at' => '2025-11-01 20:00:00',
            'status'       => 'completed',
            'home_score'   => 3,
            'away_score'   => 3,
        ]);

        // Lineup not published — goal scorers + MVP only
        $this->lineup($m4->id, $jashMuun, [
            [298, true],  // Акимбаев Сагындык (MVP)
            [303, false], // Маматкасымов Давронбек
            [302, false], // Пахридинов Гупронидин
        ]);
        $this->lineup($m4->id, $talas, [
            [12,  false], // Мукушбеков Рамис
            [26,  false], // Жаанбаев Актан
        ]);

        $this->goal($m4->id, $talas,    12,  5);  // Мукушбеков
        $this->goal($m4->id, $jashMuun, 303, 8);  // Маматкасымов
        $this->goal($m4->id, $jashMuun, 303, 14); // Маматкасымов
        $this->goal($m4->id, $talas,    12,  12); // Мукушбеков
        $this->goal($m4->id, $jashMuun, 302, 36); // Пахридинов
        $this->goal($m4->id, $talas,    26,  38); // Жаанбаев

        // ── Match 5: Лидер-ОШМУ 2-3 Талас  (02.11.2025 19:00, СК Шавкат, Ош) ──
        $m5 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $liderOshmu,
            'away_team_id' => $talas,
            'venue'        => 'СК Шавкат, Ош',
            'scheduled_at' => '2025-11-02 19:00:00',
            'status'       => 'completed',
            'home_score'   => 2,
            'away_score'   => 3,
        ]);

        $this->lineup($m5->id, $liderOshmu, [
            [186, false], // Кудайбердиев Сыймыкбек
            [317, false], // Токоев Арсланбек
            [167, false], // Абышев Элмар
            [320, false], // Турсунбаев Шумкар
            [323, false], // Эргешов Шахзодбек
            [165, false], // Эркинбаев Даниел
            [199, false], // Муктарали уулу Уланбек
            [316, false], // Базарбек уулу Байэл
            [168, false], // Алмазбеков Омурбек
            [201, false], // Ражапов Сыймык
            [197, false], // Исламов Алымбек
            [205, false], // Умаров Таалайбек
            [184, false], // Эргашев Диёрбек
        ]);
        $this->lineup($m5->id, $talas, [
            [285, true],  // Жумалиев Нурсултан (MVP)
            [143, false], // Сабырбек уулу Майрамбек
            [4,   false], // Жакыпов Руслан
            [11,  false], // Мыктыбеков Аскат
            [26,  false], // Жаанбаев Актан
            [6,   false], // Курманбеков Бектур
            [34,  false], // Орунбеков Камбар
            [12,  false], // Мукушбеков Рамис
            [140, false], // Батырбек уулу Улан
            [345, false], // Айтмырзаев Нооруэбай
            [349, false], // Ануарбек уулу Адилет
        ]);

        $this->goal($m5->id, $talas,     26,  8);  // Жаанбаев
        $this->ownGoal($m5->id, $talas,  167, 13); // Абышев АГ (benefits Талас)
        $this->goal($m5->id, $liderOshmu, 317, 18); // Токоев
        $this->goal($m5->id, $liderOshmu, 317, 33); // Токоев
        $this->goal($m5->id, $talas,     11,  36); // Мыктыбеков

        // ── Match 6: Каракол 1-7 Toyota  (02.11.2025 18:00, ФОК «Каракол», Каракол) ──
        $m6 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $karakol,
            'away_team_id' => $toyota,
            'venue'        => 'ФОК «Каракол», Каракол',
            'scheduled_at' => '2025-11-02 18:00:00',
            'status'       => 'completed',
            'home_score'   => 1,
            'away_score'   => 7,
        ]);

        $this->lineup($m6->id, $karakol, [
            [332, false], // Рахманов Бакыт
            [105, false], // Усупов Эрлан
            [326, false], // Шакилов Ийгилик
            [333, false], // Дамиров Белек
            [100, false], // Орозбеков Улукбек
            [106, false], // Шаршенбиев Ринат
            [104, false], // Усупов Адилет
            [94,  false], // Авазбеков Эрлан
            [327, false], // Дюшенбаев Жанарбек
            [93,  false], // Дюшенбаев Ислам
        ]);
        $this->lineup($m6->id, $toyota, [
            [233, false], // Джунушалиев Азирет
            [242, false], // Исабеков Азат
            [241, false], // Исабеков Азамат
            [244, true],  // Мамбеталиев Саламат (MVP)
            [376, false], // Амандык уулу Денисбек
            [234, false], // Мурзаев Бекболсун
            [90,  false], // Таштанов Актай
            [375, false], // Муратбеков Айдар
            [149, false], // Аянбаев Адил
            [247, false], // Турсунов Арстанбек
            [238, false], // Данияр уулу Абдурахим
            [128, false], // Туратбек уулу Эрназар
            [377, false], // Оруналиев Ильгиз
            [379, false], // Рашанбеков Элдар
        ]);

        $this->goal($m6->id, $toyota,  244, 1);  // Мамбеталиев
        $this->goal($m6->id, $toyota,  247, 23); // Турсунов
        $this->goal($m6->id, $toyota,  247, 25); // Турсунов
        $this->goal($m6->id, $toyota,  377, 26); // Оруналиев
        $this->goal($m6->id, $toyota,  244, 31); // Мамбеталиев
        $this->goal($m6->id, $karakol, 327, 36); // Дюшенбаев Жанарбек
        $this->goal($m6->id, $toyota,  376, 38); // Амандык уулу
        $this->goal($m6->id, $toyota,  244, 38); // Мамбеталиев

        // ── Match 7: Жаш Муун 2-1 Достук  (02.11.2025 20:00, СК «Акматаалы Ажы», Жалал-Абад) ──
        $m7 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $jashMuun,
            'away_team_id' => $dostuk,
            'venue'        => 'СК «Акматаалы Ажы», Жалал-Абад',
            'scheduled_at' => '2025-11-02 20:00:00',
            'status'       => 'completed',
            'home_score'   => 2,
            'away_score'   => 1,
        ]);

        $this->lineup($m7->id, $jashMuun, [
            [269, true],  // Абдувалиев Омурали (MVP)
            [298, false], // Акимбаев Сагындык
            [302, false], // Пахридинов Гупронидин
            [303, false], // Маматкасымов Давронбек
            [268, false], // Арапов Кубатбек
            [313, false], // Карабаев Муслимбек
            [314, false], // Октомбеков Кантенир
            [299, false], // Сайфуллаев Хожиакбар
            [300, false], // Жанторев Билал
            [301, false], // Таштемиров Абдурофи
            [304, false], // Абдурасулов Нурсултан
            [308, false], // Толонмирзаев Арген
            [310, false], // Мойдинов Мухаммадали
            [306, false], // Махаматкулов Мухаммадали
        ]);
        $this->lineup($m7->id, $dostuk, [
            [46,  false], // Кыргызов Айбек
            [270, false], // Карыбеков Даниэл
            [170, false], // Жакыпов Даулес
            [78,  false], // Жумабеков Султан
            [362, false], // Абдумажидов Абдуллах
            [363, false], // Бейшенкулов Арлен
            [49,  false], // Шамонин Станислав
            [359, false], // Токтогонов Улукман
            [360, false], // Бейшенов Бабур
            [361, false], // Бакиев Али
            [166, false], // Абдуллаев Мухаммадсодик
            [19,  false], // Касмакунов Элдияр
            [66,  false], // Тимченко Артем
            [178, false], // Сайдалиев Дамирбек
        ]);

        $this->goal($m7->id, $jashMuun, 298, 2);  // Акимбаев
        $this->goal($m7->id, $jashMuun, 303, 27); // Маматкасымов
        $this->goal($m7->id, $dostuk,   19,  40); // Касмакунов

        // ── Match 8: Виват 1-6 Кант  (02.11.2025 20:30, СК КФБ, Бишкек) ──
        $m8 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $vivat,
            'away_team_id' => $kant,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2025-11-02 20:30:00',
            'status'       => 'completed',
            'home_score'   => 1,
            'away_score'   => 6,
        ]);

        $this->lineup($m8->id, $vivat, [
            [353, false], // Яфаров Султан
            [50,  false], // Анарбеков Нурадил
            [68,  false], // Чиркин Кирилл
            [223, false], // Эсенгелдиев Асылбек
            [288, false], // Ашималиев Данияр
            [47,  false], // Маликжанов Нурэл
            [60,  false], // Кошонов Канкелди
            [64,  false], // Минкеев Ильзат
            [351, false], // Саралаев Ислам
            [57,  false], // Искендербеков Талгат
            [59,  false], // Керимбаев Эмирлан
            [63,  false], // Маликов Абдурасул
            [69,  false], // Юлдашев Набижан
            [352, false], // Игольников Илья
        ]);
        $this->lineup($m8->id, $kant, [
            [146, false], // Хамидов Акжол
            [152, false], // Кадырбек уулу Ислам
            [147, false], // Айдаркул уулу Эрмек
            [157, false], // Рахманкулов Азамат
            [3,   true],  // Замирбеков Женишбек (MVP)
            [145, false], // Пензаев Чынгыз
            [151, false], // Исроилов Кутбидин
            [162, false], // Шапданбек уулу Жолдошбек
            [155, false], // Мелисбек уулу Азамат
            [222, false], // Бейшеналиев Урмат
            [35,  false], // Саякбаев Кыяз
            [315, false], // Эсенгелдиев Калысбек
            [2,   false], // Салымбеков Нурсултан
            [232, false], // Муктарбеков Эльдар
        ]);

        $this->goal($m8->id, $kant,  152, 8);  // Кадырбек уулу
        $this->goal($m8->id, $kant,  2,   9);  // Салымбеков
        $this->goal($m8->id, $vivat, 223, 12); // Эсенгелдиев А
        $this->goal($m8->id, $kant,  315, 26); // Эсенгелдиев К
        $this->goal($m8->id, $kant,  3,   29); // Замирбеков
        $this->goal($m8->id, $kant,  232, 29); // Муктарбеков
        $this->goal($m8->id, $kant,  315, 37); // Эсенгелдиев К
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