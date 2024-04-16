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
        class="rounded py-1 px-2 mb-2 text-black bg-gray-200 hover:bg-gray-100 active:bg-gray-300
        dark:text-white dark:bg-gray-600 dark:hover:bg-gray-500 dark:active:bg-gray-700"
        @click="emit('generate:encounter')"
    >Generate Random Encounter
    </button>
    <input
        id="result-title"
        type="text"
        class="w-1/2"
        :value="result.title"
        disabled
    >
    <textarea
        id="result-description"
        class="w-1/2 h-24"
        :value="result.description"
        disabled
    ></textarea>
</template>
