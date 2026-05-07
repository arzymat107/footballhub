<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Fixture;
use App\Models\FixtureLineup;
use App\Models\Player;
use App\Models\Round;
use Illuminate\Database\Seeder;

// Суперлига 2025-26 — Matchweek 22 / 2-АЙЛАМПА (18 Apr 2026, first day)
// Source: futsal_kgz Instagram posts
class Matchweek22Season2Seeder extends Seeder
{
    public function run(): void
    {
        $round = Round::firstOrCreate(
            ['stage_id' => 4, 'name' => 'Matchweek 22'],
            ['order' => 22],
        );

        $talas      = 1;
        $artBlast   = 10;
        $alay       = 11;
        $karakol    = 5;

        $sharshenbekov = Player::firstOrCreate(['name' => 'Шаршенбиев Ринат'])->id;
        $sultangazievA = Player::firstOrCreate(['name' => 'Султангазиев А'])->id;

        // ── Match 1: Алай 3-4 Каракол  (18.04.2026 18:00, СК КФБ, Бишкек) ──
        $m1 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $alay,
            'away_team_id' => $karakol,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2026-04-18 18:00:00',
            'status'       => 'completed',
            'home_score'   => 3,
            'away_score'   => 4,
        ]);

        $this->lineup($m1->id, $alay, [
            [45,             false], // Султангазиев Илимбек
            [237,            false], // Бабажанов Саид
            [394,            false], // Ишенбек уулу Бакытбек
            [10,             false], // Сатыбалдиев Айдар
            [$sultangazievA, false], // Султангазиев А
            [257,            false], // Мурзакарим уулу Асан
            [259,            false], // Дурусбеков Таалайнур
            [235,            false], // Акматов Калдуубай
            [89,             false], // Талантбек уулу Жыргалбек
            [358,            false], // Сатыбалдиев Эльдар
        ]);
        $this->lineup($m1->id, $karakol, [
            [392,            true],  // Сайбеков Бахтияр (MVP)
            [105,            false], // Усупов Эрлан
            [326,            false], // Шакилов Ийгилик
            [$sharshenbekov, false], // Шаршенбеков Алибек
            [100,            false], // Орозбеков Улукбек
            [324,            false], // Бекбосунов Авазбек
            [94,             false], // Авазбеков Эрлан
            [98,             false], // Нурбеков Нурсултан
        ]);
        // Алай: Мурзакарим у(4'), Бабажанов(37'38')
        $this->goal($m1->id, $alay, 257, 4);
        $this->goal($m1->id, $alay, 237, 37);
        $this->goal($m1->id, $alay, 237, 38);
        // Каракол: Султангазиев А OG(4'), Сайбеков(33'), Усупов(40'), Орозбеков(40')
        $this->ownGoal($m1->id, $karakol, $sultangazievA, 4);
        $this->goal($m1->id, $karakol, 392, 33);
        $this->goal($m1->id, $karakol, 105, 40);
        $this->goal($m1->id, $karakol, 100, 40);

        // ── Match 2: Талас 2-4 Арт Бласт Групп  (18.04.2026 20:00, СК КФБ, Бишкек) ──
        $m2 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $talas,
            'away_team_id' => $artBlast,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2026-04-18 20:00:00',
            'status'       => 'completed',
            'home_score'   => 2,
            'away_score'   => 4,
        ]);

        $this->lineup($m2->id, $talas, [
            [285, false], // Жумалиев Нурсултан
            [139, false], // Бактыбек уулу Талас
            [11,  false], // Мыктыбеков Аскат
            [346, false], // Чолпонбаев Бийжан
            [140, false], // Батырбек уулу Улан
            [403, false], // Айтбаев Бексултан
            [34,  false], // Орунбеков Камбар
            [12,  false], // Мукушбеков Рамис
            [13,  false], // Алымжанов Дастан
            [345, false], // Айтмырзаев Нооруэбай
            [349, false], // Ануарбек уулу Адилет
            [399, false], // Каныбек уулу Бактияр
            [401, false], // Бекенов Азим
            [402, false], // Ныязбеков Ислам
        ]);
        $this->lineup($m2->id, $artBlast, [
            [212, false], // Насирдинов Султан
            [250, false], // Талайбеков Данияр
            [150, false], // Джанат уулу Самат
            [236, false], // Алимов Максат
            [16,  true],  // Бактыбеков Эржан (MVP)
            [38,  false], // Жусупов Чынгыз
            [220, false], // Эралиев Мухаммедиса
            [219, false], // Эралиев Мухаммедмуса
            [226, false], // Жумадилов Баатырхан
            [227, false], // Мендибаев Нурдин
            [230, false], // Анарбек уулу Акылбек
        ]);
        // Талас: Мыктыбеков(1'), Ануарбек у(11')
        $this->goal($m2->id, $talas, 11,  1);
        $this->goal($m2->id, $talas, 349, 11);
        // Арт Бласт: Талайбеков(2'), Жумадилов(12'), Бактыбеков(31'), Насирдинов(40')
        $this->goal($m2->id, $artBlast, 250, 2);
        $this->goal($m2->id, $artBlast, 226, 12);
        $this->goal($m2->id, $artBlast, 16,  31);
        $this->goal($m2->id, $artBlast, 212, 40);
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