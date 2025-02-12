export const groceryRoutes = [
  {
    path: '/',
    name: 'Home',
    component: () => import('../groceries/pages/OverviewView.vue'),
  },
  {
    path: '/overview',
    name: 'Overview',
    component: () => import('../groceries/pages/OverviewView.vue'),
  },

  {
    path: '/edit/:id',
    name: 'Edit',
    component: () => import('../groceries/pages/EditView.vue'),
  },
  {
    path: '/create',
    name: 'Create',
    component: () => import('../groceries/pages/CreateView.vue'),
  },
]
