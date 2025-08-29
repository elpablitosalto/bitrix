import { createApp } from 'vue'
import App from './App.vue'
import axios from 'axios'
import VueAxios from 'vue-axios'
import VueSuggestion from "vue-suggestion";

const app = createApp(App)
app.use(VueAxios, axios)
app.use(VueSuggestion)

app.mount('#app')

