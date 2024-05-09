<script setup>

import { computed, ref } from 'vue';

const props = defineProps(
    {
        encounters: { type: Array }
    });

const selectedDie = ref('0');
const dieWeightedEncounters = computed(() => {
    if (selectedDie.value === '0') {
        return props.encounters;
    }

    let range = 1;
    let dieRange = parseInt(selectedDie.value);
    return props.encounters.map((encounter) => {
        let weight = Math.max(Math.floor((encounter.weight / 100) * dieRange), 1);
        let displayRange;
        if (range > dieRange) return;
        if (weight === 1) {
            if ((range + weight) > dieRange) {
                displayRange = range;
            } else {
                displayRange = range + '-' + (range + weight);
            }
            range += 2;
        } else {
            if ((range + weight - 1) > dieRange) {
                displayRange = range;
            } else {
                displayRange = range + '-' + (range + weight - 1);
            }
            range += weight;
        }

        return {
            title: encounter.title,
            description: encounter.description,
            weight: displayRange
        };
    }).filter(encounter => {
        return encounter;
    });
});
</script>

<template>
    <table class="mb-4 border border-slate-500 w-3/4">
        <thead class="bg-gray-400 dark:bg-gray-950">
        <tr>
            <th class="dark:text-white border border-slate-500">
                <select name="dice" v-model="selectedDie" class="dark:bg-black w-full text-center">
                    <option value="0" selected>Chance</option>
                    <option value="4">d4</option>
                    <option value="6">d6</option>
                    <option value="8">d8</option>
                    <option value="10">d10</option>
                    <option value="12">d12</option>
                    <option value="20">d20</option>
                    <option value="100">d100</option>
                </select>
            </th>
            <th class="dark:text-white border border-slate-500">Title</th>
            <th class="dark:text-white border border-slate-500">Description</th>
        </tr>
        </thead>
        <tbody class="bg-slate-200 dark:bg-slate-700">
        <tr v-for="encounter in dieWeightedEncounters" class="even:bg-slate-300 dark:even:bg-slate-800">
            <td class="dark:text-white px-2 w-1/6 border border-slate-500">{{
                    encounter.weight
                }}{{ selectedDie.valueOf() === '0' ? '%' : '' }}
            </td>
            <td class="dark:text-white px-2 w-1/6 border border-slate-500 mx-1">{{ encounter.title }}</td>
            <td class="dark:text-white px-2 w-4/6 border border-slate-500 mx-1">{{ encounter.description }}</td>
        </tr>
        </tbody>
    </table>
</template>
