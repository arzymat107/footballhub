<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Fixture;
use App\Models\FixtureLineup;
use App\Models\Player;
use App\Models\Round;
use Illuminate\Database\Seeder;

// Суперлига 2025-26 — Matchweek 22 / 2-АЙЛАМПА (19 Apr 2026, second day)
// Source: futsal_kgz Instagram posts
class Matchweek22bSeason2Seeder extends Seeder
{
    public function run(): void
    {
        $round = Round::firstOrCreate(
            ['stage_id' => 4, 'name' => 'Matchweek 22'],
            ['order' => 22],
        );

        $topTogolok = 2;
        $vivat      = 3;
        $dostuk     = 14;
        $toyota     = 15;

        $arykbekov = Player::firstOrCreate(['name' => 'Арыкбеков'])->id;

        // ── Match 3: Toyota 11-3 Виват  (19.04.2026 18:00, СК КФБ, Бишкек) ──
        $m3 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $toyota,
            'away_team_id' => $vivat,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2026-04-19 18:00:00',
            'status'       => 'completed',
            'home_score'   => 11,
            'away_score'   => 3,
        ]);

        $this->lineup($m3->id, $toyota, [
            [234,        false], // Мурзаев Бекболсун
            [240,        false], // Долоткелдиев Азамат
            [90,         false], // Таштанов Актай
            [247,        false], // Турсунов Арстанбек
            [238,        true],  // Данияр уулу Абдурахим (MVP)
            [233,        false], // Джунушалиев Азирет
            [428,        false], // Койчубеков Ислам
            [242,        false], // Исабеков Азат
            [149,        false], // Аянбаев Адил
            [376,        false], // Амандык уулу Денисбек
            [377,        false], // Оруналиев Ильгиз
            [379,        false], // Рашанбеков Элдар
            [425,        false], // Оливейра Веллингтон
            [$arykbekov, false], // Арыкбеков
        ]);
        $this->lineup($m3->id, $vivat, [
            [132, false], // Тургунбеков Адыл
            [59,  false], // Керимбаев Эмирлан
            [60,  false], // Кошонов Канкелди
            [68,  false], // Чиркин Кирилл
            [352, false], // Игольников Илья
            [353, false], // Яфаров Султан
            [47,  false], // Маликжанов Нурэл
            [56,  false], // Зажигаев Данил
            [57,  false], // Искендербеков Талгат
            [64,  false], // Минкеев Ильзат
            [67,  false], // Хамраев Ибрахим
            [69,  false], // Юлдашев Набижан
            [66,  false], // Тимченко Артем
        ]);
        // Toyota: Таштанов(3'5'), Юлдашев OG(10'), Исабеков(16'32'), Данияр у(18'), Аянбаев(22'),
        //         Долоткелдиев(29'), Арыкбеков(31'), Турсунов(33'), Оливейра(35')
        $this->goal($m3->id, $toyota, 90,         3);
        $this->goal($m3->id, $toyota, 90,         5);
        $this->ownGoal($m3->id, $toyota, 69,      10);
        $this->goal($m3->id, $toyota, 242,        16);
        $this->goal($m3->id, $toyota, 238,        18);
        $this->goal($m3->id, $toyota, 149,        22);
        $this->goal($m3->id, $toyota, 240,        29);
        $this->goal($m3->id, $toyota, $arykbekov, 31);
        $this->goal($m3->id, $toyota, 242,        32);
        $this->goal($m3->id, $toyota, 247,        33);
        $this->goal($m3->id, $toyota, 425,        35);
        // Виват: Тимченко(4'), Юлдашев(27'), Зажигаев(39')
        $this->goal($m3->id, $vivat, 66, 4);
        $this->goal($m3->id, $vivat, 69, 27);
        $this->goal($m3->id, $vivat, 56, 39);

        // ── Match 4: Топ Тоголок 1-5 Достук  (19.04.2026 20:00, СК КФБ, Бишкек) ──
        $m4 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $topTogolok,
            'away_team_id' => $dostuk,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2026-04-19 20:00:00',
            'status'       => 'completed',
            'home_score'   => 1,
            'away_score'   => 5,
        ]);

        $this->lineup($m4->id, $topTogolok, [
            [15,  false], // Азатов Амир
            [107, false], // Азамат уулу Айдар
            [334, false], // Абдирасулов Актилек
            [277, false], // Сманов Байэл
            [405, false], // Калбаев Абдулазиз
            [133, false], // Мухтар уулу Байэл
            [25,  false], // Ашуров Сыймык
            [342, false], // Данияров Саян
            [407, false], // Жолдошалиев Ринат
            [409, false], // Нуланбек уулу Нурсултан
            [245, false], // Сакенов Илимбек
            [411, false], // Исамидинов Темирлан
            [412, false], // Жапаров Кайрат
            [413, false], // Калиев Нуржигит
        ]);
        $this->lineup($m4->id, $dostuk, [
            [46,  false], // Кыргызов Айбек
            [178, false], // Сайдалиев Дамирбек
            [360, false], // Бейшенов Бабур
            [362, false], // Абдумажидов Абдуллах
            [19,  false], // Касмакунов Элдияр
            [363, false], // Бейшенкулов Арлен
            [49,  false], // Шамонин Станислав
            [404, false], // Айтбаев Азамат
            [170, true],  // Жакыпов Даулес (MVP)
            [361, false], // Бакиев Али
            [359, false], // Токтогонов Улукман
        ]);
        // Достук: Касмакунов(12'29'), Жакыпов(16'), Токтогонов(24'), Бакиев(27')
        $this->goal($m4->id, $dostuk, 19,  12);
        $this->goal($m4->id, $dostuk, 170, 16);
        $this->goal($m4->id, $dostuk, 359, 24);
        $this->goal($m4->id, $dostuk, 361, 27);
        $this->goal($m4->id, $dostuk, 19,  29);
        // Топ Тоголок: Азамат у(40')
        $this->goal($m4->id, $topTogolok, 107, 40);
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

    private function ownGoal(int $fixtureId, int $beneficiaryTeamId, int $playerId, int $minute): void
    {
        Event::create([
            'fixture_id' => $fixtureId,
            'team_id'    => $beneficiaryTeamId,
            'player_id'  => $playerId,
            'type'       => 'own_goal',
            'minute'     => $minute,
        ]);
    }
}