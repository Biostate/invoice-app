<template>
    <Teleport to="body">
        <div>
            <div
                class="fixed bg-custom-black inset-0 opacity-50"
                @click="closeModal"
                v-show="modelValue"
            ></div>
            <div id="drawer"
             :class="{
                 'fixed': true,
                 'top-0': true,
                 'left-0': true,
                 'z-40': true,
                 'h-screen': true,
                 'p-4': true,
                 'overflow-y-auto': true,
                 'transition-transform': true,
                 '-translate-x-full': !modelValue,
                 'bg-white': true,
                 'w-[719px]': true,
                 'pl-[103px]': true,
                 }"
             tabindex="-1"
             aria-labelledby="drawer-label">
            <div class="py-14 px-12">
                <form @submit.prevent="handleStore" class="relative">
                    <h1 class="text-[24px] font-bold text-custom-black">
                        New Invoice
                    </h1>
                    <div class="mt-8">
                        <h3 class="mb-5 text-custom-purple">
                            Bill From
                        </h3>
                        <base-input
                            v-model="invoice.from_street_address"
                            label="Street Address"
                            :reqired="true"
                            wrapper-class="mb-4"
                        />
                        <div class="grid grid-cols-3 gap-4">
                            <base-input
                                v-model="invoice.from_city"
                                label="City"
                                :reqired="true"
                            />
                           <base-input
                                v-model="invoice.from_post_code"
                                label="Post Code"
                                :reqired="true"
                            />
                            <base-input
                                v-model="invoice.from_country"
                                label="Country"
                                :reqired="true"
                            />
                        </div>
                    </div>
                    <div class="mt-8">
                        <h3 class="mb-5 text-custom-purple">
                            Bill To
                        </h3>
                        <base-input
                            v-model="invoice.client_name"
                            label="Client Name"
                            :reqired="true"
                            wrapper-class="mb-4"
                        />
                        <base-input
                            v-model="invoice.client_email"
                            label="Client Email"
                            :reqired="true"
                            wrapper-class="mb-4"
                        />
                        <base-input
                            v-model="invoice.to_street_address"
                            label="Street Address"
                            :reqired="true"
                            wrapper-class="mb-4"
                        />
                        <div class="grid grid-cols-3 gap-4">
                            <base-input
                                v-model="invoice.to_city"
                                label="City"
                                :reqired="true"
                            />
                            <base-input
                                  v-model="invoice.to_post_code"
                                  label="Post Code"
                                  :reqired="true"
                                />
                            <base-input
                                v-model="invoice.to_country"
                                label="Country"
                                :reqired="true"
                            />
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="grid grid-cols-2 gap-4 mb-2">
                            <base-input
                                v-model="invoice.invoice_date"
                                label="Invoice Date"
                                :reqired="true"
                                type="date"
                            />
                            <base-input
                                v-model="invoice.payment_terms"
                                label="Payment Terms"
                                :reqired="true"
                                type="number"
                            />
                        </div>
                        <base-input
                            v-model="invoice.description"
                            label="Project Description"
                            :reqired="true"
                            wrapper-class="mt-4"
                        />
                    </div>
                    <div class="mt-8">
                            <h1 class="text-[#777F98] text-[18px] font-bold">Items</h1>
                            <div class="grid grid-cols-7 mb-4 mt-8 gap-4 text-sm text-custom-seven font-bold">
                                <div class="col-span-3">
                                    <h5>Item Name</h5>
                                </div>
                                <div>
                                    <h5>Qty.</h5>
                                </div>
                                <div class="col-span-2">
                                    <h5>Price</h5>
                                </div>
                                <div>
                                    <h5>Total</h5>
                                </div>
                                <div>

                                </div>
                            </div>
                            <div
                                v-for="(item, index) in invoice.items"
                                class="grid grid-cols-8 mb-4  gap-4"
                            >
                                <base-input
                                    v-model="item.name"
                                    :reqired="true"
                                    wrapper-class="col-span-3"
                                />
                                <base-input
                                    v-model.number="item.quantity"
                                    :reqired="true"
                                    :input-class="{'text-center': true}"
                                />
                                <base-input
                                    v-model.number="item.price"
                                    :reqired="true"
                                    wrapper-class="col-span-2"
                                />
                                <div class="flex items-center">
                                    <span class="text-base font-bold text-custom-six">{{ (item.quantity * item.price).toFixed(2) }}</span>
                                </div>
                                <div class="flex items-center">
                                    <button type="button" @click="removeItem(index)">X</button>
                                </div>
                            </div>
                            <button
                                class="text-center p-5 bg-custom-gray-light rounded-full text-custom-seven block w-full font-bold"
                                @click="addItem"
                                type="button"
                            >
                                + Add New Item
                            </button>
                        </div>
                    <div class="flex justify-end mt-8">
                        <button
                            class="bg-custom-gray-light text-custom-seven text-base py-4 px-6 font-bold rounded-full mr-2"
                            @click="closeModal"
                        >
                            Cancel
                        </button>
                        <button
                            @click="saveInvoice"
                            class="bg-custom-purple text-white text-base py-4 px-6 font-bold rounded-full">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
</div>
    </Teleport>
</template>

<script setup>
import { ref } from 'vue';
import { storeInvoice } from "@/requests/invoice";
import BaseInput from "@/components/BaseInput.vue";

defineProps({
    modelValue: {
        type: Boolean,
        required: true
    }
});

const emit = defineEmits(['update:modelValue'])

const invoice = ref({
    from_street_address: '',
    from_city: '',
    from_post_code: '',
    from_country: '',

    street_address: '',
    to_city: '',
    to_post_code: '',
    to_country: '',

    client_name: '',
    client_email: '',
    invoice_date: '',
    payment_terms: '',
    description: '',
    items: [],
})

const addItem = () => {
    invoice.value.items.push({
        name: '',
        quantity: 0,
        price: 0.00,
    })
}

const closeModal = () => {
    invoice.value = {
        from_street_address: '',
        from_city: '',
        from_post_code: '',
        from_country: '',

        street_address: '',
        to_city: '',
        to_post_code: '',
        to_country: '',

        client_name: '',
        client_email: '',
        invoice_date: '',
        payment_terms: '',
        description: '',
        items: [],
    };

    emit('update:modelValue', false)
}

const removeItem = (index) => {
    invoice.value.items.splice(index, 1)
}

const handleStore = () => {
    if (invoice.value.id) {
        //
    }else{
        storeInvoice(invoice.value)
            .then(() => {
                closeModal()
                emit('saved')
            })
    }
}
</script>
