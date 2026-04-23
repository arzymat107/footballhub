<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import PublicLayout from '@/layouts/PublicLayout.vue';
import { Trophy, ArrowRight } from 'lucide-vue-next';

defineProps<{ canRegister: boolean }>();
defineOptions({ layout: PublicLayout });
</script>

<template>
    <Head title="FootballHub — Your Football Data Hub" />

    <!-- Hero -->
    <section class="bg-gradient-to-br from-emerald-600 to-emerald-800 text-white">
        <div class="max-w-7xl mx-auto px-4 py-16 md:py-24 text-center">
            <div class="mb-4 flex justify-center">
                <div class="size-16 rounded-xl overflow-hidden shadow-lg ring-2 ring-white/30">
                    <img src="/logo.jpg" alt="FootballHub" class="size-full object-cover" />
                </div>
            </div>
            <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight mb-4">
                Your Football Hub
            </h1>
            <p class="text-emerald-100 text-lg md:text-xl max-w-xl mx-auto mb-8">
                Follow leagues, track standings, and stay on top of every fixture.
            </p>
            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                <Link href="/leagues" class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-white text-emerald-700 font-semibold hover:bg-emerald-50 transition-colors">
                    <Trophy class="size-5" />
                    Browse leagues
                </Link>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section class="max-w-7xl mx-auto px-4 py-12">
        <div class="grid sm:grid-cols-3 gap-6">
            <div v-for="feature in [
                { icon: '🏆', title: 'Leagues & Divisions', desc: 'Browse competitions from around the world, organised by division and tier.' },
                { icon: '📊', title: 'Live Standings', desc: 'Track points, goal difference and form as the season unfolds.' },
                { icon: '📅', title: 'Fixtures & Results', desc: 'See upcoming matches and past results with scores and venues.' },
            ]" :key="feature.title"
                class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 p-6 text-center"
            >
                <div class="text-4xl mb-3">{{ feature.icon }}</div>
                <h3 class="font-semibold text-slate-900 dark:text-slate-100 mb-2">{{ feature.title }}</h3>
                <p class="text-sm text-slate-500 dark:text-slate-400">{{ feature.desc }}</p>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="max-w-7xl mx-auto px-4 pb-12">
        <div class="bg-emerald-50 dark:bg-emerald-900/20 rounded-2xl border border-emerald-200 dark:border-emerald-800 p-8 text-center">
            <h2 class="text-xl font-bold text-slate-900 dark:text-slate-100 mb-2">Ready to explore?</h2>
            <p class="text-slate-500 dark:text-slate-400 mb-5 text-sm">All leagues and fixtures are available publicly — no account needed.</p>
            <Link href="/leagues" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-emerald-600 text-white text-sm font-semibold hover:bg-emerald-700 transition-colors">
                View all leagues <ArrowRight class="size-4" />
            </Link>
        </div>
    </section>
</template>