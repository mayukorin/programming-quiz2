<template>
    <v-app>
      <Navbar />
      <v-main class="grey lighten-4 main">
      <v-container>
        <v-row justify="center">
          <v-col cols="8">
            <router-view />
          </v-col>
        </v-row>
      </v-container>
    </v-main>
    </v-app>
</template>

<script>
import Navbar from "./src/components/organisms/Navbar";
export default {
  name: "App",
  components: {
    Navbar,
  },
  data: () => ({
    //
  }),
};
</script>
<style scoped>
.main {
  margin-bottom: 0rem;
  margin-top: 0rem;
}
</style>

