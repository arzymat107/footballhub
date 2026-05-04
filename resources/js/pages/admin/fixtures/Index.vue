<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
import { Pencil, Trash2, ClipboardList } from 'lucide-vue-next';

const props = defineProps<{
    fixtures: {
        data: {
            id: number; status: string; scheduled_at: string | null;
            home_score: number | null; away_score: number | null;
            home_score_pen: number | null; away_score_pen: number | null;
            home_team: { id: number; name: string; short_name: string | null };
            away_team: { id: number; name: string; short_name: string | null };
            season: { id: number; name: string; division: { league: { name: string } } };
            round: { name: string } | null;
        }[];
        links: { url: string | null; label: string; active: boolean }[];
    };
    seasons: { id: number; name: string }[];
    filters: { season_id?: string; status?: string };
}>();

defineOptions({ layout: AdminLayout });

const statusBadge: Record<string, string> = {
    scheduled: 'bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-400',
    in_progress: 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400',
    completed: 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400',
    postponed: 'bg-orange-100 text-orange-700 dark:bg-orange-900/30 dark:text-orange-400',
    cancelled: 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400',
};

function filter(key: string, value: string) {
    router.get('/admin/fixtures', { ...props.filters, [key]: value || undefined }, { preserveState: true });
}

function destroy(id: number) {
    if (confirm('Delete this fixture?')) {
        router.delete(`/admin/fixtures/${id}`);
    }
}

function formatDate(val: string | null) {
    if (!val) return '—';
    return new Date(val).toLocaleDateString('en-GB', { day: 'numeric', month: 'short', year: 'numeric' });
}
</script>

<template>
    <Head title="Fixtures" />

    <div class="p-6 space-y-4">
        <div class="flex items-center justify-between">
            <h1 class="text-xl font-bold text-slate-900 dark:text-slate-100">Fixtures</h1>
        </div>

        <!-- Filters -->
        <div class="flex flex-wrap gap-3">
            <select
                :value="filters.season_id ?? ''"
                @change="filter('season_id', ($event.target as HTMLSelectElement).value)"
                class="px-3 py-1.5 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition"
            >
                <option value="">All seasons</option>
                <option v-for="s in seasons" :key="s.id" :value="s.id">{{ s.name }}</option>
            </select>

            <select
                :value="filters.status ?? ''"
                @change="filter('status', ($event.target as HTMLSelectElement).value)"
                class="px-3 py-1.5 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition"
            >
                <option value="">All statuses</option>
                <option value="scheduled">Scheduled</option>
                <option value="in_progress">In progress</option>
                <option value="completed">Completed</option>
                <option value="postponed">Postponed</option>
                <option value="cancelled">Cancelled</option>
            </select>
        </div>

        <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="border-b border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/50">
                        <tr>
                            <th class="text-left px-4 py-3 font-medium text-slate-500 dark:text-slate-400">Match</th>
                            <th class="text-left px-4 py-3 font-medium text-slate-500 dark:text-slate-400 hidden sm:table-cell">Date</th>
                            <th class="text-left px-4 py-3 font-medium text-slate-500 dark:text-slate-400">Status</th>
                            <th class="px-4 py-3 w-20"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                        <tr v-for="fixture in fixtures.data" :key="fixture.id" class="hover:bg-slate-50 dark:hover:bg-slate-800/40 transition-colors">
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-2">
                                    <span class="font-medium text-slate-900 dark:text-slate-100">
                                        {{ fixture.home_team.short_name ?? fixture.home_team.name }}
                                    </span>
                                    <div class="flex flex-col items-center">
                                        <span class="text-xs font-bold px-1.5 py-0.5 bg-slate-100 dark:bg-slate-800 rounded text-slate-700 dark:text-slate-300 tabular-nums">
                                            {{ fixture.home_score ?? '—' }} : {{ fixture.away_score ?? '—' }}
                                        </span>
                                        <span v-if="fixture.home_score_pen !== null && fixture.away_score_pen !== null"
                                            class="text-xs text-slate-400 tabular-nums leading-none mt-0.5">
                                            pen {{ fixture.home_score_pen }}–{{ fixture.away_score_pen }}
                                        </span>
                                    </div>
                                    <span class="font-medium text-slate-900 dark:text-slate-100">
                                        {{ fixture.away_team.short_name ?? fixture.away_team.name }}
                                    </span>
                                </div>
                                <p class="text-xs text-slate-400 mt-0.5">{{ fixture.season.division.league.name }} · {{ fixture.season.name }}</p>
                            </td>
                            <td class="px-4 py-3 text-slate-500 dark:text-slate-400 hidden sm:table-cell">{{ formatDate(fixture.scheduled_at) }}</td>
                            <td class="px-4 py-3">
                                <span :class="['text-xs px-2 py-0.5 rounded-full font-medium capitalize', statusBadge[fixture.status] ?? '']">
                                    {{ fixture.status.replace('_', ' ') }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-1 justify-end">
                                    <Link :href="`/admin/fixtures/${fixture.id}/detail`" class="p-1.5 rounded text-slate-400 hover:text-emerald-600 hover:bg-emerald-50 dark:hover:bg-emerald-900/20 transition-colors" title="Lineup & Events">
                                        <ClipboardList class="size-4" />
                                    </Link>
                                    <Link :href="`/admin/fixtures/${fixture.id}/edit`" class="p-1.5 rounded text-slate-400 hover:text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors">
                                        <Pencil class="size-4" />
                                    </Link>
                                    <button @click="destroy(fixture.id)" class="p-1.5 rounded text-slate-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                                        <Trash2 class="size-4" />
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr v-if="fixtures.data.length === 0">
                            <td colspan="4" class="px-4 py-8 text-center text-slate-500 dark:text-slate-400">No fixtures found</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>