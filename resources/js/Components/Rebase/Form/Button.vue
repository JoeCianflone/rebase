<script>
import Icon from "../Icon"

export default {
   name: "Button",
   inheritAttrs: false,
   components: { Icon },

   props: {
      disable: {
         type: Boolean,
         default: false,
      },
      as: {
         type: String,
         default: "primary",
      },
      size: {
         type: String,
         default: "",
      },
      type: {
         type: String,
         default: "button",
      },
      icon: {
         type: [String, Boolean],
         default: false,
      },
   },
   computed: {
      buttonType() {
         let type = `button--${this.as}`

         if (this.size !== "") {
            type = `${type} button--${this.size}`
         }

         return type
      },
   },
}
</script>

<template>
   <button v-on="$listeners" :class="buttonType" v-bind="$attrs" :type="type" :disabled="disable">
      <slot />
      <Icon v-if="icon" :name="icon" class="icon--right" :size="18" />
   </button>
</template>

<style lang="scss">
@import "@@/abstract";

@mixin button {
   align-content: center;
   background: var(--color-true-white);
   border: 1px solid var(--color-coolGray-400);
   border-radius: var(--radius-2);
   color: var(--color-coolGray-800);
   cursor: pointer;
   font-size: var(--px-16);
   justify-content: center;
   line-height: var(--leading-normal);
   margin: 0;
   min-height: var(--px-40);
   padding: var(--px-8) var(--px-16);
   position: relative;
   text-align: center;
   text-decoration: none;
   white-space: nowrap;
   width: auto;
}

.button {
   @include with-queries {
      @include button;
   }
}
</style>
