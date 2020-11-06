<script>
export default {
   props: {
      errors: Object,
      position: {
         type: String,
         default: "top",
      },
   },
}
</script>

<template>
   <label :class="`form-item--${position}`" :errors="errors">
      <slot />
   </label>
</template>

<style lang="scss" scoped>
@import "@@/abstract";

.form-item--left,
.form-item--right {
   align-items: center;
   display: flex;
   justify-content: space-between;
   width: 100%;
}

.form-item--top {
   display: flex;
   flex-direction: column;
   width: 100%;
}

.form-item--left {
   padding-right: var(--px-8);
}

.form-item--right {
   flex-grow: 0;
   justify-content: flex-start;
}
</style>
