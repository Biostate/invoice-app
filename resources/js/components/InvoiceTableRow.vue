<template>
    <div
        @click="goToInvoice(invoice.id)"
        class="flex flex-row justify-center items-center bg-white shadow p-8 rounded-lg mb-4 cursor-pointer h-full text-[15px]"
    >
        <div class="w-1/6 h-full">
            <span class="font-bold text-lg">
                <span class="text-gray-400">#</span>
                {{ invoice.id.toUpperCase() }}
            </span>
        </div>
        <div class="w-1/6 text-custom-seven">
            Due {{ dayjs(invoice.payment_due).format('DD MMM YYYY') }}
        </div>
        <div class="w-1/6 h-full text-custom-seven">
            {{ invoice.client_name }}
        </div>
        <div class="w-1/6 h-full font-bold text-center text-lg">
            £ {{ invoice.total }}
        </div>
        <div class="w-1/6 h-full text-right flex justify-between justify-center items-center ">
            <InvoiceStatusBadge :status="invoice.status" />
        </div>

        <div class="w-1/6 h-full">
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
