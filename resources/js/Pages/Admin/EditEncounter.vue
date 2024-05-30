<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import TextInput from '@/Components/Custom/TextInput.vue';
import TextBoxInput from '@/Components/Custom/TextBoxInput.vue';
import DropdownInput from '@/Components/Custom/DropdownInput.vue';
import DefaultLayout from '@/Layouts/DefaultLayout.vue';

// Props
const props = defineProps([
    'encounter',
    'contexts',
    'weight',
    'all_contexts'
]);

// Form
const form = useForm({
    title: props.encounter.title,
    description: props.encounter.description,
    contexts: props.contexts.length !== 0 ? props.contexts.map((context) => {
        return context.id
    }) : [],
    weight: props.weight
});
function submit () {
    form.post(route('encounter.doEdit', props.encounter));
}

function addContext () {
    form.contexts.push(props.all_contexts[0].id);
}
function removeContext (key) {
    form.contexts.splice(key, 1);
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
                <div v-for="(context_id, key) in form.contexts" class="grid-span-full">
                    <DropdownInput
                        :field-key="key"
                        field-title="Context"
                        :options="all_contexts"
                        v-model:field-value="form.contexts[key]"
                        v-model:errors="form.errors.contexts"
                    />
                    <!--          Remove Svg Icon-->
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        width="24"
                        height="24"
                        class="ml-2 cursor-pointer"
                        @click="removeContext(key)"
                    >
                        <path fill="none" d="M0 0h24v24H0z" />
                        <path
                            fill="#EC4899"
                            d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm0-9.414l2.828-2.829 1.415 1.415L13.414 12l2.829 2.828-1.415 1.415L12 13.414l-2.828 2.829-1.415-1.415L10.586 12 7.757 9.172l1.415-1.415L12 10.586z"
                        />
                    </svg>
                </div>
                <!--          Add Svg Icon-->
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    width="24"
                    height="24"
                    class="ml-2 cursor-pointer"
                    @click="addContext"
                >
                    <path fill="none" d="M0 0h24v24H0z" />
                    <path
                        fill="green"
                        d="M11 11V7h2v4h4v2h-4v4h-2v-4H7v-2h4zm1 11C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16z"
                    />
                </svg>
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
