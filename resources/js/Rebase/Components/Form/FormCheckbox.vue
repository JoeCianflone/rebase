<script>
import LabelWrapper from "./LabelWrapper"

export default {
   inheritAttrs: false,

   model: {
      prop: "modelValue",
      event: "change",
   },
   components: {
      LabelWrapper,
   },
   props: {
      disableAfter: {
         type: Number,
         default: 0,
      },
      value: {
         type: String,
      },
      modelValue: {
         default: false,
      },
      trueValue: {
         default: true,
      },
      falseValue: {
         default: false,
      },
   },
   computed: {
      shouldBeChecked() {
         if (this.modelValue instanceof Array) {
            return this.modelValue.includes(this.value)
         }
         // Note that `true-value` and `false-value` are camelCase in the JS
         return this.modelValue === this.trueValue
      },
      shouldBeDisabled() {
         return this.modelValue.length >= this.disableAfter && this.disableAfter > 0 && !this.shouldBeChecked ? true : false
      },
   },
   methods: {
      updateInput(event) {
         let isChecked = event.target.checked

         if (this.modelValue instanceof Array) {
            let newValue = [...this.modelValue]

            if (isChecked) {
               newValue.push(this.value)
            } else {
               newValue.splice(newValue.indexOf(this.value), 1)
            }

            this.$emit("change", newValue)
         } else {
            this.$emit("change", isChecked ? this.trueValue : this.falseValue)
         }
      },
   },
}
</script>

<template>
   <LabelWrapper position="right">
      <input class="form-item__checkbox" :disabled="shouldBeDisabled" ref="input" type="checkbox" v-bind="$attrs" :checked="shouldBeChecked" :value="value" @change="updateInput" />
      <slot />
   </LabelWrapper>
</template>

<style lang="scss" scoped>
@import '@@/abstract';

.form-item {
   &__checkbox {
      @include form-element {
         flex-grow: 0;
         margin-right: $px-4;
         width: auto;
      }
   }
}
</style>
