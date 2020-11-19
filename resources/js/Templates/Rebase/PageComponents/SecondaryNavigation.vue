<script>
import Dropdown from "@/Components/Rebase/Dropdown"
export default {
   components: {
      Dropdown,
   },

   methods: {},
}
</script>

<template>
   <Dropdown>
      <template v-slot:dropdown>
         <ul class="navigation--secondary">
            <li><inertia-link :href="route('logout')">Switch Workspaces</inertia-link></li>
            <li><inertia-link :href="route('logout')">My Profile</inertia-link></li>
            <li><inertia-link :href="route('logout')">Logout</inertia-link></li>
         </ul>
      </template>
   </Dropdown>
</template>

<style lang="scss" scoped>
@import "@@/abstract";
.navigation--secondary {
   color: var(--color-coolGray-600);
   list-style-type: none;
   margin: 0;
   padding: 0;

   a {
      text-decoration: none;
      padding: var(--px-8) var(--px-20);
      display: block;
      border-bottom: 1px solid #ddd;

      &:hover {
         color: var(--color-coolGray-800);
         text-decoration: underline;
      }
   }
}
</style>
