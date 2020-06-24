<script>
import WithLabel from "./WithLabel"
import WithValidation from "./WithValidation"

export default {
   name: "rebase-form-item",

   components: {
      WithLabel,
      WithValidation,
   },

   props: {
      errors: Object | Array,
   },
}
</script>

<template>
   <with-validation :errors="errors" position="right">
      <with-label position="top">
         <slot />
      </with-label>
   </with-validation>
</template>
