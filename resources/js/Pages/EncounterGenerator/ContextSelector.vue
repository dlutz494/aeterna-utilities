<script setup>
import { onMounted, onUpdated } from 'vue';

const props = defineProps(
    {
        encounterContexts: { type: Object }
    });

const emit = defineEmits(['select:context']);

function selectContext () {
    emit('select:context', props.encounterContexts[0].id);
}

onMounted(() => selectContext());
onUpdated(() => selectContext());
</script>

<template>
    <div class="grid col-span-full">
        <select
            id="context-selector"
            @change="(e) => emit('select:context', e.target.value)"
            class="col-span-2"
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
