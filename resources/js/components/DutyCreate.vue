<template>
    <div v-if="errors">
        <div v-for="(v, k) in errors" :key="k" class="alert alert-danger" role="alert">
            <p>
                {{ v }}
            </p>
        </div>
    </div>

    <div v-if="!form.session_id">No Session open for dataentry</div>
    <form v-if="form.session_id" @submit.prevent="saveDuty">

        <div v-if="session_over == 'yes'" class="form-group">

            <div class="form-check">

                <input class="form-check-input" type="radio" id="oneday-multiemp" value="oneday-multiemp"
                    v-model="form.form_type" />
                <label class="form-check-label" for="oneday-multiemp">For Single Day</label>
            </div>

            <div v-if="session_over == 'yes'" class="form-check">

                <input class="form-check-input" type="radio" id="alldays-oneemp" value="alldays-oneemp"
                    v-model="form.form_type" />
                <label class="form-check-label" for="alldays-oneemp">For Whole Session</label>
            </div>
            <div v-if="session_over == 'yes'" class="form-check">
                <input class="form-check-input" type="radio" id="alldays-multiemp" value="alldays-multiemp"
                    v-model="form.form_type" />
                <label class="form-check-label" for="alldays-multiemp">For Whole Session, All Employees</label>
            </div>
        </div>
        <!--    <Datepicker v-show="form.form_type == 'oneday-multiemp'" v-model="form.date" auto-apply :allowed-dates="calender"
                                                                                                                                                no-today :format="format" :enable-time-picker="false">
                                                                                                                                            </Datepicker> -->

        <div v-if="form.form_type == 'oneday-multiemp'" class="row">
            <div class="col-sm-1">Date</div>
            <div class="col-sm-4"><v-select v-if="form.form_type == 'oneday-multiemp'" v-model="form.date" label="date"
                    :options="calender"></v-select>
            </div>
        </div>


        <table v-if="form.form_type == 'oneday-multiemp'"
            class=" text-nowrap mt-1 table table-sm table-striped table-bordered">
            <thead>
                <tr class="text-center">
                    <th rowspan="2">
                        Sl.
                    </th>
                    <th rowspan="2">
                        Name
                    </th>

                    <th colspan="2">
                        Morning <button class="btn btn-light" @click.prevent="CopyRow('am')"><i class="fa fa-clone"
                                aria-hidden="true"></i>
                        </button>
                    </th>

                    <th colspan="2">
                        Evening <button class="btn btn-light" @click.prevent="CopyRow('pm')"><i class="fa fa-clone"
                                aria-hidden="true"></i>
                        </button>
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
                            {{ item.employee_name }}
                        </td>

                        <time-input v-model:fn_from="item.fn_from" v-model:fn_to="item.fn_to" v-model:an_from="item.an_from"
                            v-model:an_to="item.an_to" @total_hours="ontotalhours_singleday(index)" />

                        <td>
                            <input readonly class="form-control" type="text" v-model='item.total_hours' />
                        </td>
                        <td>
                            <button class="btn btn-danger" @click.prevent="removeRow(index)"><i class="fa fa-trash"
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

        <div v-if="form.form_type == 'alldays-oneemp'" class="row">
            <div class="col-sm-1">Employee</div>
            <div class="col-sm-4">
                <v-select v-if="form.form_type == 'alldays-oneemp'" v-model="form.employee" label="displayname"
                    :options="sectionEmp"></v-select>
            </div>
        </div>



        <table v-if="form.form_type == 'alldays-oneemp'"
            class=" text-nowrap mt-1 table table-sm table-striped table-bordered">
            <thead>
                <tr class="text-center">
                    <th rowspan="2">
                        Sl.
                    </th>
                    <th rowspan="2">
                        Date
                    </th>

                    <th colspan="2">
                        Morning <button class="btn btn-light" @click.prevent="CopyRow('am')"><i class="fa fa-clone"
                                aria-hidden="true"></i>
                        </button>
                    </th>

                    <th colspan="2">
                        Evening <button class="btn btn-light" @click.prevent="CopyRow('pm')"><i class="fa fa-clone"
                                aria-hidden="true"></i>
                        </button>
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
                        {{ form.total_hours }}
                    </td>

                </tr>
            </tfoot>
        </table>

        <!-- whole session all emp-->
        <!-- whole session all emp-->
        <div class="table-responsive">

            <table v-if="form.form_type == 'alldays-multiemp'"
                class=" text-nowrap mt-1 table table-sm table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">
                            Sl.
                        </th>
                        <th class="text-left">
                            Name
                        </th>

                        <th class="text-center" v-for="(item, index) in form.dates">
                            {{ item.date.dateShort }}
                        </th>


                        <th class="text-center">
                            Total Hours
                        </th>

                    </tr>

                </thead>

                <tbody>
                    <template v-for="(item, index) in form.duty_items" :key="index">
                        <tr class="bg-white">
                            <td class="text-center">
                                {{ index + 1 }}
                            </td>
                            <td class="text-left">
                                {{ item.employee_name }}
                            </td>

                            <td v-for="(h, ind) in item.all_ot_hours">
                                <input style="min-width: 55px;" class="form-control" type="text"
                                    v-model='item.all_ot_hours[ind]' @change="ontotalhours_form3(index)"
                                    autocomplete="off" />
                            </td>

                            <td>
                                <input readonly class="form-control" type="text" v-model='item.total_hours' />
                            </td>

                        </tr>
                    </template>

                </tbody>

            </table>
        </div>


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
import { sumHoursForm3, copyTimes, sumDurations, ontotalhours, validateTimes } from './../shared/utility';

const { errors, session, calender, employees, getCalender, storeDuty, getEmployees } = useDailyWageForm()
const props = defineProps({

    /*  session: {
          required: false,
  
      },*/
    user_id: {
        required: false,
    },
    user: {
        required: false,
    },
    isadmin: {
        required: false,
    },
})

const selectedEmp = ref()
const sectionEmp = ref([])
const session_over = ref()

const form = reactive({
    session_id: '',
    form_type: 'oneday-multiemp',
    date: '',
    duty_items: [],
    employee: '',
    dates: [],
    total_hours: '',
})

onMounted(async () => {
    await getCalender();
    await getEmployees();
    if (calender.value?.length) {
        form.session_id = calender.value[0].session_id
        session_over.value = calender.value[0].session_over
    }

    for (let i = 0; i < employees.value.length; i++) {
        if (employees.value[i].in_usersection) {
            sectionEmp.value.push({
                id: employees.value[i].id,
                displayname: employees.value[i].displayname,
            })

            form.duty_items.push({
                employee_id: employees.value[i].id,
                employee_name: employees.value[i].displayname,
                fn_from: '',
                fn_to: '',
                an_from: '',
                an_to: '',
                total_hours: '',
                all_ot_hours: [],
                all_ot_dayids: [],
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

    //form3
    for (let i = 0; i < form.duty_items.length; i++) {
        for (let j = 0; j < calender.value.length; j++) {
            form.duty_items[i].all_ot_hours.push('');
            form.duty_items[i].all_ot_dayids.push(calender.value[j].id);

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




const ontotalhours_singleday = (index) => {
    ontotalhours(form.duty_items[index])
};

const ontotalhours_wholesession = (index) => {
    ontotalhours(form.dates[index])
    form.total_hours = sumDurations(form.dates)
};


const ontotalhours_form3 = (index) => {
    sumHoursForm3(form.duty_items[index])
};
const saveDuty = async () => {

    errors.value = []
    if (form.form_type === 'oneday-multiemp') {
        if (!form.date) {
            errors.value.push('Please select date ')
        }
        let errors2 = validateTimes(form.duty_items, true)
        errors2.forEach(e => errors.value.push(e))

    }
    else if (form.form_type === 'alldays-oneemp')  //single employee all session days
    {
        if (!form.employee) {
            errors.value.push('Please select employee ')
        }
        let errors2 = validateTimes(form.dates, false)
        errors2.forEach(e => errors.value.push(e))
    }

    if (errors.value.length) return;

    await storeDuty({ ...form })
}
// a computed ref
/*
const grandtotal_hours = computed(() => {
    return sumDurations(form.dates)
})*/


const addRow = () => {

    for (let i = 0; i < form.duty_items.length; i++) {
        if (form.duty_items[i].employee_id == selectedEmp.value.id) {
            alert('Already exists')
            return
        }
    }

    form.duty_items.push({
        employee_id: selectedEmp.value.id,
        employee_name: selectedEmp.value.displayname,
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
const CopyRow = (col) => {
    if (form.form_type == 'alldays-oneemp') {
        copyTimes(form.dates, col)
        form.total_hours = sumDurations(form.dates)
    } else {
        copyTimes(form.duty_items, col)
    }
};
</script>