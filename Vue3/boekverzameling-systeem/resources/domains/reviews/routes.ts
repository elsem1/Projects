export const reviewRoutes = [
    {
        path: '/reviews',
        name: 'review.overview',
        component: () => import('../reviews/pages/Overview.vue'),
    },

    {
        path: '/reviews/edit:id',
        name: 'review.edit',
        component: () => import('../reviews/pages/Edit.vue'),
    },

    {
        path: '/reviews/create',
        name: 'review.create',
        component: () => import('../authors/pages/Create.vue'),
    },
];
