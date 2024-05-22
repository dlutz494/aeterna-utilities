<script setup>

import { computed, ref } from 'vue';

const props = defineProps(
    {
        encounters: { type: Array }
    });

function addPadding(num) {
    if (num.toString().length === 1) {
        return num.toString().padStart(2, '0');
    } else {
        return num;
    }
}

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
                displayRange = addPadding(range);
            } else {
                displayRange = addPadding(range) + '–' + addPadding(range + weight);
            }
            range += 2;
        } else {
            if ((range + weight - 1) > dieRange) {
                displayRange = addPadding(range);
            } else {
                displayRange = addPadding(range) + '–' + addPadding(range + weight - 1);
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
    <table class="mb-4 w-1/2 bg-white text-sm">
        <thead class="border-b-[3px] border-b-stone-300">
        <tr>
            <th class="border">
                <select name="dice" v-model="selectedDie" class="w-full text-center text-sm p-4">
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
            <th class="border text-start p-4">Title</th>
            <th class="border text-start p-4 max-md:hidden">Description</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="encounter in dieWeightedEncounters" class="odd:bg-stone-100">
            <td class="border w-1/6">{{
                    encounter.weight
                }}{{ selectedDie.valueOf() === '0' ? '%' : '' }}
            </td>
            <td class="border text-start w-1/6 px-4 py-2">{{ encounter.title }}</td>
            <td class="border text-start w-4/6 px-4 py-2 max-md:hidden">{{ encounter.description }}</td>
        </tr>
        </tbody>
    </table>
</template>
