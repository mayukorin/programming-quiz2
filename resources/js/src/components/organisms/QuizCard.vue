<template>
    <v-card flat class="mb-1">
        <div>
            <v-card-title>{{ quiz.title }}</v-card-title>
            <v-card-text>{{ quiz.query }}</v-card-text>
            <v-card-actions>
                <v-row align="center">
                    <v-col cols="12">
                        <div class="text-center">
                            <div class="my-2">
                                <v-btn block depressed>
                                    あいうあいうあいうあいうあいう
                                </v-btn>
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="my-2">
                                <v-btn block depressed>
                                    あいうあいうあいうあいうあいう
                                </v-btn>
                            </div>
                        </div>
                    </v-col>
                </v-row>
            </v-card-actions>
        </div>
    </v-card>
</template>
<script>
export default {
  name: "QuizCard",
  
  data() {
      return  {
          quiz: {
              title: "わかってますか",
              query: "ああああああああああああああああああああああああ"
            }
      }
    }
};
</script>