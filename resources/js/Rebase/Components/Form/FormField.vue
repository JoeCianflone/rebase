<script>
import LabelWrapper from "./LabelWrapper"
import ValidationWrapper from "./ValidationWrapper"

export default {
   components: {
      LabelWrapper,
      ValidationWrapper,
   },

   props: {
      validate: [String],
   },
}
</script>

<template>
   <ValidationWrapper :errors="$page.errors[validate]" position="right">
      <LabelWrapper position="top">
         <slot />
      </LabelWrapper>
   </ValidationWrapper>
</template>
