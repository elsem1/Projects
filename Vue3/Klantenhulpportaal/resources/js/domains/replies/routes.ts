export const repliesRoutes = [
    {
        path: "/tickets/:ticketId/replies/create",
        name: "replies.create",
        component: () => import("./pages/Create.vue"),
    },

    {
        path: "/tickets/:ticketId/replies/:replyId/edit",
        name: "replies.edit",
        component: () => import("./pages/Edit.vue"),
    },
];
