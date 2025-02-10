
export const groceryRoutes = [
  {
    path: '/',
    name: 'Home',
    component: () => import('../groceries/pages/OverviewView.vue'),
  },
  {
    path: '/overview',
    name: 'overview',
    component: () => import('../groceries/pages/OverviewView.vue'),
  },

  {
    path: '/edit/:id',
    name: 'edit',
    component: () => import('../groceries/pages/EditView.vue'),
  },
  {
    path: '/create',
    name: 'create',
    component: () => import('../groceries/pages/CreateView.vue'),
  },
];
