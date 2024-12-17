<script setup>

const props = defineProps(
    {
        result: {
            type: Object,
            default: {
                title: '',
                description: ''
            }
        },
        rolling: {
            type: Boolean,
            default: false
        }
    });

const emit = defineEmits(['generate:encounter']);
</script>

<template>
    <button
        class="rounded-xl py-2 px-6 uppercase font-bold mb-4 text-white bg-red-600 hover:bg-red-500 active:bg-red-700 disabled:bg-red-900"
        :disabled="rolling"
        @click="emit('generate:encounter')"
    >Roll
    </button>
    <input
        id="result-title"
        type="text"
        class="w-3/4 border-stone-300"
        :value="result.title"
        disabled
    >
    <textarea
        id="result-description"
        class="w-3/4 h-24 border-stone-300 bg-stone-100"
        :value="result.description"
        disabled
    ></textarea>
</template>
