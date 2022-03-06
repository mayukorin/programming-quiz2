<template>
    <v-container class="my-5" v-show="showFlag">
        <v-row no-gutters>
            <v-col cols="12" v-for="quiz in quizList" :key="quiz.id">
                <Quiz
                    :quiz="quiz" 
                />
            </v-col>
        </v-row>
    </v-container>
</template>
<script>
import Quiz from "../molecules/Quiz";

export default {
    name: "QuizList",
    components: {
        Quiz
    },
    data() {
      return  {
            showFlag: false,
      }
    },
    created: function() {
        this.showFlag = false;
        this.$store.dispatch("quiz/fetchQuizList")
        .then(() => {
            this.showFlag = true;
        })
    },
    computed: {
        quizList: {
            get(){
                return this.$store.getters["quiz/getQuizList"];
            }
        }
    }
};
</script>