<script setup>

import { onMounted, onUpdated } from 'vue';

const props = defineProps(
    {
        encounterCategories: { type: Array }
    });

const emit = defineEmits(['select:context']);

function selectContext () {
    emit('select:context', props.encounterCategories[0]);
}

onMounted(() => selectContext());
onUpdated(() => selectContext());
</script>

<template>
    <select
        id="context-selector"
        @change="(e) => emit('select:context', e.target.value)"
    >
        <option
            v-for="context in encounterCategories"
            :value="context"
        >{{ context ?? 'Anywhere' }}
        </option>
    </select>
</template>
