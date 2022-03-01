<template>
    <v-form>
        <validation-observer ref="observer">
        <form @submit.prevent="submit">
            <validation-provider
            v-slot="{ errors }"
            name="タイトル"
            rules="required"
            id="title"
            ref="titleProvider"
            >
            <v-text-field
                v-model="quiz.title"
                :error-messages="errors"
                label="タイトル"
                required
                ref="title"
            ></v-text-field>

            </validation-provider>
            <validation-provider
            v-slot="{ errors }"
            name="クイズ内容"
            rules="required"
            id="query"
            ref="queryProvider"
            >
            <v-textarea
                v-model="quiz.query"
                :error-messages="errors"
                label="クイズ内容"
                required
                ref="query"
            ></v-textarea>
            </validation-provider>

            <div v-for="choice in choices" :key="choice.number">
                <validation-provider
                    v-slot="{ errors }"
                    :name="'選択肢'+String(choice.number)"
                    rules="required"
                    :id="'choice'+String(choice.number)"
                    :ref="'choice'+String(choice.number)+'Provider'"
                >
                    <v-text-field
                        v-model="choice.content"
                        :error-messages="errors"
                        :label="'選択肢'+String(choice.number)"
                        required
                        :ref="'choice'+String(choice.number)"
                    ></v-text-field>
                </validation-provider>
            </div>
            <!--
            <validation-provider
            v-slot="{ errors }"
            name="選択肢1"
            rules="required"
            id="choice1"
            ref="choice1Provider"
            >
            <v-text-field
                v-model="choice1"
                :error-messages="errors"
                label="選択肢1"
                required
                ref="choice1"
            ></v-text-field>
            </validation-provider>

            <validation-provider
            v-slot="{ errors }"
            name="選択肢2"
            rules="required"
            id="choice2"
            ref="choice2Provider"
            >
            <v-text-field
                v-model="choice2"
                :error-messages="errors"
                label="選択肢2"
                required
                ref="choice2"
            ></v-text-field>
            </validation-provider>

            <validation-provider
            v-slot="{ errors }"
            name="選択肢3"
            rules="required"
            id="choice3"
            ref="choice3Provider"
            >
            <v-text-field
                v-model="choice3"
                :error-messages="errors"
                label="選択肢3"
                required
                ref="choice3"
            ></v-text-field>
            </validation-provider>

            <validation-provider
            v-slot="{ errors }"
            name="選択肢4"
            rules="required"
            id="choice4"
            ref="choice4Provider"
            >
            <v-text-field
                v-model="choice4"
                :error-messages="errors"
                label="選択肢4"
                required
                ref="choice4"
            ></v-text-field>
            </validation-provider>
            -->
            <v-container
                class="px-0"
                fluid
            >
            <v-select
                :items="selectChoicesLabel"
                :error-messages="errors"
                label="正解の選択肢"
                v-model="correctChoice"
            ></v-select>
            </v-container>
            <validation-provider
            v-slot="{ errors }"
            name="解説"
            rules="required"
            id="explanation"
            ref="explanationProvider"
            >
            <v-textarea
                v-model="quiz.explanation"
                :error-messages="errors"
                label="解説"
                required
                ref="explanation"
            ></v-textarea>
            </validation-provider>


            <v-row>
            <Button :loading="loadFlag" @click="handleClick()">更新</Button>
            </v-row>
        </form>
        </validation-observer>
    </v-form>
</template>
<script>

import Button from "../atoms/Button.vue";

export default {
  name: "QuizUpdateForm",
  components: {
    Button
    },
    props: {
        loadFlag: {
            type: Boolean
        },
        originQuiz: {
            type: Object
        },
    },
    data() {
      return {
            quiz: {
                explanation: "",
                title: "",
                query: "",
            },
            choices: [],
            correctChoice: "選択肢1",
            selectChoicesLabel: [
                "選択肢1",
                "選択肢2",
                "選択肢3",
                "選択肢4",
            ],
        }
    },
    methods: {
        handleClick: function () {
            this.$refs.observer.validate().then((result) => {
                if (result) {
                    this.$nextTick()
                    .then(() => {
                        let correctChoiceNumber = this.correctChoice.slice(-1);
                        this.$emit('update-quiz', {
                            editQuiz: {
                                quiz: this.quiz,
                                choices: this.choices,
                                correct_choice_number: correctChoiceNumber,
                            },
                            id: this.$route.params.id
                        });
                    });
                }
            });
        }
    },
    watch: {
        originQuiz: function(originQuiz) {
            this.quiz.explanation = originQuiz.explanation;
            this.quiz.title = originQuiz.title;
            this.quiz.query = originQuiz.query;
            this.choices = originQuiz.choices;
            this.correctChoice = "選択肢" +  originQuiz.correct_choice.number;
        }
    }
};
</script>
<style scoped>
    .help {
        caret-color: red;
    }
    label + input[type="radio"] {
        margin-left: 8em;
    }
</style>