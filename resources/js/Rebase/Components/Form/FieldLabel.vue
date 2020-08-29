<script>
export default {
   name: "FieldLabel",

}
</script>

<template>
   <span class="form__label" :title="this.$slots.default[0].text"><slot /></span>
</template>

<style lang="scss" scoped>
   @import '@@/abstract';

   .form__label {
      display: inline-block;
      min-width: 1px;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
   }

</style>
