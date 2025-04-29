export const bookRoutes = [
    {
        path: '/',
        name: 'home',
        component: () => import('../books/pages/Overview.vue'),
    },
    {
        path: '/books',
        name: 'books.overview',
        component: () => import('../books/pages/Overview.vue'),
    },

    {
        path: '/books/:id/edit',
        name: 'books.edit',
        component: () => import('../books/pages/Edit.vue'),
    },

    {
        path: '/books/create',
        name: 'books.create',
        component: () => import('../books/pages/Create.vue'),
    },

    {
        path: '/books/:id',
        name: 'books.view',
        component: () => import('../books/pages/View.vue'),
    }
];
