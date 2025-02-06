

const routes = [
  {
    path: '/',
    name: 'overview',
    component: () => import('../groceries/pages/OverviewView.vue'),
  },
  {
    path: '/edit',
    name: 'edit',
    component: () => import('../groceries/pages/EditView.vue'),
  },
  {
    path: '/',
    name: 'create',
    component: () => import('../groceries/pages/CreateView.vue'),
  },
];

export default routes;
