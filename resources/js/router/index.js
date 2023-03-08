import { createRouter, createWebHistory } from 'vue-router'

import DutyIndex from './../components/DutyIndex'
import DutyCreate from './../components/DutyCreate'
import DutyEdit from './../components/DutyEdit.vue'
import DutyView from './../components/DutyView.vue'

const routes = [
    {
        path: '/admin/duty-forms',
        name: 'adminduty.index',
        component: DutyIndex,

    },
    {
        path: '/admin/duty-forms/:id',
        name: 'adminduty.view',
        component: DutyView,
        props: true
    },
    {
        path: '/duty-forms',
        name: 'duty.index',
        component: DutyIndex
    },
    {
        path: '/duty-forms/create',
        name: 'duty.create',
        component: DutyCreate
    },
    {
        path: '/duty-forms/:id/edit',
        name: 'duty.edit',
        component: DutyEdit,
        props: true
    },
    {
        path: '/duty-forms/:id',
        name: 'duty.view',
        component: DutyView,
        props: true
    },

];

export default createRouter({
    history: createWebHistory(),
    routes
})