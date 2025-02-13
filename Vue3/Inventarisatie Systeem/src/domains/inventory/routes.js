export const inventoryRoutes = [
    {
        path: '/',
        name: 'inventory.overview',
        component: () => import('../inventory/pages/InventoryOverview.vue'),
    },

    {
        path: '/edit/:id',
        name: 'inventory.edit',
        component: () => import('../inventory/pages/EditView.vue'),
    },
    {
        path: '/create',
        name: 'inventory.create',
        component: () => import('../inventory/pages/CreateView.vue'),
    },
    {
      path: '/bestellen',
      name: 'inventory.bestellen',
      component: () => import('../inventory/pages/BestellenView.vue'),
  },
];
