import { createRouter, createWebHistory } from "vue-router";
import { isAuthenticated } from '../utils/auth';

const routes = [
    {
        path: "/login",
        name: "LoginPage",
        component: import("../components/Login/LoginPage.vue"),
    },
      {
        path: '/register',
        name: 'RegisterPage',
        component: import("../components/Login/RegisterPage.vue")
      },
    {
        path: "/",
        name: "HomePage",
        component: () => import("../components/HomePage.vue"),
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach(async (to, from, next) => {
    const isAuth = await isAuthenticated();

    if (!isAuth && to.name !== "LoginPage" && to.name !== "RegisterPage") {
        localStorage.removeItem('token');
        next({ name: "LoginPage" });
    } else if (to.name === "LoginPage" && isAuth) {
        next({ name: "HomePage" });
    } else {
        next();
    }
});

export default router;
