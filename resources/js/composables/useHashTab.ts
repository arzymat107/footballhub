import { ref, watch, onMounted } from 'vue';

export function useHashTab<T extends string>(defaultTab: T, valid: T[]) {
    const tab = ref<T>(defaultTab);

    onMounted(() => {
        const hash = window.location.hash.slice(1) as T;
        if (valid.includes(hash)) tab.value = hash;
    });

    watch(tab, (val) => {
        history.replaceState(history.state, '', `#${val}`);
    });

    return tab;
}