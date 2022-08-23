<template>
<div class="grid grid-cols-1 gap-5 sm:grid-cols-2 md:grid-cols-3">
    <div v-for="survey in surveys.data"
        class="flex flex-col py-4 px-6 shadow-md bg-white hover:bg-gray-50 h-[170px]"
    >
        <h4 class="mt-4 text-lg font-bold">{{ survey.title }}</h4>

        <div class="flex justify-between items-center mt-3">
            <div class="flex items-center">
                <a
                    :href="`/view/survey/${survey.slug}`"
                    target="_blank"
                    class="h-8 w-8 flex items-center justify-center rounded-full border border-transparent text-sm text-indigo-500 focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                </a>
                Participate
            </div>
        </div>
    </div>
</div>
</template>

<script setup>
import useSurveys from '../composables/surveys';
import { onMounted } from 'vue';

const { publicSurveys, surveys } = useSurveys()
onMounted(publicSurveys)
</script>
