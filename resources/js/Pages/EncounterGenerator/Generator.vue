<script setup>
import { Head } from '@inertiajs/vue3';
import { computed, reactive, ref } from 'vue';
import EncounterTable from '@/Pages/EncounterGenerator/EncounterTable.vue';
import GeneratorResult from '@/Pages/EncounterGenerator/GeneratorResult.vue';
import ContextSelector from '@/Pages/EncounterGenerator/ContextSelector.vue';
import DefaultLayout from '@/Layouts/DefaultLayout.vue';

// Setup
const props = defineProps(
    {
        encounters: { type: Array },
        all_contexts: { type: Object }
    });

// Encounters
const selectedEncounter = reactive({});
const filteredEncounters = computed(() => {
    let encounters = props.encounters
        .filter(function (encounter) {
            if (encounter.contexts.length !== 0) {
                return encounter.contexts.find(function (context) {
                    return context?.id === selectedContext.value;
                });
            } else return true;
        })
        .sort((a, b) => a.weight - b.weight)
        .reverse();

    let totalWeight = 0;
    encounters.forEach((encounter) => totalWeight += encounter.weight);
    const percentage = 100 / totalWeight;

    return encounters.map((encounter) => ({
        title: encounter.title,
        description: encounter.description,
        weight: (encounter.weight * percentage).toFixed(0)
    }));
});
const rolling = ref(false);
const getEncounter = () => {
    rolling.value = true;
    selectedEncounter.value = { title: 'Rolling...' };

    setTimeout(function () {
        let weightedEncounters = [];
        filteredEncounters.value.forEach((encounter) => {
            for (let i = 0; i < encounter.weight; i++) {
                weightedEncounters.push(encounter);
            }
        });
        const index = Math.floor(Math.random() * weightedEncounters.length);
        selectedEncounter.value = weightedEncounters[index];
        rolling.value = false;
    }, 500);
};

// Contexts
const selectedContext = ref(0);
const encounterContexts = computed(() => {
    return props.all_contexts;
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
            <ContextSelector
                class="mb-2"
                :encounter-contexts="encounterContexts"
                @select:context="(context) => selectContext(context)"
            ></ContextSelector>

            <EncounterTable
                :encounters="filteredEncounters"
            ></EncounterTable>

            <GeneratorResult
                :result="selectedEncounter.value"
                :rolling="rolling.valueOf()"
                @generate:encounter="getEncounter"
            ></GeneratorResult>
        </div>
    </DefaultLayout>
</template>
