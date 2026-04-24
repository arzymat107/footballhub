<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
import { Plus, Pencil, Trash2, ClipboardList } from 'lucide-vue-next';

defineProps<{
    round: {
        id: number;
        name: string;
        order: number;
        home_away: boolean | null;
        stage: {
            id: number;
            name: string;
            home_away: boolean;
            season: {
                id: number;
                name: string;
                division: { id: number; name: string; league: { id: number; name: string } };
            };
        };
        fixtures: {
            id: number;
            status: string;
            scheduled_at: string | null;
            venue: string | null;
            home_score: number | null;
            away_score: number | null;
            home_team: { id: number; name: string; short_name: string | null };
            away_team: { id: number; name: string; short_name: string | null };
        }[];
    };
}>();

defineOptions({ layout: AdminLayout });

const statusBadge: Record<string, string> = {
    scheduled: 'bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-400',
    in_progress: 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400',
    completed: 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400',
    postponed: 'bg-orange-100 text-orange-700 dark:bg-orange-900/30 dark:text-orange-400',
    cancelled: 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400',
};

function formatDate(val: string | null) {
    if (!val) return '—';
    return new Date(val).toLocaleDateString('en-GB', { day: 'numeric', month: 'short', year: 'numeric', hour: '2-digit', minute: '2-digit' });
}

function destroyFixture(id: number) {
    if (confirm('Delete this fixture?')) {
        router.delete(`/admin/fixtures/${id}`);
    }
}
</script>

<template>
    <Head :title="round.name" />

    <div class="p-6 space-y-6">
        <!-- Header -->
        <div class="flex items-start justify-between gap-4">
            <div>
                <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400 mb-1 flex-wrap">
                    <Link href="/admin/leagues" class="hover:text-slate-700 dark:hover:text-slate-300">Leagues</Link>
                    <span>/</span>
                    <Link :href="`/admin/leagues/${round.stage.season.division.league.id}`" class="hover:text-slate-700 dark:hover:text-slate-300">{{ round.stage.season.division.league.name }}</Link>
                    <span>/</span>
                    <Link :href="`/admin/divisions/${round.stage.season.division.id}`" class="hover:text-slate-700 dark:hover:text-slate-300">{{ round.stage.season.division.name }}</Link>
                    <span>/</span>
                    <Link :href="`/admin/seasons/${round.stage.season.id}`" class="hover:text-slate-700 dark:hover:text-slate-300">{{ round.stage.season.name }}</Link>
                    <span>/</span>
                    <Link :href="`/admin/stages/${round.stage.id}`" class="hover:text-slate-700 dark:hover:text-slate-300">{{ round.stage.name }}</Link>
                    <span>/</span>
                    <span>{{ round.name }}</span>
                </div>

                <h1 class="text-xl font-bold text-slate-900 dark:text-slate-100">{{ round.name }}</h1>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                    {{ round.home_away === null
                        ? `Home & away: ${round.stage.home_away ? 'Yes' : 'No'} (inherited)`
                        : round.home_away ? 'Home & away' : 'Single leg' }}
                </p>
            </div>

            <Link
                :href="`/admin/rounds/${round.id}/edit`"
                class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-slate-300 dark:border-slate-700 text-sm font-medium text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors shrink-0"
            >
                <Pencil class="size-4" /> Edit round
            </Link>
        </div>

        <!-- Fixtures -->
        <div class="space-y-3">
            <div class="flex items-center justify-between">
                <h2 class="text-base font-semibold text-slate-800 dark:text-slate-200">
                    Fixtures <span class="text-sm font-normal text-slate-400">({{ round.fixtures.length }})</span>
                </h2>
                <Link
                    :href="`/admin/fixtures/create?round_id=${round.id}`"
                    class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-600 text-white text-sm font-medium hover:bg-emerald-700 transition-colors"
                >
                    <Plus class="size-4" /> New fixture
                </Link>
            </div>

            <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="border-b border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/50">
                        <tr>
                            <th class="text-left px-4 py-3 font-medium text-slate-500 dark:text-slate-400">Match</th>
                            <th class="text-left px-4 py-3 font-medium text-slate-500 dark:text-slate-400 hidden sm:table-cell">Date</th>
                            <th class="text-left px-4 py-3 font-medium text-slate-500 dark:text-slate-400 hidden md:table-cell">Venue</th>
                            <th class="text-left px-4 py-3 font-medium text-slate-500 dark:text-slate-400">Status</th>
                            <th class="px-4 py-3 w-24"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                        <tr
                            v-for="fixture in round.fixtures"
                            :key="fixture.id"
                            class="hover:bg-slate-50 dark:hover:bg-slate-800/40 transition-colors"
                        >
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-2">
                                    <span class="font-medium text-slate-900 dark:text-slate-100">
                                        {{ fixture.home_team.short_name ?? fixture.home_team.name }}
                                    </span>
                                    <span class="text-xs font-bold px-1.5 py-0.5 bg-slate-100 dark:bg-slate-800 rounded text-slate-700 dark:text-slate-300 tabular-nums">
                                        {{ fixture.home_score ?? '—' }} : {{ fixture.away_score ?? '—' }}
                                    </span>
                                    <span class="font-medium text-slate-900 dark:text-slate-100">
                                        {{ fixture.away_team.short_name ?? fixture.away_team.name }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-slate-500 dark:text-slate-400 hidden sm:table-cell">{{ formatDate(fixture.scheduled_at) }}</td>
                            <td class="px-4 py-3 text-slate-500 dark:text-slate-400 hidden md:table-cell">{{ fixture.venue ?? '—' }}</td>
                            <td class="px-4 py-3">
                                <span :class="['text-xs px-2 py-0.5 rounded-full font-medium capitalize', statusBadge[fixture.status] ?? '']">
                                    {{ fixture.status.replace('_', ' ') }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-1 justify-end">
                                    <Link
                                        :href="`/admin/fixtures/${fixture.id}/detail`"
                                        class="p-1.5 rounded text-slate-400 hover:text-emerald-600 hover:bg-emerald-50 dark:hover:bg-emerald-900/20 transition-colors"
                                        title="Lineup & Events"
                                    >
                                        <ClipboardList class="size-4" />
                                    </Link>
                                    <Link
                                        :href="`/admin/fixtures/${fixture.id}/edit`"
                                        class="p-1.5 rounded text-slate-400 hover:text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors"
                                    >
                                        <Pencil class="size-4" />
                                    </Link>
                                    <button
                                        @click="destroyFixture(fixture.id)"
                                        class="p-1.5 rounded text-slate-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors"
                                    >
                                        <Trash2 class="size-4" />
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr v-if="round.fixtures.length === 0">
                            <td colspan="5" class="px-4 py-8 text-center text-slate-500 dark:text-slate-400">No fixtures yet</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>