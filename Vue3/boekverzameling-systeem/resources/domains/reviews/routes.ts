export const reviewRoutes = [
    {
        path: '/reviews',
        name: 'reviews.overview',
        component: () => import('../reviews/pages/Overview.vue'),
    },

    {
        path: '/reviews/edit:id',
        name: 'reviews.edit',
        component: () => import('../reviews/pages/Edit.vue'),
    },

    {
        path: '/reviews/create',
        name: 'reviews.create',
        component: () => import('../authors/pages/Create.vue'),
    },
];
