<script setup lang="ts">
import { computed } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import PublicLayout from '@/layouts/PublicLayout.vue';
import { ChevronRight } from 'lucide-vue-next';

type LineupPlayer = {
    id: number;
    is_mvp: boolean;
    player: { id: number; name: string; position: string | null };
};

type MatchEvent = {
    id: number;
    type: 'goal' | 'own_goal' | 'yellow_card' | 'red_card';
    minute: number;
    player: { id: number; name: string };
    team_id: number;
};

const props = defineProps<{
    fixture: {
        id: number;
        status: string;
        scheduled_at: string | null;
        venue: string | null;
        home_score: number | null;
        away_score: number | null;
        home_score_et: number | null;
        away_score_et: number | null;
        home_score_pen: number | null;
        away_score_pen: number | null;
        home_team: { id: number; name: string; short_name: string | null };
        away_team: { id: number; name: string; short_name: string | null };
        round: { name: string } | null;
        season: {
            id: number; name: string;
            division: { id: number; name: string; league: { id: number; name: string } };
        };
    };
    lineups: Record<string, LineupPlayer[]>;
    events: MatchEvent[];
}>();

defineOptions({ layout: PublicLayout });

const positionBadge: Record<string, string> = {
    goalkeeper: 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400',
    defender: 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400',
    midfielder: 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400',
    forward: 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400',
};

const positionOrder: Record<string, number> = {
    goalkeeper: 0, defender: 1, midfielder: 2, forward: 3,
};

const eventIcon: Record<string, string> = {
    goal: '⚽',
    own_goal: '⚽',
    yellow_card: '🟨',
    red_card: '🟥',
};

function sortedLineup(players: LineupPlayer[]) {
    return [...players].sort((a, b) => {
        const pa = positionOrder[a.player.position ?? ''] ?? 99;
        const pb = positionOrder[b.player.position ?? ''] ?? 99;
        return pa !== pb ? pa - pb : a.player.name.localeCompare(b.player.name);
    });
}

function formatDate(val: string | null) {
    if (!val) return null;
    return new Date(val).toLocaleDateString('en-GB', {
        weekday: 'long', day: 'numeric', month: 'long', year: 'numeric',
    });
}

function formatTime(val: string | null) {
    if (!val) return null;
    return new Date(val).toLocaleTimeString('en-GB', { hour: '2-digit', minute: '2-digit' });
}

const homeId = computed(() => props.fixture.home_team.id);
const awayId = computed(() => props.fixture.away_team.id);

const homeLineup = computed(() => sortedLineup(props.lineups[homeId.value] ?? []));
const awayLineup = computed(() => sortedLineup(props.lineups[awayId.value] ?? []));

const mvps = computed(() =>
    [...(props.lineups[homeId.value] ?? []), ...(props.lineups[awayId.value] ?? [])]
        .filter(l => l.is_mvp)
);

const statusStyle: Record<string, string> = {
    completed: 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400',
    scheduled: 'bg-sky-100 text-sky-700 dark:bg-sky-900/30 dark:text-sky-400',
    postponed: 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400',
    cancelled: 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400',
};

</script>

<template>
    <Head :title="`${fixture.home_team.name} vs ${fixture.away_team.name}`" />

    <div class="max-w-3xl mx-auto px-4 py-8 space-y-5">
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-1.5 text-sm text-slate-500 dark:text-slate-400 flex-wrap">
            <Link href="/leagues" class="hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors">Leagues</Link>
            <ChevronRight class="size-4 shrink-0" />
            <Link :href="`/leagues/${fixture.season.division.league.id}`" class="hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors">
                {{ fixture.season.division.league.name }}
            </Link>
            <ChevronRight class="size-4 shrink-0" />
            <Link :href="`/seasons/${fixture.season.id}`" class="hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors">
                {{ fixture.season.name }}
            </Link>
            <ChevronRight class="size-4 shrink-0" />
            <span class="text-slate-900 dark:text-slate-100 truncate">
                {{ fixture.home_team.short_name ?? fixture.home_team.name }} vs {{ fixture.away_team.short_name ?? fixture.away_team.name }}
            </span>
        </nav>

        <!-- Score hero -->
        <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 px-4 py-3">
            <div class="flex items-center gap-3">
                <Link :href="`/seasons/${fixture.season.id}/teams/${fixture.home_team.id}`"
                    class="text-sm font-medium text-slate-900 dark:text-slate-100 flex-1 text-right hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors"
                >
                    {{ fixture.home_team.short_name ?? fixture.home_team.name }}
                </Link>
                <div class="flex flex-col items-center shrink-0">
                    <span class="text-base font-bold tabular-nums px-3 py-1 bg-slate-100 dark:bg-slate-800 rounded-lg text-slate-900 dark:text-slate-100">
                        <template v-if="fixture.status === 'completed'">
                            {{ fixture.home_score }} : {{ fixture.away_score }}
                        </template>
                        <template v-else>vs</template>
                    </span>
                    <span v-if="fixture.home_score_pen !== null && fixture.away_score_pen !== null"
                        class="text-xs text-slate-400 mt-0.5 tabular-nums">
                        pen {{ fixture.home_score_pen }}–{{ fixture.away_score_pen }}
                    </span>
                </div>
                <Link :href="`/seasons/${fixture.season.id}/teams/${fixture.away_team.id}`"
                    class="text-sm font-medium text-slate-900 dark:text-slate-100 flex-1 hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors"
                >
                    {{ fixture.away_team.short_name ?? fixture.away_team.name }}
                </Link>
            </div>
            <div class="text-center text-xs text-slate-400 mt-1.5 space-y-1">
                <p v-if="fixture.scheduled_at">
                    {{ formatDate(fixture.scheduled_at) }} · {{ formatTime(fixture.scheduled_at) }}
                </p>
                <p v-if="fixture.venue">{{ fixture.venue }}</p>
                <div class="flex items-center justify-center gap-2 flex-wrap pt-0.5">
                    <span :class="['px-2 py-0.5 rounded-full text-xs font-semibold capitalize', statusStyle[fixture.status] ?? statusStyle.scheduled]">
                        {{ fixture.status }}
                    </span>
                    <span v-if="mvps.length > 0" class="flex items-center gap-1 text-amber-500 dark:text-amber-400 font-medium">
                        ⭐ {{ mvps.map(m => m.player.name).join(', ') }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Events timeline -->
        <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 overflow-hidden">
            <h2 class="text-xs font-semibold text-slate-400 uppercase tracking-wide px-6 py-3 border-b border-slate-100 dark:border-slate-800">
                Match Events
            </h2>

            <div v-if="events.length === 0" class="text-center py-10 text-sm text-slate-400">
                No events recorded.
            </div>

            <div v-else class="divide-y divide-slate-50 dark:divide-slate-800/60">
                <div
                    v-for="event in events"
                    :key="event.id"
                    class="grid grid-cols-[1fr_3rem_1fr] items-center px-4 py-2.5 gap-2"
                >
                    <!-- Home side -->
                    <div :class="['flex items-center gap-2', event.team_id === homeId ? 'justify-end' : 'justify-start opacity-0 pointer-events-none']">
                        <span class="text-sm text-slate-700 dark:text-slate-300 text-right leading-snug">
                            {{ event.player.name }}
                            <span v-if="event.type === 'own_goal'" class="text-xs text-slate-400 ml-0.5">(OG)</span>
                        </span>
                        <span class="text-base shrink-0">{{ eventIcon[event.type] }}</span>
                    </div>

                    <!-- Minute badge (center) -->
                    <div class="flex justify-center">
                        <span class="text-xs font-bold tabular-nums text-slate-400 bg-slate-100 dark:bg-slate-800 rounded-full px-2 py-0.5 w-fit">
                            {{ event.minute }}'
                        </span>
                    </div>

                    <!-- Away side -->
                    <div :class="['flex items-center gap-2', event.team_id === awayId ? 'justify-start' : 'justify-end opacity-0 pointer-events-none']">
                        <span class="text-base shrink-0">{{ eventIcon[event.type] }}</span>
                        <span class="text-sm text-slate-700 dark:text-slate-300 leading-snug">
                            {{ event.player.name }}
                            <span v-if="event.type === 'own_goal'" class="text-xs text-slate-400 ml-0.5">(OG)</span>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Column headers -->
            <div v-if="events.length > 0" class="grid grid-cols-[1fr_3rem_1fr] px-4 py-2 border-t border-slate-100 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/40">
                <p class="text-xs font-semibold text-slate-400 text-right truncate pr-2">
                    {{ fixture.home_team.short_name ?? fixture.home_team.name }}
                </p>
                <div />
                <p class="text-xs font-semibold text-slate-400 truncate pl-2">
                    {{ fixture.away_team.short_name ?? fixture.away_team.name }}
                </p>
            </div>
        </div>

        <!-- Lineups -->
        <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 overflow-hidden">
            <h2 class="text-xs font-semibold text-slate-400 uppercase tracking-wide px-6 py-3 border-b border-slate-100 dark:border-slate-800">
                Lineups
            </h2>

            <div v-if="homeLineup.length === 0 && awayLineup.length === 0"
                class="text-center py-10 text-sm text-slate-400"
            >
                No lineups recorded.
            </div>

            <div v-else class="grid grid-cols-2 divide-x divide-slate-100 dark:divide-slate-800">
                <!-- Home -->
                <div class="p-4">
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide mb-3 truncate">
                        {{ fixture.home_team.short_name ?? fixture.home_team.name }}
                    </p>
                    <div class="space-y-1.5">
                        <div v-for="entry in homeLineup" :key="entry.id" class="flex items-center gap-2 min-w-0">
                            <span
                                v-if="entry.player.position"
                                :class="['text-xs w-5 h-5 flex items-center justify-center rounded font-bold shrink-0', positionBadge[entry.player.position] ?? '']"
                            >{{ entry.player.position[0].toUpperCase() }}</span>
                            <span v-else class="w-5 shrink-0" />
                            <span class="text-sm text-slate-800 dark:text-slate-200 truncate min-w-0">{{ entry.player.name }}</span>
                            <span v-if="entry.is_mvp" class="text-xs shrink-0 ml-auto">⭐</span>
                        </div>
                    </div>
                </div>

                <!-- Away -->
                <div class="p-4">
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide mb-3 truncate">
                        {{ fixture.away_team.short_name ?? fixture.away_team.name }}
                    </p>
                    <div class="space-y-1.5">
                        <div v-for="entry in awayLineup" :key="entry.id" class="flex items-center gap-2 min-w-0">
                            <span
                                v-if="entry.player.position"
                                :class="['text-xs w-5 h-5 flex items-center justify-center rounded font-bold shrink-0', positionBadge[entry.player.position] ?? '']"
                            >{{ entry.player.position[0].toUpperCase() }}</span>
                            <span v-else class="w-5 shrink-0" />
                            <span class="text-sm text-slate-800 dark:text-slate-200 truncate min-w-0">{{ entry.player.name }}</span>
                            <span v-if="entry.is_mvp" class="text-xs shrink-0 ml-auto">⭐</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>