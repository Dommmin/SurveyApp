import {inject, ref} from "vue";
import axios from "axios";
import {useRouter} from "vue-router/dist/vue-router";


export default function useSurveys() {
    const surveys = ref({})
    const survey = ref({})
    const router = useRouter()
    const validationErrors = ref({})
    const isLoading = ref(false)
    const swal = inject('$swal')

    const getSurveys = async () => {
        axios.get('/api/surveys')
            .then(response => {
                surveys.value = response.data
            })
    }

    const getSurvey = async (id) => {
        axios.get('/api/surveys/' + id)
            .then(response => {
                survey.value = response.data.data
            })
    }

    const storeSurvey = async (survey) => {
        if (isLoading.value) return;

        isLoading.value = true
        validationErrors.value = {}

        axios.post('/api/surveys', survey)
            .then(response => {
                router.push({ name: 'surveys.index' })
                swal({
                    icon: 'success',
                    title: 'Survey saved successfully'
                })
            })
            .catch(error => {
                if (error.response?.data)
                {
                    validationErrors.value = error.response.data.errors
                }
            })
            .finally(() => isLoading.value = false)
    }

    const updateSurvey = async (survey) => {
        if (isLoading.value) return;

        isLoading.value = true
        validationErrors.value = {}

        axios.put('/api/surveys/' + survey.id, survey)
            .then(response => {
                router.push({ name: 'surveys.index' })
                swal({
                    icon: 'success',
                    title: 'Survey saved successfully'
                })
            })
            .catch(error => {
                if (error.response?.data)
                {
                    validationErrors.value = error.response.data.errors
                }
            })
            .finally(() => isLoading.value = false)
    }

    const deleteSurvey = async (id) => {
        swal({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this action!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            confirmButtonColor: '#ef4444',
            timer: 20000,
            timerProgressBar: true,
            reverseButtons: true
        })
            .then(result => {
                if (result.isConfirmed) {
                    axios.delete('/api/surveys/' + id)
                        .then(response => {
                            getSurveys()
                            router.push({name: 'surveys.index'})
                            swal({
                                icon: 'success',
                                title: 'Survey deleted successfully'
                            })
                        })
                        .catch(error => {
                            swal({
                                icon: 'error',
                                title: 'Something went wrong'
                            })
                        })
                }
            })
    }

    return { surveys, survey, getSurvey, getSurveys, storeSurvey, updateSurvey, deleteSurvey, validationErrors, isLoading }
}
