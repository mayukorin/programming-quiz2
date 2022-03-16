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
        }
    },
    data() {
      return  {
            showFlag: false,
      }
    },
    created: function() {
        this.showFlag = false;
        this.$store.dispatch(this.actionName)
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