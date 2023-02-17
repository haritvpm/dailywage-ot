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
        <Datepicker v-show="form.type == 'oneday-multiemp'" v-model="form.date" auto-apply :allowed-dates="calender"
            no-today :format="format" :enable-time-picker="false">
        </Datepicker>



        <table class="table table-bordered">
            <thead>
                <tr>
                    <th rowspan="2">
                        Sl.
                    </th>
                    <th rowspan="2">
                        Name
                    </th>

                    <th class="text-center" colspan="2">
                        Morning
                    </th>

                    <th class="text-center" colspan="2">
                        Evening
                    </th>
                    <th rowspan="2">
                        Total Hours
                    </th>
                </tr>

                <tr>
                    <th>
                        From
                    </th>
                    <th>
                        To

                    </th>
                    <th>
                        From
                    </th>
                    <th>
                        To

                    </th>

                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                <template v-for="item in form.emp" :key="item.id">
                    <tr class="bg-white">
                        <td>
                            {{ item.id }}
                        </td>
                        <td>
                            {{ item.name }} {{ item.desig }} {{ item.ten }}
                        </td>
                        <td>
                            <input class="form-control" type="text" :name="item + item.id" v-model="item.morning_from">
                        </td>
                        <td>
                            <input class="form-control" type="text" :name="item + item.id" v-model="item.morning_to">

                        </td>
                        <td>
                            <input class="form-control" type="text" :name="item + item.id" v-model="item.eve_from">

                        </td>
                        <td>
                            <input class="form-control" type="text" :name="item + item.id" v-model="item.eve_to">

                        </td>
                        <td>
                            <input class="form-control" type="text" :name="item + item.id" v-model="item.total">

                        </td>
                    </tr>
                </template>
            </tbody>
        </table>



        <div class="form-group">
            <button class="btn btn-danger" type="submit">
                Save
            </button>
        </div>
</form>
</template>
<script setup>
import useDailyWageForm from './../composables/dailyform'
import { onMounted, reactive, computed } from 'vue'
const { errors, calender, employees, getCalender, storeDuty, getUserSectionEmployees } = useDailyWageForm()

const form = reactive({
    type: 'oneday-multiemp',
    date: '',
    emp: [],
    website: ''
})

onMounted(async () => {
    await getCalender();
    await getUserSectionEmployees();
    //  console.log(employees.value)

    for (let i = 0; i < employees.value.length; i++) {
        form.emp.push({
            id: employees.value[i].id,
            name: employees.value[i].name,
            ten: employees.value[i].ten,
            desig: employees.value[i].designation.title,
            morning_from: '',
            morning_to: '',
            eve_from: '',
            eve_to: '',
            total: '',
        })
    }

})


/*
const allowedDates = computed(() => {

    return this.calender.map(x => { console.log(x.date); return new Date(x.date) })
});
*/
// In case of a range picker, you'll receive [Date, Date]
const format = (date) => {
    const day = date.getDate();
    const month = date.getMonth() + 1;
    const year = date.getFullYear();

    return `Date is ${day}/${month}/${year}`;
}
const saveDuty = async () => {
    console.log(form)
    //await storeDuty({ ...form })
}
</script>