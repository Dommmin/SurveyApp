<template>
    <div class="py-5 px-8">
        <form @submit.prevent="submitSurvey(survey.id, answers)" class="container mx-auto">
        <h1 class="text-3xl font-bold text-center">{{ survey.title }}</h1>
        <div>
            <div v-for="(question, ind) of survey.questions" :key="question.id">
                <QuestionViewer
                    v-model="answers[question.id]"
                    :question="question"
                    :index="ind"
                />
            </div>
            <button
                type="submit"
                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >
                Submit
            </button>
        </div>
        </form>
    </div>
</template>

<script setup>
import useSurveys from '../../composables/surveys';
import {ref} from 'vue';
import { useRoute } from 'vue-router';
import QuestionViewer from '../viewer/QuestionViewer.vue';

const route = useRoute();
const answers = ref({});

const { survey, currentSurvey, submitSurvey } = useSurveys()
currentSurvey(route.params.slug)

</script>
