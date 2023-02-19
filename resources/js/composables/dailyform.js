import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

export default function useDailyWageForm() {
    const duties = ref([])
    const calender = ref([])
    const employees = ref([])

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

    const getDuties = async (id) => {
        let response = await axios.get(`/api/v1/duty-forms`)
        duties.value = response.data.data
    }
    const storeDuty = async (data) => {

        errors.value = ''
        try {
            await axios.post('/api/v1/duty-forms', data)
            //  await router.push({ name: 'duty.index' })
        } catch (e) {
            if (e.response.status === 422) {
                //for (const key in e.response.data.errors) 
                {
                    errors.value = e.response.data.errors
                    console.log(errors.value)

                }
            }
        }

    }

    const updateCompany = async (id) => {
        errors.value = ''
        try {
            await axios.patch(`/api/companies/${id}`, company.value)
            //await router.push({ name: 'duty.index' })
        } catch (e) {
            if (e.response.status === 422) {
                for (const key in e.response.data.errors) {
                    errors.value = e.response.data.errors
                }
            }
        }
    }
    const deleteCompany = async (id) => {
        if (!window.confirm('You sure?')) {
            return
        }
        //    await destroyCompany(id)
        //  await getCompanies()
    }

    return {
        errors,
        duties,
        calender,
        employees,
        getCalender,
        getEmployees,
        getDuties,

        storeDuty,
        updateCompany,
        deleteCompany,
    }
}