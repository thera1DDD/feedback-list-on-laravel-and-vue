import { createApp } from 'vue'
import './style.css'
import App from './App.vue'
import router from './router'
import axios from "axios";
import 'bootstrap/dist/css/bootstrap.min.css'
import 'bootstrap/dist/js/bootstrap.bundle.min.js'



const app = createApp(App)
app.use(router)
app.config.globalProperties.axios = axios
app.mount('#app')





