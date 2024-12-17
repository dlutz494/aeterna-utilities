<script setup>
import { onMounted, onUpdated } from 'vue';

const props = defineProps(
    {
        encounterContexts: { type: Object }
    });

const emit = defineEmits(['select:context']);

function selectContext () {
    emit('select:context', props.encounterContexts[0]?.id);
}

onMounted(() => selectContext());
onUpdated(() => selectContext());
</script>

<template>
    <div class="w-1/2 text-start pl-2">
        <label for="context-selector" class="my-2.5 mr-2 text-2xl">Context: </label>
        <select
            id="context-selector"
            @change="(e) => emit('select:context', e.target.value)"
            class="w-1/3"
        >
            <option
                v-for="context in encounterContexts"
                :value="context.id"
            >{{ context.title }}
            </option>
            <option
                :value="null"
            >Anywhere
            </option>
        </select>
    </div>
</template>
