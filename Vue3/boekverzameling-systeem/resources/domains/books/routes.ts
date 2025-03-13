export const bookRoutes = [
    {
        path: '/',
        name: 'book.overview',
        component: () => import('../books/pages/Overview.vue'),
    },

    {
        path: '/edit:id',
        name: 'book.edit',
        component: () => import('../books/pages/Edit.vue'),
    },

    {
        path: '/create',
        name: 'book.create',
        component: () => import('../authors/pages/Create.vue'),
    },
];
