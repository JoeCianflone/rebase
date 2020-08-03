<script>
import LabelWrapper from "./LabelWrapper"

export default {
   inheritAttrs: false,
   components: {
      LabelWrapper,
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
   <LabelWrapper position="right">
      <input class="form-item__radio" ref="input" type="radio" v-bind="$attrs" :checked="shouldBeChecked" :value="value" @change="updateInput" />
      <slot />
   </LabelWrapper>
</template>
