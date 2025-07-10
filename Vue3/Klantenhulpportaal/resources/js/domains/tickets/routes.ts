export const ticketsRoutes = [
    {
        path: "/tickets",
        name: "tickets.overview",
        component: () => import("./pages/Overview.vue"),
    },
    {
        path: "/tickets/:id",
        name: "tickets.view",
        component: () => import("./pages/View.vue"),
    },
    
];