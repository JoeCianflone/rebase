<script>
import Button from "@/Components/Rebase/Form/Button"

export default {
   name: "ActionButton",
   inheritAttrs: false,
   components: { Button },
   props: {
      type: {
         type: String,
         default: "button",
      },
   },
}
</script>

<template>
   <li>
      <Button :type="type" v-on="$listeners" v-bind="$attrs"><slot></slot></Button>
   </li>
</template>
