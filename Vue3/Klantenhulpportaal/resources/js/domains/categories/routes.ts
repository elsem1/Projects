export const categoriesRoutes = [
    {
        path: "/categories",
        name: "categories.overview",
        component: () => import("./pages/Overview.vue"),
    },
    {
        path: "/categories/create",
        name: "categories.create",
        component: () => import("./pages/Create.vue"),
    },
    {
        path: "/categories/:categoryId",
        name: "categories.view",
        component: () => import("./pages/View.vue"),
    },
    {
        path: "/categories/:categoryId/edit",
        name: "categories.edit",
        component: () => import("./pages/Edit.vue"),
    },
];