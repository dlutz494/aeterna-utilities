<script setup>
// Props
const props = defineProps([
    'fieldKey',
    'fieldTitle',
    'options'
]);

// Emits
const emits = defineEmits([
    'context-remove'
])

// Models
const fieldValue = defineModel('fieldValue');
const errors = defineModel('errors');
const hideButton = defineModel('hideButton')
</script>

<template>
    <label :for="props.fieldKey"
           class="content-center"
    >
        {{ props.fieldTitle }}:
    </label>
    <select :id="props.fieldKey"
            :name="props.fieldKey"
            :class="{ 'border-red-500 border-4' : errors, 'mb-2' : !errors }"
            class="col-span-2"
            v-model="fieldValue">
        <option v-for="option in options"
                :value="option.id"
                :disabled="option.selected"
        >{{ option.title }}
        </option>
    </select>
    <button type="button"
            class="col-span-1 text-white uppercase text-xs font-bold bg-sky-400 hover:bg-sky-300 active:bg-sky-400 rounded-sm ml-2"
            :class="{'mb-2' : !errors}"
            @click="emits('context-remove')"
            :hidden="hideButton"
    >
        Remove Context
    </button>
    <div v-if="errors" class="col-start-2 col-span-2 text-red-500 mb-2">{{ errors }}</div>
</template>
