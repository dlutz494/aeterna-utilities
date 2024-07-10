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
    <Head title="Home"/>
    <DefaultLayout header="Home" selected-page="Home">
        <menu class="flex flex-col items-center">
            <Link
                id="generator"
                :href="route('generator')"
                class="rounded-xl py-2 px-6 mb-4 w-1/4 text-white font-extrabold bg-red-600 hover:bg-red-500 active:bg-red-700 block"
            >
                Encounter Generator
            </Link>
            <Link
                id="admin"
                :href="route('admin')"
                class="rounded-xl py-2 px-6 mb-4 w-1/4 text-white font-extrabold bg-red-600 hover:bg-red-500 active:bg-red-700 block"
            >
                Admin Panel
            </Link>
        </menu>

    </DefaultLayout>
</template>
