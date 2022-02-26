import Vue from "vue";
import VueRouter from "vue-router";

import Home from "../components/templates/HomeView.vue";
import SignIn from "../components/templates/SignInView.vue";
import SignUp from "../components/templates/SignUpView.vue";
import QuizShow from "../components/templates/QuizShowView.vue";

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
    {
      path: "/sign-up",
      name: "SignUp",
      component: SignUp,
    },
    {
      path: "/quiz/:id",
      name: "QuizShow",
      component: QuizShow
    }
  ];
  
  const router = new VueRouter({
    mode: "history",
    base: process.env.BASE_URL,
    routes,
  });
  
  
  export default router;
  