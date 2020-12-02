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

<style lang="scss">
@import "@@/abstract";

.form-item--left,
.form-item--right,
.form-item--right .validate,
.form-item--left .validate {
   align-items: center;
   display: flex;
   justify-content: space-between;
   width: 100%;
}

.form-item--top,
.form-item--top .validate {
   display: flex;
   flex-direction: column;
   width: 100%;
}

.form-item--left,
.form-item--left .validate {
   padding-right: var(--px-8);

   span {
      overflow: unset;
      min-width: auto;
      margin: auto;
      padding-right: var(--px-8);
   }
}

.form-item--right,
.form-item--right .validate {
   flex-grow: 0;
   justify-content: flex-start;
}

.StripeElement {
   @include form-element;
}

input:focus,
.StripeElement--focus {
   box-shadow: 0 1px 3px 0 #cfd7df;
}

.StripeElement--invalid {
   border-color: #fa755a;
}

.StripeElement--webkit-autofill {
   background-color: #fefde5 !important;
}
</style>
