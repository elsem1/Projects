import { createRouter, createWebHistory } from "vue-router";
import { authRoutes } from "../domains/auth/routes";

const routes = [...authRoutes];

export const router = createRouter({
    history: createWebHistory(),
    routes,
});
