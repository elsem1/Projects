export const authorRoutes = [
    {
        path: '/authors',
        name: 'authors.overview',
        component: () => import('../authors/pages/Overview.vue'),
    },

    {
        path: '/authors/edit:id',
        name: 'authors.edit',
        component: () => import('../authors/pages/Edit.vue'),
    },

    {
        path: '/authors/create',
        name: 'authors.create',
        component: () => import('../authors/pages/Create.vue'),
    },
];
