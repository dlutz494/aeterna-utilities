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
    <Head title="Encounters"/>
    <DefaultLayout header="Encounters">
        <div class="grid place-items-center">
            <Link
                :href="create_url"
                class="rounded-xl py-2 px-6 w-1/4 text-white font-extrabold bg-red-600 hover:bg-red-500 active:bg-red-700"
            >
                Create New Encounter
            </Link>

            <table class="w-2/3 bg-white text-sm my-4">
                <thead class="border-b-[3px] border-b-stone-300">
                <tr>
                    <th class="border text-start p-4">Title</th>
                    <th class="border text-start p-4">Description</th>
                    <th class="border text-start p-4">Context</th>
                    <th class="border text-start p-4">Weight</th>
                    <th class="border text-center p-4 italic font-normal">Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="encounter in encounters" class="odd:bg-stone-100">
                    <td class="border text-start px-4 py-2">{{ encounter.title }}</td>
                    <td class="border text-start w-1/2 px-4 py-2">{{ encounter.description }}</td>
                    <td class="border text-start px-4 py-2">
                        {{ encounter.context ? encounter.context.title : 'N/A' }}
                    </td>
                    <td class="border text-start px-4 py-2">{{ encounter.weight }}</td>
                    <td class="border text-center px-4 py-2">
                        <Link
                            class="hover:text-gray-700"
                            :href="encounter.edit_url"
                            as="button"
                        >
                            Edit
                        </Link>
                        |
                        <Link
                            class="hover:text-gray-700"
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
        </div>
    </DefaultLayout>
</template>
