export const categoriesRoutes = [
    {
        path: "/categories/create",
        name: "categories.create",
        component: () => import("./pages/Create.vue"),
    },
    {
        path: "/categories/:categoryId/edit",
        name: "categories.edit",
        component: () => import("./pages/Edit.vue"),
    },
];