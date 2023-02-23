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

            <div class="form-check">

                <input class="form-check-input" type="radio" id="oneday-multiemp" value="oneday-multiemp"
                    v-model="form.form_type" />
                <label class="form-check-label" for="oneday-multiemp">For Single Day</label>
            </div>

            <div class="form-check">

                <input class="form-check-input" type="radio" id="alldays-oneemp" value="alldays-oneemp"
                    v-model="form.form_type" />
                <label class="form-check-label" for="alldays-oneemp">For Whole Session</label>
            </div>

        </div>
        <!--    <Datepicker v-show="form.form_type == 'oneday-multiemp'" v-model="form.date" auto-apply :allowed-dates="calender"
                                                                                                                                                no-today :format="format" :enable-time-picker="false">
                                                                                                                                            </Datepicker> -->
        <v-select v-show="form.form_type == 'oneday-multiemp'" v-model="form.date" label="date"
            :options="calender"></v-select>

        <table v-show="form.form_type == 'oneday-multiemp'" class=" mt-1 table table-sm table-striped table-bordered">
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
                    <th style="width: 8%" rowspan="2">
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
                <template v-for="(item, index) in form.duty_items" :key="index">
                    <tr class="bg-white">
                        <td class="text-center">
                            {{ index + 1 }}
                        </td>
                        <td>
                            {{ empid_to_displayname.get(item.employee_id) }}
                        </td>

                        <time-input v-model:fn_from="item.fn_from" v-model:fn_to="item.fn_to" v-model:an_from="item.an_from"
                            v-model:an_to="item.an_to" @total_hours="ontotalhours_singleday(index)" />

                        <td>
                            <input readonly class="form-control" type="text" v-model='item.total_hours' />
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


        <!-- whole session -->
        <v-select v-show="form.form_type == 'alldays-oneemp'" v-model="form.employee" label="displayname"
            :options="sectionEmp"></v-select>

        <table v-show="form.form_type == 'alldays-oneemp'" class=" mt-1 table table-sm table-striped table-bordered">
            <thead>
                <tr class="text-center">
                    <th rowspan="2">
                        Sl.
                    </th>
                    <th rowspan="2">
                        Date
                    </th>

                    <th colspan="2">
                        Morning
                    </th>

                    <th colspan="2">
                        Evening
                    </th>
                    <th style="width: 8%" rowspan="2">
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
                <template v-for="(item, index) in form.dates" :key="index">
                    <tr class="bg-white">
                        <td class="text-center">
                            {{ index + 1 }}
                        </td>
                        <td class="text-center">
                            {{ item.date.date }}
                        </td>

                        <time-input v-model:fn_from="item.fn_from" v-model:fn_to="item.fn_to" v-model:an_from="item.an_from"
                            v-model:an_to="item.an_to" @total_hours="ontotalhours_wholesession(index)" />

                        <td>
                            <input readonly class="form-control" type="text" v-model='item.total_hours' />
                        </td>

                    </tr>
                </template>

            </tbody>
            <tfoot class="border-0">
                <tr>
                    <td colspan="6">

                    </td>
                    <td class="text-center">
                        fdgfd
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
import { getTimeDuration, ontotalhours } from './../shared/utility';

const { errors, calender, employees, getCalender, storeDuty, getEmployees } = useDailyWageForm()
// const props = defineProps(['user'])
const selectedEmp = ref()
const empid_to_displayname = ref(new Map())
const sectionEmp = ref([])

const form = reactive({
    form_type: 'oneday-multiemp',
    date: '',
    duty_items: [],
    employee: '',
    dates: [],
})

onMounted(async () => {
    await getCalender();
    await getEmployees();
    // console.log(calender)

    for (let i = 0; i < employees.value.length; i++) {
        empid_to_displayname.value.set(employees.value[i].id, employees.value[i].displayname)
    }

    for (let i = 0; i < employees.value.length; i++) {
        if (employees.value[i].in_usersection) {
            sectionEmp.value.push({
                id: employees.value[i].id,
                displayname: employees.value[i].displayname,
            })

            form.duty_items.push({
                employee_id: employees.value[i].id,
                fn_from: '',
                fn_to: '',
                an_from: '',
                an_to: '',
                total_hours: '',
            })
        }
    }
    for (let i = 0; i < calender.value.length; i++) {
        form.dates.push({
            date: calender.value[i],
            fn_from: '',
            fn_to: '',
            an_from: '',
            an_to: '',
            total_hours: '',
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




const ontotalhours_singleday = (index) => {
    ontotalhours(form.duty_items[index])
};

const ontotalhours_wholesession = (index) => {
    ontotalhours(form.dates[index])
};

const saveDuty = async () => {
    // console.log(form)


    await storeDuty({ ...form })
}

const addRow = () => {

    for (let i = 0; i < form.duty_items.length; i++) {
        if (form.duty_items[i].employee_id == selectedEmp.value.id) {
            return
        }
    }

    form.duty_items.push({
        employee_id: selectedEmp.value.id,
        fn_from: '',
        fn_to: '',
        an_from: '',
        an_to: '',
        total_hours: '',
    })

    selectedEmp.value = ''
};
const removeRow = (n) => {
    form.duty_items.splice(n, 1);
};

</script>