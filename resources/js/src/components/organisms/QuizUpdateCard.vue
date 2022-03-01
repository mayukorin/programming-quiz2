<template>
    <v-card v-show="fillFlag">
        <v-card-title>
            <span class="headline">クイズ編集</span>
        </v-card-title>
        <v-card-text>
            <QuizUpdateForm 
              @update-quiz="updateQuiz"
              :load-flag="loadFlag"
              :origin-quiz="quiz"
            />
        </v-card-text>
    </v-card>
</template>
<script>
import QuizUpdateForm from "../molecules/QuizUpdateForm";

export default {
    name: "QuizUpdateCard",
    components: {
        QuizUpdateForm
    },
    data() {
        return {
            loadFlag: false,
            fillFlag: false
        }
    },
    methods: {
        updateQuiz: function(quizInfo) {
            this.loadFlag = true;
            this.$store.dispatch("quiz/updateQuiz", quizInfo)
            .then(() => {
                console.log("update ok");
                this.$router.replace("/quiz/"+this.$route.params.id);
            })
            .finally(() => {
                this.loadFlag = false;
            });
        }
    },
    computed: {
        quiz: {
            get () {
                return this.$store.getters["quiz/getQuiz"];
            }
        }
    },
    created: function() {
        this.$store.dispatch("quiz/fetchQuiz", { id: this.$route.params.id })
        .then(() => {
            this.fillFlag = true;
        })
    },

};
</script>