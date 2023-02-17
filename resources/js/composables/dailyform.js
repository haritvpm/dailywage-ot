import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

export default function useDailyWageForm() {
    const company = ref([])
    const calender = ref([])
    const employees = ref([])

    const errors = ref('')
    const router = useRouter()


    const getCalender = async (id) => {
        let response = await axios.get(`/api/v1/calenders`)
        calender.value = response.data.data
    }
    const getUserSectionEmployees = async (id) => {
        let response = await axios.get(`/api/v1/sections`)
        employees.value = response.data.data
    }

    const storeDuty = async (data) => {
        errors.value = ''
        try {
            await axios.post('/api/companies', data)
            await router.push({ name: 'duty.index' })
        } catch (e) {
            if (e.response.status === 422) {
                for (const key in e.response.data.errors) {
                    errors.value = e.response.data.errors
                }
            }
        }

    }

    const updateCompany = async (id) => {
        errors.value = ''
        try {
            await axios.patch(`/api/companies/${id}`, company.value)
            // await router.push({ name: 'duty.index' })
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
        company,
        calender,
        employees,
        getCalender,
        getUserSectionEmployees,

        storeDuty,
        updateCompany
    }
}