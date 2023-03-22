<template>
    <div v-if="errors">
        <div v-for="(v, k) in errors" :key="k" class="alert alert-danger" role="alert">
            <p>
                {{ v }}
            </p>
        </div>
    </div>

    <!-- {{ props.user }} -->


    <h6 class="text-center">Overtime Duty Statement</h6>
    <div class="text-center">KLA: <b>{{ duty.session?.assembly }}</b> Session: <b>{{ duty.session?.session }}</b></div>

    <div class="col-md-5">
        <table class=" mt-1 table table-sm  table-borderless">

            <tbody>

                <tr>
                    <td v-show="duty.form_type !== 'alldays-multiemp'">
                        For
                    </td>
                    <td v-show="duty.form_type == 'oneday-multiemp'">
                        <b> {{ duty.date?.date }}</b>
                    </td>
                    <td v-show="duty.form_type == 'alldays-oneemp'">
                        <b> {{ duty.employee?.displayname }}</b>
                    </td>
                </tr>

                <tr>
                    <td>
                        Section
                    </td>

                    <td>
                        <b> {{ duty.created_by?.name }}</b>
                    </td>
                </tr>

            </tbody>

        </table>
    </div>

    <table v-if="duty.form_type == 'oneday-multiemp'" class="table table-sm table-striped table-bordered">
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
            <template v-for="(item, index) in duty.duty_items" :key="index">
                <tr>
                    <td class="text-center">
                        {{ index + 1 }}
                    </td>
                    <td>
                        {{ item.employee?.displayname }}
                    </td>
                    <td class="text-center">
                        {{ item.fn_from }}
                    </td>
                    <td class="text-center">
                        {{ item.fn_to }}
                    </td>
                    <td class="text-center">
                        {{ item.an_from }}
                    </td>
                    <td class="text-center">
                        {{ item.an_to }}
                    </td>
                    <td class="text-center">
                        {{ item.total_hours }}
                    </td>
                </tr>
            </template>

        </tbody>
    </table>

    <!-- whole session -->

    <table v-if="duty.form_type == 'alldays-oneemp'" class=" mt-1 table table-sm table-striped table-bordered">
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
            <template v-for="(item, index) in duty.duty_items" :key="index">
                <tr v-show="item.fn_from || item.an_from" class="text-center">
                    <td class="text-center">
                        {{ index + 1 }}
                    </td>
                    <td class="text-center">
                        {{ item.date?.date }}
                    </td>

                    <td>
                        {{ item.fn_from }}
                    </td>
                    <td>
                        {{ item.fn_to }}
                    </td>
                    <td>
                        {{ item.an_from }}
                    </td>
                    <td>
                        {{ item.an_to }}
                    </td>
                    <td>
                        {{ item.total_hours }}
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
    <!-- whole session -->
    <!-- whole session all emp-->

    <table v-if="duty.form_type == 'alldays-multiemp'" class=" mt-1 table table-sm table-striped table-bordered">
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
                        {{ item.employee?.displayname }}
                    </td>
                    <td v-for="(h, ind) in item.all_ot_hours" class="text-center">
                        {{ item.all_ot_hours[ind] }}
                    </td>
                    <td class="text-center">
                        {{ item.total_hours }}
                    </td>

                </tr>
            </template>

        </tbody>

    </table>

    <div>
        <div class="d-print-none form-group mt-1">
            <button v-if="props.user_id !== duty.owned_by_id" @click="printDuty" class="mr-1 btn btn-warning">
                Print
            </button>

            <button v-if="props.user_id === duty.owned_by_id && !isadmin" @click="editDuty" class="mr-1 btn btn-primary">
                Edit
            </button>

            <button v-if="routes['submit']" @click="routeForm('submit')" class="mr-1 btn btn-danger">{{
                routes['submit'] }}</button>
            <button v-if="routes['return']" @click="routeForm('return')" class="mr-1 btn btn-warning">{{
                routes['return'] }}</button>

            <!-- <router-link :to="{ name: 'duty.index' }" class="btn btn-success ml-1">Go Back</router-link> -->
            <button type="button" @click.prevent="$router.go(-1)" class="ml-1 btn btn-outline-success">
                Cancel
            </button>


        </div>
    </div>
</template>
<script setup>
import useDailyWageForm from '../composables/dailyform'
import { onMounted, } from 'vue'
import router from "../router";

const { errors, duty, calender, routes, getDuty, getCalender, getRoutes, setRoute } = useDailyWageForm()


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

    isadmin: {
        required: false,
    },
    user: {
        required: false,
    },
})

onMounted(async () => {

    await getCalender();
    //   await getEmployees();

    await getDuty(props.id);
    await getRoutes(props.id);
    //   console.log(duty.value.duty_items)


})


const printDuty = async () => {
    window.print();
    //  await updateDuty(props.id)
}

const routeForm = async (action) => {
    await setRoute(props.id, action)
}

const editDuty = async () => {

    router.push({
        name: 'duty.edit',
        params: {
            id: props.id
        }
    });
}
</script>