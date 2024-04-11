<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import TextInput from '@/Components/Custom/TextInput.vue';

// Form
const form = useForm({
    title: null,
    description: null,
    context: null
});

function submit () {
    form.post('/context');
}
</script>

<template>
    <Head title="Create Context"/>
    <GuestLayout>
        <Link :href="route('context.index')"
              class="dark:text-white dark:bg-gray-600 rounded p-2 active:bg-gray-700">
            Context List
        </Link>

        <form
            @submit.prevent="submit"
            @reset.prevent="form.reset()"
            class="grid grid-cols-3 mt-4">
            <TextInput
                field-key="title"
                field-title="Title"
                v-model:field-value="form.title"
                v-model:errors="form.errors.title"
            />
            <button type="submit"
                    class="text-white bg-gray-600 rounded p-1 active:bg-gray-700 col-span-2 m-1 mt-2"
                    :disabled="form.processing">
                Submit
            </button>
            <button type="reset"
                    class="text-white bg-gray-600 rounded p-1 active:bg-gray-700 col-start-3 col-span-1 m-1 mt-2">
                Reset
            </button>
        </form>
    </GuestLayout>
</template>
