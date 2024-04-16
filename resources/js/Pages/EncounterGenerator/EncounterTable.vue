<script setup>

const props = defineProps(
    {
        encounters: { type: Object }
    });
</script>

<template>
    <table class="mb-4 border border-slate-500">
        <thead class="bg-gray-400 dark:bg-gray-950">
        <tr>
            <th class="dark:text-white border border-slate-500">Title</th>
            <th class="dark:text-white border border-slate-500">Description</th>
        </tr>
        </thead>
        <tbody class="bg-slate-200 dark:bg-slate-700">
        <tr v-for="encounter in encounters" class="even:bg-slate-300 dark:even:bg-slate-800">
            <td class="dark:text-white pl-4 w-1/6 border border-slate-500 mx-1">{{ encounter.title }}</td>
            <td class="dark:text-white pl-4 w-4/6 border border-slate-500 mx-1">{{ encounter.description }}</td>
        </tr>
        </tbody>
    </table>
</template>
