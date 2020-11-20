<script>
export default {
   name: "FieldLabel",
}
</script>

<template>
   <span class="form--label" :title="this.$slots.default[0].text"><slot /></span>
</template>

<style lang="scss" scoped>
@import "@@/abstract";

.form--label {
   display: block;
   min-width: 1px;
   overflow: hidden;
   text-overflow: ellipsis;
   white-space: nowrap;
   line-height: var(--leading-normal);
}
</style>
