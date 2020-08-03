<script>
export default {
   props: {
      position: String,
      default: "top",
   },
}
</script>

<template>
   <label :class="`form-item--${position}`">
      <slot />
   </label>
</template>
