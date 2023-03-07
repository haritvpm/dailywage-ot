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
    <div class="text-center">KLA: <b>{{ props.session.assembly }}</b> Session: <b>{{ props.session.session }}</b></div>

    <table class=" mt-1 table table-sm table-borderless">

        <tbody>

            <tr>
                <td>
                    For
                </td>
                <td v-show="duty.form_type == 'oneday-multiemp'">
                    {{ duty.date?.date }}
                </td>
                <td v-show="duty.form_type == 'alldays-oneemp'">
                    {{ duty.employee?.displayname }}
                </td>
            </tr>

            <tr>
                <td>
                    Section
                </td>

                <td>
                    {{ duty.created_by?.name }}
                </td>
            </tr>

        </tbody>

    </table>

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
                <tr v-show="item.fn_from || an_from" class="text-center">
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


    <div>
        <div class="d-print-none form-group mt-1">
            <button v-if="props.user_id !== duty.owned_by_id" @click="printDuty" class="mr-1 btn btn-warning">
                Print
            </button>


            <button v-if="props.user_id === duty.owned_by_id" @click="editDuty" class="mr-1 btn btn-primary">
                Edit
            </button>


            <button v-if="routes['submit']" @click="routeForm('submit')" class="mr-1 btn btn-danger">{{
                routes['submit'] }}</button>
            <button v-if="routes['return']" @click="routeForm('return')" class="mr-1 btn btn-warning">{{
                routes['return'] }}</button>



        </div>
    </div>
</template>
<script setup>
import useDailyWageForm from '../composables/dailyform'
import { onMounted, } from 'vue'
import router from "../router";

const { errors, duty, routes, getDuty, getRoutes, setRoute } = useDailyWageForm()

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
})

onMounted(async () => {

    //  await getCalender();
    //   await getEmployees();

    await getDuty(props.id);
    await getRoutes(props.id);
    console.log(routes)


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