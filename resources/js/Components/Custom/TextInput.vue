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
           class="dark:text-white content-center"
    >
        {{ props.fieldTitle }}:
    </label>
    <input :id="props.fieldKey"
           :class="{ 'border-red-500 border-4' : errors }"
           class="col-span-2 rounded-lg"
           type="text"
           v-model="fieldValue"
    />
    <div v-if="errors" class="col-start-2 col-span-2 text-red-500">{{ errors }}</div>
</template>
