<template>
    <div class="flex bg-custom-gray-light  h-full">
        <aside class="w-[103px] fixed left-0 top-0 h-screen bg-slate-700 z-50 rounded-r-[20px]">
            <div class="h-full grid grid-cols-1 content-between ...">
                <div>
                    <img :src="Logo" alt="Logo" class="w-[103px]">
                </div>
                <div class="text-center border-t-2 border-[#494E6E]">
                    <img :src="ProfilePicture" alt="Profile Picture" class="w-[40px] inline py-7">
                </div>
            </div>
        </aside>
        <main class="flex-1 ml-[103px]">
            <router-view></router-view>
        </main>
    </div>
</template>

<script setup>
import { useAuthStore } from "@/stores/auth";
import Logo from "@/assets/logo.png";
import ProfilePicture from "@/assets/profile-pic.png";

const auth = useAuthStore();
</script>
