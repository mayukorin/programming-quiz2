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
                                <v-btn block depressed @click="selected_choice_id=choice.id"   :color="isCorrect(choice.id)">
                                    {{ choice.content }}
                                </v-btn>
                            </div>
                        </div>
                    </v-col>
                </v-row>
            </v-card-actions>
        </div>
    </v-card>
</template>
<script>
export default {
  name: "QuizCard",
  
  data() {
      return  {
          quiz: {
              title: "わかってますか",
              query: "ああああああああああああああああああああああああ",
              choices: [
                  {id: 1, content: "あいうあいうあいうあいう"},
                  {id: 2, content: "あいうあいうあいうあいう"},
                  {id: 3, content: "あいうあいうあいうあいう"},
                  {id: 4, content: "あいうあいうあいうあいう"},
              ],
              correct_choice_id: 3
            },
            selected_choice_id: -1,
      }
    },
    methods: {
        isCorrect(choice_id) {
            // :disabled="selected_choice_id!=-1"
            if (this.selected_choice_id !== -1) {
                if (choice_id === this.quiz.correct_choice_id) return "success"
                else if (choice_id === this.selected_choice_id) return "error"
            }
        }
    }
};
</script>