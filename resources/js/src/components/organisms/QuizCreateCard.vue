<template>
    <v-card>
        <v-card-title>
            <span class="headline">クイズ作成</span>
        </v-card-title>
        <v-card-text>
            <QuizCreateForm />
        </v-card-text>
    </v-card>
</template>
<script>
import QuizCreateForm from "../molecules/QuizCreateForm";

export default {
  name: "QuizCreateCard",
  components: {
    QuizCreateForm
  },

};
</script>