<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps(
    {
        encounters: { type: Object }
    });
</script>

<template>
    <table class="mb-4 table-fixed border border-slate-500">
        <thead class="p-2 bg-gray-950">
        <tr>
            <th class="dark:text-white border border-slate-500">Title</th>
            <th class="dark:text-white border border-slate-500">Description</th>
            <th class="dark:text-white border border-slate-500 italic font-light">Actions</th>
        </tr>
        </thead>
        <tbody class="mb-2">
        <tr v-for="encounter in encounters" class="odd:bg-slate-800 even:bg-slate-900">
            <td class="dark:text-white pl-4 w-1/6 border border-slate-500 mx-1">{{ encounter.title }}</td>
            <td class="dark:text-white pl-4 w-4/6 border border-slate-500 mx-1">{{ encounter.description }}</td>
            <td class="dark:text-gray-400 w-1/6 border border-slate-500 mx-1 text-nowrap">
                <Link
                    class="dark:text-white bg-gray-700 hover:bg-gray-800 active:bg-gray-600 rounded p-1 m-0.5"
                    :href="route('encounter.edit', encounter)"
                >
                    Edit
                </Link>
                <Link
                    class="dark:text-white bg-red-700 hover:bg-red-800 active:bg-red-600 rounded p-1 m-0.5"
                    :href="route('encounter.delete', encounter)"
                    method="delete"
                    as="button"
                >
                    Delete
                </Link>
            </td>
        </tr>
        </tbody>
    </table>
</template>
