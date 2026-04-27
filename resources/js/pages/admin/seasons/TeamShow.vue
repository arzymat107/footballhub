<script setup lang="ts">
import { computed, ref } from 'vue';
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
import { Trash2, Plus } from 'lucide-vue-next';

const props = defineProps<{
    season: {
        id: number;
        name: string;
        division: { id: number; name: string; league: { id: number; name: string } };
    };
    team: { id: number; name: string; city: string | null };
    registrations: {
        id: number;
        shirt_number: number | null;
        joined_at: string | null;
        left_at: string | null;
        player: { id: number; name: string; position: string; nationality: string | null };
    }[];
    availablePlayers: { id: number; name: string; position: string }[];
}>();

defineOptions({ layout: AdminLayout });

const positionBadge: Record<string, string> = {
    goalkeeper: 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400',
    defender: 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400',
    midfielder: 'bg-violet-100 text-violet-700 dark:bg-violet-900/30 dark:text-violet-400',
    forward: 'bg-rose-100 text-rose-700 dark:bg-rose-900/30 dark:text-rose-400',
};

const addForm = useForm({ player_id: '', shirt_number: '', joined_at: '' });
const search = ref('');
const selectedPlayer = ref<{ id: number; name: string; position: string } | null>(null);
const departureEditId = ref<number | null>(null);
const departureDate = ref('');

const filteredPlayers = computed(() => {
    const q = search.value.toLowerCase().trim();
    return q ? props.availablePlayers.filter((p) => p.name.toLowerCase().includes(q)) : props.availablePlayers;
});

function selectPlayer(player: { id: number; name: string; position: string }) {
    selectedPlayer.value = player;
    addForm.player_id = String(player.id);
    search.value = player.name;
    showDropdown.value = false;
}

const showDropdown = ref(false);

function onSearchInput() {
    selectedPlayer.value = null;
    addForm.player_id = '';
    showDropdown.value = true;
}

function addPlayer() {
    if (!addForm.player_id) return;
    addForm.post(`/admin/seasons/${props.season.id}/teams/${props.team.id}/players`, {
        onSuccess: () => {
            addForm.reset();
            search.value = '';
            selectedPlayer.value = null;
        },
    });
}

function openDepartureEdit(reg: { id: number; left_at: string | null }) {
    departureEditId.value = reg.id;
    departureDate.value = reg.left_at ?? '';
}

function saveDeparture(registrationId: number) {
    router.patch(
        `/admin/seasons/${props.season.id}/teams/${props.team.id}/players/${registrationId}`,
        { left_at: departureDate.value || null },
        { onSuccess: () => { departureEditId.value = null; } },
    );
}

function removePlayer(registrationId: number) {
    router.delete(`/admin/seasons/${props.season.id}/teams/${props.team.id}/players/${registrationId}`);
}
</script>

<template>
    <Head :title="`${team.name} — ${season.name}`" />

    <div class="p-6 space-y-6">
        <!-- Header -->
        <div>
            <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400 mb-1 flex-wrap">
                <Link href="/admin/leagues" class="hover:text-slate-700 dark:hover:text-slate-300">Leagues</Link>
                <span>/</span>
                <Link :href="`/admin/leagues/${season.division.league.id}`" class="hover:text-slate-700 dark:hover:text-slate-300">{{ season.division.league.name }}</Link>
                <span>/</span>
                <Link :href="`/admin/divisions/${season.division.id}`" class="hover:text-slate-700 dark:hover:text-slate-300">{{ season.division.name }}</Link>
                <span>/</span>
                <Link :href="`/admin/seasons/${season.id}`" class="hover:text-slate-700 dark:hover:text-slate-300">{{ season.name }}</Link>
                <span>/</span>
                <span>{{ team.name }}</span>
            </div>
            <h1 class="text-xl font-bold text-slate-900 dark:text-slate-100">{{ team.name }}</h1>
            <p v-if="team.city" class="text-sm text-slate-500 dark:text-slate-400 mt-0.5">{{ team.city }}</p>
        </div>

        <!-- Players -->
        <div class="space-y-3">
            <h2 class="text-base font-semibold text-slate-800 dark:text-slate-200">
                Squad <span class="text-sm font-normal text-slate-400">({{ registrations.length }})</span>
            </h2>

            <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="border-b border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/50">
                        <tr>
                            <th class="text-left px-4 py-3 font-medium text-slate-500 dark:text-slate-400 w-12">#</th>
                            <th class="text-left px-4 py-3 font-medium text-slate-500 dark:text-slate-400">Name</th>
                            <th class="text-left px-4 py-3 font-medium text-slate-500 dark:text-slate-400">Position</th>
                            <th class="text-left px-4 py-3 font-medium text-slate-500 dark:text-slate-400 hidden sm:table-cell">Joined</th>
                            <th class="text-left px-4 py-3 font-medium text-slate-500 dark:text-slate-400 hidden sm:table-cell">Departed</th>
                            <th class="px-4 py-3 w-12"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                        <tr
                            v-for="reg in registrations"
                            :key="reg.id"
                            :class="['transition-colors', reg.left_at ? 'opacity-50' : 'hover:bg-slate-50 dark:hover:bg-slate-800/40']"
                        >
                            <td class="px-4 py-3 text-slate-400 dark:text-slate-500">{{ reg.shirt_number ?? '—' }}</td>
                            <td class="px-4 py-3 font-medium text-slate-900 dark:text-slate-100">{{ reg.player.name }}</td>
                            <td class="px-4 py-3">
                                <span :class="['text-xs px-2 py-0.5 rounded-full font-medium capitalize', positionBadge[reg.player.position] ?? '']">
                                    {{ reg.player.position }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-slate-500 dark:text-slate-400 hidden sm:table-cell text-sm">
                                {{ reg.joined_at ?? '—' }}
                            </td>
                            <td class="px-4 py-3 hidden sm:table-cell text-sm">
                                <template v-if="departureEditId === reg.id">
                                    <div class="flex items-center gap-1">
                                        <input
                                            v-model="departureDate"
                                            type="date"
                                            class="px-2 py-1 rounded border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-xs focus:outline-none focus:ring-1 focus:ring-emerald-500"
                                        />
                                        <button @click="saveDeparture(reg.id)" class="text-xs px-2 py-1 rounded bg-emerald-600 text-white hover:bg-emerald-700">Save</button>
                                        <button @click="departureEditId = null" class="text-xs px-2 py-1 rounded text-slate-400 hover:text-slate-600">Cancel</button>
                                    </div>
                                </template>
                                <template v-else>
                                    <button
                                        @click="openDepartureEdit(reg)"
                                        class="text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-200 transition-colors"
                                    >
                                        {{ reg.left_at ?? 'Set departure' }}
                                    </button>
                                </template>
                            </td>
                            <td class="px-4 py-3">
                                <button
                                    @click="removePlayer(reg.id)"
                                    class="p-1.5 rounded text-slate-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors"
                                >
                                    <Trash2 class="size-4" />
                                </button>
                            </td>
                        </tr>
                        <tr v-if="registrations.length === 0">
                            <td colspan="6" class="px-4 py-8 text-center text-slate-500 dark:text-slate-400">No players registered yet</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Add player form — outside overflow-hidden card so dropdown is visible -->
            <div class="flex gap-2">
                <div class="relative flex-1">
                    <input
                        v-model="search"
                        @input="onSearchInput"
                        @focus="showDropdown = true"
                        @blur="setTimeout(() => showDropdown = false, 150)"
                        type="text"
                        placeholder="Search player…"
                        class="w-full px-3 py-1.5 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition"
                    />
                    <ul
                        v-if="showDropdown && filteredPlayers.length > 0"
                        class="absolute z-10 mt-1 w-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg shadow-lg max-h-48 overflow-y-auto"
                    >
                        <li
                            v-for="p in filteredPlayers"
                            :key="p.id"
                            @mousedown="selectPlayer(p)"
                            class="px-3 py-2 text-sm text-slate-900 dark:text-slate-100 hover:bg-slate-50 dark:hover:bg-slate-700 cursor-pointer flex items-center justify-between"
                        >
                            <span>{{ p.name }}</span>
                            <span class="text-xs text-slate-400 capitalize">{{ p.position }}</span>
                        </li>
                    </ul>
                    <p v-if="showDropdown && search && filteredPlayers.length === 0" class="absolute z-10 mt-1 w-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg shadow-lg px-3 py-2 text-sm text-slate-400">
                        No players found
                    </p>
                </div>
                <input
                    v-model.number="addForm.shirt_number"
                    type="number"
                    min="1"
                    max="99"
                    placeholder="#"
                    class="w-16 px-3 py-1.5 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm text-center focus:outline-none focus:ring-2 focus:ring-emerald-500 transition"
                />
                <input
                    v-model="addForm.joined_at"
                    type="date"
                    title="Join date (optional)"
                    class="px-3 py-1.5 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition"
                />
                <button
                    @click="addPlayer"
                    :disabled="!addForm.player_id || addForm.processing"
                    class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-600 text-white text-sm font-medium hover:bg-emerald-700 disabled:opacity-40 transition-colors"
                >
                    <Plus class="size-4" /> Add
                </button>
            </div>
        </div>
    </div>
</template>