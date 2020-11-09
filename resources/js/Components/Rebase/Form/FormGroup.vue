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
      <div class="form-item--pre-input" v-if="!!(this.$slots.pre || [])[0]">
         <slot name="pre"></slot>
      </div>
      <slot />
      <div class="form-item--post-input" v-if="!!(this.$slots.post || [])[0]">
         <slot name="post"></slot>
      </div>
   </div>
</template>

<style lang="scss" scoped>
@import "@@/abstract";

@mixin input-slot {
   border: none;
   font-size: var(--px-16);
   line-height: normal;
   min-height: var(--px-40);
   padding: var(--px-8) var(--px-16);

   @content;
}

.form-item--grouped {
   align-items: center;
   border-radius: var(--radius-2);
   display: flex;
   justify-content: flex-start;
   border: 1px solid var(--color-coolGray-400);

   &:focus-within {
      @include form-element-focus;
      input:focus {
         border: none;
         box-shadow: none;
      }
   }

   input {
      border: 0;
      margin-right: var(--px-4);
   }
}
.form-item--pre-input {
   @include input-slot {
      border-bottom-left-radius: var(--radius-2);
      border-top-left-radius: var(--radius-2);
      margin-right: -2px;
   }
}

.form-item--post-input {
   @include input-slot {
      border-bottom-right-radius: var(--radius-2);
      border-top-right-radius: var(--radius-2);
      margin-left: -2px;
   }
}
</style>
