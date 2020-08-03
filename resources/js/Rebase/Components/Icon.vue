<script>
export default {
   name: "Icon",
   props: {
      name: String,
      fontSize: {
         type: String,
         default: "18px",
      },
      size: {
         type: Number,
      },
      width: {
         type: [Number, String],
         default: 18,
      },
      height: {
         type: [Number, String],
         default: 18,
      },
   },
   data() {
      return {
         w: this.size ? this.size : this.width,
         h: this.size ? this.size : this.height,
         fs: this.size ? `${this.size}px` : this.fontSize,
      }
   },
   methods: {},
}
</script>

<template>
   <svg :width="w" :height="h" :style="{ 'font-size': fs }">
      <use v-bind="{ 'xlink:href': '/assets/images/feather-sprite@4.28.0.svg#' + name }" />
   </svg>
</template>
