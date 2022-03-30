<template>
    <div>
        <QuizList :show-flag="showFlag" />
    </div>
</template>
<script>
import QuizList from "../organisms/QuizList";

export default {
    name: "Home",
    components: {
        QuizList,
    },
    data() {
      return  {
            showFlag: false,
      }
    },
    created: function() {
        // let id = this.$route.params.id != null ? this.$route.params.id : 0;
        this.showFlag = false;
        this.$store.dispatch("quiz/fetchQuizList")
        .then(() => {
            this.showFlag = true;
        })
    },
};
</script>
