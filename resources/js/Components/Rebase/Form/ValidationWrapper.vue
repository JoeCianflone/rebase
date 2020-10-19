<script>
export default {
   props: {
      errors: {
         type: Object | Array,
         default: () => [],
      },
      position: String,
   },
}
</script>

<template>
   <div :class="{ error: errors.length }">
      <slot />
      <p v-if="errors.length" class="error-message" :class="{ right: position === 'right' }">
         <small>{{ errors[0] }}</small>
      </p>
   </div>
</template>

<style lang="scss">
.error {
   label {
      color: #f00;
   }

   input,
   select,
   .form-item__post-input,
   .form-item__pre-input {
      border-bottom: 2px solid #f00 !important;
   }

   .error-message {
      color: #f00;
      line-height: 1;
   }

   .right {
      text-align: right;
   }
}
</style>
