export const authRoutes = [
    {
        path: '/',
        name: 'login',
        component: () => import('../auth/pages/Overview.vue')
    },
    {
        path: '/register',
        name: 'register',
        component: () => import('../auth/pages/Create.vue')
    },
    {
        path: '/reset-password/:token',
        name: 'reset-password',
        component: () => import('../auth/pages/ResetPassword.vue')
    },

];  