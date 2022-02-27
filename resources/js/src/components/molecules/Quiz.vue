<template>
    <v-card flat class="mb-1">
        <div class="d-flex flex-no-wrap justify-start">
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
            </div>
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
  }

  
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