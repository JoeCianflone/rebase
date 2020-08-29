<script>
import FormItem from "./FormItem"

export default {
   inheritAttrs: false,
   components: {
      FormItem,
   },
   model: {
      prop: "modelValue",
      event: "change",
   },
   props: {
      value: {
         type: String,
      },
      modelValue: {
         default: "",
      },
   },
   computed: {
      shouldBeChecked() {
         return this.modelValue == this.value
      },
   },
   methods: {
      updateInput() {
         this.$emit("change", this.value)
      },
   },
}
</script>

<template>
   <FormItem position="right">
      <input class="form-item__radio" ref="input" type="radio" v-bind="$attrs" :checked="shouldBeChecked" :value="value" @change="updateInput" />
      <slot />
   </FormItem>
</template>

<style lang="scss" scoped>
@import '@@/abstract';

.form-item {
   &__radio {
      @include form-element {
         flex-grow: 0;
         margin-right: $px-4;
         width: auto;
      }
   }
}
</style>
