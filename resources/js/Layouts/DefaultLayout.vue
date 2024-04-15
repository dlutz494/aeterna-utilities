<script setup>
import NavLink from '@/Components/NavLink.vue';
import { onBeforeMount, ref } from 'vue';

const darkMode = ref(false);
const setDarkMode = () => {
    darkMode.value = true;
    localStorage.setItem('theme', 'dark');
    document.querySelector('html').setAttribute('data-theme', 'dark');
};
const setLightMode = () => {
    darkMode.value = false;
    localStorage.setItem('theme', 'light');
    document.querySelector('html').setAttribute('data-theme', 'light');
};

const toggleTheme = () => {
    // Priority: localStorage > system setting
    if (localStorage.getItem('theme') === 'dark') {
        setLightMode();
    } else if (localStorage.getItem('theme') === 'light') {
        setDarkMode();
    } else if (window.matchMedia('(prefers-color-scheme: dark)').matches === true) {
        setLightMode();
    } else if (window.matchMedia('(prefers-color-scheme: dark)').matches === false) {
        setDarkMode();
    }
};

onBeforeMount(() => {
    // NOTE: https://dev.to/whitep4nth3r/the-best-lightdark-mode-theme-toggle-in-javascript-368f
    // Set the theme
    if (localStorage.getItem('theme') === 'dark') setDarkMode();
    else setLightMode();
});
</script>

<template>
    <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
        <nav class="-mx-3 flex flex-1 justify-end">
            <NavLink :href="route('welcome')">Home</NavLink>
            <NavLink :href="route('generator')">Generator</NavLink>
            <NavLink :href="route('generator.admin')">Generator Admin Panel</NavLink>
            <button type="button" @click="toggleTheme" class="text-black dark:text-white">Toggle Dark Mode:
                {{ darkMode.valueOf() ? 'Dark' : 'Light' }}
            </button>
        </nav>
    </header>

    <main>
        <slot/>
    </main>

    <footer class="py-16 text-center text-sm text-black dark:text-white/70">
        &copy; 2024 David Lutz
    </footer>
</template>
