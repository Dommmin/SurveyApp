import { createRouter, createWebHistory } from 'vue-router';
import AuthenticatedLayout from '../layouts/Authenticated.vue';
import SurveysIndex from '../components/Surveys/Index.vue';
import SurveysStats from '../components/Surveys/Stats.vue';
import SurveyCreate from '../components/Surveys/Create.vue';
import SurveyEdit from '../components/Surveys/Edit.vue';
import SurveyView from "../components/Surveys/View.vue";
import EntriesIndex from '../components/Entries/Index.vue';
import Home from '../layouts/Home.vue';
import store from '@/store'

/* Guest Component */
const Login = () => import('@/components/Login.vue')
const Register = () => import('@/components/Register.vue')
/* Guest Component */

const routes = [
    {
        name: "login",
        path: "/login",
        component: Login,
        meta: {
            middleware: "guest",
            title: `Login`
        }
    },
    {
        name: "register",
        path: "/register",
        component: Register,
        meta: {
            middleware: "guest",
            title: `Register`
        }
    },
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

const router = createRouter({
    history: createWebHistory(),
    routes, // short for `routes: routes`
})

router.beforeEach((to, from, next) => {
    document.title = to.meta.title
    if (to.meta.middleware === "guest") {
        if (store.state.auth.authenticated) {
            next({ name: "home" })
        }
        next()
    } else {
        if (store.state.auth.authenticated) {
            next()
        } else {
            next({ name: "login" })
        }
    }
})

export default router
