require('./bootstrap');
import { createApp } from 'vue'
import DutyIndex from './components/DutyIndex.vue'
import DutyCreate from './components/DutyCreate.vue'
import router from './router'
import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

const app = createApp({
    components: {
        DutyIndex, DutyCreate,
    }
})
app.component('Datepicker', Datepicker);

app.use(router).mount('#app')