<script setup>

const props = defineProps(
    {
        result: {
            type: Object,
            default: {
                title: '',
                description: ''
            }
        }
    });

const emit = defineEmits(['generate:encounter']);
</script>

<template>
    <button
        class="dark:text-white dark:bg-gray-600 rounded p-1 active:bg-gray-700 hover:bg-gray-500 mb-2"
        @click="emit('generate:encounter')"
    >Generate Random Encounter
    </button>
    <input
        id="result-title"
        type="text"
        class="w-full"
        :value="result.title"
        disabled
    >
    <textarea
        id="result-description"
        class="w-full h-24"
        :value="result.description"
        disabled
    ></textarea>
</template>
