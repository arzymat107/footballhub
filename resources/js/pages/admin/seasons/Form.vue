<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
import InputError from '@/components/InputError.vue';

const props = defineProps<{
    divisions: { id: number; name: string; league_id: number; league?: { name: string } }[];
    season?: {
        id: number; division_id: number; name: string; format: string;
        status: string; track_players: boolean;
        start_date: string | null; end_date: string | null;
    };
}>();

defineOptions({ layout: AdminLayout });

const form = useForm({
    division_id: props.season?.division_id ?? '',
    name: props.season?.name ?? '',
    format: props.season?.format ?? 'round_robin',
    status: props.season?.status ?? 'upcoming',
    track_players: props.season?.track_players ?? false,
    start_date: props.season?.start_date?.substring(0, 10) ?? '',
    end_date: props.season?.end_date?.substring(0, 10) ?? '',
});

function submit() {
    if (props.season) {
        form.put(`/admin/seasons/${props.season.id}`);
    } else {
        form.post('/admin/seasons');
    }
}
</script>

<template>
    <Head :title="season ? 'Edit Season' : 'New Season'" />

    <div class="p-6 max-w-lg">
        <h1 class="text-xl font-bold text-slate-900 dark:text-slate-100 mb-6">{{ season ? 'Edit season' : 'New season' }}</h1>

        <form @submit.prevent="submit" class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 p-5 space-y-4">
            <div class="space-y-1.5">
                <label class="text-sm font-medium text-slate-700 dark:text-slate-300">Division *</label>
                <select v-model="form.division_id" class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition">
                    <option value="">Select division…</option>
                    <option v-for="d in divisions" :key="d.id" :value="d.id">{{ d.name }}</option>
                </select>
                <InputError :message="form.errors.division_id" />
            </div>

            <div class="space-y-1.5">
                <label class="text-sm font-medium text-slate-700 dark:text-slate-300">Name *</label>
                <input v-model="form.name" type="text" class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition" placeholder="2024/25" />
                <InputError :message="form.errors.name" />
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="text-sm font-medium text-slate-700 dark:text-slate-300">Format *</label>
                    <select v-model="form.format" class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition">
                        <option value="round_robin">Round robin</option>
                        <option value="knockout">Knockout</option>
                        <option value="group_knockout">Group + knockout</option>
                        <option value="playoff">Playoff</option>
                    </select>
                    <InputError :message="form.errors.format" />
                </div>

                <div class="space-y-1.5">
                    <label class="text-sm font-medium text-slate-700 dark:text-slate-300">Status *</label>
                    <select v-model="form.status" class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition">
                        <option value="upcoming">Upcoming</option>
                        <option value="active">Active</option>
                        <option value="completed">Completed</option>
                    </select>
                    <InputError :message="form.errors.status" />
                </div>

                <div class="space-y-1.5">
                    <label class="text-sm font-medium text-slate-700 dark:text-slate-300">Start date</label>
                    <input v-model="form.start_date" type="date" class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition" />
                    <InputError :message="form.errors.start_date" />
                </div>

                <div class="space-y-1.5">
                    <label class="text-sm font-medium text-slate-700 dark:text-slate-300">End date</label>
                    <input v-model="form.end_date" type="date" class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition" />
                    <InputError :message="form.errors.end_date" />
                </div>
            </div>

            <label class="flex items-center gap-2.5 cursor-pointer">
                <input v-model="form.track_players" type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500" />
                <span class="text-sm text-slate-700 dark:text-slate-300">Track player statistics</span>
            </label>

            <div class="flex gap-3 pt-2">
                <button type="submit" :disabled="form.processing" class="px-4 py-2 rounded-lg bg-emerald-600 text-white text-sm font-medium hover:bg-emerald-700 disabled:opacity-50 transition-colors">
                    {{ season ? 'Save changes' : 'Create season' }}
                </button>
                <a href="/admin/seasons" class="px-4 py-2 rounded-lg border border-slate-300 dark:border-slate-700 text-sm font-medium text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">Cancel</a>
            </div>
        </form>
    </div>
</template>