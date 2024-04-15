<script setup>
import { Head, Link } from '@inertiajs/vue3';
import DefaultLayout from '@/Layouts/DefaultLayout.vue';

defineProps({
    canLogin: {
        type: Boolean
    },
    canRegister: {
        type: Boolean
    },
    laravelVersion: {
        type: String,
        required: true
    },
    phpVersion: {
        type: String,
        required: true
    }
});

function handleImageError () {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}
</script>

<template>
    <Head title="Welcome"/>
    <DefaultLayout>
        <nav class="flex flex-col text-center items-center">
            <Link
                :href="route('generator')"
                class="bg-blue-200 dark:bg-blue-800 text-black dark:text-white w-1/2 mb-2"
            >
                Encounter Generator
            </Link>
        </nav>
    </DefaultLayout>
</template>
