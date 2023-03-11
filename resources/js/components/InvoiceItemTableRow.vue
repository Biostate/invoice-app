<template>
    <div
        class="grid grid-cols-12 mb-3 text-base font-bold"
    >
        <div class="col-span-7 text-custom-black">
            {{ item.name }}
        </div>
        <div class="text-custom-seven text-center">
            {{ item.quantity }}
        </div>
        <div class="col-span-2 text-custom-seven text-right">
            {{ MoneyFormatter(item.price, '£') }}
        </div>
        <div class="col-span-2 text-custom-black text-right">
            {{ MoneyFormatter(item.total, '£') }}
        </div>
    </div>
</template>

<script setup>
import MoneyFormatter from '@/utils/MoneyFormatter';

defineProps({
    item: {
        type: Object,
        required: true,
    },
});
</script>
