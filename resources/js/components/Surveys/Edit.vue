<template>
    <form @submit.prevent="updateSurvey(survey)">
        <!-- Title -->
        <div>
            <label for="survey-title" class="block font-medium text-sm text-gray-700">
                Title
            </label>
            <input v-model="survey.title" id="survey-title" type="text" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <div class="text-red-600 mt-1">
                <div v-for="message in validationErrors?.title">
                    {{ message }}
                </div>
            </div>
        </div>

        <!-- Slug -->
        <div class="mb-3">
            <label for="survey-slug" class="block font-medium text-sm text-gray-700">
                Slug
            </label>
            <input v-model="survey.slug" id="survey-slug" type="text" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <div class="text-red-600 mt-1">
                <div v-for="message in validationErrors?.slug">
                    {{ message }}
                </div>
            </div>
        </div>

        <div class="text-xl">
            <input v-model="survey.is_public" type="checkbox" name="is_public" id="is_public" value="true" class="rounded cursor-pointer" :checked="survey.is_public"/>
            <label for="is_public" class="cursor-pointer ml-2 font-bold">Public</label>
        </div>

        <!-- Questions -->
        <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
            <h3 class="text-2xl font-semibold flex items-center justify-between">
                Questions

                <!-- Add new question -->
                <button
                    type="button"
                    @click="addQuestion()"
                    class="flex items-center text-sm py-1 px-4 rounded-sm text-white bg-gray-600 hover:bg-gray-700"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd"
                        />
                    </svg>
                    Add Question
                </button>
                <!--/ Add new question -->
            </h3>
            <div v-for="(question, index) in survey.questions" :key="question.id">
                <QuestionEditor
                    :question="question"
                    :index="index"
                    @change="questionChange"
                    @addQuestion="addQuestion"
                    @deleteQuestion="deleteQuestion"
                />
                <div class="text-red-600 mt-1">
                    <div v-for="message in validationErrors?.question">
                        {{ message }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Buttons -->
        <div class="mt-4">
            <button :disabled="isLoading" class="inline-flex items-center px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded disabled:opacity-75 disabled:cursor-not-allowed">
                <div v-show="isLoading" class="inline-block animate-spin w-4 h-4 mr-2 border-t-2 border-t-white border-r-2 border-r-white border-b-2 border-b-white border-l-2 border-l-blue-600 rounded-full"></div>
                <span v-if="isLoading">Processing...</span>
                <span v-else class="px-2">Save</span>
            </button>
        </div>
    </form>
</template>

<script setup>
import useSurveys from '../../composables/surveys';
import {onMounted, ref} from 'vue';
import {useRoute} from 'vue-router';
import QuestionEditor from '../editor/QuestionEditor.vue';
import {uuid} from "vue-uuid";

const route = useRoute();

let model = ref({
    title: '',
    slug: '',
    is_public: true,
    questions: {},
})

function addQuestion(index) {
    const newQuestion = {
        id: uuid.v4(),
        type: 'text',
        question: '',
        data: {},
    };

    survey.value.questions.splice(index, 0, newQuestion);
}

function deleteQuestion(question) {
    survey.value.questions = survey.value.questions.filter((q) => q !== question);
}

function questionChange(question) {
    if (question.data.options) {
        question.data.options = [...question.data.options];
    }
    survey.value.questions = survey.value.questions.map((q) => {
        if (q.id === question.id) {
            return JSON.parse(JSON.stringify(question));
        }
        return q;
    });
}

const { survey, getSurvey, updateSurvey, validationErrors, isLoading } = useSurveys()
onMounted(getSurvey(route.params.id))

</script>
