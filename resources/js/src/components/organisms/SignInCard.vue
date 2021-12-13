<template>
  <v-card>
    <v-card-title>
      <span class="headline">ログイン</span>
    </v-card-title>
    <v-card-text>
      <SignInForm :onsignin="handleSignin" />
      <v-divider class="mt-3 mb-3"></v-divider>
      アカウントをお持ちではない方は
      <v-row>
        <Button @click="goToSignUpPage">アカウント登録</Button>
      </v-row>
    </v-card-text>
  </v-card>
</template>
<script>
import SignInForm from "../molecules/SignInForm";
import Button from "../atoms/Button.vue";
export default {
  name: "SignInCard",
  components: {
    SignInForm,
    Button,
  },
  methods: {
    handleSignin: function (userInfo) {

      return this.$store
        .dispatch("auth/signin", userInfo);
    },
    goToSignUpPage: function () {
      tconsole.log("ok");
    },
  },
};
</script>