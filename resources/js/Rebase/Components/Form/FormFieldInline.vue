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
   <ValidationWrapper :errors="$page.errors[validate]" position="left">
      <slot />
   </ValidationWrapper>
</template>
