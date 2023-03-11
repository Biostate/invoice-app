<template>
    <div class="w-[730px] mx-auto min-h-screen py-16" v-if="invoice.hasOwnProperty('id')">
        <base-modal
            title="Confirm Deletion"
            :message="'Are you sure you want to delete invoice #' + invoice.id.toUpperCase() + '. This action cannot be undone.'"
            confirm-text="Delete"
            v-model="showDeleteModal"
            @confirm="handleDelete"
        />
        <router-link :to="{name: 'home'}" class="flex items-center mb-8">
            <div class="mr-6">
                <svg width="6" height="11" viewBox="0 0 6 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.3418 0.886047L0.113895 5.11395L4.3418 9.34185" stroke="#7C5DFA" stroke-width="2"/>
                </svg>
            </div>
            <span class="grow font-bold text-base">Go Back</span>
        </router-link>
        <div class="shadow-xl bg-white flex justify-between p-5 rounded-lg mb-6">
            <div class="flex flex-row justify-center items-center">
                <span class="text-[#858BB2] text-sm mr-3">Status</span>
                <InvoiceStatusBadge :status="invoice.status" />
            </div>
            <div>
                <button class="bg-custom-gray-light text-custom-seven text-base py-4 px-6 font-bold rounded-full mr-2">
                    Edit
                </button>
                <button
                    @click="showDeleteModal = true"
                    class="bg-custom-eight text-white text-base py-4 px-6 font-bold rounded-full mr-2"
                >
                    Delete
                </button>
                <button class="bg-custom-purple text-white text-base py-4 px-6 font-bold rounded-full">
                    Mark as Paid
                </button>
            </div>
        </div>
        <div class="shadow-xl bg-white p-10 rounded-lg">
            <div class="grid grid-cols-2 mb-10">
                <div>
                     <p class="mb-2">
                         <span class="font-bold text-base">
                            <span class="text-gray-400">#</span>{{ invoice.id.toUpperCase() }}
                        </span>
                     </p>
                    <p class="text-sm text-custom-seven">{{ invoice.description }}</p>
                </div>
                <div class="text-sm text-custom-seven text-right">
                    <p>{{invoice.from_street_address}}</p>
                    <p>{{invoice.from_city}}</p>
                    <p>{{invoice.from_post_code}}</p>
                    <p>{{invoice.from_country}}</p>
                </div>
            </div>
            <div class="grid grid-cols-3 gap-6 mb-10">
                <div class="grid content-between">
                    <div>
                        <h5 class="text-sm text-custom-seven mb-2">Invoice Date</h5>
                        <p class="text-base font-bold text-custom-black">{{ dayjs(invoice.created_at).format('DD MMM YYYY') }}</p>
                    </div>
                    <div>
                        <h5 class="text-sm text-custom-seven mb-2">Payment Due Date</h5>
                        <p class="text-base font-bold text-custom-black">{{ dayjs(invoice.payment_due).format('DD MMM YYYY') }}</p>
                    </div>
                </div>
                <div class="text-sm text-custom-seven">
                    <h5 class="mb-2">Bill To</h5>
                    <p class="text-base font-bold text-custom-black mb-1">{{invoice.client_name}}</p>
                    <p>{{invoice.to_street_address}}</p>
                    <p>{{invoice.to_city}}</p>
                    <p>{{invoice.to_post_code}}</p>
                    <p>{{invoice.to_country}}</p>
                </div>
                <div>
                    <h5 class="text-sm text-custom-seven mb-2">Send To</h5>
                    <p class="text-base font-bold text-custom-black">{{invoice.client_email}}</p>
                </div>
            </div>
            <div class="rounded-t-lg bg-[#F9FAFE] p-8">
                <invoice-item-table-head />
                <invoice-item-table-row
                    v-for="item in invoice.items"
                    :key="item.id"
                    :item="item"
                />
            </div>
            <div class="flex justify-between rounded-b-lg bg-custom-gray text-white p-8">
                <div>
                    <span class="text-sm">Amount Due</span>
                </div>
                <div>
                    <span class="text-[24px] font-bold">{{ MoneyFormatter(invoice.total, '£') }}</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import InvoiceStatusBadge from "@/components/InvoiceStatusBadge.vue";
import {onMounted, ref} from 'vue'
import { getInvoice, deleteInvoice } from "@/requests/invoice"
import {useRoute, useRouter} from "vue-router";
import dayjs from "dayjs";
import MoneyFormatter from "@/utils/moneyFormatter";
import InvoiceItemTableHead from "@/components/InvoiceItemTableHead.vue";
import InvoiceItemTableRow from "@/components/InvoiceItemTableRow.vue";
import BaseModal from "@/components/BaseModal.vue";

const route = useRoute();
const router = useRouter();

const invoice = ref([]);
const invoiceFetching = ref(true);
const showDeleteModal = ref(false);

// lifecycle hooks
onMounted(() => {
    getInvoice(route.params.id).then((response) => {
        invoice.value = response.data.data;
    }).finally(() => {
        invoiceFetching.value = false;
    })
})

const handleDelete = () => {
    deleteInvoice(route.params.id).then(() => {
        router.push({name: 'home'});
    })
}
</script>
