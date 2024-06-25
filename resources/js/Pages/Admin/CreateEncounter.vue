<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import TextInput from '@/Components/Custom/TextInput.vue';
import TextBoxInput from '@/Components/Custom/TextBoxInput.vue';
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import { computed } from 'vue';
import SelectContextFormInput from '@/Components/Custom/SelectContextFormInput.vue';

const props = defineProps([
    'all_contexts'
]);

// Form
const form = useForm({
    title: null,
    description: null,
    contexts: [],
    weights: [0]
});

function submit () {
    form.post('/encounter');
}

function addContext () {
    form.contexts.push(props.all_contexts[0].id);
    form.contexts.length > 1 ? form.weights.push(0) : null;
}

function removeContext (key) {
    form.contexts.splice(key, 1);
}

const selectedContexts = computed(() => {
    return props.all_contexts.map((context) => {
        if (form.contexts.includes(context.id)) {
            return {
                id: context.id,
                title: context.title,
                selected: true
            };
        }
        return {
            id: context.id,
            title: context.title,
            selected: false
        };
    });
});
</script>

<template>
    <Head title="Create Encounter"/>
    <DefaultLayout header="Create Encounter">
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
                <TextInput
                    v-if="form.contexts.length <= 1"
                    field-key="weight0"
                    field-title="Weight"
                    v-model:field-value="form.weights[0]"
                    v-model:errors="form.errors['weights.0']"
                />
                <div class="col-span-full mb-2">
                    <div v-for="(context_id, key) in form.contexts" class="grid grid-cols-4">
                        <TextInput
                            v-if="form.contexts.length > 1"
                            :field-key="`weight` + key"
                            field-title="Weight"
                            v-model:field-value="form.weights[key]"
                            v-model:errors="form.errors['weights.' + key]"
                        />
                        <SelectContextFormInput
                            :field-key="`context` + key"
                            field-title="Context"
                            :options="selectedContexts"
                            v-model:field-value="form.contexts[key]"
                            v-model:errors="form.errors['contexts.' + key]"
                            @context-remove="removeContext(key)"
                            :hide-button="form.contexts.length < 1"
                        />
                    </div>
                    <button type="button"
                            class="col-span-1 text-white uppercase text-xs font-bold bg-sky-400 hover:bg-sky-300 active:bg-sky-400 rounded-sm px-4 py-2"
                            @click="addContext">
                        Add a Context
                    </button>
                </div>
                <button type="submit"
                        class="text-white uppercase text-sm font-bold bg-sky-400 hover:bg-sky-300 active:bg-sky-400 rounded-sm py-2 col-start-2 mr-1 mb-2"
                        :disabled="form.processing">
                    Submit
                </button>
                <button type="reset"
                        class="text-white uppercase text-sm font-bold bg-sky-400 hover:bg-sky-300 active:bg-sky-400 rounded-sm py-2 col-start-3 ml-1 mb-2">
                    Reset
                </button>
            </form>
        </div>
    </DefaultLayout>
</template>
