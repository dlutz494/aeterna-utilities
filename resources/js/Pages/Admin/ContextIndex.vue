<script setup>
import { Head, Link } from '@inertiajs/vue3';
import DefaultLayout from '@/Layouts/DefaultLayout.vue';

const props = defineProps(
    {
        contexts: {
            type: {
                id: Number,
                title: String,
                edit_url: String,
                delete_url: String
            }
        },
        create_url: { type: String }
    });
</script>

<template>
    <Head title="Context Index"/>
    <DefaultLayout header="Contexts">
        <div class="grid place-items-center">
            <Link
                :href="create_url"
                class="rounded-xl py-2 px-6 w-1/4 text-white font-extrabold bg-red-600 hover:bg-red-500 active:bg-red-700"
            >
                Create New Context
            </Link>

            <table class="w-2/3 bg-white text-sm my-4">
                <thead class="border-b-[3px] border-b-stone-300">
                <tr>
                    <th class="border text-center p-4">Title</th>
                    <th class="border text-center p-4 italic font-light">Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="context in contexts" class="odd:bg-stone-100">
                    <td class="border text-center px-4 w-3/4 py-2">{{ context.title }}</td>
                    <td class="border text-center px-4 py-2">
                        <Link
                            class="rounded-sm p-1 mx-1 text-white bg-stone-600 hover:bg-stone-500 active:bg-stone-700"
                            :href="context.edit_url"
                            as="button"
                        >
                            Edit
                        </Link>
                        <Link
                            class="rounded-sm p-1 mx-1 text-white bg-red-600 hover:bg-red-500 active:bg-red-700"
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
        </div>
    </DefaultLayout>
</template>
