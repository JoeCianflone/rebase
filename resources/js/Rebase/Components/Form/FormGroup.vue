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
      <div class="form-item__pre-input" v-if="!!(this.$slots.pre || [])[0]">
         <slot name="pre"></slot>
      </div>
      <slot />
      <div class="form-item__post-input" v-if="!!(this.$slots.post || [])[0]">
         <slot name="post"></slot>
      </div>
   </div>
</template>
