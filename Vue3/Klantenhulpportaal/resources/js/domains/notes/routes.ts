export const notesRoutes = [
    {
        path: "/tickets/:ticketId/notes/create",
        name: "notes.create",
        component: () => import("./pages/Create.vue"),
    },
    {
        path: "/tickets/:ticketId/notes/:noteId/edit",
        name: "notes.edit",
        component: () => import("./pages/Edit.vue"),
    },
];