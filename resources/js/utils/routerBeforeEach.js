import { useAuthStore } from "@/stores/auth";
import pipeline from "@/middlewares/pipeline";

export default async function routerBeforeEach(to, from, next) {
    // redirect to login page if not logged in and trying to access a restricted page
    const auth = useAuthStore();

    // check seession if not checked
    if (!auth.isSessionChecked) {
        // fetch user to ensure session is valid
        try {
            await auth.getUser();
        } catch {
            // if session is not valid then logout
            await auth.logout();
        } finally {
            auth.isSessionChecked = true;
        }
    }

    if (!to.meta.middleware) {
        return next();
    }
    const middleware = to.meta.middleware;

    const context = {
        to,
        from,
        next,
        auth,
    };

    return middleware[0]({
        ...context,
        next: pipeline(context, middleware, 1),
    });
}
