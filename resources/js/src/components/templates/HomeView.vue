<template>
    <div>
        <Home :action-name="'quiz/fetchQuizList'" />
    </div>
</template>
<script>
import Home from "../organisms/Home";

export default {
    name: "HomeView",
    components: {
        Home,
    },
};
</script>
