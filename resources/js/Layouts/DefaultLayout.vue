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
const htmlElement = document.querySelector('html');
const setDarkMode = () => {
    darkMode.value = true;
    localStorage.setItem('theme', 'dark');
    htmlElement.setAttribute('data-theme', 'dark');
};
const setLightMode = () => {
    darkMode.value = false;
    localStorage.setItem('theme', 'light');
    htmlElement.setAttribute('data-theme', 'light');
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
    <div class="min-h-screen">
        <header class="pt-10 px-10">
            <nav class="flex flex-1 justify-between text-black dark:text-white">
                <div>
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
                </div>
                <button type="button" @click="toggleTheme" class="text-black dark:text-white justify-self-end">Toggle
                    Theme:
                    {{ darkMode.valueOf() ? 'Dark' : 'Light' }}
                </button>
            </nav>
        </header>

        <main class="p-2 flex flex-col justify-center text-center min-h-80">
            <h1 v-if="header" class="pb-4 font-extrabold text-3xl text-black dark:text-white">{{
                    props.header
                }}</h1>
            <slot/>
        </main>

        <footer class="py-8 text-center text-sm text-black dark:text-white/70">
            &copy; 2024 David Lutz
        </footer>
    </div>
</template>
