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
   <FormItem position="left" :inline="true">
      <ValidationWrapper position="left" :errors="$page.props.errors[validate]">
         <slot />
      </ValidationWrapper>
   </FormItem>
</template>
