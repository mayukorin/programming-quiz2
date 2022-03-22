import Vue from 'vue'
import router from "./src/router/index.js";
import store from "./src/store/index.js";
import App from "./App.vue";
import vuetify from "./src/plugins/vuetify";
import "./src/plugins/vee-validate";
import '@mdi/font/css/materialdesignicons.css' 

new Vue({
  router,
  render: (h) => h(App),
  vuetify,
  store,
}).$mount("#app");