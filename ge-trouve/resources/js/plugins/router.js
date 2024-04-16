import { createRouter, createWebHistory, RouterView } from 'vue-router'
import { authStore } from "@/stores/authStore";


const routes = [
    {
        path: '/auth',
        component: RouterView,
        meta: { requiresGuest: true },  // Add meta field for authentication check
        children: [
            {
                path: 'login',
                name: 'login',
                component: () => import("../page/auth/Login.vue"),
            },
            {
                path: 'register',
                name: 'register',
                component: () => import("../page/auth/Register.vue"),
            },
        ]
    },
    {


        path: '/app',
        component: RouterView,
        meta: { requiresAuth: true },  // Add meta field for authentication check
        children: [
            {
                path: 'map',
                name: 'map',
                component: () => import("../page/app/Map.vue")
            },
            {
                path: 'detail_objet',
                name: 'detail_objet',
                component: () => import("../page/app/Detail_objet.vue")
            },
            {
                path: 'discussion/:itemId',
                name: 'discussion',
                component: () => import("../page/app/Discussion.vue"),
                props: true
            },
            {
                path: 'about',
                name: 'about',
                component: () => import("../page/app/About.vue")
            },

        ]
    },
    {
        path: '/',
        name: 'welcome',
        component: () => import("../page/Welcome.vue")
    },
    {
        path: '/:catchAll(.*)',
        redirect: { name: 'welcome' }
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach(async (to, from, next) => {
    const store = authStore();
    // Fetch user data if not available
    if (!store.user) {
        try {
            await store.getToken(); // Ensure CSRF token is set
            await store.getUser(); // Fetch user data
        } catch (error) {
            console.error("Error fetching user data:", error);
        }
    }

    // Check if the route requires authentication
    if (to.matched.some(record => record.meta.requiresAuth)) {
        // Redirect to login if not authenticated
        if (!store.user) {
            next({ name: 'login' });
        } else {
            next();
        }
    }
    // Check if the route requires a guest (not authenticated)
    else if (to.matched.some(record => record.meta.requiresGuest)) {
        // Redirect to home if authenticated
        if (store.user) {
            next({ name: 'map' });
        } else {
            next();
        }
    } else {
        next(); // Continue to the next hook
    }
});

export default router
