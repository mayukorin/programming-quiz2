import Vue from 'vue'
import router from "./src/router/index.js";
import App from "./App.vue";
import vuetify from "./src/plugins/vuetify";
import "./src/plugins/vee-validate";

new Vue({
  router,
  render: (h) => h(App),
  vuetify,
}).$mount("#app");