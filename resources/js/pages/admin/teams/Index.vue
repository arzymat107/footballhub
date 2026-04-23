<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
import { Plus, Pencil, Trash2 } from 'lucide-vue-next';

defineProps<{
    teams: {
        data: { id: number; name: string; short_name: string | null; city: string | null; country: string | null; founded_year: number | null }[];
        links: { url: string | null; label: string; active: boolean }[];
    };
}>();

defineOptions({ layout: AdminLayout });

function destroy(id: number) {
    if (confirm('Delete this team?')) {
        router.delete(`/admin/teams/${id}`);
    }
}
</script>

<template>
    <Head title="Teams" />

    <div class="p-6 space-y-4">
        <div class="flex items-center justify-between">
            <h1 class="text-xl font-bold text-slate-900 dark:text-slate-100">Teams</h1>
            <Link href="/admin/teams/create" class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-600 text-white text-sm font-medium hover:bg-emerald-700 transition-colors">
                <Plus class="size-4" /> New team
            </Link>
        </div>

        <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="border-b border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/50">
                        <tr>
                            <th class="text-left px-4 py-3 font-medium text-slate-500 dark:text-slate-400">Name</th>
                            <th class="text-left px-4 py-3 font-medium text-slate-500 dark:text-slate-400 hidden sm:table-cell">City</th>
                            <th class="text-left px-4 py-3 font-medium text-slate-500 dark:text-slate-400 hidden md:table-cell">Country</th>
                            <th class="text-left px-4 py-3 font-medium text-slate-500 dark:text-slate-400 hidden md:table-cell">Founded</th>
                            <th class="px-4 py-3 w-20"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                        <tr v-for="team in teams.data" :key="team.id" class="hover:bg-slate-50 dark:hover:bg-slate-800/40 transition-colors">
                            <td class="px-4 py-3">
                                <span class="font-medium text-slate-900 dark:text-slate-100">{{ team.name }}</span>
                                <span v-if="team.short_name" class="ml-2 text-xs text-slate-400">{{ team.short_name }}</span>
                            </td>
                            <td class="px-4 py-3 text-slate-500 dark:text-slate-400 hidden sm:table-cell">{{ team.city ?? '—' }}</td>
                            <td class="px-4 py-3 text-slate-500 dark:text-slate-400 hidden md:table-cell">{{ team.country ?? '—' }}</td>
                            <td class="px-4 py-3 text-slate-500 dark:text-slate-400 hidden md:table-cell">{{ team.founded_year ?? '—' }}</td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-1 justify-end">
                                    <Link :href="`/admin/teams/${team.id}/edit`" class="p-1.5 rounded text-slate-400 hover:text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors">
                                        <Pencil class="size-4" />
                                    </Link>
                                    <button @click="destroy(team.id)" class="p-1.5 rounded text-slate-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                                        <Trash2 class="size-4" />
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr v-if="teams.data.length === 0">
                            <td colspan="5" class="px-4 py-8 text-center text-slate-500 dark:text-slate-400">No teams yet</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>