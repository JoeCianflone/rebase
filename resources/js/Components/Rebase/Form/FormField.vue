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
      inline: {
         type: Boolean,
         default: false,
      },
   },
}
</script>

<template>
   <FormItem position="top" :inline="inline">
      <ValidationWrapper position="right" :errors="$page.props.errors[validate]">
         <slot />
      </ValidationWrapper>
   </FormItem>
</template>
