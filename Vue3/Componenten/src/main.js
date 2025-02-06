import { createApp } from 'vue'
import App from './App.vue'
import router from './domains/groceries/routes.js'


createApp(App).mount('#app')
App.use(router)
App.mount('#app')
