<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
import InputError from '@/components/InputError.vue';

const props = defineProps<{
    leagues: { id: number; name: string }[];
    division?: { id: number; league_id: number; name: string; level: number; description: string | null };
}>();

defineOptions({ layout: AdminLayout });

const form = useForm({
    league_id: props.division?.league_id ?? '',
    name: props.division?.name ?? '',
    level: props.division?.level ?? 1,
    description: props.division?.description ?? '',
});

function submit() {
    if (props.division) {
        form.put(`/admin/divisions/${props.division.id}`);
    } else {
        form.post('/admin/divisions');
    }
}
</script>

<template>
    <Head :title="division ? 'Edit Division' : 'New Division'" />

    <div class="p-6 max-w-lg">
        <h1 class="text-xl font-bold text-slate-900 dark:text-slate-100 mb-6">
            {{ division ? 'Edit division' : 'New division' }}
        </h1>

        <form @submit.prevent="submit" class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 p-5 space-y-4">
            <div class="space-y-1.5">
                <label class="text-sm font-medium text-slate-700 dark:text-slate-300">League *</label>
                <select
                    v-model="form.league_id"
                    class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition"
                >
                    <option value="">Select league…</option>
                    <option v-for="league in leagues" :key="league.id" :value="league.id">{{ league.name }}</option>
                </select>
                <InputError :message="form.errors.league_id" />
            </div>

            <div class="space-y-1.5">
                <label class="text-sm font-medium text-slate-700 dark:text-slate-300">Name *</label>
                <input
                    v-model="form.name"
                    type="text"
                    class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition"
                    placeholder="Division 1"
                />
                <InputError :message="form.errors.name" />
            </div>

            <div class="space-y-1.5">
                <label class="text-sm font-medium text-slate-700 dark:text-slate-300">Level *</label>
                <input
                    v-model.number="form.level"
                    type="number"
                    min="1"
                    class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition"
                />
                <InputError :message="form.errors.level" />
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" :disabled="form.processing" class="px-4 py-2 rounded-lg bg-emerald-600 text-white text-sm font-medium hover:bg-emerald-700 disabled:opacity-50 transition-colors">
                    {{ division ? 'Save changes' : 'Create division' }}
                </button>
                <a href="/admin/divisions" class="px-4 py-2 rounded-lg border border-slate-300 dark:border-slate-700 text-sm font-medium text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">Cancel</a>
            </div>
        </form>
    </div>
</template>