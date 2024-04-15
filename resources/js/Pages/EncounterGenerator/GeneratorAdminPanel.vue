<script setup>
import { Head, Link } from '@inertiajs/vue3';
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
</script>

<template>
    <Head title="Encounter Generator Admin Panel"/>

    <DefaultLayout>
        <Link
            :href="route('generator')"
            class="bg-gray-900 m-2 rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
        >
            Encounter Generator
        </Link>
        <Link
            class="bg-gray-900 m-2 rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
            :href="route('encounter.index')"
        >
            Encounters
        </Link>
        <Link
            class="bg-gray-900 m-2 rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
            :href="route('context.index')"
        >
            Contexts
        </Link>
    </DefaultLayout>
</template>
