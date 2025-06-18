export const authRoutes = [
    {
        path: "/",
        name: "home",
        component: () => import("../auth/pages/Login.vue"),
    },
];
