import { createRouter, createWebHistory } from 'vue-router';
import AuthenticatedLayout from '../layouts/Authenticated.vue';
import SurveysIndex from '../components/Surveys/Index.vue';
import SurveysStats from '../components/Surveys/Stats.vue';
import SurveyCreate from '../components/Surveys/Create.vue';
import SurveyEdit from '../components/Surveys/Edit.vue';
import SurveyView from "../components/Surveys/View.vue";
import EntriesIndex from '../components/Entries/Index.vue';
import Home from '../layouts/Home.vue';

const routes = [
    {
        component: AuthenticatedLayout,
        redirect: { name: 'home' },
        // beforeEnter: auth,
        children: [
            {
                path: '/surveys',
                name: 'surveys.index',
                component: SurveysIndex,
                meta: { title: 'Surveys' },
            },
            {
                path: '/surveys/create',
                name: 'surveys.create',
                component: SurveyCreate,
                meta: { title: 'Create new Survey' }
            },
            {
                path: '/surveys/edit/:id',
                name: 'surveys.edit',
                component: SurveyEdit,
                meta: { title: 'Edit survey' }
            },
            {
                path: '/surveys/stats',
                name: 'surveys.stats',
                component: SurveysStats,
                meta: { title: 'Statistics' }
            },
            {
                path: '/view/survey/:slug',
                name: 'survey.view',
                component: SurveyView,
                meta: { title: 'Answer' }
            },
            {
                path: '/entries',
                name: 'entries.index',
                component: EntriesIndex,
                meta: { title: 'Entries' }
            },
            {
                path: '/index',
                name: 'home',
                component: Home,
                meta: { title: 'Enter survey' }
            },
        ]
    },
]

export default createRouter({
    history: createWebHistory(),
    routes
})
