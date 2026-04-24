<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
import { Plus, Pencil, Trash2 } from 'lucide-vue-next';

defineProps<{
    stage: {
        id: number;
        name: string;
        type: string;
        order: number;
        home_away: boolean;
        wins_required: number | null;
        playoff_qualify_count: number | null;
        season: {
            id: number;
            name: string;
            division: { id: number; name: string; league: { id: number; name: string } };
        };
        rounds: {
            id: number;
            name: string;
            order: number;
            home_away: boolean | null;
            fixtures_count: number;
        }[];
    };
}>();

defineOptions({ layout: AdminLayout });

const typeBadge: Record<string, string> = {
    league: 'bg-violet-100 text-violet-700 dark:bg-violet-900/30 dark:text-violet-400',
    group: 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400',
    knockout: 'bg-rose-100 text-rose-700 dark:bg-rose-900/30 dark:text-rose-400',
};

function destroyRound(id: number) {
    if (confirm('Delete this round? All fixtures in it will also be deleted.')) {
        router.delete(`/admin/rounds/${id}`);
    }
}
</script>

<template>
    <Head :title="stage.name" />

    <div class="p-6 space-y-6">
        <!-- Header -->
        <div class="flex items-start justify-between gap-4">
            <div>
                <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400 mb-1 flex-wrap">
                    <Link href="/admin/leagues" class="hover:text-slate-700 dark:hover:text-slate-300">Leagues</Link>
                    <span>/</span>
                    <Link :href="`/admin/leagues/${stage.season.division.league.id}`" class="hover:text-slate-700 dark:hover:text-slate-300">{{ stage.season.division.league.name }}</Link>
                    <span>/</span>
                    <Link :href="`/admin/divisions/${stage.season.division.id}`" class="hover:text-slate-700 dark:hover:text-slate-300">{{ stage.season.division.name }}</Link>
                    <span>/</span>
                    <Link :href="`/admin/seasons/${stage.season.id}`" class="hover:text-slate-700 dark:hover:text-slate-300">{{ stage.season.name }}</Link>
                    <span>/</span>
                    <span>{{ stage.name }}</span>
                </div>

                <h1 class="text-xl font-bold text-slate-900 dark:text-slate-100">{{ stage.name }}</h1>

                <div class="flex items-center gap-3 mt-2 flex-wrap">
                    <span :class="['text-xs px-2 py-0.5 rounded-full font-medium capitalize', typeBadge[stage.type] ?? '']">
                        {{ stage.type }}
                    </span>
                    <span class="text-sm text-slate-500 dark:text-slate-400">
                        {{ stage.home_away ? 'Home & away' : 'Single leg' }}
                    </span>
                    <span v-if="stage.wins_required" class="text-sm text-slate-500 dark:text-slate-400">
                        First to {{ stage.wins_required }} wins
                    </span>
                    <span v-if="stage.playoff_qualify_count" class="text-sm text-slate-500 dark:text-slate-400">
                        Top {{ stage.playoff_qualify_count }} qualify
                    </span>
                </div>
            </div>

            <Link
                :href="`/admin/stages/${stage.id}/edit`"
                class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-slate-300 dark:border-slate-700 text-sm font-medium text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors shrink-0"
            >
                <Pencil class="size-4" /> Edit stage
            </Link>
        </div>

        <!-- Rounds -->
        <div class="space-y-3">
            <div class="flex items-center justify-between">
                <h2 class="text-base font-semibold text-slate-800 dark:text-slate-200">Rounds</h2>
                <Link
                    :href="`/admin/rounds/create?stage_id=${stage.id}`"
                    class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-600 text-white text-sm font-medium hover:bg-emerald-700 transition-colors"
                >
                    <Plus class="size-4" /> New round
                </Link>
            </div>

            <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="border-b border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/50">
                        <tr>
                            <th class="text-left px-4 py-3 font-medium text-slate-500 dark:text-slate-400 w-8">#</th>
                            <th class="text-left px-4 py-3 font-medium text-slate-500 dark:text-slate-400">Name</th>
                            <th class="text-left px-4 py-3 font-medium text-slate-500 dark:text-slate-400 hidden sm:table-cell">Home & Away</th>
                            <th class="text-left px-4 py-3 font-medium text-slate-500 dark:text-slate-400 hidden sm:table-cell">Fixtures</th>
                            <th class="px-4 py-3 w-20"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                        <tr
                            v-for="round in stage.rounds"
                            :key="round.id"
                            class="hover:bg-slate-50 dark:hover:bg-slate-800/40 transition-colors"
                        >
                            <td class="px-4 py-3 text-slate-400 dark:text-slate-500 text-xs">{{ round.order }}</td>
                            <td class="px-4 py-3 font-medium text-slate-900 dark:text-slate-100">
                                <Link :href="`/admin/rounds/${round.id}`" class="hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors">{{ round.name }}</Link>
                            </td>
                            <td class="px-4 py-3 text-slate-500 dark:text-slate-400 hidden sm:table-cell">
                                {{ round.home_away === null ? 'Inherit' : round.home_away ? 'Yes' : 'No' }}
                            </td>
                            <td class="px-4 py-3 text-slate-500 dark:text-slate-400 hidden sm:table-cell">{{ round.fixtures_count }}</td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-1 justify-end">
                                    <Link
                                        :href="`/admin/rounds/${round.id}/edit`"
                                        class="p-1.5 rounded text-slate-400 hover:text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors"
                                    >
                                        <Pencil class="size-4" />
                                    </Link>
                                    <button
                                        @click="destroyRound(round.id)"
                                        class="p-1.5 rounded text-slate-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors"
                                    >
                                        <Trash2 class="size-4" />
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr v-if="stage.rounds.length === 0">
                            <td colspan="5" class="px-4 py-8 text-center text-slate-500 dark:text-slate-400">No rounds yet</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>