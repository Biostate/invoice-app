<template>
    <span class="
            inline-flex
            items-center
            w-full
            p-2
            rounded-lg
            text-base
            font-bold
            justify-center
        "
        :class="{
        'bg-custom-green-light': status === 'paid',
        'bg-custom-orange-light': status === 'pending',
        'bg-custom-gray-light': status === 'draft',
        'text-custom-green': status === 'paid',
        'text-custom-orange': status === 'pending',
        'text-custom-gray': status === 'draft',
    }">
        <svg height="8" width="8">
            <circle cx="4" cy="4" r="4" fill="F3FDFA" />
        </svg>
        <span class="ml-1 text-lg">
            {{ upperFirst(status) }}
        </span>
    </span>
</template>

<script setup>
import { upperFirst } from 'lodash';

const props = defineProps({
    status: {
        type: String,
        required: true
    },
    class: {
        type: String,
        required: false
    }
})
</script>
