<template>
    <v-card>
        <v-card-title>
            <span class="headline">クイズ作成</span>
        </v-card-title>
        <v-card-text>
            <QuizCreateForm 
              @create-quiz="createQuiz"
              :load-flag="loadFlag"
            />
        </v-card-text>
    </v-card>
</template>
<script>
import QuizCreateForm from "../molecules/QuizCreateForm";

export default {
  name: "QuizCreateCard",
  components: {
    QuizCreateForm
  },
  data() {
    return {
      loadFlag: false,
    }
  },
  methods: {
    createQuiz: function(quizInfo) {
      this.loadFlag = true;
      this.$store.dispatch("quiz/createQuiz", quizInfo)
      .then(() => {
        this.$router.replace("/");
      })
      .finally(() => {
        this.loadFlag = false;
      });
    }
  }

};
</script>