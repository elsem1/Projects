export const ticketsRoutes = [
    {
        path: "/tickets",
        name: "tickets.overview",
        component: () => import("./pages/Overview.vue"),
    },
];