export const usersRoutes = [
    {
        path: "/users",
        name: "users.overview",
        component: () => import("./pages/Overview.vue"),
    },       
    {
        path: "/users/:userId/edit",
        name: "users.edit",
        component: () => import("./pages/Edit.vue"),
    },
];
