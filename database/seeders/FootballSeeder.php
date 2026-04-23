<?php

namespace Database\Seeders;

use App\Models\Division;
use App\Models\Fixture;
use App\Models\League;
use App\Models\Player;
use App\Models\Round;
use App\Models\Season;
use App\Models\Stage;
use App\Models\Team;
use Illuminate\Database\Seeder;

class FootballSeeder extends Seeder
{
    public function run(): void
    {
        // Premier League
        $pl = League::create(['name' => 'Premier League', 'country' => 'England', 'description' => 'Top tier of English football.']);
        $plDiv = Division::create(['league_id' => $pl->id, 'name' => 'Premier League', 'level' => 1]);

        $plTeams = collect([
            ['name' => 'Manchester City', 'short_name' => 'MCI', 'slug' => 'manchester-city', 'city' => 'Manchester', 'country' => 'England', 'founded_year' => 1880],
            ['name' => 'Arsenal', 'short_name' => 'ARS', 'slug' => 'arsenal', 'city' => 'London', 'country' => 'England', 'founded_year' => 1886],
            ['name' => 'Liverpool', 'short_name' => 'LIV', 'slug' => 'liverpool', 'city' => 'Liverpool', 'country' => 'England', 'founded_year' => 1892],
            ['name' => 'Chelsea', 'short_name' => 'CHE', 'slug' => 'chelsea', 'city' => 'London', 'country' => 'England', 'founded_year' => 1905],
            ['name' => 'Manchester United', 'short_name' => 'MUN', 'slug' => 'manchester-united', 'city' => 'Manchester', 'country' => 'England', 'founded_year' => 1878],
            ['name' => 'Tottenham Hotspur', 'short_name' => 'TOT', 'slug' => 'tottenham-hotspur', 'city' => 'London', 'country' => 'England', 'founded_year' => 1882],
        ])->map(fn ($t) => Team::create($t));

        $plSeason = Season::create([
            'division_id' => $plDiv->id,
            'name' => '2024/25',
            'format' => 'round_robin',
            'status' => 'active',
            'track_players' => true,
            'start_date' => '2024-08-17',
            'end_date' => '2025-05-25',
        ]);

        foreach ($plTeams as $team) {
            $plSeason->teams()->attach($team->id);
        }

        $plStage = Stage::create([
            'season_id' => $plSeason->id,
            'name' => 'League Stage',
            'type' => 'league',
            'order' => 1,
            'home_away' => true,
        ]);

        // Matchday rounds with completed fixtures
        $matchdays = [
            ['name' => 'Matchday 1', 'order' => 1, 'fixtures' => [
                [$plTeams[0], $plTeams[1], 2, 1],
                [$plTeams[2], $plTeams[3], 3, 0],
                [$plTeams[4], $plTeams[5], 1, 1],
            ]],
            ['name' => 'Matchday 2', 'order' => 2, 'fixtures' => [
                [$plTeams[1], $plTeams[2], 0, 1],
                [$plTeams[3], $plTeams[4], 2, 2],
                [$plTeams[5], $plTeams[0], 0, 3],
            ]],
            ['name' => 'Matchday 3', 'order' => 3, 'fixtures' => [
                [$plTeams[0], $plTeams[3], 4, 0],
                [$plTeams[2], $plTeams[5], 2, 1],
                [$plTeams[1], $plTeams[4], 1, 0],
            ]],
            ['name' => 'Matchday 4', 'order' => 4, 'fixtures' => [
                [$plTeams[4], $plTeams[0], 0, 2],
                [$plTeams[5], $plTeams[1], 1, 2],
                [$plTeams[3], $plTeams[2], 1, 3],
            ]],
            ['name' => 'Matchday 5', 'order' => 5, 'fixtures' => [
                [$plTeams[0], $plTeams[2], 1, 1],
                [$plTeams[1], $plTeams[3], 3, 1],
                [$plTeams[5], $plTeams[4], 2, 0],
            ]],
            ['name' => 'Matchday 6', 'order' => 6, 'fixtures' => [
                [$plTeams[2], $plTeams[4], null, null, 'scheduled'],
                [$plTeams[3], $plTeams[5], null, null, 'scheduled'],
                [$plTeams[0], $plTeams[1], null, null, 'scheduled'],
            ]],
        ];

        foreach ($matchdays as $md) {
            $round = Round::create([
                'stage_id' => $plStage->id,
                'name' => $md['name'],
                'order' => $md['order'],
                'home_away' => true,
            ]);

            $date = now()->subWeeks(6 - $md['order'] + 1);

            foreach ($md['fixtures'] as $fx) {
                [$home, $away, $homeScore, $awayScore] = $fx;
                $status = $fx[4] ?? 'completed';
                Fixture::create([
                    'season_id' => $plSeason->id,
                    'stage_id' => $plStage->id,
                    'round_id' => $round->id,
                    'home_team_id' => $home->id,
                    'away_team_id' => $away->id,
                    'scheduled_at' => $date,
                    'status' => $status,
                    'home_score' => $homeScore,
                    'away_score' => $awayScore,
                ]);
                $date = $date->addHours(2);
            }
        }

        // La Liga
        $laliga = League::create(['name' => 'La Liga', 'country' => 'Spain', 'description' => 'Top tier of Spanish football.']);
        $laligaDiv = Division::create(['league_id' => $laliga->id, 'name' => 'La Liga', 'level' => 1]);

        $laligaTeams = collect([
            ['name' => 'Real Madrid', 'short_name' => 'RMA', 'slug' => 'real-madrid', 'city' => 'Madrid', 'country' => 'Spain', 'founded_year' => 1902],
            ['name' => 'FC Barcelona', 'short_name' => 'BAR', 'slug' => 'fc-barcelona', 'city' => 'Barcelona', 'country' => 'Spain', 'founded_year' => 1899],
            ['name' => 'Atletico Madrid', 'short_name' => 'ATM', 'slug' => 'atletico-madrid', 'city' => 'Madrid', 'country' => 'Spain', 'founded_year' => 1903],
            ['name' => 'Sevilla', 'short_name' => 'SEV', 'slug' => 'sevilla', 'city' => 'Seville', 'country' => 'Spain', 'founded_year' => 1890],
        ])->map(fn ($t) => Team::create($t));

        $laligaSeason = Season::create([
            'division_id' => $laligaDiv->id,
            'name' => '2024/25',
            'format' => 'round_robin',
            'status' => 'active',
            'track_players' => false,
            'start_date' => '2024-08-18',
            'end_date' => '2025-05-25',
        ]);

        foreach ($laligaTeams as $team) {
            $laligaSeason->teams()->attach($team->id);
        }

        // Some players
        $players = [
            ['name' => 'Erling Haaland', 'nationality' => 'Norwegian', 'position' => 'forward', 'date_of_birth' => '2000-07-21'],
            ['name' => 'Kevin De Bruyne', 'nationality' => 'Belgian', 'position' => 'midfielder', 'date_of_birth' => '1991-06-28'],
            ['name' => 'Mohamed Salah', 'nationality' => 'Egyptian', 'position' => 'forward', 'date_of_birth' => '1992-06-15'],
            ['name' => 'Bukayo Saka', 'nationality' => 'English', 'position' => 'midfielder', 'date_of_birth' => '2001-09-05'],
            ['name' => 'Alisson Becker', 'nationality' => 'Brazilian', 'position' => 'goalkeeper', 'date_of_birth' => '1992-10-02'],
            ['name' => 'Vinicius Jr', 'nationality' => 'Brazilian', 'position' => 'forward', 'date_of_birth' => '2000-07-12'],
            ['name' => 'Jude Bellingham', 'nationality' => 'English', 'position' => 'midfielder', 'date_of_birth' => '2003-06-29'],
            ['name' => 'Robert Lewandowski', 'nationality' => 'Polish', 'position' => 'forward', 'date_of_birth' => '1988-08-21'],
        ];

        foreach ($players as $p) {
            Player::create($p);
        }
    }
}