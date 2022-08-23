<template>
    <form @submit.prevent="updateSurvey(survey)">
        <!-- Name -->
        <div>
            <label for="survey-name" class="block font-medium text-sm text-gray-700">
                Name
            </label>
            <input v-model="survey.name" id="survey-name" type="text" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <div class="text-red-600 mt-1">
                <div v-for="message in validationErrors?.name">
                    {{ message }}
                </div>
            </div>
        </div>

        <!-- Slug -->
        <div>
            <label for="survey-slug" class="block font-medium text-sm text-gray-700">
                Slug
            </label>
            <input v-model="survey.slug" id="survey-slug" type="text" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 cursor-not-allowed" disabled>
            <div class="text-red-600 mt-1">
                <div v-for="message in validationErrors?.slug">
                    {{ message }}
                </div>
            </div>
        </div>

        <div class="mt-3">
            <label>
                <input v-model="survey.is_public" type="checkbox" name="is_public" id="is_public" value="true" class="rounded" :checked="survey.is_public"/>
                <span class="ml-2 font-bold">Public</span>
            </label>
        </div>

        <!-- Buttons -->
        <div class="mt-4">
            <button :disabled="isLoading" class="inline-flex items-center px-3 py-2 bg-blue-600 text-white rounded disabled:opacity-75 disabled:cursor-not-allowed">
                <div v-show="isLoading" class="inline-block animate-spin w-4 h-4 mr-2 border-t-2 border-t-white border-r-2 border-r-white border-b-2 border-b-white border-l-2 border-l-blue-600 rounded-full"></div>
                <span v-if="isLoading">Processing...</span>
                <span v-else>Save</span>
            </button>
        </div>
    </form>
</template>

<script>
import useSurveys from "../../composables/surveys";
import {onMounted} from "vue";
import {useRoute} from "vue-router/dist/vue-router";

export default {
    setup() {
        const { survey, getSurvey, updateSurvey, validationErrors, isLoading } = useSurveys()
        const route = useRoute()
        onMounted(getSurvey(route.params.id))

        return { survey, getSurvey, updateSurvey, validationErrors, isLoading }
    }
}

</script>
