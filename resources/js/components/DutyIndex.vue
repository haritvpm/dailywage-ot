<template>
    <div class="flex mb-4 place-content-end">
        <div class="px-4 py-2 text-white bg-indigo-600 cursor-pointer hover:bg-indigo-700">

            <router-link :to="{ name: 'duty.create' }" class="btn btn-success">Create Form</router-link>

        </div>
    </div>


    <div>
        <table class="table table-sm table-striped table-bordered">
            <thead>
                <tr>
                    <th>
                        ID
                    </th>
                    <th>
                        FormType
                    </th>
                    <th>
                        Date(s)
                    </th>
                    <th>
                        CreatedBy
                    </th>
                    <th>
                        @
                    </th>
                </tr>
            </thead>

            <tbody>
                <template v-for="item in duties" :key="item.id">
                    <tr>
                        <td>
                            {{ item.id }}
                        </td>
                        <td>
                            {{ item.form_type }}
                        </td>
                        <td>
                            {{ item.form_type == 'oneday-multiemp' ? item.date.date : 'whole session' }}
                        </td>
                        <td>
                            {{ item.created_by.name }}
                        </td>
                        <td>
                            {{ item.owned_by.name }}
                        </td>
                        <td>
                            <router-link :to="{ name: 'duty.view', params: { id: item.id } }"
                                class="mr-2 ">View</router-link>
                            <router-link :to="{ name: 'duty.edit', params: { id: item.id } }"
                                class="mr-2 ">Edit</router-link>
                            <button @click="deleteDuty(item.id)" class="ml-1 btn btn-xs btn-secondary">Delete</button>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
</template>
<script setup>
import useDailyWageForm from './../composables/dailyform'
import { onMounted, ref, computed } from 'vue'
const { errors, duties, getDuties, deleteDuty } = useDailyWageForm()

const props = defineProps({

    session: {
        required: false,

    },
})

onMounted(getDuties)
</script>