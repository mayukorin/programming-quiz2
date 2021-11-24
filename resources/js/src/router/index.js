import Vue from "vue";
import VueRouter from "vue-router";

import Home from "../components/templates/HomeView.vue";
import SignIn from "../components/templates/SignInView.vue";

Vue.use(VueRouter);

const routes = [
    {
      path: "/",
      name: "Home",
      component: Home,
    },
    {
      path: "/sign-in",
      name: "SignIn",
      component: SignIn,
    },
  ];
  
  const router = new VueRouter({
    mode: "history",
    base: process.env.BASE_URL,
    routes,
  });
  
  
  export default router;
  