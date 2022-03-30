<template>
    <v-container class="my-5" v-show="showFlag">
        <v-row no-gutters>
            <v-col cols="12" v-for="quiz in quizList" :key="quiz.id">
                <Quiz
                    :quiz="quiz" 
                    @click-stock-create-button="createStock"
                    @click-stock-destroy-button="destroyStock"
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
    props: {
        actionName: {
            type: String,
        },
        showFlag: {
            type: Boolean,
            default: false,
        }
    },
    computed: {
        quizList: {
            get(){
                console.log("computed");
                console.log(this.$store.getters["quiz/getQuizList"]);
                return this.$store.getters["quiz/getQuizList"];
            }
        }
    },
    methods: {
        createStock: function(quizId) {
            return this.$store.dispatch("stock/createStock", quizId)
            .then(() => {
                this.$store.dispatch("flashMessage/setSuccessMessage", {
                    messages: ["クイズをストックしました"],
                });
            })
        },
        destroyStock: function(stockId) {
            return this.$store.dispatch("stock/destroyStock", stockId)
            .then(() => {
                this.$store.dispatch("flashMessage/setSuccessMessage", {
                    messages: ["クイズをストックから外しました"],
                });
            })
        }
    }
};
</script>