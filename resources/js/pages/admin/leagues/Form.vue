<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
import InputError from '@/components/InputError.vue';

const props = defineProps<{
    league?: { id: number; name: string; country: string | null; description: string | null };
}>();

defineOptions({ layout: AdminLayout });

const form = useForm({
    name: props.league?.name ?? '',
    country: props.league?.country ?? '',
    description: props.league?.description ?? '',
});

function submit() {
    if (props.league) {
        form.put(`/admin/leagues/${props.league.id}`);
    } else {
        form.post('/admin/leagues');
    }
}
</script>

<template>
    <Head :title="league ? 'Edit League' : 'New League'" />

    <div class="p-6 max-w-lg">
        <div class="mb-6">
            <h1 class="text-xl font-bold text-slate-900 dark:text-slate-100">
                {{ league ? 'Edit league' : 'New league' }}
            </h1>
        </div>

        <form @submit.prevent="submit" class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 p-5 space-y-4">
            <div class="space-y-1.5">
                <label class="text-sm font-medium text-slate-700 dark:text-slate-300">Name *</label>
                <input
                    v-model="form.name"
                    type="text"
                    class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition"
                    placeholder="Premier League"
                />
                <InputError :message="form.errors.name" />
            </div>

            <div class="space-y-1.5">
                <label class="text-sm font-medium text-slate-700 dark:text-slate-300">Country</label>
                <input
                    v-model="form.country"
                    type="text"
                    class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition"
                    placeholder="England"
                />
                <InputError :message="form.errors.country" />
            </div>

            <div class="space-y-1.5">
                <label class="text-sm font-medium text-slate-700 dark:text-slate-300">Description</label>
                <textarea
                    v-model="form.description"
                    rows="3"
                    class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition resize-none"
                />
                <InputError :message="form.errors.description" />
            </div>

            <div class="flex gap-3 pt-2">
                <button
                    type="submit"
                    :disabled="form.processing"
                    class="px-4 py-2 rounded-lg bg-emerald-600 text-white text-sm font-medium hover:bg-emerald-700 disabled:opacity-50 transition-colors"
                >
                    {{ league ? 'Save changes' : 'Create league' }}
                </button>
                <a href="/admin/leagues" class="px-4 py-2 rounded-lg border border-slate-300 dark:border-slate-700 text-sm font-medium text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</template>