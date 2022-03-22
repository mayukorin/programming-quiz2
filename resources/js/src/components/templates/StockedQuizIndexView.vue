<template>
    <div>
        <QuizList :action-name="'quiz/fetchStockedQuizList'" />
    </div>
</template>
<script>
import QuizList from "../organisms/QuizList";

export default {
    name: "StockedQuizIndexView",
    components: {
        QuizList,
    },
};
</script>
