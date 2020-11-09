<script>
export default {
   props: {
      errors: {
         type: String,
         default: null,
      },
      position: String,
   },
}
</script>

<template>
   <div class="validate" :class="{ error: errors }">
      <slot />
      <p v-if="errors" class="error-message" :class="{ right: position === 'right' }">
         <small>{{ errors }}</small>
      </p>
   </div>
</template>

<style lang="scss" scoped>
.error {
   label {
      color: var(--color-red-500);
   }

   input,
   select,
   .form-item__post-input,
   .form-item__pre-input {
      border-bottom: 2px solid var(--color-red-500) !important;
   }

   .error-message {
      color: var(--color-red-500);
      line-height: 1;
   }

   .right {
      text-align: right;
   }
}
</style>
