<script setup>
import { Head, Link } from '@inertiajs/vue3';
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import { computed, ref } from 'vue';

const props = defineProps(
    {
        encounters: {
            type: {
                id: Number,
                title: String,
                description: String,
                contexts: Array,
                weight: Object,
                edit_url: String,
                delete_url: String
            }
        },
        create_url: { type: String },
        all_contexts: {
            type: Object
        }
    });

const selectContext = (context) => {
    contextFilter.value = context;
};
const contextFilter = ref('');
const filteredEncounters = computed(() => {
    return props.encounters.filter((encounter) => {
        if (contextFilter.value === '') {
            return props.encounters;
        } else if (contextFilter.value === 'N/A') {
            return encounter.contexts.length === 0;
        } else {
            return encounter.contexts.find(function (context) {
                return context?.id === parseInt(contextFilter.value);
            });
        }
    }).sort((encounterA, encounterB) => {
        switch (weightSorting.value) {
            case '':
                return encounterA.id - encounterB.id;
            case 'DESC':
                return encounterB.weight - encounterA.weight;
            case 'ASC':
                return encounterA.weight - encounterB.weight;
        }
    }).sort((encounterA, encounterB) => {
        switch (titleSorting.value) {
            case '':
                return 0;
            case 'DESC':
                return encounterB.title.localeCompare(encounterA.title);
            case 'ASC':
                return encounterA.title.localeCompare(encounterB.title);
        }
    });
});

const weightSorting = ref('');
const sortWeights = () => {
    titleSorting.value = '';
    switch (weightSorting.value) {
        case '':
            weightSorting.value = 'ASC';
            break;
        case 'ASC':
            weightSorting.value = 'DESC';
            break;
        case 'DESC':
            weightSorting.value = '';
            break;
    }
};

const titleSorting = ref('');
const sortTitles = () => {
    weightSorting.value = '';
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

const clearSorting = () => {
    document.getElementById('context-selector').value = ''
    contextFilter.value = '';
    weightSorting.value = '';
    titleSorting.value = '';
};
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
                    <th class="border"></th>
                    <th class="border"></th>
                    <th class="border"><select
                        id="context-selector"
                        class="w-full font-light"
                        @change="(e) => selectContext(e.target.value)"
                    >
                        <option
                            value=""
                            selected
                        >Filter
                        </option>
                        <option
                            v-for="context in all_contexts"
                            :value="context.id"
                        >{{ context.title }}
                        </option>
                        <option
                            value="N/A"
                        >Anywhere
                        </option>
                    </select></th>
                    <th class="border"></th>
                    <th class="border font-bold text-white hover:cursor-pointer bg-sky-400 hover:bg-sky-300 active:bg-sky-400"
                        @click="clearSorting">Clear Sorting
                    </th>
                </tr>
                <tr>
                    <th class="border text-start p-4 hover:cursor-pointer w-1/5" @click="sortTitles">Title {{
                            titleSorting.valueOf() === 'ASC' ? '▲' :
                                titleSorting.valueOf() === 'DESC' ? '▼' : ''
                        }}
                    </th>
                    <th class="border text-start p-4 w-1/2">Description</th>
                    <th class="border text-start p-4 w-[10%]">Context</th>
                    <th class="border text-start p-4 hover:cursor-pointer w-[10%]" @click="sortWeights">Weight {{
                            weightSorting.valueOf() === 'ASC' ? '▲' :
                                weightSorting.valueOf() === 'DESC' ? '▼' : ''
                        }}
                    </th>
                    <th class="border text-center p-4 italic font-normal w-[10%]">Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="encounter in filteredEncounters" class="odd:bg-stone-100">
                    <td class="border text-start px-4 py-2">{{ encounter.title }}</td>
                    <td class="border text-start w-1/2 px-4 py-2">{{ encounter.description }}</td>
                    <td class="border text-start px-4 py-2">
                        <div v-if="encounter.contexts.length === 0">Anywhere</div>
                        <ul v-else>
                            <li v-for="context in encounter.contexts">
                                {{ context.title }}
                            </li>
                        </ul>
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
                            preserve-scroll
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
