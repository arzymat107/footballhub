<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Fixture;
use App\Models\FixtureLineup;
use App\Models\Player;
use App\Models\Round;
use App\Models\Team;
use Illuminate\Database\Seeder;

// Суперлига 2025-26 — Matchweek 3 (27–28 September 2025)
// Source: futsal_kgz Instagram posts
// Full starting lineups published for all 4 matches
class Matchweek3Season2Seeder extends Seeder
{
    public function run(): void
    {
        $round = Round::firstOrCreate(
            ['stage_id' => 4, 'name' => 'Matchweek 3'],
            ['order' => 3],
        );

        $vivat      = 3;
        $topTogolok = 2;
        $karakol    = 5;
        $talas      = 1;
        $kant       = 7;
        $naryn      = 4;
        $dostuk     = Team::where('name', 'Достук')->value('id');
        $toyota     = Team::where('name', 'Toyota')->value('id');

        // ── Match 1: Виват 5-2 Топ Тоголок  (27.09.2025 18:00, СК КФБ, Бишкек) ──
        $m1 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $vivat,
            'away_team_id' => $topTogolok,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2025-09-27 18:00:00',
            'status'       => 'completed',
            'home_score'   => 5,
            'away_score'   => 2,
        ]);

        // Виват lineup
        $yafarov       = $this->player('Яфаров Султан');
        $vilyamov      = $this->player('Вильямов Бахридин');
        $koshonov      = $this->player('Кошонов Канкелди');
        $chirkin       = $this->player('Чиркин Кирилл');
        $esengeldiAsyl = $this->player('Эсенгелдиев Асылбек');
        $turgon        = $this->player('Тургунбеков Адыл');
        $anarbekov     = $this->player('Анарбеков Нурадил');   // MVP
        $kadyrov       = $this->player('Кадыров Дильшат');
        $iskenderbekov = $this->player('Искендербеков Талгат');
        $malikov       = $this->player('Маликов Абдурасул');
        $yuldashev     = $this->player('Юлдашев Набижан');
        $igolnikov     = $this->player('Игольников Илья');
        $ashimaliev    = $this->player('Ашималиев Данияр');
        $imanaliev     = $this->player('Иманалиев Элбек');

        $this->lineup($m1->id, $vivat, [
            [$yafarov, false], [$vilyamov, false], [$koshonov, false],
            [$chirkin, false], [$esengeldiAsyl, false], [$turgon, false],
            [$anarbekov, true], [$kadyrov, false], [$iskenderbekov, false],
            [$malikov, false], [$yuldashev, false], [$igolnikov, false],
            [$ashimaliev, false], [$imanaliev, false],
        ]);

        // Топ Тоголок lineup
        $azatov      = $this->player('Азатов Амир');
        $ashurov     = $this->player('Ашуров Сыймык');
        $abdirasul   = $this->player('Абдирасулов Актилек');
        $sultanovN   = $this->player('Султанов Нуралы');
        $isakovD     = $this->player('Исаков Данияр');
        $kuvatbek    = $this->player('Куватбек Адил');
        $ilyasov     = $this->player('Ильясов Бектур');
        $azamatU     = $this->player('Азамат уулу Ильгиз');
        $abdymamyt   = $this->player('Абдымамытов Адахан');
        $smanov      = $this->player('Сманов Байэл');
        $sultanovE   = $this->player('Султанов Эрлан');
        $asanov      = $this->player('Асанов Азимхан');
        $cherikbaev  = $this->player('Черикбаев Арлен');
        $daniyarov   = $this->player('Данияров Саян');

        $this->lineup($m1->id, $topTogolok, [
            [$azatov, false], [$ashurov, false], [$abdirasul, false],
            [$sultanovN, false], [$isakovD, false], [$kuvatbek, false],
            [$ilyasov, false], [$azamatU, false], [$abdymamyt, false],
            [$smanov, false], [$sultanovE, false], [$asanov, false],
            [$cherikbaev, false], [$daniyarov, false],
        ]);

        $this->goal($m1->id, $vivat,      $chirkin,    5);
        $this->goal($m1->id, $topTogolok, $daniyarov,  10);
        $this->goal($m1->id, $topTogolok, $azamatU,    20);
        $this->goal($m1->id, $vivat,      $malikov,    22);
        $this->goal($m1->id, $vivat,      $anarbekov,  26);
        $this->goal($m1->id, $vivat,      $ashimaliev, 33);
        $this->goal($m1->id, $vivat,      $kadyrov,    34);

        // ── Match 2: Достук 4-7 Toyota  (27.09.2025 20:00, СК КФБ, Бишкек) ──
        $m2 = Fixture::firstOrCreate([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $dostuk,
            'away_team_id' => $toyota,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2025-09-27 20:00:00',
            'status'       => 'completed',
            'home_score'   => 4,
            'away_score'   => 7,
        ]);

        // Достук lineup
        $kyrgyzov    = $this->player('Кыргызов Айбек');
        $beishenov   = $this->player('Бейшенов Бабур');
        $bakiev      = $this->player('Бакиев Али');
        $zhakypovD   = $this->player('Жакыпов Даулес');
        $kasmakun    = $this->player('Касмакунов Элдияр');
        $beishenkul  = $this->player('Бейшенкулов Арлен');
        $shamonin    = $this->player('Шамонин Станислав');
        $karybekov   = $this->player('Карыбеков Даниэл');
        $toktogonov  = $this->player('Токтогонов Улукман');
        $zhumabkovT  = $this->player('Джумабеков Тариэл');
        $timchenko   = $this->player('Тимченко Артем');
        $zhumabkovS  = $this->player('Жумабеков Султан');
        $saidaliев   = $this->player('Сайдалиев Дамирбек');

        $this->lineup($m2->id, $dostuk, [
            [$kyrgyzov, false], [$beishenov, false], [$bakiev, false],
            [$zhakypovD, false], [$kasmakun, false], [$beishenkul, false],
            [$shamonin, false], [$karybekov, false], [$toktogonov, false],
            [$zhumabkovT, false], [$timchenko, false], [$zhumabkovS, false],
            [$saidaliев, false],
        ]);

        // Toyota lineup
        $zhunushaliev = $this->player('Джунушалиев Азирет');
        $isabekovAzam = $this->player('Исабеков Азамат');
        $tashtanov    = $this->player('Таштанов Актай');
        $amandyk      = $this->player('Амандык уулу Денисбек');
        $abitov       = $this->player('Абитов Шухрат');
        $murzaev      = $this->player('Мурзаев Бекболсун');
        $isabekovAzat = $this->player('Исабеков Азат');
        $muratbekov   = $this->player('Муратбеков Айдар');
        $ayanbaev     = $this->player('Аянбаев Адил');
        $tursunov     = $this->player('Турсунов Арстанбек');
        $kuttubek     = $this->player('Куттубек уулу Акылбек');
        $daniyarU     = $this->player('Данияр уулу Абдурахим');
        $turatbekov   = $this->player('Туратбеков Ислам');   // MVP
        $oruналiev    = $this->player('Оруналиев Ильгиз');

        $this->lineup($m2->id, $toyota, [
            [$zhunushaliev, false], [$isabekovAzam, false], [$tashtanov, false],
            [$amandyk, false], [$abitov, false], [$murzaev, false],
            [$isabekovAzat, false], [$muratbekov, false], [$ayanbaev, false],
            [$tursunov, false], [$kuttubek, false], [$daniyarU, false],
            [$turatbekov, true], [$oruналiev, false],
        ]);

        $this->goal($m2->id, $dostuk, $kasmakun,    3);
        $this->goal($m2->id, $dostuk, $timchenko,   6);
        $this->goal($m2->id, $dostuk, $kasmakun,    9);
        $this->goal($m2->id, $toyota, $ayanbaev,    11);
        $this->goal($m2->id, $toyota, $amandyk,     14);
        $this->goal($m2->id, $toyota, $turatbekov,  18);
        $this->goal($m2->id, $toyota, $isabekovAzat, 22);
        $this->goal($m2->id, $toyota, $turatbekov,  24);
        $this->goal($m2->id, $toyota, $tursunov,    26);
        $this->goal($m2->id, $dostuk, $zhumabkovT,  34);
        $this->goal($m2->id, $toyota, $daniyarU,    34);

        // ── Match 3: Нарын 5-2 Каракол  (27.09.2025 20:00, Нарын, ФОК «Газпром») ──
        $m3 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $naryn,
            'away_team_id' => $karakol,
            'venue'        => 'ФОК «Газпром», Нарын',
            'scheduled_at' => '2025-09-27 20:00:00',
            'status'       => 'completed',
            'home_score'   => 5,
            'away_score'   => 2,
        ]);

        // Нарын lineup
        $ayylchiev    = $this->player('Айылчиев Алманбет');
        $baygazy      = $this->player('Байгазы уулу Уланбек');  // MVP
        $abdybekov    = $this->player('Абдыбеков Эржан');
        $askerov      = $this->player('Аскеров Азамат');
        $estebsov     = $this->player('Эстебесов Амир');
        $aitoktorov   = $this->player('Айтокторов Нурберген');
        $tursunbekov  = $this->player('Турсунбеков Уран');
        $kubanychM    = $this->player('Кубанычбеков Марат');
        $nurlanU      = $this->player('Нурлан уулу Эрбол');
        $zamirbekovM  = $this->player('Замирбеков Марлен');
        $bakaev       = $this->player('Бакаев Даниэль');
        $kubanychR    = $this->player('Кубанычбеков Рысбек');
        $karypbekov   = $this->player('Карыпбеков Бекмат');
        $kubanychA    = $this->player('Кубанычбеков Айбек');

        $this->lineup($m3->id, $naryn, [
            [$ayylchiev, false], [$baygazy, true], [$abdybekov, false],
            [$askerov, false], [$estebsov, false], [$aitoktorov, false],
            [$tursunbekov, false], [$kubanychM, false], [$nurlanU, false],
            [$zamirbekovM, false], [$bakaev, false], [$kubanychR, false],
            [$karypbekov, false], [$kubanychA, false],
        ]);

        // Каракол lineup
        $raxmanov    = $this->player('Рахманов Бакыт');
        $usupovE     = $this->player('Усупов Эрлан');
        $usenbaev    = $this->player('Усенбаев Бексултан');
        $dyushembaev = $this->player('Дюшембаев Жанарбек');
        $sydykov     = $this->player('Сыдыков Нурслан');
        $damirovBel  = $this->player('Дамиров Белек');
        $aibekov     = $this->player('Айбеков Нурсултан');
        $usupovAdil  = $this->player('Усупов Адилет');
        $avazbekov   = $this->player('Авазбеков Эрлан');
        $dyushebaev  = $this->player('Дюшенбаев Ислам');
        $kytaibekov  = $this->player('Кытайбеков Даниэль');
        $damirovBj   = $this->player('Дамиров Бежжан');
        $amangeldiev = $this->player('Амангелдиев Даниль');
        $shakilov    = $this->player('Шакилов Ийгилик');

        $this->lineup($m3->id, $karakol, [
            [$raxmanov, false], [$usupovE, false], [$usenbaev, false],
            [$dyushembaev, false], [$sydykov, false], [$damirovBel, false],
            [$aibekov, false], [$usupovAdil, false], [$avazbekov, false],
            [$dyushebaev, false], [$kytaibekov, false], [$damirovBj, false],
            [$amangeldiev, false],
        ]);

        // Note: Шакилов not in Starting V photo but scored — added to lineup
        $this->lineup($m3->id, $karakol, [[$shakilov, false]]);

        $this->goal($m3->id, $naryn,   $tursunbekov, 13);
        $this->goal($m3->id, $karakol, $shakilov,    21);
        $this->goal($m3->id, $naryn,   $baygazy,     22);
        $this->goal($m3->id, $naryn,   $baygazy,     27);
        $this->goal($m3->id, $naryn,   $aitoktorov,  32);
        $this->goal($m3->id, $karakol, $shakilov,    36);
        $this->goal($m3->id, $naryn,   $kubanychM,   40);

        // ── Match 4: Талас 3-2 Кант  (28.09.2025 19:00, СК КФБ, Бишкек) ──
        $m4 = Fixture::create([
            'season_id'    => 2,
            'stage_id'     => 4,
            'round_id'     => $round->id,
            'home_team_id' => $talas,
            'away_team_id' => $kant,
            'venue'        => 'СК КФБ, Бишкек',
            'scheduled_at' => '2025-09-28 19:00:00',
            'status'       => 'completed',
            'home_score'   => 3,
            'away_score'   => 2,
        ]);

        // Талас lineup
        $zhumaliev   = $this->player('Жумалиев Нурсултан');
        $sabyrbekU   = $this->player('Сабырбек уулу Майрамбек');
        $zhakypovR   = $this->player('Жакыпов Руслан');
        $myktybek    = $this->player('Мыктыбеков Аскат');
        $zhaanbaev   = $this->player('Жаанбаев Актан');
        $bayyshov    = $this->player('Байышов Омурбек');
        $baktybek    = $this->player('Бактыбек уулу Талас');
        $orunbekov   = $this->player('Орунбеков Камбар');
        $mukushbek   = $this->player('Мукушбеков Рамис');  // MVP
        $alymzhanov  = $this->player('Алымжанов Дастан');
        $aitmyrzaev  = $this->player('Айтмырзаев Нооруэбай');
        $cholponbaev = $this->player('Чолпонбаев Бийжан');
        $akhmetov    = $this->player('Ахметов Арлан');
        $anuarbek    = $this->player('Ануарбек уулу Адилет');

        $this->lineup($m4->id, $talas, [
            [$zhumaliev, false], [$sabyrbekU, false], [$zhakypovR, false],
            [$myktybek, false], [$zhaanbaev, false], [$bayyshov, false],
            [$baktybek, false], [$orunbekov, false], [$mukushbek, true],
            [$alymzhanov, false], [$aitmyrzaev, false], [$cholponbaev, false],
            [$akhmetov, false], [$anuarbek, false],
        ]);

        // Кант lineup
        $penzaev     = $this->player('Пензаев Чынгыз');
        $isroilov    = $this->player('Исроилов Кутбидин');
        $shapdanbekU = $this->player('Шапданбек уулу Жолдошбек');
        $zamirbekovJ = $this->player('Замирбеков Женишбек');
        $salymbekov  = $this->player('Салымбеков Нурсултан');
        $xamidov     = $this->player('Хамидов Акжол');
        $kadyrbekU   = $this->player('Кадырбек уулу Ислам');
        $raxmankulov = $this->player('Рахманкулов Азамат');
        $boltobaev   = $this->player('Болтобаев Темирлан');
        $beishenaliev = $this->player('Бейшеналиев Урмат');
        $sayakbaev   = $this->player('Саякбаев Кыяз');
        $muktarbekov = $this->player('Муктарбеков Эльдар');
        $andabekov   = $this->player('Андабеков Аман');
        $esengeldiK  = $this->player('Эсенгелдиев Калысбек');

        $this->lineup($m4->id, $kant, [
            [$penzaev, false], [$isroilov, false], [$shapdanbekU, false],
            [$zamirbekovJ, false], [$salymbekov, false], [$xamidov, false],
            [$kadyrbekU, false], [$raxmankulov, false], [$boltobaev, false],
            [$beishenaliev, false], [$sayakbaev, false], [$muktarbekov, false],
            [$andabekov, false], [$esengeldiK, false],
        ]);

        $this->goal($m4->id, $talas, $zhaanbaev,  1);
        $this->goal($m4->id, $talas, $aitmyrzaev, 9);
        $this->goal($m4->id, $kant,  $salymbekov, 14);
        $this->goal($m4->id, $kant,  $andabekov,  21);
        $this->goal($m4->id, $talas, $mukushbek,  36);
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
}
