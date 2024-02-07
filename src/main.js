import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import'../node_modules/bootstrap/dist/css/bootstrap.css'
import 'bootstrap-icons/font/bootstrap-icons.css'

createApp(App).use(router).mount('#app')