export const authRoutes = [
    {
        path: '/',
        name: 'login',
        component: () => import('../auth/pages/Overview.vue')
    },
    {
        path: '/register',
        name: 'register',
        component: () => import('../auth/components/RegisterForm.vue')
    },
];