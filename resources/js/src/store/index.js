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
    },
    reset(state) {
      state.username = "";
      state.email = "";
      state.isLoggedIn = false;
    },
  },
  actions: {
    signup(context, payload) {
      console.log("signup2");


      console.log(payload);
      return api({
        method: "post",
        url: "api/users/",
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
        url: "api/auth/me/",
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
        url: "api/auth/login",
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

const store = new Vuex.Store({
  modules: {
    auth: authModule,
  },
});

export default store;
