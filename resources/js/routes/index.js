import { createRouter, createWebHistory } from 'vue-router';
import AuthenticatedLayout from '../layouts/Authenticated.vue'
import SurveysIndex from '../components/Surveys/Index.vue'
import SurveysCreate from '../components/Surveys/Create.vue'
import SurveysEdit from '../components/Surveys/Edit.vue'

const routes = [
    {
        component: AuthenticatedLayout,
        // beforeEnter: auth,
        children: [
            {
                path: '/surveys',
                name: 'surveys.index',
                component: SurveysIndex,
                meta: { title: 'Surveys' }
            },
            {
                path: '/surveys/create',
                name: 'surveys.create',
                component: SurveysCreate,
                meta: { title: 'Create new Survey' }
            },
            {
                path: '/surveys/edit/:id',
                name: 'surveys.edit',
                component: SurveysEdit,
                meta: { title: 'Edit survey' }
            },
        ]
    },
]

export default createRouter({
    history: createWebHistory(),
    routes
})
