import './bootstrap';
import '../sass/app.scss';
import Router from '@/routes';
import store from '@/store';

import { createApp } from 'vue';
import '../css/app.css'

const app = createApp({});

app.use(Router);
app.use(store);
app.mount('#app');
