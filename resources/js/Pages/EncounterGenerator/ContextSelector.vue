<script setup>
import { onMounted, onUpdated } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps(
    {
        encounterContexts: { type: Object },
    });

const emit = defineEmits(['select:context']);

function selectContext () {
    emit('select:context', props.encounterContexts[0].id);
}

onMounted(() => selectContext());
onUpdated(() => selectContext());
</script>

<template>
    <div class="grid grid-cols-3">
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
        <Link
            class="text-white bg-gray-600 rounded p-1 active:bg-gray-700 hover:bg-gray-500 mb-2 text-center col-start-3"
            :href="route('context.create')"
        >
            Create New Context
        </Link>
    </div>
</template>
