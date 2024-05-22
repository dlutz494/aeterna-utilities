<script setup>
import { Head, Link } from '@inertiajs/vue3';
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
</script>

<template>
    <Head title="Admin Panel"/>

    <DefaultLayout header="Admin Panel" selected-page="Admin">
        <menu class="flex flex-col items-center">
            <Link
                class="rounded-xl py-2 px-6 mb-4 w-1/4 text-white font-extrabold bg-red-600 hover:bg-red-500 active:bg-red-700 block"
                :href="route('encounter.index')"
            >
                Encounters
            </Link>
            <Link
                class="rounded-xl py-2 px-6 mb-4 w-1/4 text-white font-extrabold bg-red-600 hover:bg-red-500 active:bg-red-700 block"
                :href="route('context.index')"
            >
                Contexts
            </Link>
        </menu>
    </DefaultLayout>
</template>
