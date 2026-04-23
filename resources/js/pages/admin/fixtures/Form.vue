<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
import InputError from '@/components/InputError.vue';

const props = defineProps<{
    seasons: { id: number; name: string }[];
    teams: { id: number; name: string }[];
    rounds: { id: number; name: string; season_id: number }[];
    fixture?: {
        id: number; season_id: number; round_id: number | null;
        home_team_id: number; away_team_id: number;
        scheduled_at: string | null; venue: string | null; status: string;
        home_score: number | null; away_score: number | null;
    };
}>();

defineOptions({ layout: AdminLayout });

const form = useForm({
    season_id: props.fixture?.season_id ?? '',
    round_id: props.fixture?.round_id ?? '',
    home_team_id: props.fixture?.home_team_id ?? '',
    away_team_id: props.fixture?.away_team_id ?? '',
    scheduled_at: props.fixture?.scheduled_at?.substring(0, 16) ?? '',
    venue: props.fixture?.venue ?? '',
    status: props.fixture?.status ?? 'scheduled',
    home_score: props.fixture?.home_score ?? '',
    away_score: props.fixture?.away_score ?? '',
});

function submit() {
    if (props.fixture) {
        form.put(`/admin/fixtures/${props.fixture.id}`);
    } else {
        form.post('/admin/fixtures');
    }
}
</script>

<template>
    <Head :title="fixture ? 'Edit Fixture' : 'New Fixture'" />

    <div class="p-6 max-w-lg">
        <h1 class="text-xl font-bold text-slate-900 dark:text-slate-100 mb-6">{{ fixture ? 'Edit fixture' : 'New fixture' }}</h1>

        <form @submit.prevent="submit" class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 p-5 space-y-4">
            <div class="grid grid-cols-2 gap-4">
                <div class="col-span-2 space-y-1.5">
                    <label class="text-sm font-medium text-slate-700 dark:text-slate-300">Season *</label>
                    <select v-model="form.season_id" class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition">
                        <option value="">Select season…</option>
                        <option v-for="s in seasons" :key="s.id" :value="s.id">{{ s.name }}</option>
                    </select>
                    <InputError :message="form.errors.season_id" />
                </div>

                <div class="space-y-1.5">
                    <label class="text-sm font-medium text-slate-700 dark:text-slate-300">Home team *</label>
                    <select v-model="form.home_team_id" class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition">
                        <option value="">Select team…</option>
                        <option v-for="t in teams" :key="t.id" :value="t.id">{{ t.name }}</option>
                    </select>
                    <InputError :message="form.errors.home_team_id" />
                </div>

                <div class="space-y-1.5">
                    <label class="text-sm font-medium text-slate-700 dark:text-slate-300">Away team *</label>
                    <select v-model="form.away_team_id" class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition">
                        <option value="">Select team…</option>
                        <option v-for="t in teams" :key="t.id" :value="t.id">{{ t.name }}</option>
                    </select>
                    <InputError :message="form.errors.away_team_id" />
                </div>

                <div class="space-y-1.5">
                    <label class="text-sm font-medium text-slate-700 dark:text-slate-300">Home score</label>
                    <input v-model.number="form.home_score" type="number" min="0" class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition" />
                    <InputError :message="form.errors.home_score" />
                </div>

                <div class="space-y-1.5">
                    <label class="text-sm font-medium text-slate-700 dark:text-slate-300">Away score</label>
                    <input v-model.number="form.away_score" type="number" min="0" class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition" />
                    <InputError :message="form.errors.away_score" />
                </div>

                <div class="col-span-2 space-y-1.5">
                    <label class="text-sm font-medium text-slate-700 dark:text-slate-300">Status *</label>
                    <select v-model="form.status" class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition">
                        <option value="scheduled">Scheduled</option>
                        <option value="in_progress">In progress</option>
                        <option value="completed">Completed</option>
                        <option value="postponed">Postponed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                    <InputError :message="form.errors.status" />
                </div>

                <div class="col-span-2 space-y-1.5">
                    <label class="text-sm font-medium text-slate-700 dark:text-slate-300">Date & time</label>
                    <input v-model="form.scheduled_at" type="datetime-local" class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition" />
                    <InputError :message="form.errors.scheduled_at" />
                </div>

                <div class="col-span-2 space-y-1.5">
                    <label class="text-sm font-medium text-slate-700 dark:text-slate-300">Venue</label>
                    <input v-model="form.venue" type="text" class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition" placeholder="Etihad Stadium" />
                    <InputError :message="form.errors.venue" />
                </div>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" :disabled="form.processing" class="px-4 py-2 rounded-lg bg-emerald-600 text-white text-sm font-medium hover:bg-emerald-700 disabled:opacity-50 transition-colors">
                    {{ fixture ? 'Save changes' : 'Create fixture' }}
                </button>
                <a href="/admin/fixtures" class="px-4 py-2 rounded-lg border border-slate-300 dark:border-slate-700 text-sm font-medium text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">Cancel</a>
            </div>
        </form>
    </div>
</template>