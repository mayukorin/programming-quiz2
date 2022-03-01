<template>
  <v-card>
    <v-card-title>
      <span class="headline">アカウント登録</span>
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
      return this.$store.dispatch("auth/signup", userInfo)
      .then(() => {
        this.$store.dispatch("auth/signin", userInfo);
      })
      .then(() => {
          let signUpSuccessMessage = "アカウント登録が完了しました";
          this.$store.dispatch("flashMessage/setSuccessMessage", {
            messages: [signUpSuccessMessage],
          });
          const next = this.$route.query.next || "/";
          this.$router.replace(next);
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>