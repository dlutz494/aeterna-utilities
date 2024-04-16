<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { computed, reactive, ref } from 'vue';
import EncounterTable from '@/Pages/EncounterGenerator/EncounterTable.vue';
import GeneratorResult from '@/Pages/EncounterGenerator/GeneratorResult.vue';
import EncounterSelector from '@/Pages/EncounterGenerator/ContextSelector.vue';
import DefaultLayout from '@/Layouts/DefaultLayout.vue';

// Setup
const props = defineProps(
    {
        encounters: { type: Object },
        contexts: { type: Object }
    });

// Encounter
const selectedEncounter = reactive({});
const filteredEncounters = computed(() => {
    return props.encounters.filter((encounter) => encounter.context_id === selectedContext.value || encounter.context_id === null);
});
const getEncounter = () => {
    const index = Math.floor(Math.random() * filteredEncounters.value.length);
    selectedEncounter.value = filteredEncounters.value[index];
};

// Context
const selectedContext = ref(0);
const encounterContexts = computed(() => {
    return props.contexts;
});
const selectContext = (context) => {
    selectedContext.value = parseInt(context);
    selectedEncounter.value = {};
};
</script>

<template>
    <Head title="Random Encounter Generator"/>
    <DefaultLayout header="Generator">
        <div class="grid place-items-center">
            <Link
                class="bg-blue-200 dark:bg-blue-800 text-black dark:text-white w-1/2 mb-2 rounded"
                :href="route('generator.admin')"
            >
                Admin Panel
            </Link>

            <EncounterSelector
                class="mb-2"
                :encounter-contexts="encounterContexts"
                @select:context="(context) => selectContext(context)"
            ></EncounterSelector>

            <EncounterTable
                :encounters="filteredEncounters"
            ></EncounterTable>

            <GeneratorResult
                :result="selectedEncounter.value"
                @generate:encounter="getEncounter"
            ></GeneratorResult>
        </div>
    </DefaultLayout>
</template>
