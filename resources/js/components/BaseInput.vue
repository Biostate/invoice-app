<template>
    <div :class="wrapperClass">
        <label v-if="label" class="block mb-2 text-sm font-medium text-custom-seven">
            {{ label }}
        </label>
        <input
            @input="handleInput"
            :type="type"
            :placeholder="placeholder"
            :value="modelValue"
            :class="inputClass"
            :required="required"
        >
    </div>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
    modelValue: {
        required: true,
    },
    label: {
        type: String,
        required: false,
    },
    type: {
        type: String,
        required: false,
        default: 'text',
    },
    placeholder: {
        type: String,
        required: false,
    },
    required: {
        type: Boolean,
        required: false,
        default: false,
    },
    wrapperClass: {
        type: String,
        required: false,
    },
    inputClass: {
        type: Object,
        required: false,
        default: {},
    },
})

const emit = defineEmits(['update:modelValue'])

const inputClass = computed(() => {
    let defaultClass = {
        'bg-white': true,
        'border': true,
        'border-gray-300': true,
        'text-gray-900': true,
        'sm:text-sm rounded-lg': true,
        'focus:ring-primary-600': true,
        'focus:border-primary-600': true,
        'block': true,
        'w-full': true,
        'p-4': true,
        'font-bold': true,
        'text-[15px]': true,
    };

    return {...defaultClass,...props.inputClass};
})

const handleInput = (event) => {
    emit('update:modelValue', event.target.value)
}

// TODO: add scroll lock

</script>
