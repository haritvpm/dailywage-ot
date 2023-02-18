<template>
    <div v-if="errors">
        <div v-for="(v, k) in errors" :key="k"
            class="bg-red-400 text-white rounded font-bold mb-4 shadow-lg py-2 px-4 pr-0">
            <p v-for="error in v" :key="error" class="text-sm">
                {{ error }}
            </p>
        </div>
    </div>

    {{ props.user }}

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



        <table class="table table-sm table-striped table-bordered">
            <thead>
                <tr class="text-center">
                    <th rowspan="2">
                        Sl.
                    </th>
                    <th rowspan="2">
                        Name
                    </th>

                    <th colspan="2">
                        Morning
                    </th>

                    <th colspan="2">
                        Evening
                    </th>
                    <th style="width: 5%" rowspan="2">
                        Total Hours
                    </th>

                </tr>

                <tr class="text-center">
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

            <tbody>
                <template v-for="(item, index) in form.emp" :key="index">
                    <tr class="bg-white">
                        <td>
                            {{ index + 1 }}
                        </td>
                        <td>
                            {{ item.name }}
                        </td>
                        <td>
                            <input class="form-control" type="text" :name="item + item.index" v-model="item.morning_from">
                        </td>
                        <td>
                            <input class="form-control" type="text" :name="item + item.index" v-model="item.morning_to">

                        </td>
                        <td>
                            <input class="form-control" type="text" :name="item + item.index" v-model="item.eve_from">

                        </td>
                        <td>
                            <input class="form-control" type="text" :name="item + item.index" v-model="item.eve_to">

                        </td>
                        <td>
                            <input class="form-control" type="text" :name="item + item.index" v-model="item.total">

                        </td>
                        <td>
                            <button class="btn btn-danger" @click="removeRow(index)"><i class="fa fa-trash"
                                    aria-hidden="true"></i></button>

                        </td>
                    </tr>
                </template>

            </tbody>
            <tfoot class="border-0">
                <tr>
                    <td colspan="4">

                    </td>
                    <td colspan="3">
                        <v-select v-model="selectedEmp" label="displayname" :options="employees"></v-select>
                    </td>
                    <td colspan="1">
                        <button class="btn btn-primary" @click="addRow"><i class="fa fa-plus" aria-hidden="true"></i>
                        </button>

                    </td>
                </tr>
            </tfoot>
        </table>






        <div class="form-group mt-1">
            <button class="btn btn-danger" type="submit">
                Save
            </button>
        </div>
    </form>
</template>
<script setup>
import useDailyWageForm from './../composables/dailyform'
import { onMounted, reactive, ref, computed } from 'vue'
const { errors, calender, employees, getCalender, storeDuty, getEmployees } = useDailyWageForm()
const props = defineProps(['user'])
const selectedEmp = ref()

const form = reactive({
    type: 'oneday-multiemp',
    date: '',
    emp: [],
    website: ''
})

onMounted(async () => {
    await getCalender();
    await getEmployees();
    // console.log(props.user)

    for (let i = 0; i < employees.value.length; i++) {
        if (employees.value[i].in_usersection) {
            form.emp.push({
                id: employees.value[i].id,
                name: employees.value[i].displayname,
                morning_from: '',
                morning_to: '',
                eve_from: '',
                eve_to: '',
                total: '',
            })
        }
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

const addRow = () => {

    form.emp.push({
        id: selectedEmp.value.id,
        name: selectedEmp.value.displayname,
        morning_from: '',
        morning_to: '',
        eve_from: '',
        eve_to: '',
        total: '',
    })
};
const removeRow = (n) => {
    form.emp.splice(n, 1);
};

</script>