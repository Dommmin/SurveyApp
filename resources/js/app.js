import './bootstrap';
import '../sass/app.scss';
import Router from '@/routes';
import store from '@/store';
import 'sweetalert2/dist/sweetalert2.min.css';
import VueSweetalert2 from 'vue-sweetalert2';

import { createApp } from 'vue';
import '../css/app.css'

const app = createApp({});

app.use(Router);
app.use(store);
app.use(VueSweetalert2)
window.Swal =  app.config.globalProperties.$swal;
app.mount('#app');
