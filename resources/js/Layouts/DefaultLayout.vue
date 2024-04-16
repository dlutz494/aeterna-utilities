<script setup>
import { Link } from '@inertiajs/vue3';
import { onBeforeMount, ref } from 'vue';

const props = defineProps({
    header: {
        type: String,
        default: ''
    },
    selectedPage: {
        type: String,
        default: ''
    }
});

// Dark mode
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

// Selected page
const selectedPage = ref('');

onBeforeMount(() => {
    // Set the theme
    if (localStorage.getItem('theme') === 'dark') setDarkMode();
    else setLightMode();
});
</script>

<template>
    <header class="pt-10 grid place-items-center">
        <nav class="mx-3 flex flex-1 text-black dark:text-white">
            <Link
                :href="route('welcome')"
                class="mx-2 border-2 rounded p-1 bg-blue-200 dark:bg-blue-700"
                :class="{ 'border-blue-500': props.selectedPage === 'Home' }"
            >Home
            </Link>
            <Link
                :href="route('generator')"
                class="mx-2 border-2 rounded p-1 bg-blue-200 dark:bg-blue-700"
                :class="{ 'border-blue-500': props.selectedPage === 'Generator' }"
            >Generator
            </Link>
            <Link
                :href="route('admin')"
                class="mx-2 border-2 rounded p-1 bg-blue-200 dark:bg-blue-700"
                :class="{ 'border-blue-500': props.selectedPage === 'Admin' }"
            >Admin Panel
            </Link>
            <button type="button" @click="toggleTheme" class="text-black dark:text-white">Toggle Dark Mode:
                {{ darkMode.valueOf() ? 'Dark' : 'Light' }}
            </button>
        </nav>
    </header>

    <main class="align-middle text-center p-2">
        <h1 v-if="header" class="justify-center pb-4 font-extrabold text-3xl text-black dark:text-white">{{
                props.header
            }}</h1>
        <slot/>
    </main>

    <footer class="py-8 text-center text-sm text-black dark:text-white/70">
        &copy; 2024 David Lutz
    </footer>
</template>
