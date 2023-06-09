import { createRouter, createWebHistory } from "vue-router";
import Home from "@/pages/Home.vue";
import InvoiceDetails from "@/pages/InvoiceDetails.vue";
import Login from "@/pages/Login.vue";
import guest from "@/middlewares/guest";
import auth from "@/middlewares/auth";

import routerBeforeEach from "@/utils/routerBeforeEach";

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: "/login",
            name: "login",
            component: Login,
            meta: {
                middleware: [guest],
            },
        },{
            path: "/",
            name: "home",
            component: Home,
            meta: {
                middleware: [auth],
            },
        },
        {
            path: "/invoices/:id",
            name: "invoice",
            component: InvoiceDetails,
            meta: {
                middleware: [auth],
            },
        },
    ],
    scrollBehavior(to) {
        if (to.hash && document.querySelector(to.hash)) {
            return window.scrollTo({
                top: document.querySelector(to.hash).offsetTop,
                behavior: "smooth",
            });
        } else {
            window.scrollTo({
                top: 0,
                left: 0,
                behavior: "smooth",
            });
        }
    },
});

router.beforeEach(routerBeforeEach);

export default router;
