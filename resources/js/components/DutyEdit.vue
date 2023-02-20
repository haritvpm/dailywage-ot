<template>
    <div v-if="errors">
        <div v-for="(v, k) in errors" :key="k" class="alert alert-danger" role="alert">
            <p>
                {{ v }}
            </p>
        </div>
    </div>

    <!-- {{ props.user }} -->

    <form @submit.prevent="saveDuty">

        <div class="form-group">
            <div>Picked: {{ duty.form_type }}</div>

            <input type="radio" id="oneday-multiemp" value="oneday-multiemp" v-model="duty.form_type" />
            <label for="oneday-multiemp">oneday-multiemp</label>

            <input type="radio" id="alldays-oneemp" value="alldays-oneemp" v-model="duty.form_type" />
            <label for="alldays-oneemp">alldays-oneemp</label>
        </div>
        <!--    <Datepicker v-show="form.form_type == 'oneday-multiemp'" v-model="form.date" auto-apply :allowed-dates="calender"
                                                                                                                                                                                                                                                                    no-today :format="format" :enable-time-picker="false">
                                                                                                                                                                                                                                                                </Datepicker> -->
        <v-select v-model="duty.date" label="date" :options="calender"></v-select>



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
                <template v-for="(item, index) in duty.duty_items" :key="index">
                    <tr class="bg-white">
                        <td>
                            {{ index + 1 }}
                        </td>
                        <td>
                            {{ empid_to_displayname.get(item.employee_id) }}
                        </td>
                        <td>
                            <input class="form-control" type="text" :name="item + item.index" v-model="item.fn_from">
                        </td>
                        <td>
                            <input class="form-control" type="text" :name="item + item.index" v-model="item.fn_to">

                        </td>
                        <td>
                            <input class="form-control" type="text" :name="item + item.index" v-model="item.an_from">

                        </td>
                        <td>
                            <input class="form-control" type="text" :name="item + item.index" v-model="item.an_to">

                        </td>
                        <td>
                            <input class="form-control" type="text" :name="item + item.index" v-model="item.total_hours">

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
                        <button :disabled="!selectedEmp" class="btn btn-primary" @click.prevent="addRow"><i
                                class="fa fa-plus" aria-hidden="true"></i>
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
import useDailyWageForm from '../composables/dailyform'
import { onMounted, reactive, ref, computed } from 'vue'
const { errors, duty, calender, employees, getDuty, getCalender, updateDuty, getEmployees } = useDailyWageForm()

const props = defineProps({
    id: {
        required: true,
        type: String
    }
})

const selectedEmp = ref()
const empid_to_displayname = ref(new Map())


onMounted(async () => {


    await getCalender();
    await getEmployees();

    await getDuty(props.id);



    for (let i = 0; i < employees.value.length; i++) {

        empid_to_displayname.value.set(employees.value[i].id, employees.value[i].displayname)
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
    // console.log(form)    

    alert('up');
    await updateDuty(props.id)
}

const addRow = () => {


    for (let i = 0; i < duty.value.duty_items.length; i++) {
        if (duty.value.duty_items[i].employee_id == selectedEmp.value.id) {
            return
        }
    }

    duty.value.duty_items.push({
        employee_id: selectedEmp.value.id,
        name: selectedEmp.value.displayname,
        fn_from: '',
        fn_to: '',
        an_from: '',
        an_to: '',
        total: '',
    })

    selectedEmp.value = ''

};
const removeRow = (n) => {
    duty.value.duty_items.splice(n, 1);
};

</script>