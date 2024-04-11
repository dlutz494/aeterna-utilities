<script setup>
import { Head, Link } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';

const props = defineProps(
    {
        contexts: { type: Object }
    });
</script>

<template>
    <Head title="Context Index"/>
    <GuestLayout>
        <Link
            :href="route('generator.admin')"
            class="bg-gray-900 rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
        >
            Admin Panel
        </Link>

        <Link
            :href="route('context.create')"
            class="bg-gray-900 rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
        >
            Create New Context
        </Link>

        <table class="mb-4 table-fixed border border-slate-500">
            <thead class="p-2 bg-gray-950">
            <tr>
                <th class="dark:text-white border border-slate-500">Title</th>
                <th class="dark:text-white border border-slate-500 italic font-light">Actions</th>
            </tr>
            </thead>
            <tbody class="mb-2">
            <tr v-for="context in contexts" class="odd:bg-slate-800 even:bg-slate-900">
                <td class="dark:text-white pl-4 w-3/4 border border-slate-500 mx-1">{{ context.title }}</td>
                <td class="dark:text-gray-400 w-1/4 border border-slate-500 mx-1 text-nowrap">
                    <Link
                        class="dark:text-white bg-gray-700 hover:bg-gray-800 active:bg-gray-600 rounded p-1 m-0.5"
                        :href="context.edit_url"
                    >
                        Edit
                    </Link>
                    <Link
                        class="dark:text-white bg-red-700 hover:bg-red-800 active:bg-red-600 rounded p-1 m-0.5"
                        :href="context.delete_url"
                        method="delete"
                        as="button"
                    >
                        Delete
                    </Link>
                </td>
            </tr>
            </tbody>
        </table>
    </GuestLayout>
</template>
