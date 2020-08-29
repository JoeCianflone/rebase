<script>
export default {
   props: {
      position: {
         type: String,
         default: "top"
      },
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
      width: 100%;
   }

   &--top {
      display: flex;
      flex-direction: column;
      // padding-bottom: $px-8;
      width: 100%;
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
