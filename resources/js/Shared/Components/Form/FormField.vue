<script>
import LabelWrapper from "./LabelWrapper"
import ValidationWrapper from "./ValidationWrapper"

export default {
   components: {
      LabelWrapper,
      ValidationWrapper,
   },

   props: {
      errors: [Object, Array],
   },
}
</script>

<template>
   <ValidationWrapper :errors="errors" position="right">
      <LabelWrapper position="top">
         <slot />
      </LabelWrapper>
   </ValidationWrapper>
</template>
