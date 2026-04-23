<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
import InputError from '@/components/InputError.vue';

const props = defineProps<{
    player?: { id: number; name: string; nationality: string | null; position: string | null; date_of_birth: string | null };
}>();

defineOptions({ layout: AdminLayout });

const form = useForm({
    name: props.player?.name ?? '',
    nationality: props.player?.nationality ?? '',
    position: props.player?.position ?? '',
    date_of_birth: props.player?.date_of_birth?.substring(0, 10) ?? '',
});

function submit() {
    if (props.player) {
        form.put(`/admin/players/${props.player.id}`);
    } else {
        form.post('/admin/players');
    }
}
</script>

<template>
    <Head :title="player ? 'Edit Player' : 'New Player'" />

    <div class="p-6 max-w-lg">
        <h1 class="text-xl font-bold text-slate-900 dark:text-slate-100 mb-6">{{ player ? 'Edit player' : 'New player' }}</h1>

        <form @submit.prevent="submit" class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 p-5 space-y-4">
            <div class="space-y-1.5">
                <label class="text-sm font-medium text-slate-700 dark:text-slate-300">Name *</label>
                <input v-model="form.name" type="text" class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition" placeholder="Erling Haaland" />
                <InputError :message="form.errors.name" />
            </div>

            <div class="space-y-1.5">
                <label class="text-sm font-medium text-slate-700 dark:text-slate-300">Position</label>
                <select v-model="form.position" class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition">
                    <option value="">Select position…</option>
                    <option value="goalkeeper">Goalkeeper</option>
                    <option value="defender">Defender</option>
                    <option value="midfielder">Midfielder</option>
                    <option value="forward">Forward</option>
                </select>
                <InputError :message="form.errors.position" />
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="text-sm font-medium text-slate-700 dark:text-slate-300">Nationality</label>
                    <input v-model="form.nationality" type="text" class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition" placeholder="Norwegian" />
                    <InputError :message="form.errors.nationality" />
                </div>

                <div class="space-y-1.5">
                    <label class="text-sm font-medium text-slate-700 dark:text-slate-300">Date of birth</label>
                    <input v-model="form.date_of_birth" type="date" class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 transition" />
                    <InputError :message="form.errors.date_of_birth" />
                </div>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" :disabled="form.processing" class="px-4 py-2 rounded-lg bg-emerald-600 text-white text-sm font-medium hover:bg-emerald-700 disabled:opacity-50 transition-colors">
                    {{ player ? 'Save changes' : 'Create player' }}
                </button>
                <a href="/admin/players" class="px-4 py-2 rounded-lg border border-slate-300 dark:border-slate-700 text-sm font-medium text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">Cancel</a>
            </div>
        </form>
    </div>
</template>