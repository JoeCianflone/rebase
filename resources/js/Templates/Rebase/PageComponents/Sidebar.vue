<script>
import MainNavigation from "./MainNavigation"

export default {
   components: {
      MainNavigation,
   },
   props: {
      nav: String,
   },
}
</script>

<template>
   <section>
      <MainNavigation>
         <li><inertia-link :href="route('dashboard')" :class="{ selected: this.nav === 'dashboard' }">Dashboard</inertia-link></li>
         <li><inertia-link href="#">Manage Members</inertia-link></li>
         <li><inertia-link href="#">Manage Workspaces</inertia-link></li>
         <li><inertia-link href="#">Billing</inertia-link></li>
         <li><inertia-link href="#">Manage Custom URL</inertia-link></li>
      </MainNavigation>
   </section>
</template>

<style lang="scss" scoped>
@import "@@/abstract";
</style>
