<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import PublicLayout from '@/layouts/PublicLayout.vue';
import { ChevronRight, Calendar, Users } from 'lucide-vue-next';
import { computed } from 'vue';
import { useHashTab } from '@/composables/useHashTab';

type SquadEntry = {
    player: { id: number; name: string; position: string | null };
    shirt_number: number | null;
    joined_at: string | null;
    left_at: string | null;
    played: number;
    goals: number;
    own_goals: number;
    yellow_cards: number;
    red_cards: number;
    mvp: number;
};

const props = defineProps<{
    season: {
        id: number; name: string; format: string; status: string; track_players: boolean;
        division: { id: number; name: string; league: { id: number; name: string } };
    };
    team: { id: number; name: string; short_name: string | null; city: string | null; country: string | null; founded_year: number | null };
    fixtures: {
        id: number; status: string; scheduled_at: string | null;
        home_score: number | null; away_score: number | null;
        home_score_pen: number | null; away_score_pen: number | null;
        home_team: { id: number; name: string; short_name?: string | null };
        away_team: { id: number; name: string; short_name?: string | null };
        round: { name: string } | null;
    }[];
    squad: SquadEntry[];
    trackPlayers: boolean;
}>();

defineOptions({ layout: PublicLayout });

const tab = useHashTab<'fixtures' | 'results' | 'squad'>('fixtures', ['fixtures', 'results', 'squad']);

const upcoming = computed(() =>
    props.fixtures.filter(f => f.status === 'scheduled')
);
const results = computed(() =>
    props.fixtures.filter(f => f.status === 'completed').reverse()
);

const positionOrder: Record<string, number> = {
    goalkeeper: 0, defender: 1, midfielder: 2, forward: 3,
};

const sortedSquad = computed(() =>
    [...props.squad].sort((a, b) => {
        const pa = positionOrder[a.player.position ?? ''] ?? 99;
        const pb = positionOrder[b.player.position ?? ''] ?? 99;
        if (pa !== pb) return pa - pb;
        return a.player.name.localeCompare(b.player.name);
    })
);

const positionBadge: Record<string, string> = {
    goalkeeper: 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400',
    defender: 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400',
    midfielder: 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400',
    forward: 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400',
};

function formatDate(val: string | null) {
    if (!val) return null;
    return new Date(val).toLocaleDateString('en-GB', { weekday: 'short', day: 'numeric', month: 'short' });
}

function formatTime(val: string | null) {
    if (!val) return null;
    return new Date(val).toLocaleTimeString('en-GB', { hour: '2-digit', minute: '2-digit' });
}

function isHome(fixture: typeof props.fixtures[0]) {
    return fixture.home_team.id === props.team.id;
}

function opponent(fixture: typeof props.fixtures[0]) {
    return isHome(fixture) ? fixture.away_team : fixture.home_team;
}
</script>

<template>
    <Head :title="`${team.name} — ${season.name}`" />

    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-1.5 text-sm text-slate-500 dark:text-slate-400 mb-6 flex-wrap">
            <Link href="/leagues" class="hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors">Leagues</Link>
            <ChevronRight class="size-4" />
            <Link :href="`/leagues/${season.division.league.id}`" class="hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors">
                {{ season.division.league.name }}
            </Link>
            <ChevronRight class="size-4" />
            <Link :href="`/seasons/${season.id}`" class="hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors">
                {{ season.name }}
            </Link>
            <ChevronRight class="size-4" />
            <span class="text-slate-900 dark:text-slate-100">{{ team.name }}</span>
        </nav>

        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-slate-900 dark:text-slate-100">{{ team.name }}</h1>
            <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">
                {{ season.division.league.name }} · {{ season.division.name }} · {{ season.name }}
                <template v-if="team.city || team.country">
                    · {{ [team.city, team.country].filter(Boolean).join(', ') }}
                </template>
                <template v-if="team.founded_year">
                    · Est. {{ team.founded_year }}
                </template>
            </p>
        </div>

        <!-- Tabs -->
        <div class="flex gap-1 bg-slate-100 dark:bg-slate-800 rounded-xl p-1 w-fit mb-6 flex-wrap">
            <button
                v-for="t in [
                    { key: 'fixtures', label: 'Fixtures', icon: Calendar },
                    { key: 'results', label: 'Results', icon: Calendar },
                    ...(trackPlayers ? [{ key: 'squad', label: 'Squad', icon: Users }] : []),
                ]"
                :key="t.key"
                @click="tab = t.key as any"
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
                            <span class="text-xs text-slate-400 w-8 shrink-0 text-center">
                                {{ isHome(fixture) ? 'H' : 'A' }}
                            </span>
                            <span class="text-sm font-medium text-slate-900 dark:text-slate-100 flex-1">
                                {{ opponent(fixture).short_name ?? opponent(fixture).name }}
                            </span>
                            <div class="flex flex-col items-center shrink-0">
                                <span class="text-xs font-semibold text-slate-400">vs</span>
                                <span v-if="fixture.scheduled_at" class="text-xs text-slate-400">{{ formatTime(fixture.scheduled_at) }}</span>
                            </div>
                        </div>
                        <div v-if="fixture.scheduled_at" class="text-center text-xs text-slate-400 mt-0.5">
                            {{ formatDate(fixture.scheduled_at) }}
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
                            <div class="flex flex-col items-center shrink-0">
                                <span class="text-base font-bold tabular-nums px-3 py-1 bg-slate-100 dark:bg-slate-800 rounded-lg text-slate-900 dark:text-slate-100">
                                    {{ fixture.home_score }} : {{ fixture.away_score }}
                                </span>
                                <span v-if="fixture.home_score_pen !== null && fixture.away_score_pen !== null"
                                    class="text-xs text-slate-400 tabular-nums mt-0.5">
                                    pen {{ fixture.home_score_pen }}–{{ fixture.away_score_pen }}
                                </span>
                            </div>
                            <span class="text-sm font-medium text-slate-900 dark:text-slate-100 flex-1">
                                {{ fixture.away_team.short_name ?? fixture.away_team.name }}
                            </span>
                        </div>
                        <div v-if="fixture.scheduled_at" class="text-center text-xs text-slate-400 mt-0.5">
                            {{ formatDate(fixture.scheduled_at) }}
                        </div>
                    </Link>
                </template>
            </div>
        </div>

        <!-- SQUAD -->
        <div v-if="tab === 'squad'">
            <div v-if="sortedSquad.length === 0" class="text-center py-16 text-slate-500 dark:text-slate-400">No squad registered.</div>
            <div v-else class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="border-b border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/50">
                            <tr>
                                <th class="text-center px-3 py-3 font-medium text-slate-500 dark:text-slate-400 w-10">#</th>
                                <th class="text-left px-4 py-3 font-medium text-slate-500 dark:text-slate-400">Player</th>
                                <th class="text-center px-3 py-3 font-medium text-slate-500 dark:text-slate-400 hidden md:table-cell">Joined</th>
                                <th class="text-center px-3 py-3 font-medium text-slate-500 dark:text-slate-400 hidden md:table-cell">Left</th>
                                <th class="text-center px-3 py-3 font-medium text-slate-500 dark:text-slate-400">MP</th>
                                <th class="text-center px-3 py-3 font-medium text-slate-500 dark:text-slate-400">⚽</th>
                                <th class="text-center px-3 py-3 font-medium text-slate-500 dark:text-slate-400 hidden sm:table-cell">OG</th>
                                <th class="text-center px-3 py-3 font-medium text-slate-500 dark:text-slate-400">🟨</th>
                                <th class="text-center px-3 py-3 font-medium text-slate-500 dark:text-slate-400">🟥</th>
                                <th class="text-center px-3 py-3 font-medium text-slate-500 dark:text-slate-400">⭐</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                            <tr
                                v-for="entry in sortedSquad"
                                :key="entry.player.id"
                                class="hover:bg-slate-50 dark:hover:bg-slate-800/40 transition-colors"
                            >
                                <td class="px-3 py-3 text-center text-slate-400 font-medium">
                                    {{ entry.shirt_number ?? '—' }}
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-2">
                                        <span class="font-medium text-slate-900 dark:text-slate-100">{{ entry.player.name }}</span>
                                        <span
                                            v-if="entry.player.position"
                                            :class="['text-xs px-1.5 py-0.5 rounded-full font-medium capitalize hidden sm:inline', positionBadge[entry.player.position] ?? '']"
                                        >{{ entry.player.position }}</span>
                                    </div>
                                </td>
                                <td class="px-3 py-3 text-center text-slate-500 dark:text-slate-400 hidden md:table-cell text-xs">
                                    {{ entry.joined_at ? formatDate(entry.joined_at) : '—' }}
                                </td>
                                <td class="px-3 py-3 text-center text-slate-500 dark:text-slate-400 hidden md:table-cell text-xs">
                                    {{ entry.left_at ? formatDate(entry.left_at) : '—' }}
                                </td>
                                <td class="px-3 py-3 text-center text-slate-500 dark:text-slate-400">{{ entry.played }}</td>
                                <td class="px-3 py-3 text-center font-semibold text-slate-900 dark:text-slate-100">
                                    {{ entry.goals > 0 ? entry.goals : '—' }}
                                </td>
                                <td class="px-3 py-3 text-center text-slate-500 dark:text-slate-400 hidden sm:table-cell">
                                    {{ entry.own_goals > 0 ? entry.own_goals : '—' }}
                                </td>
                                <td class="px-3 py-3 text-center text-slate-500 dark:text-slate-400">
                                    {{ entry.yellow_cards > 0 ? entry.yellow_cards : '—' }}
                                </td>
                                <td class="px-3 py-3 text-center text-slate-500 dark:text-slate-400">
                                    {{ entry.red_cards > 0 ? entry.red_cards : '—' }}
                                </td>
                                <td class="px-3 py-3 text-center text-slate-500 dark:text-slate-400">
                                    {{ entry.mvp > 0 ? entry.mvp : '—' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>