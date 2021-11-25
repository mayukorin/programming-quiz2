import Vue from 'vue'
import router from "./src/router/index.js";
import vuetify from "./src/plugins/vuetify.js";
import App from "./App.vue";

new Vue({
  router,
  vuetify,
  render: (h) => h(App),
}).$mount("#app");