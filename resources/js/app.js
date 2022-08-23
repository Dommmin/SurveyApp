import './bootstrap';
import '../css/app.css';
import router from './routes/index.js';
import VueSweetalert2 from "vue-sweetalert2";

import { createApp } from 'vue/dist/vue.esm-bundler'

const app = createApp({})
app.use(router)
app.use(VueSweetalert2)
app.mount('#app')
