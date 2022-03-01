<template>
  <nav>
    <v-snackbar v-model="snac" top :color="flashMessage.color">
      <div v-for="message in flashMessage.messages" :key="message">
        {{ message }}
      </div>
    </v-snackbar>
    <v-app-bar flat app>
      <v-app-bar-nav-icon class="grey--text"></v-app-bar-nav-icon>
      <v-toolbar-title class="text-uppercase grey--text">
        <span class="font-weight-light">Pro-Quiz</span>
      </v-toolbar-title>
    </v-app-bar>
  </nav>
</template>
<script>
export default {
  name: "Navbar",
  data() {
    return {
      snac: true,
    };
  },
  methods: {
    setSnacFalse: function () {
      this.snac = false;
    },
    setSnacTrue: function () {
      this.snac = true;
    },
  },
  computed: {
    flashMessage: function () {
      let messages = this.$store.state.flashMessage.messages;
      console.log("change");
      console.log(messages);
      if (messages.length > 0) {
        this.setSnacTrue();
        if (messages.indexOf("ログインの有効期限切れです．") != -1 && this.$route.path != "/sign-in" ) {
          console.log("ok");
          this.$router.replace({
            path: "/sign-in",
            query: { next: this.$route.path }
            
          });
        }
      }
      else this.setSnacFalse();
      return this.$store.state.flashMessage;
    },
  },
};
</script>
