<script>
export default {
   inheritAttrs: false,
   components: {},

   props: {
      defaultText: {
         type: String,
         default: "Select",
      },
      value: [String, Number],
      options: Array,
   },

   methods: {
      handleInput(e) {
         this.$emit("input", e.target.value)
      },
   },
}
</script>

<template>
   <select class="select" ref="select" v-bind="$attrs" @input="handleInput">
      <option value="" v-if="defaultText !== ''">{{ defaultText }}</option>
      <option v-for="option in options" :key="option" :selected="value === option">{{ option }}</option>
   </select>
</template>

<style lang="scss"></style>
