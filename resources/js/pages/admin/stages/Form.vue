<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
import InputError from '@/components/InputError.vue';

const props = defineProps<{
    season: {
        id: number;
        name: string;
        division: { id: number; name: string; league: { id: number; name: string } };
    };
    stage?: {
        id: number;
        season_id: number;
        name: string;
        type: string;
        order: number;
        home_away: boolean;
        wins_required: number | null;
        playoff_qualify_count: number | null;
    };
}>();

defineOptions({ layout: AdminLayout });

const form = useForm({
    season_id: props.season.id,
    name: props.stage?.name ?? '',
    type: props.stage?.type ?? 'league',
    order: props.stage?.order ?? 1,
    home_away: props.stage?.home_away ?? false,
    wins_required: props.stage?.wins_required ?? '',
    playoff_qualify_count: props.stage?.playoff_qualify_count ?? '',
});

const cancelHref = `/admin/seasons/${props.season.id}`;

function submit() {
    if (props.stage) {
        form.put(`/admin/stages/${props.stage.id}`);
    } else {
        form.post('/admin/stages');
    }
}
</script>

<template>
    <Head :title="stage ? 'Edit Stage' : 'New Stage'" />

    <div class="p-6 max-w-lg">
        <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400 mb-4 flex-wrap">
            <a :href="`/admin/leagues/${season.division.league.id}`" class="hover:text-slate-700 dark:hover:text-slate-300">{{ season.division.league.name }}</a>
            <span>/</span>
            <a :href="`/admin/divisions/${season.division.id}`" class="hover:text-slate-700 dark:hover:text-slate-300">{{ season.division.name }}</a>
            <span>/</span>
            <a :href="`/admin/seasons/${season.id}`" class="hover:text-slate-700 dark:hover:text-slate-300">{{ season.name }}</a>
        </div>

        <h1 class="text-xl font-bold text-slate-900 dark:text-slate-100 mb-6">
            {{ stage ? 'Edit stage' : 'New stage' }}
        </h1>

        <form @submit.prevent="submit" class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 p-5 space-y-4">
            <div class="space-y-1.5">
                <label class="text-sm font-medium text-slate-700 dark:text-slate-300">Name *</label>
                <input
                    v-model="form.name"
                    type="text"
                    class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition"
                    placeholder="League Stage"
                />
                <InputError :message="form.errors.name" />
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="text-sm font-medium text-slate-700 dark:text-slate-300">Type *</label>
                    <select
                        v-model="form.type"
                        class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition"
                    >
                        <option value="league">League</option>
                        <option value="group">Group</option>
                        <option value="knockout">Knockout</option>
                    </select>
                    <InputError :message="form.errors.type" />
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
                    <label class="text-sm font-medium text-slate-700 dark:text-slate-300">Wins required</label>
                    <input
                        v-model.number="form.wins_required"
                        type="number"
                        min="1"
                        placeholder="—"
                        class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition"
                    />
                    <InputError :message="form.errors.wins_required" />
                </div>

                <div class="space-y-1.5">
                    <label class="text-sm font-medium text-slate-700 dark:text-slate-300">Playoff qualify count</label>
                    <input
                        v-model.number="form.playoff_qualify_count"
                        type="number"
                        min="1"
                        placeholder="—"
                        class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition"
                    />
                    <InputError :message="form.errors.playoff_qualify_count" />
                </div>
            </div>

            <label class="flex items-center gap-2.5 cursor-pointer">
                <input v-model="form.home_away" type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500" />
                <span class="text-sm text-slate-700 dark:text-slate-300">Home & away</span>
            </label>

            <div class="flex gap-3 pt-2">
                <button
                    type="submit"
                    :disabled="form.processing"
                    class="px-4 py-2 rounded-lg bg-emerald-600 text-white text-sm font-medium hover:bg-emerald-700 disabled:opacity-50 transition-colors"
                >
                    {{ stage ? 'Save changes' : 'Create stage' }}
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