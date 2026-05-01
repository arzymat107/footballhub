<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Fixture;
use App\Models\FixtureLineup;
use App\Models\Round;
use App\Models\Team;
use Illuminate\Database\Seeder;

// Суперлига 2025-26 — Matchweek 6 (25–26 October 2025)
// Source: futsal_kgz Instagram posts
// Full Starting V lineups published
class Matchweek6Season2Seeder extends Seeder
{
    public function run(): void
    {
        $round = Round::firstOrCreate(
            ['stage_id' => 4, 'name' => 'Matchweek 6'],
            ['order' => 6],
        );

        $naryn      = 4;
        $topTogolok = 2;
        $talas      = 1;
        $kant       = 7;
        $artBlast   = 10;
        $alay       = 11;
        $toyota     = Team::where('name', 'Toyota')->value('id');
        $dostuk     = Team::where('name', 'Достук')->value('id');

        // ── Match 1: Нарын 4-8 Достук  (25.10.2025 16:30, ФОК «Газпром», Нарын) ──
        $m1 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $naryn,
            'away_team_id' => $dostuk,
            'venue'        => 'ФОК «Газпром», Нарын',
            'scheduled_at' => '2025-10-25 16:30:00',
            'status'       => 'completed',
            'home_score'   => 4,
            'away_score'   => 8,
        ]);

        $this->lineup($m1->id, $naryn, [
            [71,  false], // Айылчиев Алманбет
            [75,  false], // Байгазы уулу Уланбек
            [87,  false], // Нурлан уулу Эрбол
            [111, false], // Абдыбеков Эдил
            [118, false], // Аскеров Азамат
            [374, false], // Аскербеков Актан
            [79,  false], // Жыргалбеков Бактияр
            [73,  false], // Айтокторов Нурберген
            [91,  false], // Турсунбеков Уран
            [86,  false], // Мухтарбек уулу Бакыт
            [365, false], // Рахатбеков Бектен
            [153, false], // Карыпбеков Бекмат
            [165, false], // Эркинбаев Даниел
        ]);
        $this->lineup($m1->id, $dostuk, [
            [46,  true],  // Кыргызов Айбек (MVP)
            [360, false], // Бейшенов Бабур
            [166, false], // Абдуллаев Мухаммадсодик
            [19,  false], // Касмакунов Элдияр
            [178, false], // Сайдалиев Дамирбек
            [363, false], // Бейшенкулов Арлен
            [49,  false], // Шамонин Станислав
            [270, false], // Карыбеков Даниэл
            [359, false], // Токтогонов Улукман
            [361, false], // Бакиев Али
            [170, false], // Жакыпов Даулес
            [78,  false], // Жумабеков Султан
            [66,  false], // Тимченко Артем
            [362, false], // Абдумажидов Абдуллах
        ]);

        // Goals (minutes not published)
        $this->goal($m1->id, $naryn,  118, 0); // Аскеров
        $this->goal($m1->id, $naryn,  87,  0); // Нурлан уулу
        $this->goal($m1->id, $naryn,  91,  0); // Турсунбеков
        $this->ownGoal($m1->id, $naryn, 166, 0); // Абдуллаев АГ (benefits Нарын)
        $this->goal($m1->id, $dostuk, 19,  0); // Касмакунов
        $this->goal($m1->id, $dostuk, 19,  0); // Касмакунов
        $this->goal($m1->id, $dostuk, 19,  0); // Касмакунов (хет-трик)
        $this->goal($m1->id, $dostuk, 166, 0); // Абдуллаев
        $this->goal($m1->id, $dostuk, 170, 0); // Жакыпов
        $this->goal($m1->id, $dostuk, 270, 0); // Карыбеков
        $this->goal($m1->id, $dostuk, 78,  0); // Жумабеков
        $this->goal($m1->id, $dostuk, 46,  0); // Кыргызов

        // ── Match 2: Топ Тоголок 2-3 Art Blast Group  (25.10.2025 18:00, СК КФБ, Бишкек) ──
        $m2 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $topTogolok,
            'away_team_id' => $artBlast,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2025-10-25 18:00:00',
            'status'       => 'completed',
            'home_score'   => 2,
            'away_score'   => 3,
        ]);

        $this->lineup($m2->id, $topTogolok, [
            [15,  false], // Азатов Амир
            [24,  false], // Абдымамытов Адахан
            [25,  false], // Ашуров Сыймык
            [277, false], // Сманов Байэл
            [342, false], // Данияров Саян
            [20,  false], // Куватбек Адил
            [21,  false], // Ильясов Бектур
            [107, false], // Азамат уулу Айдар
            [334, false], // Абдирасулов Актилек
            [28,  false], // Канатбеков Аймен
            [341, false], // Черикбаев Арлен
            [343, false], // Колопов Достук
        ]);
        $this->lineup($m2->id, $artBlast, [
            [210, false], // Жусупов Абдуазим
            [213, false], // Абдурашит уулу Арген
            [250, false], // Талайбеков Данияр
            [227, false], // Мендибаев Нурдин
            [150, false], // Джанат уулу Самат
            [212, false], // Насирдинов Султан
            [231, false], // Самат уулу Алмазбек
            [219, true],  // Эралиев Мухаммедмуса (MVP)
            [229, false], // Канетов Эмил
            [226, false], // Жумадилов Баатырхан
            [230, false], // Анарбек уулу Акылбек
            [224, false], // Маматов Артур
            [159, false], // Султанбеков Бекзат
            [236, false], // Алимов Максат
        ]);

        $this->goal($m2->id, $artBlast,   213, 1);  // Абдурашит уулу
        $this->goal($m2->id, $topTogolok, 334, 26); // Абдирасулов
        $this->goal($m2->id, $topTogolok, 28,  29); // Канатбеков
        $this->goal($m2->id, $artBlast,   226, 29); // Жумадилов
        $this->goal($m2->id, $artBlast,   219, 31); // Эралиев Муса

        // ── Match 3: Toyota 3-3 Талас  (25.10.2025 20:00, СК КФБ, Бишкек) ──
        $m3 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $toyota,
            'away_team_id' => $talas,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2025-10-25 20:00:00',
            'status'       => 'completed',
            'home_score'   => 3,
            'away_score'   => 3,
        ]);

        $this->lineup($m3->id, $toyota, [
            [234, false], // Мурзаев Бекболсун
            [149, false], // Аянбаев Адил
            [90,  false], // Таштанов Актай
            [375, false], // Муратбеков Айдар
            [238, false], // Данияр уулу Абдурахим
            [233, false], // Джунушалиев Азирет
            [244, false], // Мамбеталиев Саламат
            [241, false], // Исабеков Азамат
            [242, false], // Исабеков Азат
            [376, false], // Амандык уулу Денисбек
            [142, false], // Куттубек уулу Акылбек
            [378, false], // Абитов Шухрат
            [128, false], // Туратбек уулу Эрназар
            [377, false], // Оруналиев Ильгиз
        ]);
        $this->lineup($m3->id, $talas, [
            [285, false], // Жумалиев Нурсултан
            [143, false], // Сабырбек уулу Майрамбек
            [11,  false], // Мыктыбеков Аскат
            [4,   false], // Жакыпов Руслан
            [26,  false], // Жаанбаев Актан
            [139, false], // Бактыбек уулу Талас
            [34,  false], // Орунбеков Камбар
            [12,  true],  // Мукушбеков Рамис (MVP)
            [345, false], // Айтмырзаев Нооруэбай
            [346, false], // Чолпонбаев Бийжан
            [140, false], // Батырбек уулу Улан
            [37,  false], // Ахметов Арлан
            [348, false], // Раманкулов Абдурахим
            [349, false], // Ануарбек уулу Адилет
        ]);

        $this->goal($m3->id, $talas,  349, 10); // Ануарбек у
        $this->goal($m3->id, $toyota, 244, 19); // Мамбеталиев
        $this->goal($m3->id, $talas,  12,  25); // Мукушбеков
        $this->goal($m3->id, $toyota, 242, 26); // Исабеков Азат
        $this->goal($m3->id, $toyota, 244, 27); // Мамбеталиев
        $this->goal($m3->id, $talas,  4,   37); // Жакыпов

        // ── Match 4: Кант 1-2 Алай  (26.10.2025 20:30, СК КФБ, Бишкек) ──
        $m4 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $kant,
            'away_team_id' => $alay,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2025-10-26 20:30:00',
            'status'       => 'completed',
            'home_score'   => 1,
            'away_score'   => 2,
        ]);

        $this->lineup($m4->id, $kant, [
            [145, false], // Пензаев Чынгыз
            [152, false], // Кадырбек уулу Ислам
            [157, false], // Рахманкулов Азамат
            [162, false], // Шапданбек уулу Жолдошбек
            [155, false], // Мелисбек уулу Азамат
            [146, false], // Хамидов Акжол
            [147, false], // Айдаркул уулу Эрмек
            [8,   false], // Болтобаев Темирлан
            [222, false], // Бейшеналиев Урмат
            [315, false], // Эсенгелдиев Калысбек
            [3,   false], // Замирбеков Женишбек
            [2,   false], // Салымбеков Нурсултан
        ]);
        $this->lineup($m4->id, $alay, [
            [45,  false], // Султангазиев Илимбек
            [257, false], // Мурзакарим уулу Асан
            [246, false], // Салимбаев Юлдашбай
            [198, false], // Култаев Адилет
            [89,  false], // Талантбек уулу Жыргалбек
            [295, false], // Суйорбеков Сагынбек
            [237, false], // Бабажанов Саид
            [240, false], // Долоткелдиев Азамат
            [235, false], // Акматов Калдуубай
            [259, false], // Дурусбеков Таалайнур
            [243, true],  // Кубанычов Кайрат (MVP)
        ]);

        $this->goal($m4->id, $kant, 2,   10); // Салымбеков
        $this->goal($m4->id, $alay, 89,  18); // Талантбек у
        $this->goal($m4->id, $alay, 243, 39); // Кубанычов
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