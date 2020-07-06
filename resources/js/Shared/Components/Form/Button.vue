<script>
import Icon from "@/Shared/Components/Icon"

export default {
   inheritAttrs: false,
   components: { Icon },

   props: {
      type: {
         type: String,
         default: "primary",
      },
      icon: {
         type: [String, Boolean],
         default: false,
      },
   },
   computed: {
      classObject: function () {
         return {
            "-primary": this.type === "primary",
            "-secondary": this.type === "secondary",
         }
      },
   },
}
</script>

<template>
   <button v-on="$listeners" v-bind="$attrs" class="button" :class="classObject">
      <slot />
      <Icon v-if="icon" :name="icon" class="-icon-right" :size="18" />
   </button>
</template>
``
