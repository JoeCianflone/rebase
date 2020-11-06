<script>
export default {
   inheritAttrs: false,
   components: {},

   props: {
      defaultText: {
         type: String,
         default: "",
      },
      value: [String, Number],
   },
}
</script>

<template>
   <textarea class="form-item__textarea" ref="textarea" v-bind="$attrs" :value="value" @input="$emit('input', $event.target.value)">{{ defaultText }}</textarea>
</template>

<style lang="scss" scoped>
@import "@@/abstract";

.form-item--textarea {
   @include form-element;
}
</style>
