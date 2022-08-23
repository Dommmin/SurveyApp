<template>
    <table class="min-w-full divide-y divide-gray-200 border">
        <thead>
        <tr>
            <th class="px-6 py-3 bg-gray-50 text-left">
                <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">ID</span>
            </th>
            <th class="px-6 py-3 bg-gray-50 text-left">
                <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Participant</span>
            </th>
            <th class="px-6 py-3 bg-gray-50 text-left">
                <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Answered at</span>
            </th>
            <th class="px-6 py-3 bg-gray-50 text-left">
                <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Survey</span>
            </th>
            <th class="px-6 py-3 bg-gray-50 text-center">
                Actions
            </th>
        </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200 divide-solid">
        <tr v-for="entry in entries.data" class="transition ease-in duration-100 hover:bg-gray-300">
            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900 ">
                {{ entry.id }}
            </td>
            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                {{ entry.participant }}
            </td>
            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                {{ entry.created_at }}
            </td>
            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-green-500">
                {{ entry.survey }}
            </td>
            <td class="flex items-center justify-center whitespace-no-wrap text-sm leading-5 text-gray-900">
                <div class="mt-3 ml-3">
                    <a href="#" @click.prevent="deleteEntry(entry.id)">
                        <svg class="h-6 w-6 text-red-500 hover:text-red-800" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </a>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</template>

<script setup>
import useSurveys from "../../composables/surveys";
import {onMounted} from "vue";

const { entries, getEntries, deleteEntry } = useSurveys()
onMounted(getEntries)
</script>
