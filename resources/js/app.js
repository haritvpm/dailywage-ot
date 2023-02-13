require('./bootstrap');
import { createApp } from 'vue'
import DutyIndex from './components/DutyIndex.vue'
import DutyCreate from './components/DutyCreate.vue'
import router from './router'


const app = createApp({
    components: {
        DutyIndex, DutyCreate
    }
})

app.use(router).mount('#app')