<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
import { Trophy, Users, User, Swords } from 'lucide-vue-next';

defineProps<{
    stats: { leagues: number; teams: number; players: number; fixtures: number };
}>();

defineOptions({ layout: AdminLayout });

const statCards = [
    { label: 'Leagues', key: 'leagues', icon: Trophy, color: 'text-emerald-600', bg: 'bg-emerald-50 dark:bg-emerald-900/20' },
    { label: 'Teams', key: 'teams', icon: Users, color: 'text-blue-600', bg: 'bg-blue-50 dark:bg-blue-900/20' },
    { label: 'Players', key: 'players', icon: User, color: 'text-purple-600', bg: 'bg-purple-50 dark:bg-purple-900/20' },
    { label: 'Fixtures', key: 'fixtures', icon: Swords, color: 'text-orange-600', bg: 'bg-orange-50 dark:bg-orange-900/20' },
] as const;
</script>

<template>
    <Head title="Admin Dashboard" />

    <div class="p-6 space-y-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-slate-100">Dashboard</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Overview of your football data</p>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            <div
                v-for="card in statCards"
                :key="card.key"
                class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 p-4 flex flex-col gap-3"
            >
                <div :class="[card.bg, 'rounded-lg p-2.5 w-fit']">
                    <component :is="card.icon" :class="['size-5', card.color]" />
                </div>
                <div>
                    <p class="text-2xl font-bold text-slate-900 dark:text-slate-100">{{ stats[card.key] }}</p>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">{{ card.label }}</p>
                </div>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-4">
            <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 p-4">
                <h2 class="font-semibold text-slate-900 dark:text-slate-100 mb-3">Quick links</h2>
                <div class="flex flex-col gap-1">
                    <a v-for="link in [
                        { label: 'Add league', href: '/admin/leagues/create' },
                        { label: 'Add team', href: '/admin/teams/create' },
                        { label: 'Add player', href: '/admin/players/create' },
                        { label: 'Add fixture', href: '/admin/fixtures/create' },
                    ]" :key="link.href" :href="link.href"
                        class="px-3 py-2 text-sm text-slateald-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 rounded-lg transition-colors"
                    >
                        + {{ link.label }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>