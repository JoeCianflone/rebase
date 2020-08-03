<script>
import Icon from "@/Rebase/Components/Icon"

export default {
   inheritAttrs: false,
   components: { Icon },

   props: {
      type: {
         type: String,
         default: "button",
      },
      icon: {
         type: [String, Boolean],
         default: false,
      },
   },
}
</script>

<template>
   <button v-on="$listeners" v-bind="$attrs" :type="type">
      <slot />
      <Icon v-if="icon" :name="icon" class="icon--right" :size="18" />
   </button>
</template>
``
