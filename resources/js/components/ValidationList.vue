<template>
    <ul class="text-red-500">
        <li v-for="error in errorValues" :key="error">
            {{ error }}
        </li>
    </ul>
</template>

<script setup>
import { computed } from 'vue'
const props = defineProps({
    errors: {
        type: Object,
        required: true
    }
})

const errorValues = computed(() => {
    let errors = [];
    Object.keys(props.errors).forEach((key) => {
        errors = [...errors, ...props.errors[key]];
    });

    return Object.values(errors)
})
</script>
