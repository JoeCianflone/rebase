<script>
export default {
   components: {},

   methods: {},
}
</script>

<template>
   <nav class="navigation--secondary">
      <ul>
         <li><inertia-link :href="route('logout')">Logout</inertia-link></li>
      </ul>
   </nav>
</template>

<style lang="scss" scoped>
@import "@@/abstract";
.navigation--secondary {
   color: var(--color-coolGray-600);
   a {
      text-decoration: none;

      &:hover {
         color: var(--color-coolGray-800);
         text-decoration: underline;
      }
   }
}
</style>
