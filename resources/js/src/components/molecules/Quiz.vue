<template>
    <v-card flat class="mb-1">
        <div class="d-flex flex-no-wrap justify-space-between">
          <!--
            <v-avatar
                class="ma-3"
                :size="culateHeight()"
                tile
              >
                <v-img src="/media/tennis.jpg" contain></v-img>
              </v-avatar>
            -->
            <div>
                <router-link :to="{name: 'QuizShow', params: { id: quiz.id }}">
                  <v-card-title>{{ quiz.title }}</v-card-title>
                </router-link>
                <v-card-text v-if="quiz.coding_language_and_frameworks.length != 0">
                  <span>
                    <v-icon class="mr-1">mdi-tag</v-icon>
                    <span class="mr-1" v-for="clf in quiz.coding_language_and_frameworks" :key="clf.name">
                        <router-link :to="{name: 'TaggedQuizIndex', params: { id: clf.id }}">{{ clf.name }}</router-link>
                    </span>
                  </span>
                </v-card-text>
            </div> 
            <v-icon v-if="isLoggedIn && quiz.stock_id == null" class="mr-2" @click="$emit('click-stock-create-button', {quiz_id: quiz.id})">mdi-star-outline</v-icon>
            <v-icon v-else-if="isLoggedIn && quiz.stock_id != null" class="mr-2" @click="$emit('click-stock-destroy-button', { stockId: quiz.stock_id })">mdi-star</v-icon>
        </div>
    </v-card>
</template>
<script>
export default {
  name: "Quiz",
  props: {
    quiz: {
        type: Object
    }
  },
  methods: {
    culateHeight() {
        switch (this.$vuetify.breakpoint.name) {
            case 'xs': return '50'
            case 'sm': return '80'
            case 'md': return '120'
            case 'lg': return '150'
            case 'xl': return '180'
        }
    }
  },
  computed: {
    isLoggedIn() {
      return this.$store.state.auth.isLoggedIn;
    },
  },
};
</script>
<style scoped>
  a {
        color: black!important;;
        text-decoration: none;
    }

  a:hover {
    color: green!important;
  }
</style>