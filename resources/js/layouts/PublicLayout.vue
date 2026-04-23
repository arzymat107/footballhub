<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import { Home, Trophy, Calendar, Menu, X, Shield } from 'lucide-vue-next';

const page = usePage();
const auth = computed(() => page.props.auth as { user?: { name: string; is_admin?: boolean } } | null);
const mobileMenuOpen = ref(false);

const navLinks = [
    { label: 'Home', href: '/', icon: Home },
    { label: 'Leagues', href: '/leagues', icon: Trophy },
];
</script>

<template>
    <div class="min-h-screen flex flex-col bg-slate-50 dark:bg-slate-950">
        <!-- Header -->
        <header class="sticky top-0 z-50 bg-white dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 h-14 flex items-center justify-between gap-4">
                <!-- Logo -->
                <Link href="/" class="flex items-center gap-2 font-bold text-lg text-emerald-600 dark:text-emerald-400 shrink-0">
                    <span class="text-2xl">⚽</span>
                    <span class="hidden sm:inline">FootballHub</span>
                </Link>

                <!-- Desktop nav -->
                <nav class="hidden md:flex items-center gap-1">
                    <Link
                        v-for="link in navLinks"
                        :key="link.href"
                        :href="link.href"
                        class="px-3 py-1.5 rounded-lg text-sm font-medium text-slate-600 hover:text-emerald-600 hover:bg-emerald-50 dark:text-slate-300 dark:hover:text-emerald-400 dark:hover:bg-emerald-900/20 transition-colors"
                    >
                        {{ link.label }}
                    </Link>
                </nav>

                <!-- Right side -->
                <div class="flex items-center gap-2">
                    <template v-if="auth?.user">
                        <Link
                            v-if="auth.user.is_admin"
                            href="/admin"
                            class="hidden sm:flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-sm font-medium bg-emerald-600 text-white hover:bg-emerald-700 transition-colors"
                        >
                            <Shield class="size-3.5" />
                            Admin
                        </Link>
                        <Link
                            href="/dashboard"
                            class="hidden sm:block px-3 py-1.5 rounded-lg text-sm font-medium text-slate-600 hover:text-emerald-600 hover:bg-emerald-50 dark:text-slate-300 dark:hover:text-emerald-400 dark:hover:bg-emerald-900/20 transition-colors"
                        >
                            {{ auth.user.name }}
                        </Link>
                    </template>
                    <template v-else>
                        <Link
                            href="/login"
                            class="hidden sm:block px-3 py-1.5 rounded-lg text-sm font-medium text-slate-600 hover:text-emerald-600 hover:bg-emerald-50 dark:text-slate-300 transition-colors"
                        >
                            Sign in
                        </Link>
                    </template>

                    <!-- Mobile menu toggle -->
                    <button
                        class="md:hidden p-2 rounded-lg text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors"
                        @click="mobileMenuOpen = !mobileMenuOpen"
                    >
                        <X v-if="mobileMenuOpen" class="size-5" />
                        <Menu v-else class="size-5" />
                    </button>
                </div>
            </div>

            <!-- Mobile menu -->
            <div v-if="mobileMenuOpen" class="md:hidden border-t border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 px-4 py-3 flex flex-col gap-1">
                <Link
                    v-for="link in navLinks"
                    :key="link.href"
                    :href="link.href"
                    class="flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-700 hover:bg-emerald-50 hover:text-emerald-700 dark:text-slate-300 dark:hover:bg-emerald-900/20 transition-colors"
                    @click="mobileMenuOpen = false"
                >
                    <component :is="link.icon" class="size-4" />
                    {{ link.label }}
                </Link>
                <div class="border-t border-slate-100 dark:border-slate-800 mt-2 pt-2">
                    <template v-if="auth?.user">
                        <Link
                            v-if="auth.user.is_admin"
                            href="/admin"
                            class="flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-sm font-medium text-emerald-600 hover:bg-emerald-50 dark:text-emerald-400 transition-colors"
                            @click="mobileMenuOpen = false"
                        >
                            <Shield class="size-4" />
                            Admin Panel
                        </Link>
                        <Link
                            href="/dashboard"
                            class="flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-700 hover:bg-slate-50 dark:text-slate-300 transition-colors"
                            @click="mobileMenuOpen = false"
                        >
                            {{ auth.user.name }}
                        </Link>
                    </template>
                    <template v-else>
                        <Link
                            href="/login"
                            class="flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-700 hover:bg-slate-50 dark:text-slate-300 transition-colors"
                            @click="mobileMenuOpen = false"
                        >
                            Sign in
                        </Link>
                    </template>
                </div>
            </div>
        </header>

        <!-- Page content -->
        <main class="flex-1 pb-20 md:pb-0">
            <slot />
        </main>

        <!-- Footer (desktop) -->
        <footer class="hidden md:block bg-white dark:bg-slate-900 border-t border-slate-200 dark:border-slate-800 py-6 text-center text-sm text-slate-500 dark:text-slate-400">
            © {{ new Date().getFullYear() }} FootballHub
        </footer>

        <!-- Mobile bottom nav -->
        <nav class="md:hidden fixed bottom-0 inset-x-0 z-40 bg-white dark:bg-slate-900 border-t border-slate-200 dark:border-slate-800 safe-bottom">
            <div class="grid grid-cols-2 h-16">
                <Link
                    v-for="link in navLinks"
                    :key="link.href"
                    :href="link.href"
                    class="flex flex-col items-center justify-center gap-1 text-xs font-medium text-slate-500 hover:text-emerald-600 dark:text-slate-400 dark:hover:text-emerald-400 transition-colors active:bg-slate-50 dark:active:bg-slate-800"
                >
                    <component :is="link.icon" class="size-5" />
                    {{ link.label }}
                </Link>
            </div>
        </nav>
    </div>
</template>