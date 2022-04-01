<template>
    <v-card>
        <v-card-title>
            <span class="headline">クイズ作成</span>
        </v-card-title>
        <v-card-text>
            <QuizCreateForm 
              @create-quiz="createQuiz"
              @input-coding-language-and-framework-name="searchCodingLanguageAndFrameworkByName"
              :load-flag="loadFlag"
              :coding-language-and-framework-entries="codingLanguageAndFrameworkEntries"
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
      // codingLanguageAndFrameworkEntries: [{"id": 1, "name": "Java"}],
      codingLanguageAndFrameworkEntries: [],
    }
  },
  methods: {
    createQuiz: function(quizInfo) {
      this.loadFlag = true;
      this.$store.dispatch("quiz/createQuiz", quizInfo)
      .then(() => {
        this.$store.dispatch("flashMessage/setSuccessMessage", {
            messages: ["クイズを新規作成しました"],
          });
        this.$router.replace("/");
      })
      .finally(() => {
        this.loadFlag = false;
      });
    },
    searchCodingLanguageAndFrameworkByName: function(name) {
      this.$store.dispatch("codingLanguageAndFramework/searchCodingLanguageAndFrameworkByName", {
        name: name
      })
      .then((response) => {
        this.codingLanguageAndFrameworkEntries = response.data;
      })
    }
  }

};
</script>