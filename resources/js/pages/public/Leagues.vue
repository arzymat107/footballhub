<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import PublicLayout from '@/layouts/PublicLayout.vue';
import { ChevronRight, Layers } from 'lucide-vue-next';

defineProps<{
    leagues: { id: number; name: string; country: string | null; divisions_count: number }[];
}>();

defineOptions({ layout: PublicLayout });
</script>

<template>
    <Head title="Leagues" />

    <div class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold text-slate-900 dark:text-slate-100 mb-6">All Leagues</h1>

        <div v-if="leagues.length === 0" class="text-center py-20 text-slate-500 dark:text-slate-400">
            No leagues available yet.
        </div>

        <div v-else class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <Link
                v-for="league in leagues"
                :key="league.id"
                :href="`/leagues/${league.id}`"
                class="group bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 p-5 hover:border-emerald-400 dark:hover:border-emerald-600 hover:shadow-md transition-all"
            >
                <div class="flex items-start justify-between gap-3">
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="text-2xl">🏆</span>
                            <h2 class="font-semibold text-slate-900 dark:text-slate-100 truncate group-hover:text-emerald-700 dark:group-hover:text-emerald-400 transition-colors">
                                {{ league.name }}
                            </h2>
                        </div>
                        <div class="flex items-center gap-3 text-sm text-slate-500 dark:text-slate-400">
                            <span v-if="league.country">🌍 {{ league.country }}</span>
                            <span class="flex items-center gap-1">
                                <Layers class="size-3.5" />
                                {{ league.divisions_count }} {{ league.divisions_count === 1 ? 'division' : 'divisions' }}
                            </span>
                        </div>
                    </div>
                    <ChevronRight class="size-5 text-slate-400 group-hover:text-emerald-500 shrink-0 transition-colors mt-0.5" />
                </div>
            </Link>
        </div>
    </div>
</template>