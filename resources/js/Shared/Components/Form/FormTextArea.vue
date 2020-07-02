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
   <textarea ref="textarea" v-bind="$attrs" :value="value" @input="$emit('input', $event.target.value)">{{ defaultText }}</textarea>
</template>

<style lang="scss"></style>
