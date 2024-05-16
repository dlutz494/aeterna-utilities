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
        <header class="w-full">
            <h1 v-if="header"
                class="py-4 w-full text-center font-extrabold text-3xl text-white border-b-2 border-b-red-600 bg-black">{{
                    props.header
                }}</h1>
            <nav class="flex flex-1 py-2 px-32 justify-between bg-gray-800">
                <div class="w-1/3 flex text-center">
                    <Link
                        :href="route('welcome')"
                        class="mx-2 p-1 text-gray-300 hover:text-white"
                        :class="{ 'border-blue-500': props.selectedPage === 'Home' }"
                    >Home
                    </Link>
                    <Link
                        :href="route('generator')"
                        class="mx-2 p-1 text-gray-300 hover:text-white"
                        :class="{ 'border-blue-500': props.selectedPage === 'Generator' }"
                    >Generator
                    </Link>
                    <Link
                        :href="route('admin')"
                        class="mx-2 p-1 text-gray-300 hover:text-white"
                        :class="{ 'border-blue-500': props.selectedPage === 'Admin' }"
                    >Admin Panel
                    </Link>
                </div>

                <button type="button" @click="toggleTheme" class="w-1/3 text-end text-white justify-self-end">Toggle
                    Theme:
                    {{ darkMode.valueOf() ? 'Dark' : 'Light' }}
                </button>
            </nav>
        </header>

        <main
            class="pt-20 px-2 flex flex-col text-center">
            <slot/>
        </main>

        <footer class="py-4 text-center text-sm text-white/70 bg-black sticky top-[100vh]">
            &copy; 2024 David Lutz
        </footer>
    </div>
</template>
