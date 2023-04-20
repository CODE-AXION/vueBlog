import './bootstrap';

import router from './router/router'

import { createApp } from 'vue';

import app from './App.vue'

createApp(app).use(router).mount("#app")
