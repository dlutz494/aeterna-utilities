<script setup>
import { Head, Link } from '@inertiajs/vue3';
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
</script>

<template>
    <Head title="Admin Panel"/>

    <DefaultLayout header="Admin Panel" selected-page="Admin">
        <menu class="flex flex-col items-center">
            <Link
                class="bg-blue-200 dark:bg-blue-800 text-black dark:text-white w-1/2 mb-2 rounded py-1 px-2"
                :href="route('encounter.index')"
            >
                Encounters
            </Link>
            <Link
                class="bg-blue-200 dark:bg-blue-800 text-black dark:text-white w-1/2 mb-2 rounded py-1 px-2"
                :href="route('context.index')"
            >
                Contexts
            </Link>
        </menu>
    </DefaultLayout>
</template>
