<script>
export default {
   name: "with-validation",

   components: {},

   props: {
      errors: {
         type: Object | Array,
         default: () => [],
      },
      position: String,
   },

   data: () => ({}),

   methods: {},
}
</script>

<template>
   <div :class="{ error: errors.length }">
      <slot />
      <p v-if="errors.length" class="error-message" :class="{ right: position === 'right' }">
         <small>{{ errors }}</small>
      </p>
   </div>
</template>

<style lang="scss">
.error {
   label {
      color: #f00;
   }

   input {
      border-bottom: 2px solid #f00 !important;
   }

   .error-message {
      color: #f00;
   }

   .right {
      text-align: right;
   }
}
</style>
