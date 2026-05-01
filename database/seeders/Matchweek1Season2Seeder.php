<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Fixture;
use App\Models\FixtureLineup;
use App\Models\Player;
use App\Models\Round;
use App\Models\Team;
use Illuminate\Database\Seeder;

// Суперлига 2025-26 — Matchweek 1 (6–7 September 2025)
// Source: futsal_kgz Instagram posts
// Lineups are partial (goal scorers + MVP only)
class Matchweek1Season2Seeder extends Seeder
{
    public function run(): void
    {
        $round = Round::firstOrCreate(
            ['stage_id' => 4, 'name' => 'Matchweek 1'],
            ['order' => 1],
        );

        $vivat      = 3;
        $alay       = 11;
        $topTogolok = 2;
        $karakol    = 5;
        $talas      = 1;
        $jashMuun   = Team::where('name', 'Жаш Муун')->value('id');
        $liderOshmu = Team::where('name', 'Лидер-ОШМУ')->value('id');
        $dostuk     = Team::where('name', 'Достук')->value('id');

        // ── Match 1: Жаш Муун 1-1 Лидер-ОШМУ  (6.09.2025 20:00, Жалал-Абад) ──
        $m1 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $jashMuun,
            'away_team_id' => $liderOshmu,
            'venue'        => 'Жалал-Абад',
            'scheduled_at' => '2025-09-06 20:00:00',
            'status'       => 'completed',
            'home_score'   => 1,
            'away_score'   => 1,
        ]);

        $arapov   = $this->player('Арапов Кубатбек');
        $tokoyev  = $this->player('Токоев Арсланбек');
        $abduvali = $this->player('Абдувалиев Омурали'); // MVP

        $this->lineup($m1->id, $jashMuun,   [[$arapov, false], [$abduvali, true]]);
        $this->lineup($m1->id, $liderOshmu, [[$tokoyev, false]]);
        $this->goal($m1->id, $jashMuun,   $arapov,  7);
        $this->goal($m1->id, $liderOshmu, $tokoyev, 18);

        // ── Match 2: Виват 3-3 Достук  (7.09.2025 18:00, Бишкек) ──
        $m2 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $vivat,
            'away_team_id' => $dostuk,
            'venue'        => 'Бишкек',
            'scheduled_at' => '2025-09-07 18:00:00',
            'status'       => 'completed',
            'home_score'   => 3,
            'away_score'   => 3,
        ]);

        $kadyrov   = $this->player('Кадыров Дильшат');
        $chirkin   = $this->player('Чиркин Кирилл');
        $beishenov = $this->player('Бейшенов Бабур');   // MVP
        $zhakypovD = $this->player('Жакыпов Даулес');
        $kasmakun  = $this->player('Касмакунов Элдияр');

        $this->lineup($m2->id, $vivat,  [[$kadyrov, false], [$chirkin, false]]);
        $this->lineup($m2->id, $dostuk, [[$beishenov, true], [$zhakypovD, false], [$kasmakun, false]]);
        $this->goal($m2->id, $vivat,  $kadyrov,   8);
        $this->goal($m2->id, $dostuk, $beishenov, 26);
        $this->goal($m2->id, $dostuk, $zhakypovD, 34);
        $this->goal($m2->id, $vivat,  $kadyrov,   36);
        $this->goal($m2->id, $dostuk, $kasmakun,  38);
        $this->goal($m2->id, $vivat,  $chirkin,   39);

        // ── Match 3: Алай 4-4 Топ Тоголок  (7.09.2025 20:00, Бишкек) ──
        $m3 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $alay,
            'away_team_id' => $topTogolok,
            'venue'        => 'Бишкек',
            'scheduled_at' => '2025-09-07 20:00:00',
            'status'       => 'completed',
            'home_score'   => 4,
            'away_score'   => 4,
        ]);

        $akmatov   = $this->player('Акматов Калдуубай');
        $sadykov   = $this->player('Садыков Канат');
        $salimbaev = $this->player('Салимбаев Юлдашбай');
        $kubanycho = $this->player('Кубанычов Кайрат');   // MVP
        $dolot     = $this->player('Долоткелдиев Азамат');
        $ilyasov   = $this->player('Ильясов Бектур');
        $azamatU   = $this->player('Азамат уулу Ильгиз');

        $this->lineup($m3->id, $alay,       [[$akmatov, false], [$sadykov, false], [$salimbaev, false], [$kubanycho, true], [$dolot, false]]);
        $this->lineup($m3->id, $topTogolok, [[$ilyasov, false], [$azamatU, false]]);
        $this->goal($m3->id, $alay,       $akmatov,   9);
        $this->goal($m3->id, $alay,       $sadykov,   10);
        $this->goal($m3->id, $topTogolok, $ilyasov,   15);
        $this->goal($m3->id, $topTogolok, $azamatU,   16);
        // Долоткелдиев АГ — own goal benefits Топ Тоголок
        $this->ownGoal($m3->id, $topTogolok, $dolot,  36);
        $this->goal($m3->id, $alay,       $salimbaev, 36);
        $this->goal($m3->id, $alay,       $kubanycho, 36);
        $this->goal($m3->id, $topTogolok, $ilyasov,   38);

        // ── Match 4: Каракол 1-5 Талас  (7.09.2025 20:00, Каракол) ──
        $m4 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $karakol,
            'away_team_id' => $talas,
            'venue'        => 'Каракол',
            'scheduled_at' => '2025-09-07 20:00:00',
            'status'       => 'completed',
            'home_score'   => 1,
            'away_score'   => 5,
        ]);

        $orozbek   = $this->player('Орозбеков Улукбек');
        $myktybek  = $this->player('Мыктыбеков Аскат');
        $mukushbek = $this->player('Мукушбеков Рамис');
        $sabyrb    = $this->player('Сабырбек уулу Майрамбек');
        $zhakypovR = $this->player('Жакыпов Руслан');
        $baktybek  = $this->player('Бактыбек уулу Талас');  // MVP

        $this->lineup($m4->id, $karakol, [[$orozbek, false]]);
        $this->lineup($m4->id, $talas,   [[$myktybek, false], [$mukushbek, false], [$sabyrb, false], [$zhakypovR, false], [$baktybek, true]]);
        $this->goal($m4->id, $talas,   $myktybek,  3);
        $this->goal($m4->id, $karakol, $orozbek,   11);
        $this->goal($m4->id, $talas,   $mukushbek, 18);
        $this->goal($m4->id, $talas,   $sabyrb,    20);
        $this->goal($m4->id, $talas,   $zhakypovR, 38);
        $this->goal($m4->id, $talas,   $baktybek,  40);
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