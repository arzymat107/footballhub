<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
import { Plus, Pencil, Trash2, Users } from 'lucide-vue-next';

defineProps<{
    seasons: {
        data: {
            id: number; name: string; format: string; status: string;
            start_date: string | null; end_date: string | null;
            division: { id: number; name: string; league: { name: string } };
        }[];
        links: { url: string | null; label: string; active: boolean }[];
    };
}>();

defineOptions({ layout: AdminLayout });

const statusBadge: Record<string, string> = {
    upcoming: 'bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-400',
    active: 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400',
    completed: 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400',
};

function destroy(id: number) {
    if (confirm('Delete this season?')) {
        router.delete(`/admin/seasons/${id}`);
    }
}
</script>

<template>
    <Head title="Seasons" />

    <div class="p-6 space-y-4">
        <div class="flex items-center justify-between">
            <h1 class="text-xl font-bold text-slate-900 dark:text-slate-100">Seasons</h1>
            <Link href="/admin/seasons/create" class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-600 text-white text-sm font-medium hover:bg-emerald-700 transition-colors">
                <Plus class="size-4" /> New season
            </Link>
        </div>

        <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="border-b border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/50">
                        <tr>
                            <th class="text-left px-4 py-3 font-medium text-slate-500 dark:text-slate-400">Season</th>
                            <th class="text-left px-4 py-3 font-medium text-slate-500 dark:text-slate-400 hidden sm:table-cell">Division</th>
                            <th class="text-left px-4 py-3 font-medium text-slate-500 dark:text-slate-400 hidden md:table-cell">Format</th>
                            <th class="text-left px-4 py-3 font-medium text-slate-500 dark:text-slate-400">Status</th>
                            <th class="px-4 py-3 w-20"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                        <tr v-for="season in seasons.data" :key="season.id" class="hover:bg-slate-50 dark:hover:bg-slate-800/40 transition-colors">
                            <td class="px-4 py-3">
                                <p class="font-medium text-slate-900 dark:text-slate-100">{{ season.name }}</p>
                                <p class="text-xs text-slate-400 sm:hidden">{{ season.division.league.name }}</p>
                            </td>
                            <td class="px-4 py-3 text-slate-500 dark:text-slate-400 hidden sm:table-cell">
                                {{ season.division.league.name }} / {{ season.division.name }}
                            </td>
                            <td class="px-4 py-3 text-slate-500 dark:text-slate-400 hidden md:table-cell capitalize">
                                {{ season.format.replace('_', ' ') }}
                            </td>
                            <td class="px-4 py-3">
                                <span :class="['text-xs px-2 py-0.5 rounded-full font-medium capitalize', statusBadge[season.status] ?? '']">
                                    {{ season.status }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-1 justify-end">
                                    <Link :href="`/admin/seasons/${season.id}/squad`" class="p-1.5 rounded text-slate-400 hover:text-emerald-600 hover:bg-emerald-50 dark:hover:bg-emerald-900/20 transition-colors" title="Squad">
                                        <Users class="size-4" />
                                    </Link>
                                    <Link :href="`/admin/seasons/${season.id}/edit`" class="p-1.5 rounded text-slate-400 hover:text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors">
                                        <Pencil class="size-4" />
                                    </Link>
                                    <button @click="destroy(season.id)" class="p-1.5 rounded text-slate-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                                        <Trash2 class="size-4" />
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr v-if="seasons.data.length === 0">
                            <td colspan="5" class="px-4 py-8 text-center text-slate-500 dark:text-slate-400">No seasons yet</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>