<script>
export default {
   name: "Icon",
   props: {
      name: String,
      size: {
         type: Number,
         default: 20,
      },
   },
   data() {
      return {
         w: `${this.size}px`,
         h: `${this.size}px`,
      }
   },
}
</script>

<template>
   <svg-vue :icon="name" class="icon" :style="{ width: w, height: h }"></svg-vue>
</template>

<style lang="scss">
@import "@@/abstract";

@mixin icon {
   fill: none;
   line-height: 0;
   @content;
}

.icon {
   @include icon;
   &--left {
      @include icon {
         margin-right: var(--px-8);
      }
   }

   &--right {
      @include icon {
         margin-left: var(--px-8);
      }
   }
}
</style>
