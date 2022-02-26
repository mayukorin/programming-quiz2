<template>
    <v-container class="my-5">
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
    created: function() {
        this.$store.dispatch("quiz/fetchQuizList");
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