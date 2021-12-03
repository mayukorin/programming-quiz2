<template>
  <v-btn
    :text="textFlag"
    :class="classString"
    :color="colorString"
    @click="handleClick"
    depressed
    :loading="loading"
    :small="smallFlag"
  >
    <slot />
  </v-btn>
</template>
<script>
export default {
  name: "Button",
  props: {
    loading: {
      type: Boolean,
      default: false,
    },
    textFlag: {
      type: Boolean,
      default: true,
    },
    classString: {
      type: String,
      default: "success mt-3 mx-auto mb-3",
    },
    colorString: {
      type: String,
      default: "",
    },
    smallFlag: {
      type: Boolean,
      default: false,
    },
  },
  methods: {
    handleClick(ev) {
      this.$emit("click", ev);
    },
  },
};
</script>

<style></style>