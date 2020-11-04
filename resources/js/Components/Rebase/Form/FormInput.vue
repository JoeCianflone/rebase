<script>
export default {
   name: "FormInput",
   inheritAttrs: false,

   props: {
      slugify: {
         type: Boolean,
         default: false,
      },
      value: [String, Number],
   },

   methods: {
      handleInput(e) {
         if (this.slugify) {
            this.$emit("input", this.makeSlug(e.target.value))
         } else {
            this.$emit("input", e.target.value)
         }
      },
      makeSlug(v) {
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
   <input class="form-item__textbox" ref="input" v-bind="$attrs" :value="value" @input="handleInput" />
</template>

<style lang="scss" scoped>
@import "@@/abstract";

.form-item {
   &__textbox {
      @include form-element;

      &--right {
         @include form-element;
      }
   }
}
</style>
