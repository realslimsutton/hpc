<?php

namespace App\Services\Club;

use App\Imports\ClubUpdateImport;
use App\Models\Club\ClubRingGame;
use App\Models\Club\ClubTournament;
use App\Models\Club\ClubUpdate;
use App\Models\Club\UserClubUpdate;
use App\Models\User;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class ClubUpdateImportService
{
    public function import(string $file): void
    {
        $users = User::query()
            ->select(['id', 'clubgg_id', 'balance', 'nickname'])
            ->get()
            ->mapWithKeys(static fn(User $user): array => [
                $user->clubgg_id => $user
            ]);

        $data = $this->load($file);

        DB::transaction(function () use ($users, $data) {
            $clubUpdate = $this->createClubUpdate($data);

            $this->processClubOverview($clubUpdate, $users, $data['Club Overview']);

            $this->processRingGames($clubUpdate, $users, $data['Ring Game Detail']);

            $this->processTournaments($clubUpdate, $users, $data['Tournament Detail']);

            $this->processBalances($users, $data['Club Member Balance']);

            $this->updateUsers($users);
        });
    }

    private function processBalances(Collection $users, Collection $data): void
    {
        for ($index = 5, $lastIndex = $data->count() - 1; $index < $lastIndex; $index++) {
            [, , $userId, $nickname, $agentId, $agentNickname, $balance] = $data[$index];

            if (!$user = $users->get($userId)) {
                continue;
            }

            if ($user->nickname !== $nickname) {
                $user->nickname = $nickname;
            }

            if (
                (filled($agentId) && $agent = $users->get($agentId)) &&
                $agent->nickname !== $agentNickname
            ) {
                $agent->nickname = $agentNickname;
            }

            if ($user->balance !== $balance) {
                $user->balance = (float)$balance * 100;
            }
        }
    }

    private function processTournaments(ClubUpdate $clubUpdate, Collection $users, Collection $data): void
    {
        $currentDateTime = now();

        $tournament = null;
        $records = [];

        for ($index = 1, $lastIndex = $data->count() - 1; $index < $lastIndex; $index++) {
            $row = $data[$index];

            if (Str::startsWith($row[0], 'Start/End Time')) {
                $tournament = $this->createTournament($clubUpdate, $users, $data, $index);

                $tournament->users()->insert($records);
                $records = [];

                $index += 4;

                continue;
            }

            if ($row[0] === 'Total') {
                continue;
            }

            if (!$user = $users->get($row[0])) {
                continue;
            }

            $records[] = [
                'user_id' => $user->id,
                'club_tournament_id' => $tournament->id,
                'buy_in' => (float)$row[2] * 100,
                'buy_in_fee' => (float)$row[3] * 100,
                're_entry' => (float)$row[4] * 100,
                're_entry_fee' => (float)$row[5] * 100,
                'hands' => (int)$row[6],
                'gross_winnings' => (int)$row[7] * 100,
                'net_winnings' => (int)$row[8] * 100,
                'created_at' => $currentDateTime,
                'updated_at' => $currentDateTime
            ];
        }

        if ($tournament !== null && !empty($records)) {
            $tournament->users()->insert($records);
        }
    }

    private function processRingGames(ClubUpdate $clubUpdate, Collection $users, Collection $data): void
    {
        $currentDateTime = now();

        $ringGame = null;
        $records = [];

        for ($index = 1, $lastIndex = $data->count() - 1; $index < $lastIndex; $index++) {
            $row = $data[$index];

            if (Str::startsWith($row[0], 'Start/End Time')) {
                $ringGame = $this->createRingGame($clubUpdate, $users, $data, $index);

                $ringGame->users()->insert($records);
                $records = [];

                $index += 4;

                continue;
            }

            if ($row[0] === 'Total') {
                continue;
            }

            if (!$user = $users->get($row[0])) {
                continue;
            }

            $records[] = [
                'user_id' => $user->id,
                'club_ring_game_id' => $ringGame->id,
                'buy_in' => (float)$row[2] * 100,
                'hands' => (int)$row[3],
                'rake' => (float)$row[4] * 100,
                'insurance' => (float)$row[5] * 100,
                'gross_winnings' => (float)$row[6] * 100,
                'net_winnings' => (float)$row[7] * 100,
                'created_at' => $currentDateTime,
                'updated_at' => $currentDateTime
            ];
        }

        if ($ringGame !== null && !empty($records)) {
            $ringGame->users()->insert($records);
        }
    }

    private function createTournament(ClubUpdate $clubUpdate, Collection $users, Collection $data, int $index): ClubTournament
    {
        $timeRange = $this->getGameTimeRange($data[$index][0]);
        $metadata = $this->getTournamentMetadata($users, $data, $index);

        return ClubTournament::query()
            ->create([
                'started_at' => $timeRange[0],
                'ended_at' => $timeRange[1],
                'table_name' => $metadata['table_name'],
                'user_id' => $metadata['user_id'],
                'club_update_id' => $clubUpdate->id,
                'game_rules' => $metadata['game_rules'],
                'buy_in' => $metadata['buy_in'],
                'gtd_prize' => $metadata['gtd_prize'],
                're_entry' => $metadata['re_entry']
            ]);
    }

    private function createRingGame(ClubUpdate $clubUpdate, Collection $users, Collection $data, int $index): ClubRingGame
    {
        $timeRange = $this->getGameTimeRange($data[$index][0]);
        $metadata = $this->getRingGameMetadata($users, $data, $index);

        return ClubRingGame::query()
            ->create([
                'started_at' => $timeRange[0],
                'ended_at' => $timeRange[1],
                'table_name' => $metadata['table_name'],
                'user_id' => $metadata['user_id'],
                'club_update_id' => $clubUpdate->id,
                'game_rules' => $metadata['game_rules'],
                'blinds' => $metadata['blinds'],
                'rake' => $metadata['rake'],
                'rake_cap' => $metadata['rake_cap']
            ]);
    }

    private function getTournamentMetadata(Collection $users, Collection $data, int $index): array
    {
        $tableNameCell = $data[++$index][0];
        $tableInformationCell = $data[++$index][0];

        $tableNameParts = explode(' , Creator : ', $tableNameCell);

        $tableName = Str::after($tableNameParts[0], 'Table Name : ');
        $creatorId = rtrim(Str::afterLast($tableNameParts[1], '('), ')');

        $tableInformationParts = explode(' , ', Str::after($tableInformationCell, 'Table Information : '));

        $gameRules = Str::after($tableInformationParts[0], ' : ');
        $buyIn = Str::after($tableInformationParts[1], ' : ');
        $gtdPrize = Str::after($tableInformationParts[2], ' : ');

        $reEntry = Str::of($tableInformationParts[3])->after(' : ')->upper()->value() !== 'OFF';

        return [
            'table_name' => $tableName,
            'user_id' => $users->get($creatorId)?->id,
            'game_rules' => $gameRules,
            'buy_in' => $buyIn,
            'gtd_prize' => $gtdPrize,
            're_entry' => $reEntry
        ];
    }

    private function getRingGameMetadata(Collection $users, Collection $data, int $index): array
    {
        $tableNameCell = $data[++$index][0];
        $tableInformationCell = $data[++$index][0];

        $tableNameParts = explode(' , Creator : ', $tableNameCell);

        $tableName = Str::after($tableNameParts[0], 'Table Name : ');
        $creatorId = rtrim(Str::afterLast($tableNameParts[1], '('), ')');

        $tableInformationParts = explode(' , ', Str::after($tableInformationCell, 'Table Information : '));

        $gameRules = Str::after($tableInformationParts[0], ' : ');
        $blinds = ltrim(Str::after($tableInformationParts[1], ' : '), '$');
        $rake = Str::after($tableInformationParts[2], ' : ');

        $rakeCap = Str::after($tableInformationParts[3], ' : ');
        if ($rakeCap === 'No Cap') {
            $rakeCap = null;
        }

        return [
            'table_name' => $tableName,
            'user_id' => $users->get($creatorId)?->id,
            'game_rules' => $gameRules,
            'blinds' => $blinds,
            'rake' => $rake,
            'rake_cap' => $rakeCap
        ];
    }

    private function getGameTimeRange(string $timeRange): array
    {
        $parts = explode(' ', $timeRange);

        $timeDifference = explode(':', rtrim($parts[9], ')'));

        // We need to convert the timestamp to UTC.
        // Since we're only given the hour/minute difference from UTC, we need to add/remove
        // That from the parsed datetimes
        $hourDifference = (int)$timeDifference[0] * -1;
        $minuteDifference = (int)$timeDifference[1] * -1;

        return [
            Carbon::parse($parts[3] . ' ' . $parts[4])->addHours($hourDifference)->addMinutes($minuteDifference),
            Carbon::parse($parts[6] . ' ' . $parts[7])->addhours($hourDifference)->addMinutes($minuteDifference)
        ];
    }

    private function updateUsers(Collection $users): void
    {
        foreach ($users as $user) {
            $user->save();
        }
    }

    private function processClubOverview(ClubUpdate $clubUpdate, Collection $users, Collection $data): void
    {
        $currentDateTime = now();

        $records = [];

        // Records don't start until row 6 (the first 5 are metadata and headers)
        // The last row is table summary which we also don't need
        for ($index = 5, $lastIndex = $data->count() - 1; $index < $lastIndex; $index++) {
            [, , $userId, , $agentId, , $games, $hands, $fee, $insurance, $netWinnings] = $data[$index];

            if (!$user = $users->get($userId)) {
                continue;
            }

            $agent = filled($agentId)
                ? $users->get($agentId)
                : null;

            $records[] = [
                'user_id' => $user->id,
                'club_update_id' => $clubUpdate->id,
                'agent_id' => $agent?->id,
                'games' => (int)$games,
                'hands' => (int)$hands,
                'fee' => (float)$fee * 100,
                'insurance' => (float)$insurance * 100,
                'net_winnings' => (float)$netWinnings * 100,
                'created_at' => $currentDateTime,
                'updated_at' => $currentDateTime
            ];
        }

        UserClubUpdate::query()
            ->insert($records);
    }

    private function createClubUpdate(Collection $data): ClubUpdate
    {
        return ClubUpdate::query()
            ->create([
                'date' => $this->getFileDateTime($data),
                'user_id' => auth()->id()
            ]);
    }

    private function getFileDateTime(Collection $data): DateTimeInterface
    {
        $cell = Str::remove('Period : ', $data['Club Overview'][2][0]);

        $dates = explode(' ', $cell);

        return Carbon::parse($dates[2]);
    }

    private function load(string $file): Collection
    {
        return Excel::toCollection(new ClubUpdateImport(), $file);
    }
}
