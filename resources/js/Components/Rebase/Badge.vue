<script>
export default {
   name: "Badge",

   props: {
      type: {
         default: "primary",
         type: String,
      },
   },
}
</script>

<template>
   <span :class="`badge--${type}`"><slot></slot></span>
</template>

<style lang="scss">
.badge {
   display: inline-block;
   padding: var(--px-4) var(--px-12);
   font-size: var(--px-12);
   font-weight: 600;
   text-transform: uppercase;
}

.badge--primary {
   @extend .badge;
   background: var(--color-blueGray-800);
   color: var(--color-true-white);
}

.badge--danger {
   @extend .badge;
   background: var(--color-red-500);
   color: var(--color-coolGray-100);
}

.badge--success {
   @extend .badge;
   background: var(--color-emerald-500);
   color: var(--color-coolGray-100);
}
</style>
