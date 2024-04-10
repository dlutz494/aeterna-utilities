<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import TextInput from '@/Components/Custom/TextInput.vue';

// Props
const props = defineProps([
    'context'
]);

// Form
const form = useForm({
    title: props.context.title
});

function submit () {
    form.post(route('context.doEdit', props.context));
}

</script>

<template>
    <Head title="Edit Context"/>
    <GuestLayout>
        <Link :href="route('generator')"
              class="dark:text-white dark:bg-gray-600 rounded p-2 active:bg-gray-700">
            Encounter Generator
        </Link>

        <form @submit.prevent="submit"
              @reset.prevent="form.reset()"
              class="grid grid-cols-3 mt-4">
            <TextInput
                field-key="title"
                field-title="Title"
                v-model:field-value="form.title"
                v-model:errors="form.errors.title"
            />
            <button type="submit"
                    class="text-white bg-gray-600 rounded p-1 active:bg-gray-700 hover:bg-gray-500 col-span-2 m-1 mt-2"
                    :disabled="form.processing">
                Submit
            </button>
            <button type="reset"
                    class="text-white bg-gray-600 rounded p-1 active:bg-gray-700 hover:bg-gray-500 col-start-3 col-span-1 m-1 mt-2">
                Undo
            </button>
        </form>
        <Link :href="route('context.delete', props.context)"
              method="delete"
              as="button"
              class="text-white bg-red-600 rounded p-1 active:bg-red-700 hover:bg-red-500 col-start-3 col-span-1 m-1 mt-2">
            Delete Context
        </Link>
    </GuestLayout>
</template>
