<script setup lang="ts">
import { Head, Link, useForm, router } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
import { ChevronRight, Plus, Trash2, Star, X } from 'lucide-vue-next';
import { ref, computed, watch } from 'vue';

type Player = { id: number; name: string; position: string };
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
        home_score_pen: number | null; away_score_pen: number | null;
        home_team: { id: number; name: string };
        away_team: { id: number; name: string };
        season: { id: number; name: string };
        round: { name: string } | null;
    };
    seasonPlayers: Record<number, Player[]>;
    allPlayers: Player[];
    lineups: Record<number, LineupEntry[]>;
    events: EventEntry[];
}>();

defineOptions({ layout: AdminLayout });

const tab = ref<'lineup' | 'events'>('lineup');
const lineupTeam = ref<number>(props.fixture.home_team.id);

// ── Lineup player search ──────────────────────────────────────────────────────

const search = ref('');
const showDropdown = ref(false);
const showCreateForm = ref(false);
const selectedPlayer = ref<Player | null>(null);
const selectedPlayerIsExternal = ref(false);

const quickForm = useForm({ name: '', position: 'forward', team_id: lineupTeam.value as number | '' });

const filteredSquadPlayers = computed(() => {
    const inLineup = new Set((props.lineups[lineupTeam.value] ?? []).map(l => l.player.id));
    const available = (props.seasonPlayers[lineupTeam.value] ?? []).filter(p => !inLineup.has(p.id));
    const q = search.value.toLowerCase().trim();
    return q ? available.filter(p => p.name.toLowerCase().includes(q)) : available;
});

const filteredAllPlayers = computed(() => {
    const q = search.value.toLowerCase().trim();
    if (!q) return [];
    const squadIds = new Set((props.seasonPlayers[lineupTeam.value] ?? []).map(p => p.id));
    return props.allPlayers.filter(p => !squadIds.has(p.id) && p.name.toLowerCase().includes(q)).slice(0, 8);
});

function onSearchInput() {
    selectedPlayer.value = null;
    selectedPlayerIsExternal.value = false;
    lineupForm.player_id = '';
    showDropdown.value = true;
    showCreateForm.value = false;
}

function selectPlayer(p: Player, external = false) {
    selectedPlayer.value = p;
    selectedPlayerIsExternal.value = external;
    lineupForm.player_id = p.id;
    search.value = p.name;
    showDropdown.value = false;
}

function openCreateForm() {
    showCreateForm.value = true;
    showDropdown.value = false;
}

watch(lineupTeam, () => {
    search.value = '';
    selectedPlayer.value = null;
    selectedPlayerIsExternal.value = false;
    lineupForm.player_id = '';
    showCreateForm.value = false;
    quickForm.team_id = lineupTeam.value;
});

const lineupForm = useForm({ team_id: lineupTeam.value as number | '', player_id: '' as number | '', is_mvp: false });
const attachForm = useForm({ player_id: '' as number | '', team_id: '' as number | '' });

function addLineup() {
    lineupForm.team_id = lineupTeam.value;
    const doAdd = () => lineupForm.post(`/admin/fixtures/${props.fixture.id}/lineup`, {
        onSuccess: () => {
            lineupForm.reset('player_id', 'is_mvp');
            search.value = '';
            selectedPlayer.value = null;
            selectedPlayerIsExternal.value = false;
        },
    });

    if (selectedPlayerIsExternal.value && selectedPlayer.value) {
        attachForm.player_id = selectedPlayer.value.id;
        attachForm.team_id = lineupTeam.value;
        attachForm.post(`/admin/fixtures/${props.fixture.id}/attach-player`, { onSuccess: doAdd });
    } else {
        doAdd();
    }
}

function removeLineup(lineupId: number) {
    router.delete(`/admin/fixtures/${props.fixture.id}/lineup/${lineupId}`);
}

function submitQuickPlayer() {
    quickForm.team_id = lineupTeam.value;
    quickForm.post(`/admin/fixtures/${props.fixture.id}/quick-player`, {
        onSuccess: () => {
            quickForm.reset('name');
            showCreateForm.value = false;
            search.value = '';
        },
    });
}

// ── Events player search ──────────────────────────────────────────────────────

const eventForm = useForm({
    team_id: props.fixture.home_team.id as number | '',
    player_id: '' as number | '',
    type: 'goal',
    minute: '' as number | '',
});

const eventSearch = ref('');
const showEventDropdown = ref(false);
const showEventCreateForm = ref(false);
const selectedEventPlayer = ref<Player | null>(null);
const selectedEventPlayerIsExternal = ref(false);

const quickEventForm = useForm({ name: '', position: 'forward', team_id: eventForm.team_id as number | '' });
const attachEventForm = useForm({ player_id: '' as number | '', team_id: '' as number | '' });

const filteredEventSquadPlayers = computed(() => {
    const teamId = Number(eventForm.team_id);
    const squad = props.seasonPlayers[teamId] ?? [];
    const q = eventSearch.value.toLowerCase().trim();
    return q ? squad.filter(p => p.name.toLowerCase().includes(q)) : squad;
});

const filteredEventAllPlayers = computed(() => {
    const q = eventSearch.value.toLowerCase().trim();
    if (!q) return [];
    const teamId = Number(eventForm.team_id);
    const squadIds = new Set((props.seasonPlayers[teamId] ?? []).map(p => p.id));
    return props.allPlayers.filter(p => !squadIds.has(p.id) && p.name.toLowerCase().includes(q)).slice(0, 8);
});

function onEventSearchInput() {
    selectedEventPlayer.value = null;
    selectedEventPlayerIsExternal.value = false;
    eventForm.player_id = '';
    showEventDropdown.value = true;
    showEventCreateForm.value = false;
}

function selectEventPlayer(p: Player, external = false) {
    selectedEventPlayer.value = p;
    selectedEventPlayerIsExternal.value = external;
    eventForm.player_id = p.id;
    eventSearch.value = p.name;
    showEventDropdown.value = false;
}

watch(() => eventForm.team_id, () => {
    eventSearch.value = '';
    selectedEventPlayer.value = null;
    selectedEventPlayerIsExternal.value = false;
    eventForm.player_id = '';
    showEventCreateForm.value = false;
    quickEventForm.team_id = eventForm.team_id as number | '';
});

function submitQuickEventPlayer() {
    quickEventForm.team_id = eventForm.team_id as number | '';
    quickEventForm.post(`/admin/fixtures/${props.fixture.id}/quick-player`, {
        onSuccess: () => {
            quickEventForm.reset('name');
            showEventCreateForm.value = false;
            eventSearch.value = '';
        },
    });
}

function addEvent() {
    const doAdd = () => eventForm.post(`/admin/fixtures/${props.fixture.id}/events`, {
        onSuccess: () => {
            eventForm.reset('player_id', 'minute');
            eventSearch.value = '';
            selectedEventPlayer.value = null;
            selectedEventPlayerIsExternal.value = false;
        },
    });

    if (selectedEventPlayerIsExternal.value && selectedEventPlayer.value) {
        attachEventForm.player_id = selectedEventPlayer.value.id;
        attachEventForm.team_id = eventForm.team_id;
        attachEventForm.post(`/admin/fixtures/${props.fixture.id}/attach-player`, { onSuccess: doAdd });
    } else {
        doAdd();
    }
}

function removeEvent(eventId: number) {
    router.delete(`/admin/fixtures/${props.fixture.id}/events/${eventId}`);
}

const eventIcon: Record<string, string> = {
    goal: '⚽', own_goal: '🔴', yellow_card: '🟨', red_card: '🟥',
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
                <div class="flex flex-col items-center">
                    <span class="text-xl font-bold tabular-nums px-4 py-1 bg-slate-100 dark:bg-slate-800 rounded-lg text-slate-900 dark:text-slate-100">
                        {{ fixture.home_score ?? '—' }} : {{ fixture.away_score ?? '—' }}
                    </span>
                    <span v-if="fixture.home_score_pen !== null && fixture.away_score_pen !== null"
                        class="text-xs text-slate-400 mt-0.5 tabular-nums">
                        pen {{ fixture.home_score_pen }}–{{ fixture.away_score_pen }}
                    </span>
                </div>
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
        <div v-if="tab === 'lineup'" class="space-y-3">
            <!-- Team toggle -->
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

            <!-- Player search + add -->
            <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 p-4 space-y-3">
                <div class="flex gap-2 items-start">
                    <div class="relative flex-1">
                        <input
                            v-model="search"
                            @input="onSearchInput"
                            @focus="showDropdown = true"
                            @blur="setTimeout(() => showDropdown = false, 150)"
                            type="text"
                            placeholder="Search player…"
                            class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition"
                        />
                        <ul v-if="showDropdown" class="absolute z-10 mt-1 w-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg shadow-lg max-h-56 overflow-y-auto">
                            <template v-if="filteredSquadPlayers.length">
                                <li class="px-3 py-1 text-xs font-semibold text-slate-400 uppercase tracking-wide bg-slate-50 dark:bg-slate-700/50">In squad</li>
                                <li
                                    v-for="p in filteredSquadPlayers"
                                    :key="p.id"
                                    @mousedown="selectPlayer(p, false)"
                                    class="px-3 py-2 text-sm text-slate-900 dark:text-slate-100 hover:bg-slate-50 dark:hover:bg-slate-700 cursor-pointer flex items-center justify-between"
                                >
                                    <span>{{ p.name }}</span>
                                    <span class="text-xs text-slate-400 capitalize">{{ p.position }}</span>
                                </li>
                            </template>
                            <template v-if="filteredAllPlayers.length">
                                <li class="px-3 py-1 text-xs font-semibold text-slate-400 uppercase tracking-wide bg-slate-50 dark:bg-slate-700/50">Other players</li>
                                <li
                                    v-for="p in filteredAllPlayers"
                                    :key="p.id"
                                    @mousedown="selectPlayer(p, true)"
                                    class="px-3 py-2 text-sm text-slate-900 dark:text-slate-100 hover:bg-slate-50 dark:hover:bg-slate-700 cursor-pointer flex items-center justify-between"
                                >
                                    <span>{{ p.name }}</span>
                                    <span class="text-xs text-slate-400 capitalize">{{ p.position }}</span>
                                </li>
                            </template>
                            <li v-if="!filteredSquadPlayers.length && !filteredAllPlayers.length && search" class="px-3 py-2 text-sm text-slate-400 text-center">No players found</li>
                            <li @mousedown="openCreateForm" class="px-3 py-2 text-sm text-emerald-600 dark:text-emerald-400 hover:bg-emerald-50 dark:hover:bg-emerald-900/20 cursor-pointer flex items-center gap-1.5">
                                <Plus class="size-3.5" /> Create new player
                            </li>
                        </ul>
                    </div>
                    <label class="flex items-center gap-1.5 text-sm text-slate-700 dark:text-slate-300 cursor-pointer pt-2">
                        <input v-model="lineupForm.is_mvp" type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500" />
                        <Star class="size-4 text-yellow-500" /> MVP
                    </label>
                    <button
                        @click="addLineup"
                        :disabled="!lineupForm.player_id || lineupForm.processing"
                        class="flex items-center gap-1 px-3 py-2 rounded-lg bg-emerald-600 text-white text-sm font-medium hover:bg-emerald-700 disabled:opacity-40 transition-colors"
                    >
                        <Plus class="size-4" /> Add
                    </button>
                </div>

                <!-- Quick create form -->
                <div v-if="showCreateForm" class="flex gap-2 items-end p-3 bg-slate-50 dark:bg-slate-800/50 rounded-lg">
                    <div class="flex-1 space-y-1">
                        <label class="text-xs font-medium text-slate-500">Name</label>
                        <input v-model="quickForm.name" type="text" placeholder="Player name" class="w-full px-2.5 py-1.5 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition" />
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-medium text-slate-500">Position</label>
                        <select v-model="quickForm.position" class="px-2.5 py-1.5 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition">
                            <option value="goalkeeper">Goalkeeper</option>
                            <option value="defender">Defender</option>
                            <option value="midfielder">Midfielder</option>
                            <option value="forward">Forward</option>
                        </select>
                    </div>
                    <button @click="submitQuickPlayer" :disabled="!quickForm.name || quickForm.processing" class="px-3 py-1.5 rounded-lg bg-emerald-600 text-white text-sm font-medium hover:bg-emerald-700 disabled:opacity-40 transition-colors">Create</button>
                    <button @click="showCreateForm = false" class="p-1.5 rounded-lg text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 transition-colors"><X class="size-4" /></button>
                </div>
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
        <div v-if="tab === 'events'" class="space-y-3">
            <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 p-4 space-y-3">
                <div class="grid grid-cols-2 gap-3">
                    <div class="space-y-1">
                        <label class="text-xs font-medium text-slate-500">Team</label>
                        <select v-model="eventForm.team_id" class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition">
                            <option :value="fixture.home_team.id">{{ fixture.home_team.name }}</option>
                            <option :value="fixture.away_team.id">{{ fixture.away_team.name }}</option>
                        </select>
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-medium text-slate-500">Event type</label>
                        <select v-model="eventForm.type" class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition">
                            <option value="goal">⚽ Goal</option>
                            <option value="own_goal">🔴 Own goal</option>
                            <option value="yellow_card">🟨 Yellow card</option>
                            <option value="red_card">🟥 Red card</option>
                        </select>
                    </div>
                </div>

                <!-- Event player search -->
                <div class="grid grid-cols-2 gap-3">
                    <div class="space-y-1">
                        <label class="text-xs font-medium text-slate-500">Player</label>
                        <div class="relative">
                            <input
                                v-model="eventSearch"
                                @input="onEventSearchInput"
                                @focus="showEventDropdown = true"
                                @blur="setTimeout(() => showEventDropdown = false, 150)"
                                type="text"
                                placeholder="Search player…"
                                class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition"
                            />
                            <ul v-if="showEventDropdown" class="absolute z-10 mt-1 w-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg shadow-lg max-h-56 overflow-y-auto">
                                <template v-if="filteredEventSquadPlayers.length">
                                    <li class="px-3 py-1 text-xs font-semibold text-slate-400 uppercase tracking-wide bg-slate-50 dark:bg-slate-700/50">In squad</li>
                                    <li v-for="p in filteredEventSquadPlayers" :key="p.id" @mousedown="selectEventPlayer(p, false)" class="px-3 py-2 text-sm text-slate-900 dark:text-slate-100 hover:bg-slate-50 dark:hover:bg-slate-700 cursor-pointer flex items-center justify-between">
                                        <span>{{ p.name }}</span>
                                        <span class="text-xs text-slate-400 capitalize">{{ p.position }}</span>
                                    </li>
                                </template>
                                <template v-if="filteredEventAllPlayers.length">
                                    <li class="px-3 py-1 text-xs font-semibold text-slate-400 uppercase tracking-wide bg-slate-50 dark:bg-slate-700/50">Other players</li>
                                    <li v-for="p in filteredEventAllPlayers" :key="p.id" @mousedown="selectEventPlayer(p, true)" class="px-3 py-2 text-sm text-slate-900 dark:text-slate-100 hover:bg-slate-50 dark:hover:bg-slate-700 cursor-pointer flex items-center justify-between">
                                        <span>{{ p.name }}</span>
                                        <span class="text-xs text-slate-400 capitalize">{{ p.position }}</span>
                                    </li>
                                </template>
                                <li v-if="!filteredEventSquadPlayers.length && !filteredEventAllPlayers.length && eventSearch" class="px-3 py-2 text-sm text-slate-400 text-center">No players found</li>
                                <li @mousedown="showEventCreateForm = true; showEventDropdown = false" class="px-3 py-2 text-sm text-emerald-600 dark:text-emerald-400 hover:bg-emerald-50 dark:hover:bg-emerald-900/20 cursor-pointer flex items-center gap-1.5">
                                    <Plus class="size-3.5" /> Create new player
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-medium text-slate-500">Minute</label>
                        <input v-model.number="eventForm.minute" type="number" min="1" max="120" placeholder="45" class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition" />
                    </div>
                </div>

                <!-- Event quick create -->
                <div v-if="showEventCreateForm" class="flex gap-2 items-end p-3 bg-slate-50 dark:bg-slate-800/50 rounded-lg">
                    <div class="flex-1 space-y-1">
                        <label class="text-xs font-medium text-slate-500">Name</label>
                        <input v-model="quickEventForm.name" type="text" placeholder="Player name" class="w-full px-2.5 py-1.5 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition" />
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-medium text-slate-500">Position</label>
                        <select v-model="quickEventForm.position" class="px-2.5 py-1.5 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition">
                            <option value="goalkeeper">Goalkeeper</option>
                            <option value="defender">Defender</option>
                            <option value="midfielder">Midfielder</option>
                            <option value="forward">Forward</option>
                        </select>
                    </div>
                    <button @click="submitQuickEventPlayer" :disabled="!quickEventForm.name || quickEventForm.processing" class="px-3 py-1.5 rounded-lg bg-emerald-600 text-white text-sm font-medium hover:bg-emerald-700 disabled:opacity-40 transition-colors">Create</button>
                    <button @click="showEventCreateForm = false" class="p-1.5 rounded-lg text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 transition-colors"><X class="size-4" /></button>
                </div>

                <button @click="addEvent" :disabled="!eventForm.player_id || !eventForm.minute || eventForm.processing" class="flex items-center gap-1.5 px-4 py-2 rounded-lg bg-emerald-600 text-white text-sm font-medium hover:bg-emerald-700 disabled:opacity-40 transition-colors">
                    <Plus class="size-4" /> Add event
                </button>
            </div>

            <!-- Events list -->
            <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 overflow-hidden">
                <div v-if="!events.length" class="px-4 py-6 text-center text-sm text-slate-400">
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