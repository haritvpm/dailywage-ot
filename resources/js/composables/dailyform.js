import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

export default function useDailyWageForm() {
    const duties = ref([])
    const calender = ref([])
    const employees = ref([])
    const duty = ref([])
    const routes = ref([])

    const errors = ref('')
    const router = useRouter()



    const getCalender = async (id) => {
        let response = await axios.get(`/api/v1/calenders`)


        calender.value = response.data.data
    }
    const getEmployees = async (id) => {
        let response = await axios.get(`/api/v1/daily-wage-employees`)
        employees.value = response.data.data
    }
    const getDuty = async (id) => {
        let response = await axios.get('/api/v1/duty-forms/' + id)
        duty.value = response.data.data;
    }
    const getDuties = async (id) => {
        let response = await axios.get(`/api/v1/duty-forms`)
        duties.value = response.data.data
    }


    const storeDuty = async (data) => {

        errors.value = ''
        try {


            await axios.post('/api/v1/duty-forms', data)
            await router.push({ name: 'duty.index' })
            // await router.push({ name: 'duty.view' }, duty.id )
        } catch (e) {
            if (e.response.status === 422) {
                //for (const key in e.response.data.errors) 
                {
                    errors.value = e.response.data.errors
                }
            }
        }

    }

    const updateDuty = async (id) => {
        errors.value = ''
        try {
            await axios.patch(`/api/v1/duty-forms/${id}`, duty.value)
            await router.push({ name: 'duty.view' }, duty.id)
            await router.push({ name: 'duty.index' })
        } catch (e) {
            if (e.response.status === 422) {
                for (const key in e.response.data.errors) {
                    errors.value = e.response.data.errors
                }
            }
        }
    }
    const deleteDuty = async (id) => {
        if (!window.confirm('You sure?')) {
            return
        }
        await axios.delete(`/api/v1/duty-forms/${id}`, id)
        await getDuties()
    }

    const getRoutes = async (id) => {
        let response = await axios.get(`/api/v1/duty-forms/${id}/routes`)
        routes.value = response.data.data
    }

    const setRoute = async (id, route) => {
        errors.value = ''
        try {
            console.log(route)
            await axios.post(`/api/v1/duty-forms/${id}/route`, { id, route })
            await router.push({ name: 'duty.index' })
        } catch (e) {
            if (e.response.status === 422) {
                for (const key in e.response.data.errors) {
                    errors.value = e.response.data.errors
                }
            }
        }
    }

    return {
        errors,
        duty,
        duties,
        calender,
        employees,
        routes,
        getCalender,
        getEmployees,
        getDuties,
        getDuty,
        storeDuty,
        updateDuty,
        deleteDuty,
        getRoutes,
        setRoute,

    }
}