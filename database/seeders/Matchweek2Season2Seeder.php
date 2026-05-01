<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Fixture;
use App\Models\FixtureLineup;
use App\Models\Player;
use App\Models\Round;
use App\Models\Team;
use Illuminate\Database\Seeder;

// Суперлига 2025-26 — Matchweek 2 (13–14 September 2025)
// Source: futsal_kgz Instagram posts
// Lineups are partial (goal scorers + MVP only)
class Matchweek2Season2Seeder extends Seeder
{
    public function run(): void
    {
        $round = Round::firstOrCreate(
            ['stage_id' => 4, 'name' => 'Matchweek 2'],
            ['order' => 2],
        );

        $alay       = 11;
        $topTogolok = 2;
        $karakol    = 5;
        $talas      = 1;
        $kant       = 7;
        $artBlast   = 10;
        $liderOshmu = Team::where('name', 'Лидер-ОШМУ')->value('id');
        $jashMuun   = Team::where('name', 'Жаш Муун')->value('id');
        $toyota     = Team::where('name', 'Toyota')->value('id');
        $dostuk     = Team::where('name', 'Достук')->value('id');

        // ── Match 1: Топ Тоголок 2-4 Талас  (13.09.2025 18:00, СК КФБ, Бишкек) ──
        $m1 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $topTogolok,
            'away_team_id' => $talas,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2025-09-13 18:00:00',
            'status'       => 'completed',
            'home_score'   => 2,
            'away_score'   => 4,
        ]);

        $kanatbekov = $this->player('Канатбеков Аймен');
        $isakovD    = $this->player('Исаков Данияр');
        $aitmyrzaev = $this->player('Айтмырзаев Нооруэбай');
        $orunbekov  = $this->player('Орунбеков Камбар');   // MVP
        $myktybek   = $this->player('Мыктыбеков Аскат');

        $this->lineup($m1->id, $topTogolok, [[$kanatbekov, false], [$isakovD, false]]);
        $this->lineup($m1->id, $talas,      [[$aitmyrzaev, false], [$orunbekov, true], [$myktybek, false]]);
        $this->goal($m1->id, $topTogolok, $kanatbekov, 6);
        $this->goal($m1->id, $talas,      $aitmyrzaev, 17);
        $this->goal($m1->id, $topTogolok, $isakovD,    17);
        $this->goal($m1->id, $talas,      $orunbekov,  18);
        $this->goal($m1->id, $talas,      $myktybek,   20);
        $this->goal($m1->id, $talas,      $orunbekov,  36);

        // ── Match 2: Лидер-ОШМУ 1-2 Алай  (13.09.2025 19:00, СК «Шавкат», Ош) ──
        $m2 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $liderOshmu,
            'away_team_id' => $alay,
            'venue'        => 'СК «Шавкат», Ош',
            'scheduled_at' => '2025-09-13 19:00:00',
            'status'       => 'completed',
            'home_score'   => 1,
            'away_score'   => 2,
        ]);

        $hudayberdiev = $this->player('Худайбердиев Исломбек');
        $murzakarim   = $this->player('Мурзакарим уулу Асан');
        $talantbek    = $this->player('Талантбек уулу Жыргалбек'); // MVP

        $this->lineup($m2->id, $liderOshmu, [[$hudayberdiev, false]]);
        $this->lineup($m2->id, $alay,       [[$murzakarim, false], [$talantbek, true]]);
        $this->goal($m2->id, $alay,       $murzakarim,   5);
        $this->goal($m2->id, $liderOshmu, $hudayberdiev, 17);
        $this->goal($m2->id, $alay,       $talantbek,    26);

        // ── Match 3: Жаш Муун 0-3 Art Blast Group  (13.09.2025 20:00, СК «Акматалы ажы», Ырыс а.) ──
        $m3 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $jashMuun,
            'away_team_id' => $artBlast,
            'venue'        => 'СК «Акматалы ажы», Ырыс а.',
            'scheduled_at' => '2025-09-13 20:00:00',
            'status'       => 'completed',
            'home_score'   => 0,
            'away_score'   => 3,
        ]);

        $samatUulu = $this->player('Самат уулу Алмазбек'); // MVP

        $this->lineup($m3->id, $artBlast, [[$samatUulu, true]]);
        // Individual goal scorers not published for this match

        // ── Match 4: Toyota 2-0 Кант  (13.09.2025 20:00, СК КФБ, Бишкек) ──
        $m4 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $toyota,
            'away_team_id' => $kant,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2025-09-13 20:00:00',
            'status'       => 'completed',
            'home_score'   => 2,
            'away_score'   => 0,
        ]);

        $mambetaliev = $this->player('Мамбеталиев Саламат'); // MVP

        $this->lineup($m4->id, $toyota, [[$mambetaliev, true]]);
        $this->goal($m4->id, $toyota, $mambetaliev, 9);
        $this->goal($m4->id, $toyota, $mambetaliev, 17);

        // ── Match 5: Каракол 0-4 Достук  (14.09.2025 20:00, ФОК «Каракол», Каракол) ──
        $m5 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $karakol,
            'away_team_id' => $dostuk,
            'venue'        => 'ФОК «Каракол», Каракол',
            'scheduled_at' => '2025-09-14 20:00:00',
            'status'       => 'completed',
            'home_score'   => 0,
            'away_score'   => 4,
        ]);

        $kyrgyzov = $this->player('Кыргызов Айбек'); // MVP

        $this->lineup($m5->id, $dostuk, [[$kyrgyzov, true]]);
        // Individual goal scorers not published for this match

        // ── Match 6: Жаш Муун 1-5 Алай  (14.09.2025 20:00, СК «Акматалы ажы», Ырыс а.) ──
        $m6 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $jashMuun,
            'away_team_id' => $alay,
            'venue'        => 'СК «Акматалы ажы», Ырыс а.',
            'scheduled_at' => '2025-09-14 20:00:00',
            'status'       => 'completed',
            'home_score'   => 1,
            'away_score'   => 5,
        ]);

        $tashtemirov    = $this->player('Таштемиров Абдурофи');
        $akmatov        = $this->player('Акматов Калдуубай');
        $kubanycho      = $this->player('Кубанычов Кайрат');
        $karabaevGk     = $this->player('Карабаев Муслимбек'); // own goal
        $kultaev        = $this->player('Култаев Адилет');
        $mamatkaSymov   = $this->player('Маматкасымов Давронбек'); // MVP

        $this->lineup($m6->id, $jashMuun, [[$tashtemirov, false], [$karabaevGk, false], [$mamatkaSymov, true]]);
        $this->lineup($m6->id, $alay,     [[$akmatov, false], [$kubanycho, false], [$kultaev, false]]);
        $this->goal($m6->id, $alay,     $akmatov,      2);
        $this->goal($m6->id, $alay,     $kubanycho,    10);
        $this->goal($m6->id, $jashMuun, $tashtemirov,  16);
        $this->goal($m6->id, $alay,     $akmatov,      22);
        // Карабаев АГ — own goal by Жаш Муун GK, counts for Алай
        $this->ownGoal($m6->id, $alay,  $karabaevGk,   28);
        $this->goal($m6->id, $alay,     $kultaev,      36);

        // ── Match 7: Лидер-ОШМУ 5-4 Art Blast Group  (14.09.2025 18:30, СК «Шавкат», Ош) ──
        $m7 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $liderOshmu,
            'away_team_id' => $artBlast,
            'venue'        => 'СК «Шавкат», Ош',
            'scheduled_at' => '2025-09-14 18:30:00',
            'status'       => 'completed',
            'home_score'   => 5,
            'away_score'   => 4,
        ]);

        $tursunbaev  = $this->player('Турсунбаев Шумкар');
        $nazaraliev  = $this->player('Назаралиев Урмат');
        $tokoyev     = $this->player('Токоев Арсланбек'); // MVP
        $zhumadilов  = $this->player('Жумадилов Баатырхан');
        // Самат уулу Алмазбек: scorer for ABG and own-goal for Лидер-ОШМУ

        $this->lineup($m7->id, $liderOshmu, [[$tursunbaev, false], [$nazaraliev, false], [$tokoyev, true]]);
        $this->lineup($m7->id, $artBlast,   [[$zhumadilов, false], [$samatUulu, false]]);
        $this->goal($m7->id, $artBlast,   $zhumadilов,  4);
        $this->goal($m7->id, $liderOshmu, $tursunbaev,  11);
        $this->goal($m7->id, $artBlast,   $samatUulu,   11);
        $this->goal($m7->id, $artBlast,   $samatUulu,   17);
        $this->goal($m7->id, $artBlast,   $samatUulu,   18);
        $this->goal($m7->id, $liderOshmu, $tursunbaev,  15);
        $this->goal($m7->id, $liderOshmu, $nazaraliev,  34);
        $this->goal($m7->id, $liderOshmu, $tokoyev,     36);
        // Самат уулу АГ — own goal by ABG player, counts for Лидер-ОШМУ
        $this->ownGoal($m7->id, $liderOshmu, $samatUulu, 39);
    }

    private function player(string $name): int
    {
        return Player::where('name', $name)->value('id');
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