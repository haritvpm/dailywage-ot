import { createRouter, createWebHistory } from 'vue-router'

import DutyIndex from './../components/DutyIndex'
import DutyCreate from './../components/DutyCreate'

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
];

export default createRouter({
    history: createWebHistory(),
    routes
})