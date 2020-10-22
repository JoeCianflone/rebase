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

<style lang="scss" scoped>
@import "@@/abstract";

.button {
   @include as("primary") {
      @include form-button {
         background: $color-gray-800;
         border-color: $color-gray-800;
         border-width: 2px;
         color: $color-gray-300;

         &:disabled {
            background: $color-gray-600;
            border-color: $color-gray-600;
         }
      }
   }

   @include as("secondary") {
      @include form-button {
         background: transparent;
         border-color: $color-gray-800;
         border-width: 2px;
         color: $color-gray-800;

         &:disabled {
            border-color: $color-gray-600;
            color: $color-gray-600;
         }
      }
   }

   @include as("link") {
      @include form-button {
         background: transparent;
         border-color: $color-gray-800;
         border-width: 0;
         color: $color-blue-500;
         padding: 0;

         &:disabled {
            border-color: $color-gray-600;
            color: $color-gray-600;
         }
      }
   }

   @include size("sm") {
      @include form-small;
   }

   @include size("lg") {
      @include form-large;
   }

   &--is-block {
      width: 100%;
   }
}
</style>
