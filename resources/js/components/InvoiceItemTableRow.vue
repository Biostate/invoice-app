<template>
    <div
        class="grid grid-cols-12 mb-3"
    >
        <div class="col-span-7">
            <p class="text-[15px] font-bold text-custom-black">{{ item.name }}</p>
        </div>
        <div>
            <p class="text-[15px] font-bold text-custom-seven text-center">{{ item.quantity }}</p>
        </div>
        <div class="col-span-2">
            <p class="text-[15px] font-bold text-custom-seven text-right">{{ MoneyFormatter(item.price, '£') }}</p>
        </div>
        <div class="col-span-2">
            <p class="text-[15px] font-bold text-custom-black text-right">{{ MoneyFormatter(item.total, '£') }}</p>
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
