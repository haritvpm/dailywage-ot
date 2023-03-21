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

        <!--    <Datepicker v-show="form.form_type == 'oneday-multiemp'" v-model="form.date" auto-apply :allowed-dates="calender"                                                                                                                                                                                  no-today :format="format" :enable-time-picker="false">                                                                                                                                                                                                                                                                                </Datepicker> -->

        <div v-if="duty.form_type == 'oneday-multiemp'" class="row">
            <div class="col-sm-1">Date</div>
            <div class="col-sm-4">
                <v-select v-if="duty.form_type == 'oneday-multiemp'" v-model="duty.date" label="date"
                    :options="calender"></v-select>
            </div>
        </div>



        <table v-show="duty.form_type == 'oneday-multiemp'" class="table table-sm table-striped table-bordered">
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
                        <button class="btn btn-light" @click.prevent="CopyRow('am')"><i class="fa fa-clone"
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
                <template v-for="(item, index) in duty.duty_items" :key="index">
                    <tr class="bg-white">
                        <td>
                            {{ index + 1 }}
                        </td>
                        <td>
                            {{ item.employee?.displayname ?? item?.added_name }}
                        </td>
                        <time-input v-model:fn_from="item.fn_from" v-model:fn_to="item.fn_to" v-model:an_from="item.an_from"
                            v-model:an_to="item.an_to" @total_hours="ontotalhours_(index)" />
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
                <v-select v-show="duty.form_type == 'alldays-oneemp'" v-model="duty.employee" label="displayname"
                    :options="sectionEmp"></v-select>
            </div>
        </div>


        <table v-show="duty.form_type == 'alldays-oneemp'" class=" mt-1 table table-sm table-striped table-bordered">
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
                <template v-for="(item, index) in duty.duty_items" :key="index">
                    <tr class="bg-white">
                        <td class="text-center">
                            {{ index + 1 }}
                        </td>
                        <td class="text-center">
                            {{ item.date?.date }}
                        </td>

                        <time-input v-model:fn_from="item.fn_from" v-model:fn_to="item.fn_to" v-model:an_from="item.an_from"
                            v-model:an_to="item.an_to" @total_hours="ontotalhours_(index)" />

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
                    <td v-if="duty.form_type == 'alldays-oneemp'" class="text-center">
                        {{ duty.total_hours ?? '' }}
                    </td>

                </tr>
            </tfoot>
        </table>


        <!-- whole session all emp-->
        <!-- whole session -->

        <table v-show="duty.form_type == 'alldays-multiemp'" class=" mt-1 table table-sm table-striped table-bordered">
            <thead>
                <tr class="text-center">
                    <th>
                        Sl.
                    </th>
                    <th style="width: 15%" class="text-left">
                        Name
                    </th>

                    <th class="text-center" v-for="(item, index) in calender">
                        {{ item.dateShort }}
                    </th>

                    <th style="width: 8%">
                        Total Hours
                    </th>

                </tr>

            </thead>

            <tbody>
                <template v-for="(item, index) in duty.duty_items" :key="index">
                    <tr class="bg-white">
                        <td class="text-center">
                            {{ index + 1 }}
                        </td>
                        <td class="text-left">
                            {{ item.employee?.displayname ?? item?.added_name }}
                        </td>
                        <td v-for="(h, ind) in item.all_ot_hours">
                            <input class="form-control" type="text" v-model='item.all_ot_hours[ind]'
                                @change="ontotalhours_form3(index)" autocomplete="off" />
                        </td>
                        <td>
                            <input readonly class="form-control" type="text" v-model='item.total_hours' />
                        </td>

                    </tr>
                </template>

            </tbody>

        </table>




        <div class="form-group mt-1">
            <button class="btn btn-danger" type="submit">
                Update
            </button>
            <button type="button" @click.prevent="$router.go(-1)" class="ml-1 btn btn-outline-success">
                Cancel
            </button>

        </div>
    </form>
</template>
<script setup>
import useDailyWageForm from '../composables/dailyform'
import { onMounted, reactive, ref, computed } from 'vue'
import { sumHoursForm3, copyTimes, sumDurations, ontotalhours, validateTimes } from './../shared/utility';

const { errors, duty, calender, employees, getDuty, getCalender, updateDuty, getEmployees } = useDailyWageForm()

const props = defineProps({
    id: {
        required: true,
        type: String
    },
    session: {
        required: false,

    },
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
// const grandtotal_hours = ref('')

onMounted(async () => {


    await getCalender();
    await getEmployees();


    console.log(calender)

    console.log(duty)

    for (let i = 0; i < employees.value.length; i++) {


        if (employees.value[i].in_usersection) {
            sectionEmp.value.push({
                id: employees.value[i].id,
                displayname: employees.value[i].displayname,
            })
        }
    }



    await getDuty(props.id);
    /*
     for (let i = 0; i < sectionEmp.value.length; i++) {
 
         if (duty.employee_id == sectionEmp.value[i].id) {
             duty.employee.value == sectionEmp.value[i]
         }
     }
 */

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

// a computed ref
// const grandtotal_hours = computed(() => {
//     return sumDurations(duty.value.duty_items)
// })


const ontotalhours_ = (index) => {

    ontotalhours(duty.value.duty_items[index])

    duty.value.total_hours = sumDurations(duty.value.duty_items)

};


const ontotalhours_form3 = (index) => {
    sumHoursForm3(duty.value.duty_items[index])
};

const saveDuty = async () => {
    // console.log(duty.value.form_type)
    errors.value = []
    if (duty.value.form_type === 'oneday-multiemp') {
        if (!duty.value.date) {
            errors.value.push('Please select date ')
        }
        let errors2 = validateTimes(duty.value.duty_items, true)
        errors2.forEach(e => errors.value.push(e))

    }
    else if (duty.value.form_type === 'alldays-oneemp') //single employee all session days
    {
        if (!duty.value.employee_id) {
            errors.value.push('Please select employee ')
        }
        let errors2 = validateTimes(duty.value.duty_items, false)
        errors2.forEach(e => errors.value.push(e))
    }

    if (errors.value.length) return;

    await updateDuty(props.id)
}

const addRow = () => {


    for (let i = 0; i < duty.value.duty_items.length; i++) {
        if (duty.value.duty_items[i].employee_id == selectedEmp.value.id) {
            alert('Already exists')
            return
        }
    }

    duty.value.duty_items.push({
        employee_id: selectedEmp.value.id,
        added_name: selectedEmp.value.displayname,
        fn_from: '',
        fn_to: '',
        an_from: '',
        an_to: '',
        total_hours: '',
    })

    selectedEmp.value = ''

};
const removeRow = (n) => {
    duty.value.duty_items.splice(n, 1);
};


const CopyRow = (col) => {

    copyTimes(duty.value.duty_items, col)
    duty.value.total_hours = sumDurations(duty.value.duty_items)

};

</script>