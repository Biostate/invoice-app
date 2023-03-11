<template>
    <div
        @click="goToInvoice(invoice.id)"
        class="flex rounded-lg mb-4 cursor-pointer bg-white shadow  items-center p-6"
    >
        <div class="grow grid grid-cols-6 gap-4 text-sm items-center">
            <div>
                <span class="font-bold text-lg text-base">
                    <span class="text-gray-400">#</span>
                    {{ invoice.id.toUpperCase() }}
                </span>
            </div>
            <div class="text-custom-seven">
                Due {{ dayjs(invoice.payment_due).format('DD MMM YYYY') }}
            </div>
            <div class="col-span-2 text-custom-seven">
                {{ invoice.client_name }}
            </div>
            <div class="font-bold text-right text-lg text-base">
                {{ MoneyFormatter(invoice.total, '£') }}
            </div>
            <div class="text-right flex justify-between justify-center items-center ">
                <InvoiceStatusBadge :status="invoice.status" />
            </div>
        </div>

        <div class="flex-none h-full pl-6">
            <svg width="7" height="10" viewBox="0 0 7 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 1L5 5L1 9" stroke="#7C5DFA" stroke-width="2"/>
            </svg>
        </div>
    </div>
</template>

<script setup>
import InvoiceStatusBadge from "@/components/InvoiceStatusBadge.vue";
import dayjs from "dayjs";
import { useRouter } from "vue-router";
import MoneyFormatter from "@/utils/moneyFormatter";

const props = defineProps({
    invoice: {
        type: Object,
        required: true
    }
})

const router = useRouter();

const goToInvoice = (id) => {
    router.push(`/invoices/${id}`);
}

</script>
