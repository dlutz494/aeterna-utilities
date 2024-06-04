<script setup>
// Props
const props = defineProps([
    'fieldKey',
    'fieldTitle'
]);

// Models
const fieldValue = defineModel('fieldValue');
const errors = defineModel('errors');
</script>

<template>
    <label :for="props.fieldKey"
           class="col-span-1 content-center"
    >
        {{ props.fieldTitle }}:
    </label>
    <input :id="props.fieldKey"
           :class="{ 'border-red-500 border-4' : errors, 'mb-2' : !errors }"
           class="col-span-3 border shadow"
           type="text"
           v-model="fieldValue"
    />
    <div v-if="errors" class="col-start-2 col-span-3 text-red-500 mb-2">{{ errors }}</div>
</template>
