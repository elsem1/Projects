export const authorRoutes = [
    {
        path: '/authors',
        name: 'author.overview',
        component: () => import('../authors/pages/Overview.vue'),
    },

    {
        path: '/authors/edit:id',
        name: 'author.edit',
        component: () => import('../authors/pages/Edit.vue'),
    },

    {
        path: '/authors/create',
        name: 'author.create',
        component: () => import('../authors/pages/Create.vue'),
    },
];
