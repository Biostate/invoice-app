<template>
    <div class="w-[730px] mx-auto min-h-screen py-16" v-if="invoice.hasOwnProperty('id')">
        <router-link :to="{name: 'home'}">
            <svg width="6" height="11" viewBox="0 0 6 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4.3418 0.886047L0.113895 5.11395L4.3418 9.34185" stroke="#7C5DFA" stroke-width="2"/>
            </svg>
            Go Back
        </router-link>
        <div class="shadow-xl bg-white flex justify-between p-5 rounded-lg mb-6">
            <div class="flex flex-row justify-center items-center">
                <span class="text-[#858BB2] text-[13px] mr-3">Status</span>
                <InvoiceStatusBadge :status="invoice.status" />
            </div>
            <div>
                <button class="bg-custom-gray-light text-custom-seven text-[15px] py-4 px-6 font-bold rounded-full mr-2">
                    Edit
                </button>
                <button class="bg-custom-eight text-white text-[15px] py-4 px-6 font-bold rounded-full mr-2">
                    Delete
                </button>
                <button class="bg-custom-purple text-white text-[15px] py-4 px-6 font-bold rounded-full">
                    Mark as Paid
                </button>
            </div>
        </div>
        <div class="shadow-xl bg-white p-10 rounded-lg">
            <div class="grid grid-cols-2 mb-10">
                <div>
                     <p class="mb-2">
                         <span class="font-bold text-[15px]">
                            <span class="text-gray-400">#</span>{{ invoice.id.toUpperCase() }}
                        </span>
                     </p>
                    <p class="text-[13px] text-custom-seven">{{ invoice.description }}</p>
                </div>
                <div class="text-[13px] text-custom-seven text-right">
                    <p>{{invoice.from_street_address}}</p>
                    <p>{{invoice.from_city}}</p>
                    <p>{{invoice.from_post_code}}</p>
                    <p>{{invoice.from_country}}</p>
                </div>
            </div>
            <div class="grid grid-cols-4 mb-10">
                <div class="grid grid-cols-1 gap-4 content-between">
                    <div>
                        <h5 class="text-[13px] text-custom-seven mb-2">Invoice Date</h5>
                        <p class="text-[15px] font-bold text-custom-black">{{ dayjs(invoice.created_at).format('DD MMM YYYY') }}</p>
                    </div>
                    <div>
                        <h5 class="text-[13px] text-custom-seven mb-2">Payment Due Date</h5>
                        <p class="text-[15px] font-bold text-custom-black">{{ dayjs(invoice.payment_due).format('DD MMM YYYY') }}</p>
                    </div>
                </div>
                <div class="text-[13px] text-custom-seven">
                    <h5 class="mb-2">Bill To</h5>
                    <p class="text-[15px] font-bold text-custom-black mb-1">{{invoice.client_name}}</p>
                    <p>{{invoice.to_street_address}}</p>
                    <p>{{invoice.to_city}}</p>
                    <p>{{invoice.to_post_code}}</p>
                    <p>{{invoice.to_country}}</p>
                </div>
                <div class="col-span-2">
                    <h5 class="text-[13px] text-custom-seven mb-2">Send To</h5>
                    <p class="text-[15px] font-bold text-custom-black">{{invoice.client_email}}</p>
                </div>
            </div>
            <div class="rounded-t-lg bg-[#F9FAFE] p-8">
                <div class="grid grid-cols-4 mb-8">
                    <div>
                        <h5 class="text-[13px] text-custom-seven">Item Name</h5>
                    </div>
                    <div>
                        <h5 class="text-[13px] text-custom-seven text-center">QTY.</h5>
                    </div>
                    <div>
                        <h5 class="text-[13px] text-custom-seven text-right">Price</h5>
                    </div>
                    <div>
                        <h5 class="text-[13px] text-custom-seven text-right">Total</h5>
                    </div>
                </div>
                <div
                    v-for="item in invoice.items"
                    :key="item.id"
                    class="grid grid-cols-4 mb-3"
                >
                    <div>
                        <p class="text-[15px] font-bold text-custom-black">{{ item.name }}</p>
                    </div>
                    <div>
                        <p class="text-[15px] font-bold text-custom-seven text-center">{{ item.quantity }}</p>
                    </div>
                    <div>
                        <p class="text-[15px] font-bold text-custom-seven text-right">{{ MoneyFormatter(item.price, '£') }}</p>
                    </div>
                    <div>
                        <p class="text-[15px] font-bold text-custom-black text-right">{{ MoneyFormatter(item.total, '£') }}</p>
                    </div>
                </div>
            </div>
            <div class="flex justify-between rounded-b-lg bg-custom-gray text-white p-8">
                <div>
                    <span class="text-[13px]">Amount Due</span>
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
import { getInvoice } from "@/requests/invoice"
import {useRoute} from "vue-router";
import dayjs from "dayjs";
import MoneyFormatter from "@/utils/moneyFormatter";

const route = useRoute();

const invoice = ref([]);
const invoiceFetching = ref(true);

// lifecycle hooks
onMounted(() => {
    getInvoice(route.params.id).then((response) => {
        invoice.value = response.data.data;
    }).finally(() => {
        invoiceFetching.value = false;
    })
})
</script>
