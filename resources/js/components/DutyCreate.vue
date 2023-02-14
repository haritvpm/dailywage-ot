<template>
    <div v-if="errors">
        <div v-for="(v, k) in errors" :key="k"
            class="bg-red-400 text-white rounded font-bold mb-4 shadow-lg py-2 px-4 pr-0">
            <p v-for="error in v" :key="error" class="text-sm">
                {{ error }}
            </p>
        </div>
    </div>


    <form @submit.prevent="saveDuty">

        <div class="form-group">
            <div>Picked: {{ form.type }}</div>

            <input type="radio" id="oneday-multiemp" value="oneday-multiemp" v-model="form.type" />
            <label for="oneday-multiemp">oneday-multiemp</label>

            <input type="radio" id="allday-oneemp" value="allday-oneemp" v-model="form.type" />
            <label for="allday-oneemp">allday-oneemp</label>
        </div>

        <template v-for="item in calender" :key="item.id">
            <tr class="bg-white">
                <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                    {{ item.date }}
                </td>

            </tr>
        </template>


        <div class="form-group">
            <button class="btn btn-danger" type="submit">
                Save
            </button>
        </div>
    </form>



</template>
<script setup>
import useDailyWageForm from './../composables/dailyform'
import { onMounted, reactive } from 'vue'

const form = reactive({
    type: 'oneday-multiemp',


    website: ''
})

const { errors, calender, getCalender, storeDuty } = useDailyWageForm()
onMounted(getCalender)

const saveDuty = async () => {
    await storeDuty({ ...form })
}
</script>