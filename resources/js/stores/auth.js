import { defineStore } from "pinia";
import { login, getUser } from "@/requests/auth";

export const useAuthStore = defineStore({
    id: "auth",
    state: () => ({
        isSessionChecked: false,
        user: null,
        message: "Test",
    }),
    actions: {
        // eslint-disable-next-line no-unused-vars
        async login(email, password) {
            return login(email, password).then(response => {
                this.user = response.data.data;
            })
        },
        async getUser() {
            return getUser().then(response => {
                this.user = response.data.data;
            });
        },
        async logout() {
            // TODO: logout from server
        },
    },
});
