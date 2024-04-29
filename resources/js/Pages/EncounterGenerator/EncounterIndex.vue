<script setup>
import { Head, Link } from '@inertiajs/vue3';
import DefaultLayout from '@/Layouts/DefaultLayout.vue';

const props = defineProps(
    {
        encounters: {
            type: {
                id: Number,
                title: String,
                description: String,
                context: Object,
                weight: Object,
                edit_url: String,
                delete_url: String
            }
        },
        create_url: { type: String }
    });
</script>

<template>
    <Head title="Encounters Index"/>
    <DefaultLayout header="Encounters">
        <Link
            :href="route('admin')"
            class="rounded py-1 px-2 mb-2 text-black bg-gray-200 hover:bg-gray-100 active:bg-gray-300 dark:text-white dark:bg-gray-600 dark:hover:bg-gray-500 dark:active:bg-gray-700"
        >
            Admin Panel
        </Link>

        <Link
            :href="create_url"
            class="rounded py-1 px-2 mb-2 text-black bg-gray-200 hover:bg-gray-100 active:bg-gray-300 dark:text-white dark:bg-gray-600 dark:hover:bg-gray-500 dark:active:bg-gray-700"
        >
            Create New Encounter
        </Link>

        <table class="mb-4 table-fixed border border-slate-500">
            <thead class="p-2 bg-gray-400 dark:bg-gray-950">
            <tr>
                <th class="dark:text-white border border-slate-500">Title</th>
                <th class="dark:text-white border border-slate-500">Description</th>
                <th class="dark:text-white border border-slate-500">Context</th>
                <th class="dark:text-white border border-slate-500">Weight</th>
                <th class="dark:text-white border border-slate-500 italic font-light">Actions</th>
            </tr>
            </thead>
            <tbody class="mb-2">
            <tr v-for="encounter in encounters" class="odd:bg-slate-200 even:bg-slate-300 dark:even:bg-slate-900 dark:odd:bg-slate-800">
                <td class="dark:text-white pl-4 w-1/6 border border-slate-500 mx-1">{{ encounter.title }}</td>
                <td class="dark:text-white pl-4 w-3/6 border border-slate-500 mx-1">{{ encounter.description }}</td>
                <td class="dark:text-white pl-4 w-1/6 border border-slate-500 mx-1">
                    {{ encounter.context ? encounter.context.title : 'N/A' }}
                </td>
                <td class="dark:text-white pl-4 w-3/6 border border-slate-500 mx-1">{{ encounter.weight }}</td>
                <td class="dark:text-gray-400 w-1/6 border border-slate-500 mx-1 text-nowrap">
                    <Link
                        class="dark:text-white bg-gray-400 dark:bg-gray-700 hover:bg-gray-500 dark:hover:bg-gray-800 active:bg-gray-600 rounded p-1 m-0.5"
                        :href="encounter.edit_url"
                    >
                        Edit
                    </Link>
                    <Link
                        class="dark:text-white bg-red-400 dark:bg-red-700 hover:bg-red-500 dark:hover:bg-red-800 active:bg-red-600 rounded p-1 m-0.5"
                        :href="encounter.delete_url"
                        method="delete"
                        as="button"
                    >
                        Delete
                    </Link>
                </td>
            </tr>
            </tbody>
        </table>
    </DefaultLayout>
</template>
