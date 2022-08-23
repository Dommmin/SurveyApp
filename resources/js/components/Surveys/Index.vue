<template>
    <div class="overflow-hidden overflow-x-auto p-6 bg-white border-gray-200">
        <div class="min-w-full align-middle">

            <div class="flex place-content-end mb-4">
                <div class="px-4 py-2 text-white bg-indigo-600 hover:bg-indigo-700 cursor-pointer rounded-xl">
                    <router-link :to="{ name: 'surveys.create' }" class="text-sm font-medium">Create Survey</router-link>
                </div>
            </div>

            <table class="min-w-full divide-y divide-gray-200 border">
                <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50 text-left">
                        <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">ID</span>
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left">
                        <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Name</span>
                    </th>
<!--                    <th class="px-6 py-3 bg-gray-50 text-left">-->
<!--                        <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Content</span>-->
<!--                    </th>-->
                    <th class="px-6 py-3 bg-gray-50 text-left">
                        <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Created at</span>
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left">
                        <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Public</span>
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-center">
                        Actions
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                <tr v-for="survey in surveys.data">
                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                        {{ survey.id }}
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                        {{ survey.name }}
                    </td>
<!--                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">-->
<!--                        {{ survey.content }}-->
<!--                    </td>-->
                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                        {{ survey.created_at }}
                    </td>
                    <td v-if="survey.is_public" class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-green-500">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z" />
                        </svg>
                    </td>
                    <td v-else class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-red-500">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </td>
                    <td class="text-center whitespace-no-wrap text-sm leading-5 text-gray-900">
                        <router-link :to="{ name: 'surveys.edit', params: { id: survey.id } }" class="bg-cyan-500 text-white font-extrabold hover:bg-cyan-400 px-2 py-1 rounded-xl">Edit</router-link>
                        <a href="#" @click.prevent="deleteSurvey(survey.id)" class="ml-2 font-extrabold text-white bg-gray-900 hover:bg-gray-600 px-2 py-1 rounded-xl">Delete</a>
                        <router-link to="" class="ml-2 bg-violet-500 text-white font-extrabold hover:bg-violet-400 px-2 py-1 rounded-xl">Stats</router-link>
                    </td>

                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>

import useSurveys from "../../composables/surveys";
import {onMounted} from "vue";

export default {
    setup() {
        const { surveys, getSurveys, deleteSurvey } = useSurveys()
        onMounted(getSurveys)

        return { surveys, getSurveys, deleteSurvey }
    }
}
</script>
