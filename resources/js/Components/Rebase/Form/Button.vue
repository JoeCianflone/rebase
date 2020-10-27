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
   <button v-on="$listeners" v-bind="$attrs" :disabled="disable">
      <slot />
      <Icon v-if="icon" :name="icon" class="icon--right" :size="18" />
   </button>
</template>

<style lang="scss">
@import "@@/abstract";

@mixin button {
   align-content: center;
   background: var(--color-coolGray-800);
   border: 1px solid var(--color-coolGray-800);
   border-radius: var(--radius-2);
   color: var(--color-coolGray-100);
   cursor: pointer;
   display: inline-flex;
   font-size: var(--px-16);
   justify-content: center;
   line-height: var(--leading-normal);
   margin: auto;
   min-height: var(--px-40);
   padding: var(--px-8) var(--px-16);
   position: relative;
   text-align: center;
   text-decoration: none;
   white-space: nowrap;
}

@mixin button--secondary {
   @include button;
   background: transparent;
   border: 2px solid var(--color-coolGray-800);
   color: var(--color-coolGray-800);
}

@mixin button--success {
   @include button;
   background: var(--color-emerald-500);
   border: 2px solid var(--color-emerald-500);
   color: var(--color-coolGray-100);
}

@mixin button--danger {
   @include button;
   background: var(--color-red-500);
   border: 2px solid var(--color-red-500);
   color: var(--color-coolGray-100);
}

.button {
   @include with-queries {
      @include button;

      @include xsmall {
         @include button;
         font-size: var(--px-12);
         min-height: var(--px-18);
         padding: var(--px-4) var(--px-12);
      }

      @include small {
         @include button;
         font-size: var(--px-14);
         min-height: var(--px-20);
         padding: var(--px-4) var(--px-16);
      }

      @include large {
         @include button;
         font-size: var(--px-18);
         min-height: var(--px-20);
         padding: var(--px-8) var(--px-16);
      }

      @include xlarge {
         @include button;
         font-size: var(--px-24);
         min-height: var(--px-40);
         padding: var(--px-4) var(--px-24);
      }
   }

   &--secondary {
      @include with-queries {
         @include button--secondary;
      }
   }

   &--success {
      @include with-queries {
         @include button--success;
      }
   }

   &--danger {
      @include with-queries {
         @include button--danger;
      }
   }
}
</style>
