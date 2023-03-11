<template>
    <section class="bg-custom-gray-light">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-custom-black md:text-2xl">
                        Sign in to your account for manage your invoices
                    </h1>
                    <form class="space-y-4 md:space-y-6" @submit.prevent="loginHandler">
                        <base-input
                            v-model="email"
                            type="email"
                            placeholder="test@example.com"
                            :required="true"
                        />
                        <base-input
                            v-model="password"
                            type="password"
                            placeholder="••••••••"
                            :required="true"
                        />
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="remember" aria-describedby="remember" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="remember" class="text-gray-500">Remember me</label>
                            </div>
                        </div>
                        <button
                            type="submit"
                            class="
                                w-full
                                text-white
                                bg-custom-purple
                                hover:bg-primary-700
                                focus:ring-4
                                focus:outline-none
                                focus:ring-primary-300
                                font-medium rounded-lg
                                text-sm
                                py-4
                                text-center
                            "
                            :disabled="isRequesting"
                        >
                            Sign in
                        </button>
                    </form>
                    <validation-list :errors="errors" />
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import ValidationList from "@/components/ValidationList.vue";
import { useAuthStore } from "@/stores/auth";
import { ref } from 'vue';
import { useRouter } from "vue-router";
import BaseInput from "@/components/BaseInput.vue";

const email = ref('');
const password = ref('');
const auth = useAuthStore();
const errors = ref({});
const isRequesting = ref(false);
const router = useRouter();

const loginHandler = async () => {
    isRequesting.value = true;
    await auth.login(email.value, password.value).then(response => {
        errors.value = {};
        router.push({ name: 'home' });
    }).catch(error => {
        errors.value = error.response.data.errors;
    }).finally(() => {
        isRequesting.value = false;
    });
}

</script>
