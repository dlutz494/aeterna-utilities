<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import TextInput from '@/Components/Custom/TextInput.vue';
import DefaultLayout from '@/Layouts/DefaultLayout.vue';

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
    <DefaultLayout>
        <div class="grid place-items-center">
            <Link :href="route('context.index')"
                  class="rounded-xl py-2 px-6 w-1/4 text-white font-extrabold bg-red-600 hover:bg-red-500 active:bg-red-700 block">
                Context List
            </Link>

            <form
                @submit.prevent="submit"
                @reset.prevent="form.reset()"
                class="grid grid-cols-4 mt-4 w-3/4">
                <TextInput
                    field-key="title"
                    field-title="Title"
                    v-model:field-value="form.title"
                    v-model:errors="form.errors.title"
                />
                <Link :href="route('context.delete', props.context)"
                      method="delete"
                      as="button"
                      class="text-white uppercase text-sm font-bold bg-red-500 hover:bg-red-400 active:bg-sky-400 rounded-sm p-1 mx-1">
                    Delete Context
                </Link>
                <button type="submit"
                        class="text-white uppercase text-sm font-bold bg-sky-400 hover:bg-sky-300 active:bg-sky-400 rounded-sm py-2 col-start-2 mr-1"
                        :disabled="form.processing">
                    Submit
                </button>
                <button type="reset"
                        class="text-white uppercase text-sm font-bold bg-sky-400 hover:bg-sky-300 active:bg-sky-400 rounded-sm py-2 col-start-3 ml-1">
                    Reset
                </button>
            </form>
        </div>
    </DefaultLayout>
</template>
