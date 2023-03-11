<template>
    <div class="w-[730px] mx-auto min-h-screen">
        <invoice-form-drawer v-model="showAddNewInvoiceModal" @saved="fetchInvoices"/>
        <div class="grid grid-cols-3 py-16">
            <div>
                <h1 class="text-[36px] font-bold">
                    Invoices
                </h1>
                <p class="text-gray-500" v-if="invoices.length === 0 && !invoicesFetching">No invoices</p>
                <p class="text-gray-500" v-else>There are {{ invoiceMeta.total }} total invoices</p>
            </div>
            <div>
                Filter Select/dopdown
            </div>
            <div class="text-right">
                <button
                    @click="showAddNewInvoiceModal = !showAddNewInvoiceModal"
                    class="rounded-full bg-[#7C5DFA] text-white font-bold p-5 font-medium"
                >
                    New Invoice
                </button>
            </div>
        </div>
        <div>
            <div
                v-if="invoices.length === 0 && !invoicesFetching"
            >
                <div
                    class="w-[242px] mx-auto my-auto text-center"
                >
                    <img :src="thereIsNoInvoiceImage" class="inline" alt="There is no invoice">
                    <h1 class="text-[24px] mt-16 mb-4 font-bold">There is nothing here</h1>
                    <p class="text-base text-custom-six">Create an invoice by clicking the <span class="font-bold">New Invoice</span> button and get started</p>
                </div>
            </div>
            <InvoiceTableRow v-for="invoice in invoices" :key="invoice.id" :invoice="invoice" />
        </div>
    </div>
</template>

<script setup>
import {onMounted, ref} from 'vue'
import InvoiceTableRow from "@/components/InvoiceTableRow.vue";
import {getInvoices} from "@/requests/invoice";
import ThereIsNoInvoiceImage from "@/assets/there_is_no_invoice.png";
import InvoiceFormDrawer from "@/components/InvoiceFormDrawer.vue";

const invoices = ref([]);
const thereIsNoInvoiceImage = ThereIsNoInvoiceImage;
const invoicesFetching = ref(true);
const invoiceMeta = ref({});

const showAddNewInvoiceModal = ref(false);

const fetchInvoices = async () => {
    invoicesFetching.value = true;
    invoices.value = [];

    getInvoices().then((response) => {
        invoices.value = response.data.data;
        invoiceMeta.value = response.data.meta;
    }).finally(() => {
        invoicesFetching.value = false;
    })
}

onMounted(() => {
    fetchInvoices();
})
</script>
