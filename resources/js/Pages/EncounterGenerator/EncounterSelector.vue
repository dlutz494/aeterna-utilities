<script setup>

import { onMounted, onUpdated } from 'vue';

const props = defineProps(
    {
        encounterCategories: { type: Array }
    });

const emit = defineEmits(['select:category']);

function selectCategory () {
    emit('select:category', props.encounterCategories[0]);
}

onMounted(() => selectCategory());
onUpdated(() => selectCategory());
</script>

<template>
    <select
        id="location-selector"
        @change="(e) => emit('select:category', e.target.value)"
    >
        <option
            v-for="category in encounterCategories"
            :value="category"
        >{{ category ?? 'Anywhere' }}
        </option>
    </select>
</template>
