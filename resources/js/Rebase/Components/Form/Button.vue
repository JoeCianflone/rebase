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
   <button v-on="$listeners" v-bind="$attrs" :type="type" :disabled="disable">
      <slot />
      <Icon v-if="icon" :name="icon" class="icon--right" :size="18" />
   </button>
</template>

<style lang="scss" scoped>
@import '@@/abstract';

@mixin form-button {
   align-content: center;
   justify-content: center;
   padding: $px-8 $px-16;
   text-align: center;
   text-decoration: none;
   white-space: nowrap;
   width: auto;

   @content;
}

@mixin primary {
   @include form-element {
      @include form-button {
         background: $color-gray-80;
         border-color: $color-gray-80;
         border-width: 2px;
         color: $color-gray-30;

         @content;

         &:disabled {
            background: $color-gray-60;
            border-color: $color-gray-60;
         }
      }
   }
}

.button {
   &--primary {
      @include primary;

      &-small {
         @include primary {
            @include form-small;
         }
      }

      &-large {
         @include primary {
            @include form-large;
         }
      }
   }

   &--secondary {
      @include form-element {
         @include form-button {
            background: transparent;
            border-color: $color-gray-80;
            border-width: 2px;
            color: $color-gray-80;

            &:disabled {
               border-color: $color-gray-60;
               color: $color-gray-60;
            }
         }
      }
   }

   &--link {
      @include form-element {
         @include form-button {
            background: transparent;
            border-color: $color-gray-80;
            border-width: 0;
            color: $color-blue-50;
            padding: 0;

            &:disabled {
               border-color: $color-gray-60;
               color: $color-gray-60;
            }
         }
      }
   }

   &--is-block {
      width: 100%;
   }
}
</style>
