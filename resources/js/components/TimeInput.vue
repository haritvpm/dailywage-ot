

<script setup>

const props = defineProps({
    fn_from: String,
    fn_to: String,
    an_from: String,
    an_to: String,
    // total_hours: String,
})

const emit = defineEmits(['update:fn_from', 'update:fn_to', 'update:an_from', 'update:an_to', 'total_hours'])



function emitValue(model, e) {
    let value = e.target.value
    value = value.replaceAll('.', ':');



    emit(model, value)

    emit('total_hours')

}

</script>

<template>
    <td>
        <input class="form-control" type="text" :value="fn_from" @input="emitValue('update:fn_from', $event)" />
    </td>
    <td>
        <input class="form-control" type="text" :value="fn_to" @input="emitValue('update:fn_to', $event)" />
    </td>
    <td>
        <input class="form-control" type="text" :value="an_from" @input="emitValue('update:an_from', $event)" />
    </td>
    <td>
        <input class="form-control" type="text" :value="an_to" @input="emitValue('update:an_to', $event)" />
    </td>
</template>