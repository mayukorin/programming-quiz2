import Vue from "vue";
import Vuex from "vuex";
import api from "../services/api";

Vue.use(Vuex);

const authModule = {
  namespaced: true,
  state: {
    name: "",
    email: "",
    isLoggedIn: false,
  },
  mutations: {
    set(state, payload) {
      state.name = payload.user.name;
      state.email = payload.user.email;
      state.isLoggedIn = true;
      console.log(state.isLoggedIn);
    },
    reset(state) {
      state.username = "";
      state.email = "";
      state.isLoggedIn = false;
    },
  },
  actions: {
    signup(context, payload) {
      return api({
        method: "post",
        url: "users",
        data: {
          name: payload.name,
          email: payload.email,
          password: payload.password,
          password_confirmation: payload.password_confirmation,
        },
      });
    },
    renew(context) {
      return api({
        method: "get",
        url: "auth/me",
      }).then((response) => {
        console.log(response.data);
        context.commit("set", { user: response.data });
        return response;
      });
    },
    signin(context, payload) {
      console.log("signinまで");
      return api({
        method: "post",
        url: "auth/login",
        data: {
          session: {
            email: payload.email,
            password: payload.password,
          },
        },
      })
    .then((response) => {
      console.log(response.data.access_token);
      localStorage.setItem("access", response.data.access_token);
      return context.dispatch("renew");
    });
    },
    signout(context) {
      localStorage.removeItem("access");
      context.commit("reset");
    },
  },
};

const flashMessageModule = {
  namespaced: true,
  state: {
    messages: [],
    color: "",
  },
  mutations: {
    set(state, payload) {
      if (payload.error) {
        state.messages = payload.error;
        state.color = "error";
      } else if (payload.warning) {
        state.messages = payload.warning;
        state.color = "warning";
      } else if (payload.success) {
        state.messages = payload.success;
        state.color = "success";
      }
    },
    clear(state) {
      state.messages = [];
      state.color = "";
    },
  },
  actions: {
    setErrorMessage(context, payload) {
      context.commit("clear");
      console.log("actions");
      console.log(payload.message);
      context.commit("set", { error: payload.messages });
    },
    setWarningMessages(context, payload) {
      context.commit("clear");
      context.commit("set", { warning: payload.messages });
    },
    setSuccessMessage(context, payload) {
      console.log("setSuccess呼ばれる");
      context.commit("clear");
      context.commit("set", { success: payload.messages });
    },
    clearMessages(context) {
      context.commit("clear");
    },
  },
};

const quizModule = {
  namespaced: true,
  state: {
    quiz: null,
    quizList: [],
  },
  mutations: {
    setQuiz(state, payload) {
      state.quiz = payload.quiz;
    },
    setQuizList(state, payload) {
      state.quizList = payload.quizList;
    },
    clear(state) {
      state.quiz = null;
    },
  },
  getters: {
    getQuiz(state) {
      return state.quiz;
    },
    getQuizList(state) {
      return state.quizList;
    }
  },
  actions: {
    fetchQuiz(context, payload) {
      return api({
        method: "get",
        url: "quizzes/"+payload.id,
      }).then((response) => {
        console.log(response.data);
        context.commit("setQuiz", { quiz: response.data });
        // return response;
      });
    },
    fetchQuizList(context) {
      return api({
        method: "get",
        url: "quizzes",
      }).then((response) => {
        console.log(response.data);
        context.commit("setQuizList", { quizList: response.data });
      })
    },
    createQuiz(context, payload) {
      return api({
        method: "post",
        url: "quizzes",
        data: payload
      }).then((response) => {
        console.log(response.data);
      })
    },
    updateQuiz(context, payload) {
      console.log("これからupdate");
      console.log(payload.editQuiz);
      return api({
        method: "patch",
        url: "quizzes/"+payload.id,
        data: payload.editQuiz,
      }).then((response) => {
        console.log(response.data);
      })
    },
    deleteQuiz(context, payload) {
      return api({
        method: "delete",
        url: "/quizzes/"+payload.id,
      }).then((response) => {
        console.log(response);
      })
    }
  }
};

const stockModule = {
  namespaced: true,
  actions: {
    createStock(context, payload) {
      console.log("stock");
      console.log(payload);
      return api({
        method: "post",
        url: "stocks",
        data: payload
      }).then((response) => {
        console.log(response.data);
        context.dispatch("quiz/fetchQuizList", null, { root: true });
        // return response;
      });
    },
    destroyStock(context, payload) {
      console.log("stock destroy");
      console.log(payload);
      return api({
        method: "delete",
        url: "stocks/"+payload.stockId,
      }).then((response) => {
        console.log(response.data);
        context.dispatch("quiz/fetchQuizList", null, { root: true });
        // return response;
      });
    }
  }
};


const store = new Vuex.Store({
  modules: {
    auth: authModule,
    flashMessage: flashMessageModule,
    quiz: quizModule,
    stock: stockModule,
  },
});

export default store;
