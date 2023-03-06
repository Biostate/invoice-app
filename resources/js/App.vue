<template><div class="flex bg-custom-gray-light  h-full">
    <aside class="w-44 fixed left-0 top-0 h-screen bg-slate-700 p-10">
        <div class="h-full grid grid-cols-1 content-between ...">
            <div>LOGO</div>
            <div>{{ auth.message }}</div>
        </div>
    </aside>
    <main class="flex-1 ml-44">
        <router-view></router-view>
    </main>
</div>
</template>

<script setup>
import { useAuthStore } from "@/stores/auth";

const auth = useAuthStore();
</script>
