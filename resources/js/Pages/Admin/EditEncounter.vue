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
    <DefaultLayout header="Edit Encounter">
        <div class="grid place-items-center">
            <Link :href="route('encounter.index')"
                  class="rounded-xl py-2 px-6 w-1/4 text-white font-extrabold bg-red-600 hover:bg-red-500 active:bg-red-700 block">
                Encounter List
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
                <TextBoxInput
                    field-key="description"
                    field-title="Description"
                    v-model:field-value="form.description"
                    v-model:errors="form.errors.description"
                />
                <div class="col-span-full mb-2">
                    <div v-for="(context_id, key) in form.contexts" class="grid grid-cols-4">
                        <DropdownInput
                            :field-key="key"
                            field-title="Context"
                            :options="all_contexts"
                            v-model:field-value="form.contexts[key]"
                            v-model:errors="form.errors.contexts"
                        />
                        <button type="button"
                                class="col-span-1 text-white uppercase text-xs font-bold bg-sky-400 hover:bg-sky-300 active:bg-sky-400 rounded-sm ml-2 mb-2"
                                @click="removeContext(key)"
                                :class="{ hidden : form.contexts.length < 1}">
                            Remove Context
                        </button>
                    </div>
                    <button type="button"
                            class="col-span-1 text-white uppercase text-xs font-bold bg-sky-400 hover:bg-sky-300 active:bg-sky-400 rounded-sm px-4 py-2"
                            @click="addContext">
                        Add a Context
                    </button>
                </div>
                <TextInput
                    field-key="weight"
                    field-title="Weight"
                    v-model:field-value="form.weight"
                    v-model:errors="form.errors.weight"
                />
                <Link :href="route('encounter.delete', props.encounter)"
                      method="delete"
                      as="button"
                      class="text-white uppercase text-sm font-bold bg-red-500 hover:bg-red-400 active:bg-sky-400 rounded-sm p-1 mx-1">
                    Delete Encounter
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
