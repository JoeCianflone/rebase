<script>
import FormItem from "./FormItem"
import ValidationWrapper from "./ValidationWrapper"

export default {
   components: {
      FormItem,
      ValidationWrapper,
   },

   props: {
      validate: [String],
   },
}
</script>

<template>
   <FormItem position="left">
      <ValidationWrapper :errors="$page.errors[validate]" position="left">
         <slot />
      </ValidationWrapper>
   </FormItem>
</template>
