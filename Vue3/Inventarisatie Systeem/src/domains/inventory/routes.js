export const inventoryRoutes = [
    {
        path: '/',
        name: 'Home',
        component: () => import('../inventory/pages/InventoryOverview.vue'),
    },
    {
        path: '/overview',
        name: 'Overview',
        component: () => import('../inventory/pages/InventoryOverview.vue'),
    },

    {
        path: '/edit/:id',
        name: 'Edit',
        component: () => import('../inventory/pages/EditView.vue'),
    },
    {
        path: '/create',
        name: 'Create',
        component: () => import('../inventory/pages/CreateView.vue'),
    },
];
