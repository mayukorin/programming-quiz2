import Vue from "vue";
import VueRouter from "vue-router";

import Home from "../components/templates/HomeView.vue";
import SignIn from "../components/templates/SignInView.vue";
import SignUp from "../components/templates/SignUpView.vue";
import QuizShow from "../components/templates/QuizShowView.vue";
import NotFound from "../components/templates/NotFoundView.vue";
import QuizCreate from "../components/templates/QuizCreateView.vue";

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
    },
    {
      path: "/quizzes/new",
      name: "QuizCreate",
      component: QuizCreate,
      meta: { requiresAuth: true }
    },
    {
      path: "*",
      name: "NotFound",
      component: NotFound
    }
  ];
  
  const router = new VueRouter({
    mode: "history",
    base: process.env.BASE_URL,
    routes,
  });
  
  
  export default router;
  