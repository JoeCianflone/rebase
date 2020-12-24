<script>
export default {
   name: "FormInput",
   inheritAttrs: false,

   props: {
      subify: {
         type: Boolean,
         default: false,
      },
      value: [String, Number],
   },

   methods: {
      handleInput(e) {
         if (this.subify) {
            this.$emit("input", this.makesub(e.target.value))
         } else {
            this.$emit("input", e.target.value)
         }
      },
      makesub(v) {
         return v
            .trim()
            .toLowerCase()
            .replace(/ /g, "-")
            .replace(/[-]+/g, "-")
            .replace(/![a-z0-9]+/g, "")
            .replace(/[\-]$/g, "")
            .replace(/[\-]+$/g, "")
            .replace(/^[\-]/g, "")
            .replace(/^[\-]+/g, "")
            .replace(/[^\w-]+/g, "")
      },
   },
}
</script>

<template>
   <input class="form-item--textbox" ref="input" v-bind="$attrs" :value="value" @input="handleInput" />
</template>

<style lang="scss" scoped>
@import "@@/abstract";

.form-item--textbox {
   @include form-element;
}
</style>
