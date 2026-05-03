<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Fixture;
use App\Models\FixtureLineup;
use App\Models\Round;
use Illuminate\Database\Seeder;

// Суперлига 2025-26 — Matchweek 12 (6–7 December 2025)
// Source: futsal_kgz Instagram posts
class Matchweek12Season2Seeder extends Seeder
{
    public function run(): void
    {
        $round = Round::firstOrCreate(
            ['stage_id' => 4, 'name' => 'Matchweek 12'],
            ['order' => 12],
        );

        $vivat    = 3;
        $karakol  = 5;
        $alay     = 11;
        $talas    = 1;
        $kant     = 7;
        $dostuk   = 14;
        $naryn    = 4;
        $artBlast = 10;

        // ── Match 1: Виват 5-5 Каракол  (06.12.2025 18:00, СК КФБ, Бишкек) ──
        $m1 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $vivat,
            'away_team_id' => $karakol,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2025-12-06 18:00:00',
            'status'       => 'completed',
            'home_score'   => 5,
            'away_score'   => 5,
        ]);

        $this->lineup($m1->id, $vivat, [
            [132, false], // Тургунбеков Адыл
            [50,  false], // Анарбеков Нурадил
            [64,  false], // Минкеев Ильзат
            [68,  false], // Чиркин Кирилл
            [223, false], // Эсенгелдиев Асылбек
            [353, false], // Яфаров Султан
            [52,  false], // Вильямов Бахридин
            [56,  false], // Зажигаев Данил
            [57,  true],  // Искендербеков Талгат (MVP)
            [59,  false], // Керимбаев Эмирлан
            [63,  false], // Маликов Абдурасул
            [67,  false], // Хамраев Ибрахим
            [69,  false], // Юлдашев Набижан
        ]);
        $this->lineup($m1->id, $karakol, [
            [332, false], // Рахманов Бакыт
            [105, false], // Усупов Эрлан
            [326, false], // Шакилов Ийгилик
            [100, false], // Орозбеков Улукбек
            [88,  false], // Сыдыков Нурслан
            [106, false], // Шаршенбиев Ринат
            [327, false], // Дюшембаев Жанарбек
        ]);
        // Goal details not published for this match

        // ── Match 2: Алай 5-3 Талас  (06.12.2025 20:00, СК КФБ, Бишкек) ──
        $m2 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $alay,
            'away_team_id' => $talas,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2025-12-06 20:00:00',
            'status'       => 'completed',
            'home_score'   => 5,
            'away_score'   => 3,
        ]);

        $this->lineup($m2->id, $alay, [
            [45,  false], // Султангазиев Илимбек
            [240, false], // Долоткелдиев Азамат
            [235, false], // Акматов Калдуубай
            [246, true],  // Салимбаев Юлдашбай (MVP)
            [243, false], // Кубанычов Кайрат
            [295, false], // Суйорбеков Сагынбек
            [257, false], // Мурзакарим уулу Асан
            [237, false], // Бабажанов Саид
            [259, false], // Дурусбеков Таалайнур
            [289, false], // Садыков Канат
            [292, false], // Бейшенбеков Максат
            [198, false], // Култаев Адилет
        ]);
        $this->lineup($m2->id, $talas, [
            [285, false], // Жумалиев Нурсултан
            [139, false], // Бактыбек уулу Талас
            [143, false], // Сабырбек уулу Майрамбек
            [11,  false], // Мыктыбеков Аскат
            [26,  false], // Жаанбаев Актан
            [6,   false], // Курманбеков Бектур
            [140, false], // Батырбек уулу Улан
            [34,  false], // Орунбеков Камбар
            [12,  false], // Мукушбеков Рамис
            [13,  false], // Алымжанов Дастан
            [345, false], // Айтмырзаев Нооруэбай
            [346, false], // Чолпонбаев Бийжан
            [37,  false], // Ахметов Арлан
            [349, false], // Ануарбек уулу Адилет
        ]);
        // Алай: Бабажанов(11'), Долоткелдиев(22'), Салимбаев(22'), Акматов(29'), Кубанычов(33')
        $this->goal($m2->id, $alay, 237, 11);
        $this->goal($m2->id, $alay, 240, 22);
        $this->goal($m2->id, $alay, 246, 22);
        $this->goal($m2->id, $alay, 235, 29);
        $this->goal($m2->id, $alay, 243, 33);
        // Талас: Бактыбек У(2', 39')
        $this->goal($m2->id, $talas, 139, 2);
        $this->goal($m2->id, $talas, 139, 39);

        // ── Match 3: Кант 2-4 Достук  (06.12.2025 19:00, ФОК «Кант», Кант) ──
        $m3 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $kant,
            'away_team_id' => $dostuk,
            'venue'        => 'ФОК «Кант», Кант',
            'scheduled_at' => '2025-12-06 19:00:00',
            'status'       => 'completed',
            'home_score'   => 2,
            'away_score'   => 4,
        ]);

        $this->lineup($m3->id, $kant, [
            [145, false], // Пензаев Чынгыз
            [152, false], // Кадырбек уулу Ислам
            [157, false], // Рахманкулов Азамат
            [232, false], // Муктарбеков Эльдар
            [217, false], // Андабеков Аман
            [146, false], // Хамидов Акжол
            [147, false], // Айдаркул уулу Эрмек
            [162, false], // Шапданбек уулу Жолдошбек
            [155, false], // Мелисбек уулу Азамат
            [222, false], // Бейшеналиев Урмат
            [35,  false], // Саякбаев Кыяз
            [315, false], // Эсенгелдиев Калысбек
            [3,   false], // Замирбеков Женишбек
            [2,   false], // Салымбеков Нурсултан
        ]);
        $this->lineup($m3->id, $dostuk, [
            [46,  false], // Кыргызов Айбек
            [170, false], // Жакыпов Даулес
            [166, false], // Абдуллаев Мухаммадсодик
            [19,  true],  // Касмакунов Элдияр (MVP)
            [178, false], // Сайдалиев Дамирбек
            [363, false], // Бейшенкулов Арлен
            [49,  false], // Шамонин Станислав
            [270, false], // Карыбеков Даниэл
            [359, false], // Токтогонов Улукман
            [360, false], // Бейшенов Бабур
            [361, false], // Бакиев Али
            [78,  false], // Жумабеков Султан
            [362, false], // Абдумажидов Абдуллах
            [66,  false], // Тимченко Артем
        ]);
        // Кант: Шапданбек У(15'), Кадырбек У(28')
        $this->goal($m3->id, $kant, 162, 15);
        $this->goal($m3->id, $kant, 152, 28);
        // Достук: Жакыпов(16'), Жумабеков(26'), Касмакунов(36'), Касмакунов(40')
        $this->goal($m3->id, $dostuk, 170, 16);
        $this->goal($m3->id, $dostuk, 78,  26);
        $this->goal($m3->id, $dostuk, 19,  36);
        $this->goal($m3->id, $dostuk, 19,  40);

        // ── Match 4: Нарын 3-4 Арт Бласт Групп  (07.12.2025 18:00, ФОК «Газпром», Нарын) ──
        $m4 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $naryn,
            'away_team_id' => $artBlast,
            'venue'        => 'ФОК «Газпром», Нарын',
            'scheduled_at' => '2025-12-07 18:00:00',
            'status'       => 'completed',
            'home_score'   => 3,
            'away_score'   => 4,
        ]);

        $this->lineup($m4->id, $naryn, [
            [75,  false], // Байгазы уулу Уланбек
            [71,  false], // Айылчиев Алманбет
            [364, false], // Абдыбеков Эржан
            [118, false], // Аскеров Азамат
            [153, false], // Карыпбеков Бекмат
            [79,  false], // Жыргалбеков Бактияр
            [83,  false], // Кубанычбеков Марат
            [86,  false], // Мухтарбек уулу Бакыт
            [87,  false], // Нурлан уулу Эрбол
            [368, false], // Садыков Мурадил
            [76,  false], // Бакаев Даниэль
            [370, false], // Эстебесов Амир
            [165, false], // Эркинбеков Даниел
        ]);
        $this->lineup($m4->id, $artBlast, [
            [210, false], // Жусупов Абдуазим
            [213, false], // Абдурашит уулу Арген
            [231, true],  // Самат уулу Алмазбек (MVP)
            [227, false], // Мендибаев Нурдин
            [159, false], // Султанбеков Бекзат
            [212, false], // Насирдинов Султан
            [218, false], // Кенешбеков Жанарбек
            [220, false], // Эралиев Мухаммедиса
            [226, false], // Жумадилов Баатырхан
            [230, false], // Анарбек уулу Акылбек
            [224, false], // Маматов Артур
            [236, false], // Алимов Максат
        ]);
        // Нарын: Аскеров(10', 28', 39')
        $this->goal($m4->id, $naryn, 118, 10);
        $this->goal($m4->id, $naryn, 118, 28);
        $this->goal($m4->id, $naryn, 118, 39);
        // Арт Бласт: Мендибаев(16', 27'), Самат У(25'), Кенешбеков(37')
        $this->goal($m4->id, $artBlast, 227, 16);
        $this->goal($m4->id, $artBlast, 227, 27);
        $this->goal($m4->id, $artBlast, 231, 25);
        $this->goal($m4->id, $artBlast, 218, 37);
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