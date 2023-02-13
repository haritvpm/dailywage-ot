<template>
    <h1>{{ title }}</h1>
</template>
<script>
export default {
    data() {
        return {
            title: 'How To Install Vue 3 in Laravel 8 From Scratch'
        }
    },
    mounted() {
        console.log('Component mounted.')
    }
}
</script>