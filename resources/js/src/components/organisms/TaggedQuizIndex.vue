<template>
    <div>
        {{ codingLanguageAndFramework.name }}のタグが付いている問題一覧
        <QuizList :show-flag="showFlag" />
    </div>
</template>
<script>
import QuizList from "../organisms/QuizList";

export default {
    name: "TaggedQuizIndex",
    components: {
        QuizList,
    },
    data() {
      return  {
        showFlag: false
      }
    },
    created: function() {
        // let id = this.$route.params.id != null ? this.$route.params.id : 0;
        this.showFlag = false;
        this.$store.dispatch("codingLanguageAndFramework/fetchCodingLanguageAndFramework", {id: this.$route.params.id})
        .then(() => {
            this.showFlag = true;
        })
    },
    computed: {
        codingLanguageAndFramework: {
            get() {
                return this.$store.getters["codingLanguageAndFramework/getCodingLanguageAndFramework"];
            }
        }
    }
};
</script>
