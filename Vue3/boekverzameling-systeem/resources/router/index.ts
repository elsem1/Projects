import {createRouter, createWebHistory} from 'vue-router';
import {authorRoutes} from '../domains/authors/routes';
import {bookRoutes} from '../domains/books/routes';
import {reviewRoutes} from '../domains/reviews/routes';

const routes = [...authorRoutes, ...bookRoutes, ...reviewRoutes];

export const router = createRouter({
    history: createWebHistory(),
    routes,
});
