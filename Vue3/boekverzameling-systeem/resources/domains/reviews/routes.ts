export const reviewRoutes = [
    {
        path: '/',
        name: 'review.overview',
        component: () => import('../reviews/pages/Overview.vue'),
    },

    {
        path: '/edit:id',
        name: 'review.edit',
        component: () => import('../reviews/pages/Edit.vue'),
    },

    {
        path: '/',
        name: 'review.create',
        component: () => import('../authors/pages/Create.vue'),
    },
];
