<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
import InputError from '@/components/InputError.vue';

const props = defineProps<{
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
    round?: {
        id: number;
        stage_id: number;
        name: string;
        order: number;
        home_away: boolean | null;
    };
}>();

defineOptions({ layout: AdminLayout });

const form = useForm({
    stage_id: props.stage.id,
    name: props.round?.name ?? '',
    order: props.round?.order ?? 1,
    home_away: props.round?.home_away ?? null,
});

const cancelHref = `/admin/stages/${props.stage.id}`;

function submit() {
    if (props.round) {
        form.put(`/admin/rounds/${props.round.id}`);
    } else {
        form.post('/admin/rounds');
    }
}
</script>

<template>
    <Head :title="round ? 'Edit Round' : 'New Round'" />

    <div class="p-6 max-w-lg">
        <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400 mb-4 flex-wrap">
            <a :href="`/admin/leagues/${stage.season.division.league.id}`" class="hover:text-slate-700 dark:hover:text-slate-300">{{ stage.season.division.league.name }}</a>
            <span>/</span>
            <a :href="`/admin/divisions/${stage.season.division.id}`" class="hover:text-slate-700 dark:hover:text-slate-300">{{ stage.season.division.name }}</a>
            <span>/</span>
            <a :href="`/admin/seasons/${stage.season.id}`" class="hover:text-slate-700 dark:hover:text-slate-300">{{ stage.season.name }}</a>
            <span>/</span>
            <a :href="`/admin/stages/${stage.id}`" class="hover:text-slate-700 dark:hover:text-slate-300">{{ stage.name }}</a>
        </div>

        <h1 class="text-xl font-bold text-slate-900 dark:text-slate-100 mb-6">
            {{ round ? 'Edit round' : 'New round' }}
        </h1>

        <form @submit.prevent="submit" class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 p-5 space-y-4">
            <div class="space-y-1.5">
                <label class="text-sm font-medium text-slate-700 dark:text-slate-300">Name *</label>
                <input
                    v-model="form.name"
                    type="text"
                    class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition"
                    placeholder="Matchday 1"
                />
                <InputError :message="form.errors.name" />
            </div>

            <div class="space-y-1.5">
                <label class="text-sm font-medium text-slate-700 dark:text-slate-300">Order *</label>
                <input
                    v-model.number="form.order"
                    type="number"
                    min="1"
                    class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition"
                />
                <InputError :message="form.errors.order" />
            </div>

            <div class="space-y-1.5">
                <label class="text-sm font-medium text-slate-700 dark:text-slate-300">Home & Away</label>
                <select
                    v-model="form.home_away"
                    class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition"
                >
                    <option :value="null">Inherit from stage ({{ stage.home_away ? 'Yes' : 'No' }})</option>
                    <option :value="true">Yes</option>
                    <option :value="false">No</option>
                </select>
                <InputError :message="form.errors.home_away" />
            </div>

            <div class="flex gap-3 pt-2">
                <button
                    type="submit"
                    :disabled="form.processing"
                    class="px-4 py-2 rounded-lg bg-emerald-600 text-white text-sm font-medium hover:bg-emerald-700 disabled:opacity-50 transition-colors"
                >
                    {{ round ? 'Save changes' : 'Create round' }}
                </button>
                <a
                    :href="cancelHref"
                    class="px-4 py-2 rounded-lg border border-slate-300 dark:border-slate-700 text-sm font-medium text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors"
                >
                    Cancel
                </a>
            </div>
        </form>
    </div>
</template>