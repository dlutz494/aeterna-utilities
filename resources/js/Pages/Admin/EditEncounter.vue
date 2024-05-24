<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import TextInput from '@/Components/Custom/TextInput.vue';
import TextBoxInput from '@/Components/Custom/TextBoxInput.vue';
import DropdownInput from '@/Components/Custom/DropdownInput.vue';
import DefaultLayout from '@/Layouts/DefaultLayout.vue';

// Props
const props = defineProps([
    'encounter',
    'context',
    'weight',
    'contexts'
]);

// Form
const form = useForm({
    title: props.encounter.title,
    description: props.encounter.description,
    context_id: props.context?.id ?? null,
    weight: props.weight
});

function submit () {
    form.post(route('encounter.doEdit', props.encounter));
}
</script>

<template>
    <Head title="Edit Encounter"/>
    <DefaultLayout>
        <div class="grid place-items-center">
            <Link :href="route('encounter.index')"
                  class="rounded-xl py-2 px-6 w-1/4 text-white font-extrabold bg-red-600 hover:bg-red-500 active:bg-red-700 block">
                Encounter List
            </Link>

            <form
                @submit.prevent="submit"
                @reset.prevent="form.reset()"
                class="grid grid-cols-3 mt-4 w-1/2">
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
                <DropdownInput
                    field-key="context_id"
                    field-title="Context"
                    :options="contexts"
                    v-model:field-value="form.context_id"
                    v-model:errors="form.errors.context_id"
                />
                <TextInput
                    field-key="weight"
                    field-title="Weight"
                    v-model:field-value="form.weight"
                    v-model:errors="form.errors.weight"
                />
                <Link :href="route('encounter.delete', props.encounter)"
                      method="delete"
                      as="button"
                      class="text-white font-bold bg-red-500 hover:bg-red-400 active:bg-sky-400 rounded-sm p-1 mx-1">
                    Delete Encounter
                </Link>
                <button type="submit"
                        class="text-white font-bold bg-sky-400 hover:bg-sky-300 active:bg-sky-400 rounded-sm p-1 col-start-2 mr-1"
                        :disabled="form.processing">
                    Submit
                </button>
                <button type="reset"
                        class="text-white font-bold bg-sky-400 hover:bg-sky-300 active:bg-sky-400 rounded-sm p-1 col-start-3 ml-1">
                    Reset
                </button>
            </form>
        </div>
    </DefaultLayout>
</template>
