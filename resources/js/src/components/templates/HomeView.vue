<template>
    <div>
        <QuizList :action-name="'quiz/fetchQuizList'" />
    </div>
</template>
<script>
import QuizList from "../organisms/QuizList";

export default {
    name: "Home",
    components: {
        QuizList,
    },
};
</script>
