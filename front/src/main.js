import { createApp } from 'vue'
import App from './App.vue'
import components from '@/components'
import './assets/tailwind.css'
import './main.css'
import { createRouter, createWebHashHistory } from 'vue-router'
import routes from '@/router/routes'
import { createStore } from 'vuex'
import store from "@/store"
// Vuetify
import 'material-design-icons-iconfont/dist/material-design-icons.css'
import '@mdi/font/css/materialdesignicons.css'
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import { aliases, mdi } from 'vuetify/iconsets/mdi'
import * as componentss from 'vuetify/components'
import * as directives from 'vuetify/directives'
import axios from 'axios'
import {app as firebase} from '@/firebase/init'
import capitalLetter from './services/capitalLetter'
axios.defaults.baseURL = 'http://server/api/';
const vuetify = createVuetify({
  components: componentss,
  directives,
  icons: {
    defaultSet: 'mdi',
    aliases,
    sets: {
      mdi,
    },
  },
})
const app = createApp(App)
components.forEach(component => {
    app.component(component.name, component)
})
const router = createRouter({
    history: createWebHashHistory(),
    routes,
})
const vuex = createStore(store)
app.config.globalProperties.axios = axios
app.config.globalProperties.firebase = firebase
app.config.globalProperties.capitalLetter = capitalLetter
app.config.globalProperties.baseURL = 'http://server/api/'
app
.use(router)
.use(vuex)
.use(vuetify)
.mount('#app')
