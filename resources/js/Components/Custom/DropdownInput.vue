<script setup>
// Props
const props = defineProps([
    'fieldKey',
    'fieldTitle',
    'options'
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
    <select :id="props.fieldKey"
            :name="props.fieldKey"
            :class="{ 'border-red-500 border-4' : errors, 'mb-2' : !errors }"
            class="col-span-2"
            v-model="fieldValue">
        <option v-for="option in options"
                :value="option.id"
        >{{ option.title }}
        </option>
    </select>
    <div v-if="errors" class="col-start-2 col-span-2 text-red-500 mb-2">{{ errors }}</div>
</template>
