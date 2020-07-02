<script>
export default {
   props: {
      position: String,
      default: "top",
   },
}
</script>

<template>
   <label class="label" :class="`-label-${position}`">
      <slot />
   </label>
</template>
