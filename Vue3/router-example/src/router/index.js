import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";
import BrazilPage from "../views/BrazilPage.vue";
import AboutView from "../views/AboutView.vue";
import HawaiiPage from "../views/HawaiiPage.vue";
import PanamaPage from "../views/PanamaPage.vue";
import JamaicaPage from "../views/JamaicaPage.vue";

const routes = [
  {
    path: "/",
    name: "home",
    component: HomeView,
  },
  {
    path: "/about",
    name: "about",
    component: AboutView,
  },
  {
    path: "/brazil",
    name: "brazil",
    component: BrazilPage,
  },
  {
    path: "/hawaii",
    name: "hawaii",
    component: HawaiiPage,
  },
  {
    path: "/panama",
    name: "panama",
    component: PanamaPage,
  },
  {
    path: "/jamaica",
    name: "jamaica",
    component: JamaicaPage,
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;
