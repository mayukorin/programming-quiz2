import Vue from "vue";
import VueRouter from "vue-router";

import HomeView from "../components/templates/HomeView.vue";
import SignIn from "../components/templates/SignInView.vue";
import SignUp from "../components/templates/SignUpView.vue";
import QuizShow from "../components/templates/QuizShowView.vue";
import NotFound from "../components/templates/NotFoundView.vue";
import QuizCreate from "../components/templates/QuizCreateView.vue";
import QuizUpdate from "../components/templates/QuizUpdateView.vue";
import StockedQuizIndex from "../components/templates/StockedQuizIndexView.vue";
import TaggedQuizIndexView from "../components/templates/TaggedQuizIndexView.vue";

Vue.use(VueRouter);

const routes = [
    {
      path: "/",
      name: "Home",
      component: HomeView,
    },
    {
      path: "/stocked-quizzes",
      name: "StockedQuizIndex",
      component: StockedQuizIndex,
      meta: { requiresAuth: true }
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
      path: "/quizzes/edit/:id",
      name: "QuizUpdate",
      component: QuizUpdate,
      meta: { requiresAuth: true }
    },
    {
      path: "/coding_language_and_frameworks/:id",
      name: "TaggedQuizIndex",
      component: TaggedQuizIndexView,
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
  