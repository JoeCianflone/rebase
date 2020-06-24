<script>
export default {
   name: "with-label",

   components: {},

   props: {
      position: String,
      default: "left",
   },

   data: () => ({}),

   methods: {},
}
</script>

<template>
   <label class="label" :class="position">
      <slot />
   </label>
</template>

<style lang="scss">
.label {
   display: flex;

   &.left,
   &.right {
      align-items: center;
      justify-content: space-between;
   }

   &.top {
      flex-direction: column;
      padding-bottom: 8px;
   }

   &.left {
      padding-right: 8px;
   }

   input {
      flex-grow: 1;
   }
}
</style>
