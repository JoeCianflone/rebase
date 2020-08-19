<script>
export default {
   props: {
      position: String,
      default: "top",
   },
}
</script>

<template>
   <label :class="`form-item--${position}`">
      <slot />
   </label>
</template>

<style lang="scss" scoped>
@import '@@/abstract';

.form-item {
   &--left,
   &--right {
      align-items: center;
      display: flex;
      justify-content: space-between;
   }

   &--top {
      display: flex;
      flex-direction: column;
      padding-bottom: $px-8;
   }

   &--left {
      padding-right: $px-8;
   }

   &--right {
      flex-grow: 0;
      justify-content: flex-start;
   }
}
</style>
