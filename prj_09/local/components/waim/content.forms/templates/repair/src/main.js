import './assets/main.css'

import { createApp } from 'vue'
import { store } from './store'
import App from './App.vue'
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css'
import globalMixins from './mixins/global'

const app = createApp(App)

app.component('v-select', vSelect)
app.use(store)
app.mixin(globalMixins)

app.mount('#app')
