<script>
export default {
   name: "rebase-input",
   inheritAttrs: false,
   components: {},

   props: {
      x: String,
      type: {
         type: String,
         default: "text",
      },
      value: String | Number | Boolean,
   },

   data: () => ({}),

   methods: {},
}
</script>

<template>
   <input ref="input" v-bind="$attrs" :type="type" :value="value" @input="$emit('input', $event.target.value)" />
</template>

<style lang="scss"></style>
