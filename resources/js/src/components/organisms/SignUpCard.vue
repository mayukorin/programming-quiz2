<template>
  <v-card>
    <v-card-title>
      <span class="headline">登</span>
    </v-card-title>
    <v-card-text>
      <SignUpForm :onsignup="handleSignup" />
    </v-card-text>
  </v-card>
</template>
<script>
import SignUpForm from "../molecules/SignUpForm";
export default {
  name: "SignUpCard",
  components: {
    SignUpForm,
  },
  methods: {
    handleSignup: function (userInfo) {
      console.log("signups");
      console.log(userInfo);
      return this.$store.dispatch("auth/signup", userInfo)
      .then(() => {
        this.$store.dispatch("auth/signin", userInfo);
      })
    },
  },
};
</script>