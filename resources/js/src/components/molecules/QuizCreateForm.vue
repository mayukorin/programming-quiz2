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
            <!--
            <div class="tag-caption">記事につけるタグ</div>
            <div v-for="(tagName, index) in tags" :key="index">
                <validation-provider
                    v-slot="{ errors }"
                    name="タグ"
                    rules="required"
                    id="tag"
                    ref="tagProvider"
                >
                    <v-container
                        class="px-0"
                        fluid
                    >
                        <v-row>
                            <v-col
                                cols="12"
                                md="10"
                            >
                                <v-autocomplete
                                    v-model="tags[index]"
                                    :items="items"
                                    :error-messages="errors"
                                    label="タグ"
                                    required
                                    ref="tag"
                                ></v-autocomplete>
                            </v-col>
                            <v-col
                                cols="2"
                                md="2"
                            >
                                <Button @click="deleteTag(index)">削除</Button>
                            </v-col>
                        </v-row>
                    </v-container>
                </validation-provider>
            </div>
            <Button @click="addTag()" v-if="!isTagMax">タグ追加</Button>
            -->
            <v-autocomplete
                label="記事につけるタグ"
                v-model="tags"
                :items="items"
                hide-no-data
                hide-selected
                :counter="maxSelected"
                :counter-value="computedCounterValue"
                :menu-props="menuProps"
                multiple
                chips
                deletable-chips
                @input="adjustOptions"
            ></v-autocomplete>
            <v-row>
                <Button :loading="loadFlag" @click="handleClick()">作成</Button>
            </v-row>
        </form>
        </validation-observer>
    </v-form>
</template>
<script>

import Button from "../atoms/Button.vue";

export default {
  name: "QuizCreateForm",
  components: {
    Button
    },
    props: {
        loadFlag: {
            type: Boolean
        }
    },
    data() {
      return {
            maxSelected: 2,
            quiz: {
                explanation: "",
                title: "",
                query: "",
            },
            choices: [
                { number: 1, content: "" },
                { number: 2, content: "" },
                { number: 3, content: "" },
                { number: 4, content: "" }
            ],
            correctChoice: "選択肢1",
            selectChoicesLabel: [
                "選択肢1",
                "選択肢2",
                "選択肢3",
                "選択肢4",
            ],
            tags: [],
            items: [ "Vue", "JavaScript", "Java"],
            menuProps: {
                disabled: false
            },
        }
    },
    methods: {
        handleClick: function () {
            this.$refs.observer.validate().then((result) => {
                if (result) {
                    this.$nextTick()
                    .then(() => {
                        console.log(this.tags);
                        let correctChoiceNumber = this.correctChoice.slice(-1);
                        let tagsWithNameKey = this.tags.map(function( tagName ) {
                            return {"name": tagName};
                        });
                        console.log(tagsWithNameKey);
                        this.$emit('create-quiz', {
                            quiz: this.quiz,
                            choices: this.choices,
                            correct_choice_number: correctChoiceNumber,
                            tags: tagsWithNameKey,
                        });
                    });
                }
            });
        },
        adjustOptions: function(selectedIds) {
            if (this.computedCounterValue >= this.maxSelected) {
                this.menuProps.disabled = true
            } else {
                this.menuProps.disabled = false
            }
        }
    },
    computed: {
        computedCounterValue () {
            let totalCount = 0
            if (this.tags && this.tags.length > 0) {
                const selectedItems = this.tags.map((name) => {
                return this.items.find((element) => element == name)
                })
                totalCount = selectedItems.reduce(function(prev, cur) {
                return prev + ((cur.count)? cur.count: 1);
                }, 0);
            }
            return totalCount
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
    .tag-caption {
        font-size: 16px!important;
    }
</style>