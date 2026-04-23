<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import PublicLayout from '@/layouts/PublicLayout.vue';
import { ChevronRight, Calendar } from 'lucide-vue-next';

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
            seasons: { id: number; name: string; status: string; format: string; start_date: string | null }[];
        }[];
    };
}>();

defineOptions({ layout: PublicLayout });

const statusBadge: Record<string, string> = {
    upcoming: 'bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-400',
    active: 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400',
    completed: 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400',
};
</script>

<template>
    <Head :title="league.name" />

    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-1.5 text-sm text-slate-500 dark:text-slate-400 mb-6">
            <Link href="/leagues" class="hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors">Leagues</Link>
            <ChevronRight class="size-4" />
            <span class="text-slate-900 dark:text-slate-100">{{ league.name }}</span>
        </nav>

        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-2">
                <span class="text-4xl">🏆</span>
                <div>
                    <h1 class="text-2xl font-bold text-slate-900 dark:text-slate-100">{{ league.name }}</h1>
                    <p v-if="league.country" class="text-slate-500 dark:text-slate-400 text-sm">{{ league.country }}</p>
                </div>
            </div>
            <p v-if="league.description" class="text-slate-600 dark:text-slate-400 mt-3 max-w-2xl">{{ league.description }}</p>
        </div>

        <!-- Divisions -->
        <div v-if="league.divisions.length === 0" class="text-center py-16 text-slate-500 dark:text-slate-400">
            No divisions yet.
        </div>

        <div v-else class="space-y-6">
            <div v-for="division in league.divisions" :key="division.id" class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 overflow-hidden">
                <div class="px-5 py-4 border-b border-slate-100 dark:border-slate-800 flex items-center gap-3">
                    <span class="text-xs font-semibold px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400">
                        Level {{ division.level }}
                    </span>
                    <h2 class="font-semibold text-slate-900 dark:text-slate-100">{{ division.name }}</h2>
                </div>

                <div v-if="division.seasons.length === 0" class="px-5 py-4 text-sm text-slate-500 dark:text-slate-400">
                    No seasons yet.
                </div>

                <div v-else class="divide-y divide-slate-100 dark:divide-slate-800">
                    <Link
                        v-for="season in division.seasons"
                        :key="season.id"
                        :href="`/seasons/${season.id}`"
                        class="group flex items-center justify-between px-5 py-3.5 hover:bg-slate-50 dark:hover:bg-slate-800/40 transition-colors"
                    >
                        <div class="flex items-center gap-3">
                            <Calendar class="size-4 text-slate-400" />
                            <div>
                                <span class="text-sm font-medium text-slate-900 dark:text-slate-100 group-hover:text-emerald-700 dark:group-hover:text-emerald-400 transition-colors">
                                    {{ season.name }}
                                </span>
                                <span class="ml-2 text-xs text-slate-400 capitalize">{{ season.format.replace('_', ' ') }}</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <span :class="['text-xs px-2 py-0.5 rounded-full font-medium capitalize', statusBadge[season.status] ?? '']">
                                {{ season.status }}
                            </span>
                            <ChevronRight class="size-4 text-slate-400 group-hover:text-emerald-500 transition-colors" />
                        </div>
                    </Link>
                </div>
            </div>
        </div>
    </div>
</template>