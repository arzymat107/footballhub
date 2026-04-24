<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
import { Plus, Pencil, Trash2 } from 'lucide-vue-next';

defineProps<{
    league: {
        id: number;
        name: string;
        country: string | null;
        description: string | null;
        divisions: {
            id: number;
            name: string;
            level: number;
            seasons_count: number;
        }[];
    };
}>();

defineOptions({ layout: AdminLayout });

function destroyDivision(id: number) {
    if (confirm('Delete this division?')) {
        router.delete(`/admin/divisions/${id}`);
    }
}
</script>

<template>
    <Head :title="league.name" />

    <div class="p-6 space-y-6">
        <!-- Header -->
        <div class="flex items-start justify-between gap-4">
            <div>
                <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400 mb-1">
                    <Link href="/admin/leagues" class="hover:text-slate-700 dark:hover:text-slate-300">Leagues</Link>
                    <span>/</span>
                    <span>{{ league.name }}</span>
                </div>
                <h1 class="text-xl font-bold text-slate-900 dark:text-slate-100">{{ league.name }}</h1>
                <p v-if="league.country" class="text-sm text-slate-500 dark:text-slate-400 mt-0.5">{{ league.country }}</p>
                <p v-if="league.description" class="text-sm text-slate-600 dark:text-slate-300 mt-2 max-w-prose">{{ league.description }}</p>
            </div>
            <Link
                :href="`/admin/leagues/${league.id}/edit`"
                class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-slate-300 dark:border-slate-700 text-sm font-medium text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors shrink-0"
            >
                <Pencil class="size-4" /> Edit league
            </Link>
        </div>

        <!-- Divisions -->
        <div class="space-y-3">
            <div class="flex items-center justify-between">
                <h2 class="text-base font-semibold text-slate-800 dark:text-slate-200">Divisions</h2>
                <Link
                    :href="`/admin/divisions/create?league_id=${league.id}`"
                    class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-600 text-white text-sm font-medium hover:bg-emerald-700 transition-colors"
                >
                    <Plus class="size-4" /> New division
                </Link>
            </div>

            <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="border-b border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/50">
                        <tr>
                            <th class="text-left px-4 py-3 font-medium text-slate-500 dark:text-slate-400">Name</th>
                            <th class="text-left px-4 py-3 font-medium text-slate-500 dark:text-slate-400">Level</th>
                            <th class="text-left px-4 py-3 font-medium text-slate-500 dark:text-slate-400 hidden sm:table-cell">Seasons</th>
                            <th class="px-4 py-3 w-20"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                        <tr
                            v-for="division in league.divisions"
                            :key="division.id"
                            class="hover:bg-slate-50 dark:hover:bg-slate-800/40 transition-colors"
                        >
                            <td class="px-4 py-3 font-medium text-slate-900 dark:text-slate-100">
                                <Link :href="`/admin/divisions/${division.id}`" class="hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors">{{ division.name }}</Link>
                            </td>
                            <td class="px-4 py-3 text-slate-500 dark:text-slate-400">{{ division.level }}</td>
                            <td class="px-4 py-3 text-slate-500 dark:text-slate-400 hidden sm:table-cell">{{ division.seasons_count }}</td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-1 justify-end">
                                    <Link
                                        :href="`/admin/divisions/${division.id}/edit`"
                                        class="p-1.5 rounded text-slate-400 hover:text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors"
                                    >
                                        <Pencil class="size-4" />
                                    </Link>
                                    <button
                                        @click="destroyDivision(division.id)"
                                        class="p-1.5 rounded text-slate-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors"
                                    >
                                        <Trash2 class="size-4" />
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr v-if="league.divisions.length === 0">
                            <td colspan="4" class="px-4 py-8 text-center text-slate-500 dark:text-slate-400">No divisions yet</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>