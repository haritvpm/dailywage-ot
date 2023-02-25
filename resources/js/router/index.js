import { createRouter, createWebHistory } from 'vue-router'

import DutyIndex from './../components/DutyIndex'
import DutyCreate from './../components/DutyCreate'
import DutyEdit from './../components/DutyEdit.vue'
import DutyView from './../components/DutyView.vue'

const routes = [
    {
        path: '/duty',
        name: 'duty.index',
        component: DutyIndex
    },
    {
        path: '/duty/create',
        name: 'duty.create',
        component: DutyCreate
    },
    {
        path: '/duty/:id/edit',
        name: 'duty.edit',
        component: DutyEdit,
        props: true
    },
    {
        path: '/duty/:id',
        name: 'duty.view',
        component: DutyView,
        props: true
    },
];

export default createRouter({
    history: createWebHistory(),
    routes
})