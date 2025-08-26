export const ticketsRoutes = [
    {
        path: "/tickets",
        name: "tickets.overview",
        component: () => import("./pages/Overview.vue"),
    },
    {
        path: "/tickets/create",
        name: "tickets.create",
        component: () => import("./pages/Create.vue"),
    },
    {
        path: "/tickets/:id",
        name: "tickets.view",
        component: () => import("./pages/View.vue"),
    },
    {
        path: "/tickets/:id/edit",
        name: "tickets.edit",
        component: () => import("./pages/Edit.vue"),
    },
    
    
];