require('./bootstrap');
import { createApp } from 'vue'
import DutyIndex from './components/DutyIndex.vue'
import DutyCreate from './components/DutyCreate.vue'
import router from './router'
import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';
import TimeInput from './components/TimeInput.vue'


const app = createApp({
    components: {
        DutyIndex, DutyCreate,
    }
})
app.component('Datepicker', Datepicker);
app.component('v-select', vSelect);
app.component('time-input', TimeInput);

app.use(router).mount('#app')