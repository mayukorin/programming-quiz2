<template>
    <v-card flat class="mb-1">
        <div>
            <v-card-title>{{ quiz.title }}</v-card-title>
            <v-card-text>{{ quiz.query }}</v-card-text>
            <v-card-actions>
                <v-row align="center">
                    <v-col cols="12">
                        <div class="text-center" v-for="choice in quiz.choices" :key="choice.id">
                            <div class="my-2">
                                <v-btn block depressed @click="selected_choice_id=choice.id"   :color="isCorrect(choice.id)" :class="{ 'disable-button': selected_choice_id != -1}">
                                    {{choice.number}} : {{ choice.content }}
                                </v-btn>
                            </div>
                        </div>
                    </v-col>
                </v-row>
            </v-card-actions>
            <div v-show="selected_choice_id!=-1">
                <v-divider />
                <v-card-title>
                    正解：
                    <span :class="isCorrect(selected_choice_id, '--text')">
                        {{ quiz.correct_choice.number }}
                    </span>
                </v-card-title>
                <v-card-text>{{ quiz.explanation }}</v-card-text>
            </div>
        </div>
    </v-card>
</template>
<script>
export default {
  name: "QuizCard",
  
  data() {
      return  {
          /*
          quiz: {
              title: "わかってますか",
              query: "ああああああああああああああああああああああああ",
              choices: [
                  {id: 1, content: "あいうあいうあいうあいう", number: 1},
                  {id: 2, content: "あいうあいうあいうあいう", number: 2},
                  {id: 3, content: "あいうあいうあいうあいう", number: 3},
                  {id: 4, content: "あいうあいうあいうあいう", number: 4},
              ],
              correct_choice: {
                id: 3, content: "あいうあいうあいうあいう", number: 3
              },
              explanation : "あああああああああああああ"
            },
            */
            selected_choice_id: -1,
      }
    },
    methods: {
        isCorrect(choice_id, addText="") {
            // :disabled="selected_choice_id!=-1"
            if (this.selected_choice_id !== -1) {
                if (choice_id === this.quiz.correct_choice.id) return "success" + addText
                else if (choice_id === this.selected_choice_id) return "error" + addText
            }
        },
    },
    computed: {
        quiz: {
            get () {
                return this.$store.getters["quiz/getQuiz"];
            }
        }
    },
    created: function() {
        // this.$route.params.id
        console.log(this.$route.params.id);
        this.$store
            .dispatch("quiz/fetchQuiz", { id: this.$route.params.id })
            .then(() => {
                console.log(this.$store.getters["quiz/getQuiz"]);
            })
        
    }
};
</script>
<style scoped>
    .disable-button {
        pointer-events: none;
    }
</style>