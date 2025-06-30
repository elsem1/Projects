import { createRouter, createWebHistory } from 'vue-router';
import { authRoutes } from '../../domains/auth/routes';
import { notesRoutes } from '../../domains/notes/routes';
import { repliesRoutes } from '../../domains/replies/routes';
import { ticketsRoutes } from '../../domains/tickets/routes';
import { usersRoutes } from '../../domains/users/routes';

const routes = [...authRoutes, ...notesRoutes, ...repliesRoutes, ...ticketsRoutes, ...usersRoutes];

export const router = createRouter({
    history: createWebHistory(),
    routes,    
});