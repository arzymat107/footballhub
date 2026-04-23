<script setup lang="ts">
import { Head, Link, useForm, router } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
import { ChevronRight, Plus, Trash2, Star } from 'lucide-vue-next';
import { ref, computed } from 'vue';

type TeamPlayer = { id: number; player: { id: number; name: string; position: string | null } };
type LineupEntry = { id: number; is_mvp: boolean; player: { id: number; name: string } };
type EventEntry = {
    id: number; type: string; minute: number;
    player: { id: number; name: string };
    team: { id: number; name: string };
};

const props = defineProps<{
    fixture: {
        id: number; status: string; scheduled_at: string | null;
        home_score: number | null; away_score: number | null;
        home_team: { id: number; name: string };
        away_team: { id: number; name: string };
        season: { id: number; name: string };
        round: { name: string } | null;
    };
    seasonPlayers: Record<number, TeamPlayer[]>;
    lineups: Record<number, LineupEntry[]>;
    events: EventEntry[];
}>();

defineOptions({ layout: AdminLayout });

const tab = ref<'lineup' | 'events'>('lineup');
const lineupTeam = ref<number>(props.fixture.home_team.id);

const lineupForm = useForm({
    team_id: lineupTeam,
    player_id: '',
    is_mvp: false,
});

const eventForm = useForm({
    team_id: props.fixture.home_team.id as number | '',
    player_id: '',
    type: 'goal',
    minute: '',
});

const availableForLineup = computed(() => {
    const registered = (props.seasonPlayers[lineupTeam.value] ?? []).map(r => r.player);
    const already = new Set((props.lineups[lineupTeam.value] ?? []).map(l => l.player.id));
    return registered.filter(p => !already.has(p.id));
});

const playersForEvent = computed(() => {
    const teamId = Number(eventForm.team_id);
    return (props.seasonPlayers[teamId] ?? []).map(r => r.player);
});

function addLineup() {
    lineupForm.team_id = lineupTeam.value as any;
    lineupForm.post(`/admin/fixtures/${props.fixture.id}/lineup`, {
        onSuccess: () => lineupForm.reset('player_id', 'is_mvp'),
    });
}

function removeLineup(lineupId: number) {
    router.delete(`/admin/fixtures/${props.fixture.id}/lineup/${lineupId}`);
}

function addEvent() {
    eventForm.post(`/admin/fixtures/${props.fixture.id}/events`, {
        onSuccess: () => eventForm.reset('player_id', 'minute'),
    });
}

function removeEvent(eventId: number) {
    router.delete(`/admin/fixtures/${props.fixture.id}/events/${eventId}`);
}

const eventIcon: Record<string, string> = {
    goal: '⚽', own_goal: '🔴', yellow_card: '🟨', red_card: '🟥',
};

const positionBadge: Record<string, string> = {
    goalkeeper: 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400',
    defender: 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400',
    midfielder: 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400',
    forward: 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400',
};
</script>

<template>
    <Head :title="`${fixture.home_team.name} vs ${fixture.away_team.name}`" />

    <div class="p-6 space-y-5 max-w-3xl">
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-1.5 text-sm text-slate-500 dark:text-slate-400">
            <Link href="/admin/fixtures" class="hover:text-slate-700 dark:hover:text-slate-200 transition-colors">Fixtures</Link>
            <ChevronRight class="size-4" />
            <span class="text-slate-900 dark:text-slate-100">Lineup & Events</span>
        </nav>

        <!-- Match header -->
        <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 p-4">
            <div class="flex items-center justify-between gap-4">
                <span class="font-bold text-slate-900 dark:text-slate-100 flex-1 text-right">{{ fixture.home_team.name }}</span>
                <span class="text-xl font-bold tabular-nums px-4 py-1 bg-slate-100 dark:bg-slate-800 rounded-lg text-slate-900 dark:text-slate-100">
                    {{ fixture.home_score ?? '—' }} : {{ fixture.away_score ?? '—' }}
                </span>
                <span class="font-bold text-slate-900 dark:text-slate-100 flex-1">{{ fixture.away_team.name }}</span>
            </div>
            <p class="text-center text-xs text-slate-400 mt-1.5">
                {{ fixture.season.name }}{{ fixture.round ? ` · ${fixture.round.name}` : '' }}
            </p>
        </div>

        <!-- Tabs -->
        <div class="flex gap-1 bg-slate-100 dark:bg-slate-800 rounded-xl p-1 w-fit">
            <button
                v-for="t in [{ key: 'lineup', label: 'Lineup' }, { key: 'events', label: 'Events' }]"
                :key="t.key"
                @click="tab = t.key as any"
                :class="[
                    'px-4 py-1.5 rounded-lg text-sm font-medium transition-colors',
                    tab === t.key
                        ? 'bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100 shadow-sm'
                        : 'text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-300',
                ]"
            >
                {{ t.label }}
            </button>
        </div>

        <!-- LINEUP TAB -->
        <div v-if="tab === 'lineup'" class="space-y-4">
            <!-- Team selector -->
            <div class="flex gap-2">
                <button
                    v-for="team in [fixture.home_team, fixture.away_team]"
                    :key="team.id"
                    @click="lineupTeam = team.id"
                    :class="[
                        'flex-1 py-2 rounded-lg border text-sm font-medium transition-colors',
                        lineupTeam === team.id
                            ? 'bg-emerald-600 text-white border-emerald-600'
                            : 'border-slate-300 dark:border-slate-700 text-slate-700 dark:text-slate-300 hover:border-emerald-400',
                    ]"
                >
                    {{ team.name }}
                    <span class="ml-1 opacity-70 text-xs">({{ (lineups[team.id] ?? []).length }})</span>
                </button>
            </div>

            <!-- Add player -->
            <form @submit.prevent="addLineup" class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 p-4 flex flex-wrap gap-3 items-end">
                <div class="flex-1 min-w-40 space-y-1">
                    <label class="text-xs font-medium text-slate-500">Player</label>
                    <select
                        v-model="lineupForm.player_id"
                        class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition"
                    >
                        <option value="">Select player…</option>
                        <option v-for="p in availableForLineup" :key="p.id" :value="p.id">{{ p.name }}</option>
                    </select>
                </div>
                <label class="flex items-center gap-2 text-sm text-slate-700 dark:text-slate-300 cursor-pointer">
                    <input v-model="lineupForm.is_mvp" type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500" />
                    MVP
                </label>
                <button
                    type="submit"
                    :disabled="!lineupForm.player_id || lineupForm.processing"
                    class="flex items-center gap-1.5 px-4 py-2 rounded-lg bg-emerald-600 text-white text-sm font-medium hover:bg-emerald-700 disabled:opacity-40 transition-colors"
                >
                    <Plus class="size-4" /> Add
                </button>
            </form>

            <div v-if="(seasonPlayers[lineupTeam] ?? []).length === 0"
                class="text-center py-6 text-sm text-amber-600 dark:text-amber-400 bg-amber-50 dark:bg-amber-900/20 rounded-xl border border-amber-200 dark:border-amber-800"
            >
                No players registered for this team in this season. Go to <Link :href="`/admin/seasons/${fixture.season.id}/squad`" class="underline">Squad management</Link> first.
            </div>

            <!-- Lineup list -->
            <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 overflow-hidden">
                <div v-if="(lineups[lineupTeam] ?? []).length === 0" class="px-4 py-6 text-center text-sm text-slate-400">
                    No players in lineup yet.
                </div>
                <div v-else class="divide-y divide-slate-100 dark:divide-slate-800">
                    <div
                        v-for="entry in lineups[lineupTeam] ?? []"
                        :key="entry.id"
                        class="flex items-center gap-3 px-4 py-2.5 hover:bg-slate-50 dark:hover:bg-slate-800/40 transition-colors"
                    >
                        <Star v-if="entry.is_mvp" class="size-4 text-yellow-500 fill-yellow-400 shrink-0" />
                        <span v-else class="size-4 shrink-0" />
                        <span class="flex-1 text-sm font-medium text-slate-900 dark:text-slate-100">{{ entry.player.name }}</span>
                        <button @click="removeLineup(entry.id)" class="p-1 rounded text-slate-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                            <Trash2 class="size-3.5" />
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- EVENTS TAB -->
        <div v-if="tab === 'events'" class="space-y-4">
            <!-- Add event -->
            <form @submit.prevent="addEvent" class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 p-4 space-y-3">
                <div class="grid grid-cols-2 gap-3">
                    <div class="space-y-1">
                        <label class="text-xs font-medium text-slate-500">Team</label>
                        <select
                            v-model="eventForm.team_id"
                            class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition"
                        >
                            <option :value="fixture.home_team.id">{{ fixture.home_team.name }}</option>
                            <option :value="fixture.away_team.id">{{ fixture.away_team.name }}</option>
                        </select>
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-medium text-slate-500">Player</label>
                        <select
                            v-model="eventForm.player_id"
                            class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition"
                        >
                            <option value="">Select player…</option>
                            <option v-for="p in playersForEvent" :key="p.id" :value="p.id">{{ p.name }}</option>
                        </select>
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-medium text-slate-500">Event type</label>
                        <select
                            v-model="eventForm.type"
                            class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition"
                        >
                            <option value="goal">⚽ Goal</option>
                            <option value="own_goal">🔴 Own goal</option>
                            <option value="yellow_card">🟨 Yellow card</option>
                            <option value="red_card">🟥 Red card</option>
                        </select>
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-medium text-slate-500">Minute</label>
                        <input
                            v-model.number="eventForm.minute"
                            type="number" min="1" max="120"
                            class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition"
                            placeholder="45"
                        />
                    </div>
                </div>
                <button
                    type="submit"
                    :disabled="!eventForm.player_id || !eventForm.minute || eventForm.processing"
                    class="flex items-center gap-1.5 px-4 py-2 rounded-lg bg-emerald-600 text-white text-sm font-medium hover:bg-emerald-700 disabled:opacity-40 transition-colors"
                >
                    <Plus class="size-4" /> Add event
                </button>
            </form>

            <!-- Events list -->
            <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 overflow-hidden">
                <div v-if="events.length === 0" class="px-4 py-6 text-center text-sm text-slate-400">
                    No events recorded yet.
                </div>
                <div v-else class="divide-y divide-slate-100 dark:divide-slate-800">
                    <div
                        v-for="event in events"
                        :key="event.id"
                        class="flex items-center gap-3 px-4 py-2.5 hover:bg-slate-50 dark:hover:bg-slate-800/40 transition-colors"
                    >
                        <span class="text-base w-6 text-center shrink-0">{{ eventIcon[event.type] ?? '•' }}</span>
                        <span class="text-xs font-mono text-slate-400 w-8 shrink-0">{{ event.minute }}'</span>
                        <span class="flex-1 text-sm font-medium text-slate-900 dark:text-slate-100">{{ event.player.name }}</span>
                        <span class="text-xs text-slate-400">{{ event.team.name }}</span>
                        <button @click="removeEvent(event.id)" class="p-1 rounded text-slate-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                            <Trash2 class="size-3.5" />
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>