<script setup lang="ts">
import { computed } from 'vue';
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
import { Plus, Pencil, Trash2, Users, X } from 'lucide-vue-next';

const props = defineProps<{
    season: {
        id: number;
        name: string;
        format: string;
        status: string;
        track_players: boolean;
        start_date: string | null;
        end_date: string | null;
        division: {
            id: number;
            name: string;
            league: { id: number; name: string };
        };
        teams: { id: number; name: string; city: string | null }[];
        stages: {
            id: number;
            name: string;
            type: string;
            order: number;
            home_away: boolean;
            wins_required: number | null;
            playoff_qualify_count: number | null;
        }[];
    };
    allTeams: { id: number; name: string }[];
}>();

defineOptions({ layout: AdminLayout });

const attachedIds = computed(() => new Set(props.season.teams.map((t) => t.id)));
const availableTeams = computed(() => props.allTeams.filter((t) => !attachedIds.value.has(t.id)));

const attachForm = useForm({ team_id: '' });

function attachTeam() {
    if (!attachForm.team_id) return;
    attachForm.post(`/admin/seasons/${props.season.id}/teams`, {
        onSuccess: () => { attachForm.reset(); },
    });
}

function detachTeam(teamId: number) {
    router.delete(`/admin/seasons/${props.season.id}/teams/${teamId}`);
}

const statusBadge: Record<string, string> = {
    upcoming: 'bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-400',
    active: 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400',
    completed: 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400',
};

const typeBadge: Record<string, string> = {
    league: 'bg-violet-100 text-violet-700 dark:bg-violet-900/30 dark:text-violet-400',
    group: 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400',
    knockout: 'bg-rose-100 text-rose-700 dark:bg-rose-900/30 dark:text-rose-400',
};

function destroyStage(id: number) {
    if (confirm('Delete this stage? All rounds and fixtures in it will also be deleted.')) {
        router.delete(`/admin/stages/${id}`);
    }
}
</script>

<template>
    <Head :title="season.name" />

    <div class="p-6 space-y-6">
        <!-- Header -->
        <div class="flex items-start justify-between gap-4">
            <div>
                <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400 mb-1 flex-wrap">
                    <Link href="/admin/leagues" class="hover:text-slate-700 dark:hover:text-slate-300">Leagues</Link>
                    <span>/</span>
                    <Link :href="`/admin/leagues/${season.division.league.id}`" class="hover:text-slate-700 dark:hover:text-slate-300">{{ season.division.league.name }}</Link>
                    <span>/</span>
                    <Link :href="`/admin/divisions/${season.division.id}`" class="hover:text-slate-700 dark:hover:text-slate-300">{{ season.division.name }}</Link>
                    <span>/</span>
                    <span>{{ season.name }}</span>
                </div>
                <h1 class="text-xl font-bold text-slate-900 dark:text-slate-100">{{ season.name }}</h1>

                <div class="flex items-center gap-3 mt-2 flex-wrap">
                    <span :class="['text-xs px-2 py-0.5 rounded-full font-medium capitalize', statusBadge[season.status] ?? '']">
                        {{ season.status }}
                    </span>
                    <span class="text-sm text-slate-500 dark:text-slate-400 capitalize">
                        {{ season.format.replace('_', ' ') }}
                    </span>
                    <span v-if="season.start_date || season.end_date" class="text-sm text-slate-400 dark:text-slate-500">
                        {{ season.start_date ? new Date(season.start_date).toLocaleDateString('en-GB', { day: 'numeric', month: 'short', year: 'numeric' }) : '?' }}
                        –
                        {{ season.end_date ? new Date(season.end_date).toLocaleDateString('en-GB', { day: 'numeric', month: 'short', year: 'numeric' }) : '?' }}
                    </span>
                    <span v-if="season.track_players" class="text-xs px-2 py-0.5 rounded-full bg-sky-100 text-sky-700 dark:bg-sky-900/30 dark:text-sky-400 font-medium">
                        Tracks players
                    </span>
                </div>
            </div>

            <div class="flex items-center gap-2 shrink-0">
                <Link
                    :href="`/admin/seasons/${season.id}/squad`"
                    class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-slate-300 dark:border-slate-700 text-sm font-medium text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors"
                >
                    <Users class="size-4" /> Squad
                </Link>
                <Link
                    :href="`/admin/seasons/${season.id}/edit`"
                    class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-slate-300 dark:border-slate-700 text-sm font-medium text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors"
                >
                    <Pencil class="size-4" /> Edit season
                </Link>
            </div>
        </div>

        <!-- Stages -->
        <div class="space-y-3">
            <div class="flex items-center justify-between">
                <h2 class="text-base font-semibold text-slate-800 dark:text-slate-200">Stages</h2>
                <Link
                    :href="`/admin/stages/create?season_id=${season.id}`"
                    class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-600 text-white text-sm font-medium hover:bg-emerald-700 transition-colors"
                >
                    <Plus class="size-4" /> New stage
                </Link>
            </div>

            <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="border-b border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/50">
                        <tr>
                            <th class="text-left px-4 py-3 font-medium text-slate-500 dark:text-slate-400 w-8">#</th>
                            <th class="text-left px-4 py-3 font-medium text-slate-500 dark:text-slate-400">Name</th>
                            <th class="text-left px-4 py-3 font-medium text-slate-500 dark:text-slate-400">Type</th>
                            <th class="text-left px-4 py-3 font-medium text-slate-500 dark:text-slate-400 hidden sm:table-cell">Home & Away</th>
                            <th class="text-left px-4 py-3 font-medium text-slate-500 dark:text-slate-400 hidden md:table-cell">Wins required</th>
                            <th class="px-4 py-3 w-20"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                        <tr
                            v-for="stage in season.stages"
                            :key="stage.id"
                            class="hover:bg-slate-50 dark:hover:bg-slate-800/40 transition-colors"
                        >
                            <td class="px-4 py-3 text-slate-400 dark:text-slate-500 text-xs">{{ stage.order }}</td>
                            <td class="px-4 py-3 font-medium text-slate-900 dark:text-slate-100">
                                <Link :href="`/admin/stages/${stage.id}`" class="hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors">{{ stage.name }}</Link>
                            </td>
                            <td class="px-4 py-3">
                                <span :class="['text-xs px-2 py-0.5 rounded-full font-medium capitalize', typeBadge[stage.type] ?? '']">
                                    {{ stage.type }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-slate-500 dark:text-slate-400 hidden sm:table-cell">
                                {{ stage.home_away ? 'Yes' : 'No' }}
                            </td>
                            <td class="px-4 py-3 text-slate-500 dark:text-slate-400 hidden md:table-cell">
                                {{ stage.wins_required ?? '—' }}
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-1 justify-end">
                                    <Link
                                        :href="`/admin/stages/${stage.id}/edit`"
                                        class="p-1.5 rounded text-slate-400 hover:text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors"
                                    >
                                        <Pencil class="size-4" />
                                    </Link>
                                    <button
                                        @click="destroyStage(stage.id)"
                                        class="p-1.5 rounded text-slate-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors"
                                    >
                                        <Trash2 class="size-4" />
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr v-if="season.stages.length === 0">
                            <td colspan="6" class="px-4 py-8 text-center text-slate-500 dark:text-slate-400">No stages yet</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Teams -->
        <div class="space-y-3">
            <h2 class="text-base font-semibold text-slate-800 dark:text-slate-200">
                Teams <span class="text-sm font-normal text-slate-400">({{ season.teams.length }})</span>
            </h2>

            <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 overflow-hidden">
                <div v-if="season.teams.length > 0" class="divide-y divide-slate-100 dark:divide-slate-800">
                    <div
                        v-for="team in season.teams"
                        :key="team.id"
                        class="flex items-center justify-between px-4 py-2.5"
                    >
                        <Link :href="`/admin/seasons/${season.id}/teams/${team.id}`" class="text-sm font-medium text-slate-900 dark:text-slate-100 hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors">{{ team.name }}</Link>
                        <button
                            @click="detachTeam(team.id)"
                            class="p-1 rounded text-slate-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors"
                            title="Remove from season"
                        >
                            <X class="size-4" />
                        </button>
                    </div>
                </div>
                <p v-else class="px-4 py-6 text-sm text-center text-slate-400 dark:text-slate-500">No teams added yet</p>

                <!-- Attach form -->
                <div class="border-t border-slate-100 dark:border-slate-800 px-4 py-3 flex gap-2">
                    <select
                        v-model="attachForm.team_id"
                        class="flex-1 px-3 py-1.5 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition"
                    >
                        <option value="">Add a team…</option>
                        <option v-for="team in availableTeams" :key="team.id" :value="team.id">{{ team.name }}</option>
                    </select>
                    <button
                        @click="attachTeam"
                        :disabled="!attachForm.team_id || attachForm.processing"
                        class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-600 text-white text-sm font-medium hover:bg-emerald-700 disabled:opacity-40 transition-colors"
                    >
                        <Plus class="size-4" /> Add
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>