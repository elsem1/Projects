import { createRouter, createWebHistory } from 'vue-router'
import Vue from 'vue';
import VueRouter from 'vue-router';
import routes from '@/grocery/routes';


Vue.use(VueRouter);

const router = createRouter({
  history: createWebHistory(import.meta.env.VITE_BASE_URL),
  routes,
});
export default router;

