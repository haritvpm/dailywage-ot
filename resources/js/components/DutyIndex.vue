<template>

    <div class="flex mb-4 place-content-end">
        <div class="px-4 py-2 text-white bg-indigo-600 cursor-pointer hover:bg-indigo-700">

            <router-link :to="{ name: 'duty.create' }" class="btn btn-success">Create company</router-link>

        </div>
    </div>


    <h1>{{ title }}</h1>
</template>
<script>
export default {
    data() {
        return {
            title: 'create To Install Vue 3 in Laravel 8 From Scratch'
        }
    },
    mounted() {
        console.log('Component mounted.')
    }
}
</script>