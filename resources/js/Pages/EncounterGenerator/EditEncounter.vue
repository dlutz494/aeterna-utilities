<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import TextInput from '@/Components/Custom/TextInput.vue';
import TextBoxInput from '@/Components/Custom/TextBoxInput.vue';

// Props
const props = defineProps([
    'encounter'
]);

// Form
const form = useForm({
    title: props.encounter.title,
    description: props.encounter.description,
    context: props.encounter.context
});

function submit () {
    form.post(route('encounter.doEdit', props.encounter));
}

</script>

<template>
    <Head title="Edit Encounter"/>
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
            <TextBoxInput
                field-key="description"
                field-title="Description"
                v-model:field-value="form.description"
                v-model:errors="form.errors.description"
            />
            <TextInput
                field-key="context"
                field-title="Context"
                v-model:field-value="form.context"
                v-model:errors="form.errors.context"
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
        <Link :href="route('encounter.delete', props.encounter)"
              method="delete"
              as="button"
              class="text-white bg-red-600 rounded p-1 active:bg-red-700 hover:bg-red-500 col-start-3 col-span-1 m-1 mt-2">
            Delete Encounter
        </Link>
    </GuestLayout>
</template>
