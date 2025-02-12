import {createRouter, createWebHistory} from 'vue-router';
import {inventoryRoutes} from '../domains/inventory/routes';

const routes = [...inventoryRoutes];

export const router = createRouter({
    history: createWebHistory(),
    routes,
});
