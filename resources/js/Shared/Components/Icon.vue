<script>
export default {
   name: "Icon",
   props: {
      name: String,
      width: {
         type: [Number, String],
         default: 24,
      },
      height: {
         type: [Number, String],
         default: 24,
      },
   },
   data: () => ({}),

   methods: {},
}
</script>

<template>
   <svg class="icon" :width="width" :height="height">
      <use v-bind="{ 'xlink:href': '/assets/images/feather-sprite@4.28.0.svg#' + name }" />
   </svg>
</template>

<style lang="scss">
.icon {
   stroke: currentColor;
   stroke-width: 2;
   stroke-linecap: round;
   stroke-linejoin: round;
   fill: none;
}
</style>
