<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
import InputError from '@/components/InputError.vue';

const props = defineProps<{
    team?: { id: number; name: string; short_name: string | null; city: string | null; country: string | null; founded_year: number | null };
}>();

defineOptions({ layout: AdminLayout });

const form = useForm({
    name: props.team?.name ?? '',
    short_name: props.team?.short_name ?? '',
    city: props.team?.city ?? '',
    country: props.team?.country ?? '',
    founded_year: props.team?.founded_year ?? '',
});

function submit() {
    if (props.team) {
        form.put(`/admin/teams/${props.team.id}`);
    } else {
        form.post('/admin/teams');
    }
}
</script>

<template>
    <Head :title="team ? 'Edit Team' : 'New Team'" />

    <div class="p-6 max-w-lg">
        <h1 class="text-xl font-bold text-slate-900 dark:text-slate-100 mb-6">{{ team ? 'Edit team' : 'New team' }}</h1>

        <form @submit.prevent="submit" class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 p-5 space-y-4">
            <div class="grid grid-cols-2 gap-4">
                <div class="col-span-2 space-y-1.5">
                    <label class="text-sm font-medium text-slate-700 dark:text-slate-300">Name *</label>
                    <input v-model="form.name" type="text" class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition" placeholder="Manchester City" />
                    <InputError :message="form.errors.name" />
                </div>

                <div class="space-y-1.5">
                    <label class="text-sm font-medium text-slate-700 dark:text-slate-300">Short name</label>
                    <input v-model="form.short_name" type="text" maxlength="10" class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition" placeholder="MCI" />
                    <InputError :message="form.errors.short_name" />
                </div>

                <div class="space-y-1.5">
                    <label class="text-sm font-medium text-slate-700 dark:text-slate-300">Founded year</label>
                    <input v-model.number="form.founded_year" type="number" min="1800" :max="new Date().getFullYear()" class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition" placeholder="1880" />
                    <InputError :message="form.errors.founded_year" />
                </div>

                <div class="space-y-1.5">
                    <label class="text-sm font-medium text-slate-700 dark:text-slate-300">City</label>
                    <input v-model="form.city" type="text" class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition" placeholder="Manchester" />
                    <InputError :message="form.errors.city" />
                </div>

                <div class="space-y-1.5">
                    <label class="text-sm font-medium text-slate-700 dark:text-slate-300">Country</label>
                    <input v-model="form.country" type="text" class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition" placeholder="England" />
                    <InputError :message="form.errors.country" />
                </div>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" :disabled="form.processing" class="px-4 py-2 rounded-lg bg-emerald-600 text-white text-sm font-medium hover:bg-emerald-700 disabled:opacity-50 transition-colors">
                    {{ team ? 'Save changes' : 'Create team' }}
                </button>
                <a href="/admin/teams" class="px-4 py-2 rounded-lg border border-slate-300 dark:border-slate-700 text-sm font-medium text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">Cancel</a>
            </div>
        </form>
    </div>
</template>