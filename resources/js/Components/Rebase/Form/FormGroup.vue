<script>
export default {
   props: {
      position: {
         type: String,
         default: "start",
      },
   },
}
</script>

<template>
   <div class="form-item--grouped">
      <button class="form-item__pre-input" v-if="!!(this.$slots.preButton || [])[0]">
         <slot name="preButton"></slot>
      </button>
      <div class="form-item__pre-input" v-if="!!(this.$slots.pre || [])[0]">
         <slot name="pre"></slot>
      </div>
      <slot />
      <div class="form-item__post-input" v-if="!!(this.$slots.post || [])[0]">
         <slot name="post"></slot>
      </div>
      <button class="form-item__post-input" v-if="!!(this.$slots.postButton || [])[0]" type="button">
         <slot name="postButton"></slot>
      </button>
   </div>
</template>

<style lang="scss" scoped>
@import "@@/abstract";

@mixin input-slot {
   background-color: var(--color-gray-400);
   border: $form-border;
   font-size: $form-font-size;
   line-height: $form-line-height;
   min-height: $form-height;
   padding: var(--px-8) var(--px-16);

   @content;
}

.form-item {
   &--grouped {
      align-items: center;
      border-radius: $form-border-radius;
      display: flex;
      justify-content: flex-start;
      border: $form-border;

      &:focus-within {
         @include form-element-focus;

         input:focus {
            @include form-element-unfocus;
         }
      }
   }

   &__pre-input {
      @include input-slot {
         border-bottom-left-radius: $form-border-radius;
         border-top-left-radius: $form-border-radius;
         margin-right: -2px;
      }
   }

   &__post-input {
      @include input-slot {
         border-bottom-right-radius: $form-border-radius;
         border-top-right-radius: $form-border-radius;
         margin-left: -2px;
      }
   }
}
</style>
