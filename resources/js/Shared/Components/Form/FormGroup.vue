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
   <div class="input-group">
      <div class="input-slot -pre-input" v-if="!!(this.$slots.pre || [])[0]">
         <slot name="pre"></slot>
      </div>
      <slot />
      <div class="input-slot -post-input" v-if="!!(this.$slots.post || [])[0]">
         <slot name="post"></slot>
      </div>
   </div>
</template>
