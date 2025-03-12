export const authorRoutes = [
    {
        path: '/',
        name: 'author.overview',
        component: () => import('../authors/pages/Overview.vue'),
    },

    {
        path: '/edit:id',
        name: 'author.edit',
        component: () => import('../authors/pages/Edit.vue'),
    },

    {
        path: '/create',
        name: 'author.create',
        component: () => import('../authors/pages/Create.vue'),
    },
];
