<script setup>
import { Head } from '@inertiajs/vue3';
import { computed, reactive, ref } from 'vue';
import EncounterTable from '@/Pages/EncounterGenerator/EncounterTable.vue';
import GeneratorResult from '@/Pages/EncounterGenerator/GeneratorResult.vue';
import EncounterSelector from '@/Pages/EncounterGenerator/ContextSelector.vue';
import DefaultLayout from '@/Layouts/DefaultLayout.vue';

// Setup
const props = defineProps(
    {
        encounters: { type: Array },
        contexts: { type: Object }
    });

// Encounter
const selectedEncounter = reactive({});
const filteredEncounters = computed(() => {
    // Return encounters matching the selected context, sorted most to least likely based on weight
    return props.encounters
        .filter((encounter) => encounter.context?.id === selectedContext.value || encounter.context === null)
        .sort((a, b) => a.weight - b.weight)
        .reverse();
});
const getEncounter = () => {
    // create an array with a number of entries based on weight
    let weightedEncounters = [];
    // iterate over each encounter, adding it to the new array a number of times equal to the weight
    filteredEncounters.value.forEach((encounter) => {
        for (let i = 0; i < encounter.weight; i++) {
            weightedEncounters.push(encounter);
        }
    });
    // select a random index from that new array
    const index = Math.floor(Math.random() * weightedEncounters.length);
    selectedEncounter.value = weightedEncounters[index];
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
    <DefaultLayout header="Generator" selected-page="Generator">
        <div class="grid place-items-center">
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
