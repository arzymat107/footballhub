<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import PublicLayout from '@/layouts/PublicLayout.vue';
import { ChevronRight, Trophy, Calendar, Users } from 'lucide-vue-next';
import { ref, computed } from 'vue';
import { useHashTab } from '@/composables/useHashTab';

type PlayerStat = {
    player: { id: number; name: string; position: string | null };
    team: { id: number; name: string };
    played: number; goals: number; own_goals: number;
    yellow_cards: number; red_cards: number; mvp: number;
};

const props = defineProps<{
    season: {
        id: number; name: string; format: string; status: string; track_players: boolean;
        division: { id: number; name: string; league: { id: number; name: string } };
        teams: { id: number; name: string }[];
    };
    standings: {
        team: { id: number; name: string };
        played: number; won: number; drawn: number; lost: number;
        goals_for: number; goals_against: number; goal_difference: number; points: number;
    }[];
    fixtures: {
        id: number; status: string; scheduled_at: string | null;
        home_score: number | null; away_score: number | null;
        home_team: { id: number; name: string; short_name?: string | null };
        away_team: { id: number; name: string; short_name?: string | null };
        round: { name: string } | null;
    }[];
    playerStats: PlayerStat[];
}>();

defineOptions({ layout: PublicLayout });

const tabs = computed(() => {
    const t = [
        { key: 'standings', label: 'Standings', icon: Trophy },
        { key: 'fixtures', label: 'Fixtures', icon: Calendar },
        { key: 'results', label: 'Results', icon: Calendar },
    ];
    if (props.season.track_players && props.playerStats.length > 0) {
        t.push({ key: 'players', label: 'Players', icon: Users });
    }
    return t;
});

const tab = useHashTab('standings', ['standings', 'fixtures', 'results', 'players']);

const upcoming = computed(() =>
    props.fixtures.filter(f => f.status === 'scheduled').slice(0, 10)
);
const results = computed(() =>
    props.fixtures.filter(f => f.status === 'completed').reverse()
);

const topScorers = computed(() =>
    [...props.playerStats].sort((a, b) => b.goals - a.goals).filter(p => p.goals > 0)
);
const topCards = computed(() =>
    [...props.playerStats]
        .sort((a, b) => (b.yellow_cards + b.red_cards * 2) - (a.yellow_cards + a.red_cards * 2))
        .filter(p => p.yellow_cards > 0 || p.red_cards > 0)
);
const topMvps = computed(() =>
    [...props.playerStats].sort((a, b) => b.mvp - a.mvp).filter(p => p.mvp > 0)
);

const playerTab = ref<'scorers' | 'cards' | 'mvp'>('scorers');

function formatDate(val: string | null) {
    if (!val) return null;
    return new Date(val).toLocaleDateString('en-GB', { weekday: 'short', day: 'numeric', month: 'short' });
}

function formatTime(val: string | null) {
    if (!val) return null;
    return new Date(val).toLocaleTimeString('en-GB', { hour: '2-digit', minute: '2-digit' });
}

const positionBadge: Record<string, string> = {
    goalkeeper: 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400',
    defender: 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400',
    midfielder: 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400',
    forward: 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400',
};
</script>

<template>
    <Head :title="`${season.name} — ${season.division.name}`" />

    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-1.5 text-sm text-slate-500 dark:text-slate-400 mb-6 flex-wrap">
            <Link href="/leagues" class="hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors">Leagues</Link>
            <ChevronRight class="size-4" />
            <Link :href="`/leagues/${season.division.league.id}`" class="hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors">
                {{ season.division.league.name }}
            </Link>
            <ChevronRight class="size-4" />
            <span class="text-slate-900 dark:text-slate-100">{{ season.name }}</span>
        </nav>

        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-slate-900 dark:text-slate-100">{{ season.name }}</h1>
            <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">
                {{ season.division.league.name }} · {{ season.division.name }} ·
                <span class="capitalize">{{ season.format.replace('_', ' ') }}</span>
            </p>
        </div>

        <!-- Tabs -->
        <div class="flex gap-1 bg-slate-100 dark:bg-slate-800 rounded-xl p-1 w-fit mb-6 flex-wrap">
            <button
                v-for="t in tabs"
                :key="t.key"
                @click="tab = t.key"
                :class="[
                    'flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-sm font-medium transition-colors',
                    tab === t.key
                        ? 'bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100 shadow-sm'
                        : 'text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-300',
                ]"
            >
                <component :is="t.icon" class="size-3.5" />
                {{ t.label }}
            </button>
        </div>

        <!-- STANDINGS -->
        <div v-if="tab === 'standings'">
            <div v-if="standings.length === 0" class="text-center py-16 text-slate-500 dark:text-slate-400">
                No standings available yet.
            </div>
            <div v-else class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="border-b border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/50">
                            <tr>
                                <th class="text-left px-4 py-3 font-medium text-slate-500 dark:text-slate-400 w-8">#</th>
                                <th class="text-left px-4 py-3 font-medium text-slate-500 dark:text-slate-400">Team</th>
                                <th class="text-center px-3 py-3 font-medium text-slate-500 dark:text-slate-400">P</th>
                                <th class="text-center px-3 py-3 font-medium text-slate-500 dark:text-slate-400">W</th>
                                <th class="text-center px-3 py-3 font-medium text-slate-500 dark:text-slate-400">D</th>
                                <th class="text-center px-3 py-3 font-medium text-slate-500 dark:text-slate-400">L</th>
                                <th class="text-center px-3 py-3 font-medium text-slate-500 dark:text-slate-400 hidden sm:table-cell">GF</th>
                                <th class="text-center px-3 py-3 font-medium text-slate-500 dark:text-slate-400 hidden sm:table-cell">GA</th>
                                <th class="text-center px-3 py-3 font-medium text-slate-500 dark:text-slate-400">GD</th>
                                <th class="text-center px-3 py-3 font-bold text-slate-700 dark:text-slate-300">Pts</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                            <tr
                                v-for="(row, i) in standings"
                                :key="row.team.id"
                                class="hover:bg-slate-50 dark:hover:bg-slate-800/40 transition-colors"
                            >
                                <td class="px-4 py-3 text-slate-400 text-center font-medium">{{ i + 1 }}</td>
                                <td class="px-4 py-3 font-medium text-slate-900 dark:text-slate-100">
                                    <Link :href="`/seasons/${season.id}/teams/${row.team.id}`" class="hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors">
                                        {{ row.team.name }}
                                    </Link>
                                </td>
                                <td class="px-3 py-3 text-center text-slate-500 dark:text-slate-400">{{ row.played }}</td>
                                <td class="px-3 py-3 text-center text-slate-500 dark:text-slate-400">{{ row.won }}</td>
                                <td class="px-3 py-3 text-center text-slate-500 dark:text-slate-400">{{ row.drawn }}</td>
                                <td class="px-3 py-3 text-center text-slate-500 dark:text-slate-400">{{ row.lost }}</td>
                                <td class="px-3 py-3 text-center text-slate-500 dark:text-slate-400 hidden sm:table-cell">{{ row.goals_for }}</td>
                                <td class="px-3 py-3 text-center text-slate-500 dark:text-slate-400 hidden sm:table-cell">{{ row.goals_against }}</td>
                                <td class="px-3 py-3 text-center text-slate-500 dark:text-slate-400">
                                    {{ row.goal_difference > 0 ? '+' : '' }}{{ row.goal_difference }}
                                </td>
                                <td class="px-3 py-3 text-center font-bold text-slate-900 dark:text-slate-100">{{ row.points }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- FIXTURES -->
        <div v-if="tab === 'fixtures'">
            <div v-if="upcoming.length === 0" class="text-center py-16 text-slate-500 dark:text-slate-400">No upcoming fixtures.</div>
            <div v-else class="space-y-2">
                <template v-for="(group, round) in Object.groupBy(upcoming, f => f.round?.name ?? 'Fixtures')" :key="round">
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide pt-2 px-1">{{ round }}</p>
                    <div v-for="fixture in group" :key="fixture.id"
                        class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 px-4 py-3"
                    >
                        <div class="flex items-center gap-3">
                            <span class="text-sm font-medium text-slate-900 dark:text-slate-100 flex-1 text-right">
                                {{ fixture.home_team.short_name ?? fixture.home_team.name }}
                            </span>
                            <div class="flex flex-col items-center shrink-0">
                                <span class="text-xs font-semibold text-slate-400">vs</span>
                                <span v-if="fixture.scheduled_at" class="text-xs text-slate-400">{{ formatTime(fixture.scheduled_at) }}</span>
                            </div>
                            <span class="text-sm font-medium text-slate-900 dark:text-slate-100 flex-1">
                                {{ fixture.away_team.short_name ?? fixture.away_team.name }}
                            </span>
                        </div>
                        <div v-if="fixture.scheduled_at" class="text-center text-xs text-slate-400 mt-0.5">
                            {{ formatDate(fixture.scheduled_at) }} · {{ formatTime(fixture.scheduled_at) }}
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <!-- RESULTS -->
        <div v-if="tab === 'results'">
            <div v-if="results.length === 0" class="text-center py-16 text-slate-500 dark:text-slate-400">No results yet.</div>
            <div v-else class="space-y-2">
                <template v-for="(group, round) in Object.groupBy(results, f => f.round?.name ?? 'Results')" :key="round">
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide pt-2 px-1">{{ round }}</p>
                    <Link v-for="fixture in group" :key="fixture.id"
                        :href="`/fixtures/${fixture.id}`"
                        class="block bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 px-4 py-3 hover:border-emerald-400 dark:hover:border-emerald-600 transition-colors"
                    >
                        <div class="flex items-center gap-3">
                            <span class="text-sm font-medium text-slate-900 dark:text-slate-100 flex-1 text-right">
                                {{ fixture.home_team.short_name ?? fixture.home_team.name }}
                            </span>
                            <span class="text-base font-bold tabular-nums px-3 py-1 bg-slate-100 dark:bg-slate-800 rounded-lg shrink-0 text-slate-900 dark:text-slate-100">
                                {{ fixture.home_score }} : {{ fixture.away_score }}
                            </span>
                            <span class="text-sm font-medium text-slate-900 dark:text-slate-100 flex-1">
                                {{ fixture.away_team.short_name ?? fixture.away_team.name }}
                            </span>
                        </div>
                        <div v-if="fixture.scheduled_at" class="text-center text-xs text-slate-400 mt-0.5">
                            {{ formatDate(fixture.scheduled_at) }} · {{ formatTime(fixture.scheduled_at) }}
                        </div>
                    </Link>
                </template>
            </div>
        </div>

        <!-- PLAYERS -->
        <div v-if="tab === 'players'" class="space-y-4">
            <!-- Sub-tabs -->
            <div class="flex gap-1 bg-slate-100 dark:bg-slate-800 rounded-xl p-1 w-fit">
                <button
                    v-for="pt in [{ key: 'scorers', label: '⚽ Top scorers' }, { key: 'cards', label: '🟨 Discipline' }, { key: 'mvp', label: '⭐ MVP' }]"
                    :key="pt.key"
                    @click="playerTab = pt.key as any"
                    :class="[
                        'px-3 py-1.5 rounded-lg text-sm font-medium transition-colors',
                        playerTab === pt.key
                            ? 'bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100 shadow-sm'
                            : 'text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-300',
                    ]"
                >
                    {{ pt.label }}
                </button>
            </div>

            <!-- Top scorers -->
            <div v-if="playerTab === 'scorers'">
                <div v-if="topScorers.length === 0" class="text-center py-12 text-slate-500 dark:text-slate-400">No goals recorded yet.</div>
                <div v-else class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 overflow-hidden">
                    <table class="w-full text-sm">
                        <thead class="border-b border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/50">
                            <tr>
                                <th class="text-left px-4 py-3 font-medium text-slate-500 w-8">#</th>
                                <th class="text-left px-4 py-3 font-medium text-slate-500">Player</th>
                                <th class="text-left px-4 py-3 font-medium text-slate-500 hidden sm:table-cell">Team</th>
                                <th class="text-center px-3 py-3 font-medium text-slate-500">MP</th>
                                <th class="text-center px-3 py-3 font-bold text-slate-700 dark:text-slate-300">⚽</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                            <tr v-for="(stat, i) in topScorers" :key="stat.player.id"
                                class="hover:bg-slate-50 dark:hover:bg-slate-800/40 transition-colors"
                            >
                                <td class="px-4 py-3 text-slate-400 text-center font-medium">{{ i + 1 }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-2">
                                        <span class="font-medium text-slate-900 dark:text-slate-100">{{ stat.player.name }}</span>
                                        <span
                                            v-if="stat.player.position"
                                            :class="['text-xs px-1.5 py-0.5 rounded-full font-medium capitalize hidden sm:inline', positionBadge[stat.player.position] ?? '']"
                                        >
                                            {{ stat.player.position }}
                                        </span>
                                    </div>
                                    <p class="text-xs text-slate-400 sm:hidden mt-0.5">{{ stat.team.name }}</p>
                                </td>
                                <td class="px-4 py-3 text-slate-500 dark:text-slate-400 hidden sm:table-cell">{{ stat.team.name }}</td>
                                <td class="px-3 py-3 text-center text-slate-500 dark:text-slate-400">{{ stat.played }}</td>
                                <td class="px-3 py-3 text-center font-bold text-slate-900 dark:text-slate-100">{{ stat.goals }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Discipline -->
            <div v-if="playerTab === 'cards'">
                <div v-if="topCards.length === 0" class="text-center py-12 text-slate-500 dark:text-slate-400">No cards recorded yet.</div>
                <div v-else class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 overflow-hidden">
                    <table class="w-full text-sm">
                        <thead class="border-b border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/50">
                            <tr>
                                <th class="text-left px-4 py-3 font-medium text-slate-500">Player</th>
                                <th class="text-left px-4 py-3 font-medium text-slate-500 hidden sm:table-cell">Team</th>
                                <th class="text-center px-3 py-3 font-medium text-slate-500">🟨</th>
                                <th class="text-center px-3 py-3 font-medium text-slate-500">🟥</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                            <tr v-for="stat in topCards" :key="stat.player.id"
                                class="hover:bg-slate-50 dark:hover:bg-slate-800/40 transition-colors"
                            >
                                <td class="px-4 py-3">
                                    <span class="font-medium text-slate-900 dark:text-slate-100">{{ stat.player.name }}</span>
                                    <p class="text-xs text-slate-400 sm:hidden mt-0.5">{{ stat.team.name }}</p>
                                </td>
                                <td class="px-4 py-3 text-slate-500 dark:text-slate-400 hidden sm:table-cell">{{ stat.team.name }}</td>
                                <td class="px-3 py-3 text-center font-semibold text-slate-900 dark:text-slate-100">{{ stat.yellow_cards }}</td>
                                <td class="px-3 py-3 text-center font-semibold text-slate-900 dark:text-slate-100">{{ stat.red_cards }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- MVP -->
            <div v-if="playerTab === 'mvp'">
                <div v-if="topMvps.length === 0" class="text-center py-12 text-slate-500 dark:text-slate-400">No MVPs recorded yet.</div>
                <div v-else class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 overflow-hidden">
                    <table class="w-full text-sm">
                        <thead class="border-b border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/50">
                            <tr>
                                <th class="text-left px-4 py-3 font-medium text-slate-500 w-8">#</th>
                                <th class="text-left px-4 py-3 font-medium text-slate-500">Player</th>
                                <th class="text-left px-4 py-3 font-medium text-slate-500 hidden sm:table-cell">Team</th>
                                <th class="text-center px-3 py-3 font-medium text-slate-500">MP</th>
                                <th class="text-center px-3 py-3 font-bold text-slate-700 dark:text-slate-300">⭐</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                            <tr v-for="(stat, i) in topMvps" :key="stat.player.id"
                                class="hover:bg-slate-50 dark:hover:bg-slate-800/40 transition-colors"
                            >
                                <td class="px-4 py-3 text-slate-400 text-center font-medium">{{ i + 1 }}</td>
                                <td class="px-4 py-3">
                                    <span class="font-medium text-slate-900 dark:text-slate-100">{{ stat.player.name }}</span>
                                    <p class="text-xs text-slate-400 sm:hidden mt-0.5">{{ stat.team.name }}</p>
                                </td>
                                <td class="px-4 py-3 text-slate-500 dark:text-slate-400 hidden sm:table-cell">{{ stat.team.name }}</td>
                                <td class="px-3 py-3 text-center text-slate-500 dark:text-slate-400">{{ stat.played }}</td>
                                <td class="px-3 py-3 text-center font-bold text-slate-900 dark:text-slate-100">{{ stat.mvp }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>