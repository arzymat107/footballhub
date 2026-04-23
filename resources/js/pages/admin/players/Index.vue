<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
import { Plus, Pencil, Trash2 } from 'lucide-vue-next';

defineProps<{
    players: {
        data: { id: number; name: string; nationality: string | null; position: string | null; date_of_birth: string | null }[];
        links: { url: string | null; label: string; active: boolean }[];
    };
}>();

defineOptions({ layout: AdminLayout });

const positionBadge: Record<string, string> = {
    goalkeeper: 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400',
    defender: 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400',
    midfielder: 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400',
    forward: 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400',
};

function destroy(id: number) {
    if (confirm('Delete this player?')) {
        router.delete(`/admin/players/${id}`);
    }
}
</script>

<template>
    <Head title="Players" />

    <div class="p-6 space-y-4">
        <div class="flex items-center justify-between">
            <h1 class="text-xl font-bold text-slate-900 dark:text-slate-100">Players</h1>
            <Link href="/admin/players/create" class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-600 text-white text-sm font-medium hover:bg-emerald-700 transition-colors">
                <Plus class="size-4" /> New player
            </Link>
        </div>

        <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="border-b border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/50">
                        <tr>
                            <th class="text-left px-4 py-3 font-medium text-slate-500 dark:text-slate-400">Name</th>
                            <th class="text-left px-4 py-3 font-medium text-slate-500 dark:text-slate-400 hidden sm:table-cell">Position</th>
                            <th class="text-left px-4 py-3 font-medium text-slate-500 dark:text-slate-400 hidden md:table-cell">Nationality</th>
                            <th class="px-4 py-3 w-20"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                        <tr v-for="player in players.data" :key="player.id" class="hover:bg-slate-50 dark:hover:bg-slate-800/40 transition-colors">
                            <td class="px-4 py-3 font-medium text-slate-900 dark:text-slate-100">{{ player.name }}</td>
                            <td class="px-4 py-3 hidden sm:table-cell">
                                <span v-if="player.position" :class="['text-xs px-2 py-0.5 rounded-full font-medium capitalize', positionBadge[player.position] ?? 'bg-slate-100 text-slate-600']">
                                    {{ player.position }}
                                </span>
                                <span v-else class="text-slate-400">—</span>
                            </td>
                            <td class="px-4 py-3 text-slate-500 dark:text-slate-400 hidden md:table-cell">{{ player.nationality ?? '—' }}</td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-1 justify-end">
                                    <Link :href="`/admin/players/${player.id}/edit`" class="p-1.5 rounded text-slate-400 hover:text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors">
                                        <Pencil class="size-4" />
                                    </Link>
                                    <button @click="destroy(player.id)" class="p-1.5 rounded text-slate-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                                        <Trash2 class="size-4" />
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr v-if="players.data.length === 0">
                            <td colspan="4" class="px-4 py-8 text-center text-slate-500 dark:text-slate-400">No players yet</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>