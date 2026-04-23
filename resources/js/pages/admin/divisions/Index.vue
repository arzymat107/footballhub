<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
import { Plus, Pencil, Trash2 } from 'lucide-vue-next';

defineProps<{
    divisions: {
        data: { id: number; name: string; level: number; league: { id: number; name: string } }[];
        links: { url: string | null; label: string; active: boolean }[];
    };
}>();

defineOptions({ layout: AdminLayout });

function destroy(id: number) {
    if (confirm('Delete this division?')) {
        router.delete(`/admin/divisions/${id}`);
    }
}
</script>

<template>
    <Head title="Divisions" />

    <div class="p-6 space-y-4">
        <div class="flex items-center justify-between">
            <h1 class="text-xl font-bold text-slate-900 dark:text-slate-100">Divisions</h1>
            <Link href="/admin/divisions/create" class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-600 text-white text-sm font-medium hover:bg-emerald-700 transition-colors">
                <Plus class="size-4" /> New division
            </Link>
        </div>

        <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="border-b border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/50">
                        <tr>
                            <th class="text-left px-4 py-3 font-medium text-slate-500 dark:text-slate-400">Name</th>
                            <th class="text-left px-4 py-3 font-medium text-slate-500 dark:text-slate-400 hidden sm:table-cell">League</th>
                            <th class="text-left px-4 py-3 font-medium text-slate-500 dark:text-slate-400 hidden sm:table-cell">Level</th>
                            <th class="px-4 py-3 w-20"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                        <tr v-for="division in divisions.data" :key="division.id" class="hover:bg-slate-50 dark:hover:bg-slate-800/40 transition-colors">
                            <td class="px-4 py-3 font-medium text-slate-900 dark:text-slate-100">{{ division.name }}</td>
                            <td class="px-4 py-3 text-slate-500 dark:text-slate-400 hidden sm:table-cell">{{ division.league.name }}</td>
                            <td class="px-4 py-3 text-slate-500 dark:text-slate-400 hidden sm:table-cell">{{ division.level }}</td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-1 justify-end">
                                    <Link :href="`/admin/divisions/${division.id}/edit`" class="p-1.5 rounded text-slate-400 hover:text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors">
                                        <Pencil class="size-4" />
                                    </Link>
                                    <button @click="destroy(division.id)" class="p-1.5 rounded text-slate-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                                        <Trash2 class="size-4" />
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr v-if="divisions.data.length === 0">
                            <td colspan="4" class="px-4 py-8 text-center text-slate-500 dark:text-slate-400">No divisions yet</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>