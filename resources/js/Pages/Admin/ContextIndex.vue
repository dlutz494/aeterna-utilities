<script setup>
import { Head, Link } from '@inertiajs/vue3';
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import { computed, ref } from 'vue';

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
        create_url: { type: String },
        pagination: {
            type: Number,
            default: 25
        }
    });

// Sorting
const titleSorting = ref('');
const sortTitles = () => {
    switch (titleSorting.value) {
        case '':
            titleSorting.value = 'ASC';
            break;
        case 'ASC':
            titleSorting.value = 'DESC';
            break;
        case 'DESC':
            titleSorting.value = '';
            break;
    }
};

// Context filtering/sorting/paginating
const sortContexts = (contexts) => {
    return contexts.sort((contextA, contextB) => {
        switch (titleSorting.value) {
            case '':
                return contextA.id - contextB.id;
            case 'DESC':
                return contextB.title.localeCompare(contextA.title);
            case 'ASC':
                return contextA.title.localeCompare(contextB.title);
        }
    });
};
const paginateContexts = (contexts) => {
    return contexts.slice(currentPage.value, currentPage.value + props.pagination);
};

// Context list
const sortedContexts = computed(() => {
    let sorted = sortContexts(props.contexts);
    return paginateContexts(sorted);
});
const sortedContextsLength = computed(() => {
    let sorted = sortContexts(props.contexts);
    return sorted.length;
});

// Pagination
const currentPage = ref(0);
const nextPage = () => {
    if (currentPage.value + props.pagination <= sortedContextsLength.value) {
        currentPage.value = currentPage.value + props.pagination;
    }
};
const previousPage = () => {
    if ((currentPage.value) > 0) {
        currentPage.value = currentPage.value - props.pagination;
    }
};
const goToPage = (pageNumber) => {
    currentPage.value = (pageNumber - 1) * props.pagination;
};
const pages = computed(() => {
    let pagesArray = [];
    for (let i = 1; i <= Math.ceil(sortedContextsLength.value / props.pagination); i++) {
        pagesArray.push(i);
    }
    return pagesArray;
});
</script>

<template>
    <Head title="Contexts"/>
    <DefaultLayout header="Contexts">
        <div class="grid place-items-center">
            <Link
                :href="create_url"
                class="rounded-xl py-2 px-6 w-1/4 text-white font-extrabold bg-red-600 hover:bg-red-500 active:bg-red-700"
            >
                Create New Context
            </Link>

            <table class="w-2/3 bg-white text-sm mt-4">
                <thead class="border-b-[3px] border-b-stone-300">
                <tr>
                    <th class="border text-start p-4 hover:cursor-pointer" @click="sortTitles">Title {{
                            titleSorting.valueOf() === 'ASC' ? '▲' :
                                titleSorting.valueOf() === 'DESC' ? '▼' : ''
                        }}
                    </th>
                    <th class="border text-center p-4 italic font-normal">Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="context in sortedContexts" class="odd:bg-stone-100">
                    <td class="border text-start px-4 w-3/4 py-2">{{ context.title }}</td>
                    <td class="border text-center px-4 py-2">
                        <Link
                            class="hover:text-gray-700"
                            :href="context.edit_url"
                            as="button"
                        >
                            Edit
                        </Link>
                        |
                        <Link
                            class="hover:text-gray-700"
                            :href="context.delete_url"
                            method="delete"
                            as="button"
                            preserve-scroll
                        >
                            Delete
                        </Link>
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="mb-4 flex w-2/3 justify-end">
                <button
                    class="bg-white p-1 border"
                    @click="previousPage"
                >Back
                </button>
                <div v-for="page in pages">
                    <button
                        class="bg-white p-1 border"
                        @click="goToPage(page)"
                        :class="{ 'text-sky-400' : (currentPage === (page - 1) * props.pagination) }"
                    >{{ page }}
                    </button>
                </div>
                <button
                    class="bg-white p-1 border"
                    @click="nextPage"
                >Next
                </button>
            </div>
        </div>
    </DefaultLayout>
</template>
