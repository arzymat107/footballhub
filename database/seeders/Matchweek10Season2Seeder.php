<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Fixture;
use App\Models\FixtureLineup;
use App\Models\Round;
use Illuminate\Database\Seeder;

// Суперлига 2025-26 — Matchweek 10 (22–23 November 2025)
// Source: futsal_kgz Instagram posts
class Matchweek10Season2Seeder extends Seeder
{
    public function run(): void
    {
        $round = Round::firstOrCreate(
            ['stage_id' => 4, 'name' => 'Matchweek 10'],
            ['order' => 10],
        );

        $vivat      = 3;
        $toyota     = 15;
        $artBlast   = 10;
        $talas      = 1;
        $karakol    = 5;
        $alay       = 11;
        $dostuk     = 14;
        $topTogolok = 2;

        // ── Match 1: Виват 1-9 Toyota  (22.11.2025 18:00, СК КФБ, Бишкек) ──
        $m1 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $vivat,
            'away_team_id' => $toyota,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2025-11-22 18:00:00',
            'status'       => 'completed',
            'home_score'   => 1,
            'away_score'   => 9,
        ]);

        $this->lineup($m1->id, $vivat, [
            [353, false], // Яфаров Султан
            [58,  false], // Кадыров Дильшат
            [352, false], // Игольников Илья
            [288, false], // Ашималиев Данияр
            [27,  false], // Иманалиев Элбек
            [132, false], // Тургунбеков Адыл
            [50,  false], // Анарбеков Нурадил
            [57,  false], // Искендербеков Талгат
            [59,  false], // Керимбаев Эмирлан
            [63,  false], // Маликов Абдурасул
            [64,  false], // Минкеев Ильзат
            [68,  false], // Чиркин Кирилл
            [223, false], // Эсенгелдиев Асылбек
            [255, false], // Эрмеков Ильгиз
        ]);
        $this->lineup($m1->id, $toyota, [
            [234, false], // Мурзаев Бекболсун
            [149, false], // Аянбаев Адил
            [247, false], // Турсунов Арстанбек
            [221, false], // Туратбеков Ислам
            [377, false], // Оруналиев Ильгиз
            [233, false], // Жунушалиев Азирет
            [242, false], // Исабеков Азат
            [244, false], // Мамбеталиев Саламат
            [90,  false], // Таштанов Актай
            [375, false], // Муратбеков Айдар
            [376, true],  // Амандык уулу Денисбек (MVP)
            [142, false], // Куттубек уулу Акылбек
            [379, false], // Рашанбеков Элдар
        ]);
        // Виват: Иманалиев(39')
        $this->goal($m1->id, $vivat, 27, 39);
        // Toyota: Турсунов(4'), Амандык(5'6'20'24'32'), Таштанов(6'10'), Аянбаев(36')
        $this->goal($m1->id, $toyota, 247, 4);
        $this->goal($m1->id, $toyota, 376, 5);
        $this->goal($m1->id, $toyota, 376, 6);
        $this->goal($m1->id, $toyota, 90,  6);
        $this->goal($m1->id, $toyota, 90,  10);
        $this->goal($m1->id, $toyota, 376, 20);
        $this->goal($m1->id, $toyota, 376, 24);
        $this->goal($m1->id, $toyota, 376, 32);
        $this->goal($m1->id, $toyota, 149, 36);

        // ── Match 2: Арт Бласт Групп 2-1 Талас  (22.11.2025 20:00, СК КФБ, Бишкек) ──
        $m2 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $artBlast,
            'away_team_id' => $talas,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2025-11-22 20:00:00',
            'status'       => 'completed',
            'home_score'   => 2,
            'away_score'   => 1,
        ]);

        $this->lineup($m2->id, $artBlast, [
            [210, false], // Жусупов Абдуазим
            [213, false], // Абдурашит уулу Арген
            [250, false], // Талайбеков Данияр
            [231, false], // Самат уулу Алмазбек
            [227, false], // Мендибаев Нурдин
            [212, false], // Насирдинов Султан
            [220, false], // Эралиев Мухаммедиса
            [226, false], // Жумадилов Баатырхан
            [230, false], // Анарбек уулу Акылбек
            [216, false], // Мелисов Нурсултан
            [224, false], // Маматов Артур
            [236, true],  // Алимов Максат (MVP)
            [358, false], // Сатыбалдиев Эльдар
            [214, false], // Сулайманбеков Айдар
        ]);
        $this->lineup($m2->id, $talas, [
            [285, false], // Жумалиев Нурсултан
            [143, false], // Сабырбек уулу Майрамбек
            [4,   false], // Жакыпов Руслан
            [12,  false], // Мукушбеков Рамис
            [26,  false], // Жаанбаев Актан
            [6,   false], // Курманбеков Бектур
            [13,  false], // Алымжанов Дастан
            [345, false], // Айтмырзаев Нооруэбай
            [346, false], // Чолпонбаев Бийжан
            [140, false], // Батырбек уулу Улан
            [37,  false], // Ахметов Арлан
            [347, false], // Бузурманкулов Эрмек
            [349, false], // Ануарбек уулу Адилет
        ]);
        // Арт Бласт: Самат У(15'), Алимов(37')
        $this->goal($m2->id, $artBlast, 231, 15);
        $this->goal($m2->id, $artBlast, 236, 37);
        // Талас: Сабырбек У(1')
        $this->goal($m2->id, $talas, 143, 1);

        // ── Match 3: Каракол 3-8 Алай  (23.11.2025 18:00, ФОК «Каракол», Каракол) ──
        $m3 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $karakol,
            'away_team_id' => $alay,
            'venue'        => 'ФОК «Каракол», Каракол',
            'scheduled_at' => '2025-11-23 18:00:00',
            'status'       => 'completed',
            'home_score'   => 3,
            'away_score'   => 8,
        ]);

        $this->lineup($m3->id, $karakol, [
            [332, false], // Рахманов Бакыт
            [105, false], // Усупов Эрлан
            [326, false], // Шакилов Ийгилик
            [331, false], // Дамиров Бежжан
            [88,  false], // Сыдыков Нурслан
            [106, false], // Шаршенбиев Ринат
            [327, false], // Дюшембаев Жанарбек
            [104, false], // Усупов Адилет
            [94,  false], // Авазбеков Эрлан
            [93,  false], // Дюшенбаев Ислам
            [100, false], // Орозбеков Улукбек
        ]);
        $this->lineup($m3->id, $alay, [
            [45,  false], // Султангазиев Илимбек
            [257, false], // Мурзакарим уулу Асан
            [237, false], // Бабажанов Саид
            [259, false], // Дурусбеков Таалайнур
            [89,  false], // Талантбек уулу Жыргалбек
            [240, false], // Долоткелдиев Азамат
            [235, false], // Акматов Калдуубай
            [246, false], // Салимбаев Юлдашбай
            [292, false], // Бейшенбеков Максат
            [243, true],  // Кубанычов Кайрат (MVP)
            [293, false], // Дюшенов Урмат
            [198, false], // Култаев Адилет
        ]);
        // Каракол: Усупов(20'), Дамиров(14'), Сыдыков(2')
        $this->goal($m3->id, $karakol, 88,  2);
        $this->goal($m3->id, $karakol, 331, 14);
        $this->goal($m3->id, $karakol, 105, 20);
        // Алай: Кубанычов(5'7'17'), Долоткелдиев(15'), Салимбаев(31'33'), Култаев(36'), Талантбек(37')
        $this->goal($m3->id, $alay, 243, 5);
        $this->goal($m3->id, $alay, 243, 7);
        $this->goal($m3->id, $alay, 240, 15);
        $this->goal($m3->id, $alay, 243, 17);
        $this->goal($m3->id, $alay, 246, 31);
        $this->goal($m3->id, $alay, 246, 33);
        $this->goal($m3->id, $alay, 198, 36);
        $this->goal($m3->id, $alay, 89,  37);

        // ── Match 4: Достук 4-2 Топ Тоголок  (23.11.2025 20:30, СК КФБ, Бишкек) ──
        $m4 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $dostuk,
            'away_team_id' => $topTogolok,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2025-11-23 20:30:00',
            'status'       => 'completed',
            'home_score'   => 4,
            'away_score'   => 2,
        ]);

        $this->lineup($m4->id, $dostuk, [
            [46,  false], // Кыргызов Айбек
            [270, false], // Карыбеков Даниэл
            [170, true],  // Жакыпов Даулес (MVP)
            [362, false], // Абдумажидов Абдуллах
            [66,  false], // Тимченко Артем
            [363, false], // Бейшенкулов Арлен
            [49,  false], // Шамонин Станислав
            [359, false], // Токтогонов Улукман
            [360, false], // Бейшенов Бабур
            [361, false], // Бакиев Али
            [78,  false], // Жумабеков Султан
            [166, false], // Абдуллаев Мухаммадсодик
            [19,  false], // Касмакунов Элдияр
            [178, false], // Сайдалиев Дамирбек
        ]);
        $this->lineup($m4->id, $topTogolok, [
            [20,  false], // Куватбек Адил
            [21,  false], // Ильясов Бектур
            [134, false], // Азамат уулу Ильгиз
            [28,  false], // Канатбеков Аймен
            [336, false], // Султанов Нуралы
            [15,  false], // Азатов Амир
            [24,  false], // Абдымамытов Адахан
            [25,  false], // Ашуров Сыймык
            [334, false], // Абдирасулов Актилек
            [335, false], // Бекбоев Кутман
            [341, false], // Черикбаев Арлен
            [277, false], // Сманов Байэл
        ]);
        // Goal details not published for this match
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