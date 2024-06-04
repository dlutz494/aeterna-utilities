<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import TextInput from '@/Components/Custom/TextInput.vue';
import DefaultLayout from '@/Layouts/DefaultLayout.vue';

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
    <DefaultLayout header="Create Context">
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
