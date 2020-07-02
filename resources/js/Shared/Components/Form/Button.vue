<script>
import Icon from "@/Shared/Components/Icon"

export default {
   inheritAttrs: false,
   components: { Icon },

   props: {
      icon: {
         type: String,
         default: false,
      },
   },
}
</script>

<template>
   <button v-on="$listeners" v-bind="$attrs" class="button -button-block">
      <slot />
      <span class="button-icon -button-icon-right" v-if="icon">
         <Icon :name="icon" />
      </span>
   </button>
</template>
