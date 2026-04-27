<script setup lang="ts">
import { Head, Link, useForm, router } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
import { ChevronRight, Plus, Trash2, UserCheck } from 'lucide-vue-next';
import { ref, computed } from 'vue';

const props = defineProps<{
    season: {
        id: number; name: string;
        division: { name: string; league: { name: string } };
        teams: { id: number; name: string }[];
        track_players: boolean;
    };
    squads: Record<number, {
        id: number;
        shirt_number: number | null;
        joined_at: string | null;
        left_at: string | null;
        team: { id: number; name: string };
        player: { id: number; name: string; position: string | null };
    }[]>;
    players: { id: number; name: string; position: string | null }[];
}>();

defineOptions({ layout: AdminLayout });

const selectedTeam = ref<number>(props.season.teams[0]?.id ?? 0);

const form = useForm({
    player_id: '',
    team_id: selectedTeam,
    shirt_number: '',
    joined_at: '',
});

const currentSquad = computed(() =>
    props.squads[selectedTeam.value] ?? []
);

const assignedPlayerIds = computed(() =>
    new Set(currentSquad.value.filter(r => r.left_at === null).map(r => r.player.id))
);

const availablePlayers = computed(() =>
    props.players.filter(p => !assignedPlayerIds.value.has(p.id))
);

const departureEditId = ref<number | null>(null);
const departureDate = ref('');

function submit() {
    form.team_id = selectedTeam.value as any;
    form.post(`/admin/seasons/${props.season.id}/squad`, {
        onSuccess: () => { form.reset('player_id', 'shirt_number', 'joined_at'); },
    });
}

function openDepartureEdit(reg: { id: number; left_at: string | null }) {
    departureEditId.value = reg.id;
    departureDate.value = reg.left_at ?? '';
}

function saveDeparture(registrationId: number) {
    router.patch(
        `/admin/seasons/${props.season.id}/squad/${registrationId}`,
        { left_at: departureDate.value || null },
        { onSuccess: () => { departureEditId.value = null; } },
    );
}

function remove(registrationId: number) {
    router.delete(`/admin/seasons/${props.season.id}/squad/${registrationId}`);
}

const positionBadge: Record<string, string> = {
    goalkeeper: 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400',
    defender: 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400',
    midfielder: 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400',
    forward: 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400',
};
</script>

<template>
    <Head :title="`Squad — ${season.name}`" />

    <div class="p-6 space-y-5 max-w-3xl">
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-1.5 text-sm text-slate-500 dark:text-slate-400">
            <Link href="/admin/seasons" class="hover:text-slate-700 dark:hover:text-slate-200 transition-colors">Seasons</Link>
            <ChevronRight class="size-4" />
            <span class="text-slate-900 dark:text-slate-100">{{ season.name }} — Squad</span>
        </nav>

        <div>
            <h1 class="text-xl font-bold text-slate-900 dark:text-slate-100">
                {{ season.division.league.name }} · {{ season.name }}
            </h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-0.5">Manage player registrations per team</p>
            <div v-if="!season.track_players" class="mt-2 inline-flex items-center gap-1.5 text-xs px-2.5 py-1 rounded-full bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400">
                ⚠ Player tracking is disabled for this season — enable it in season settings for stats to appear publicly.
            </div>
        </div>

        <!-- Team tabs -->
        <div class="flex gap-1 bg-slate-100 dark:bg-slate-800 rounded-xl p-1 w-fit flex-wrap">
            <button
                v-for="team in season.teams"
                :key="team.id"
                @click="selectedTeam = team.id"
                :class="[
                    'px-3 py-1.5 rounded-lg text-sm font-medium transition-colors',
                    selectedTeam === team.id
                        ? 'bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100 shadow-sm'
                        : 'text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-300',
                ]"
            >
                {{ team.name }}
                <span class="ml-1 text-xs opacity-60">{{ (squads[team.id] ?? []).length }}</span>
            </button>
        </div>

        <!-- Add player form -->
        <form @submit.prevent="submit" class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 p-4 flex flex-wrap gap-3 items-end">
            <div class="flex-1 min-w-40 space-y-1">
                <label class="text-xs font-medium text-slate-500 dark:text-slate-400">Player</label>
                <select
                    v-model="form.player_id"
                    class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition"
                >
                    <option value="">Select player…</option>
                    <option v-for="p in availablePlayers" :key="p.id" :value="p.id">
                        {{ p.name }}{{ p.position ? ` (${p.position})` : '' }}
                    </option>
                </select>
            </div>
            <div class="w-24 space-y-1">
                <label class="text-xs font-medium text-slate-500 dark:text-slate-400">Shirt #</label>
                <input
                    v-model.number="form.shirt_number"
                    type="number" min="1" max="99"
                    class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition"
                    placeholder="10"
                />
            </div>
            <div class="space-y-1">
                <label class="text-xs font-medium text-slate-500 dark:text-slate-400">Join date</label>
                <input
                    v-model="form.joined_at"
                    type="date"
                    class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition"
                />
            </div>
            <button
                type="submit"
                :disabled="!form.player_id || form.processing"
                class="flex items-center gap-1.5 px-4 py-2 rounded-lg bg-emerald-600 text-white text-sm font-medium hover:bg-emerald-700 disabled:opacity-40 transition-colors"
            >
                <Plus class="size-4" /> Add
            </button>
        </form>

        <!-- Current squad -->
        <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 overflow-hidden">
            <div class="px-4 py-3 border-b border-slate-100 dark:border-slate-800 flex items-center gap-2">
                <UserCheck class="size-4 text-emerald-600" />
                <span class="font-medium text-sm text-slate-900 dark:text-slate-100">
                    {{ season.teams.find(t => t.id === selectedTeam)?.name ?? '' }}
                </span>
                <span class="text-xs text-slate-400 ml-auto">{{ currentSquad.length }} players</span>
            </div>

            <div v-if="currentSquad.length === 0" class="px-4 py-8 text-center text-sm text-slate-400">
                No players registered yet.
            </div>

            <div v-else class="divide-y divide-slate-100 dark:divide-slate-800">
                <div
                    v-for="reg in currentSquad"
                    :key="reg.id"
                    :class="['flex items-center gap-3 px-4 py-2.5 transition-colors', reg.left_at ? 'opacity-50' : 'hover:bg-slate-50 dark:hover:bg-slate-800/40']"
                >
                    <span class="w-7 text-center text-sm font-bold text-slate-400">
                        {{ reg.shirt_number ?? '—' }}
                    </span>
                    <span class="flex-1 text-sm font-medium text-slate-900 dark:text-slate-100">
                        {{ reg.player.name }}
                    </span>
                    <span
                        v-if="reg.player.position"
                        :class="['text-xs px-2 py-0.5 rounded-full font-medium capitalize', positionBadge[reg.player.position] ?? 'bg-slate-100 text-slate-600']"
                    >
                        {{ reg.player.position }}
                    </span>
                    <template v-if="departureEditId === reg.id">
                        <input
                            v-model="departureDate"
                            type="date"
                            class="px-2 py-1 rounded border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-xs focus:outline-none focus:ring-1 focus:ring-emerald-500"
                        />
                        <button @click="saveDeparture(reg.id)" class="text-xs px-2 py-1 rounded bg-emerald-600 text-white hover:bg-emerald-700">Save</button>
                        <button @click="departureEditId = null" class="text-xs text-slate-400 hover:text-slate-600">Cancel</button>
                    </template>
                    <template v-else>
                        <button
                            @click="openDepartureEdit(reg)"
                            :class="['text-xs transition-colors', reg.left_at ? 'text-orange-500' : 'text-slate-300 hover:text-slate-500']"
                            :title="reg.left_at ? `Departed: ${reg.left_at}` : 'Set departure date'"
                        >
                            {{ reg.left_at ?? 'Transfer out' }}
                        </button>
                    </template>
                    <button
                        @click="remove(reg.id)"
                        class="p-1 rounded text-slate-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors"
                    >
                        <Trash2 class="size-3.5" />
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>