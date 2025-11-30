import { createApp } from 'vue'
import App from './App.vue'
import '@/assets/css/main.css'
import store from './store'
import router from './router'

import axios from 'axios'

// Restaurar token do localStorage no axios ao iniciar
const token = localStorage.getItem('token')
if (token) {
	axios.defaults.headers.common['Authorization'] = `Bearer ${token}`
}

createApp(App).use(store).use(router).mount('#app')
