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
         <li><inertia-link href="#">Members</inertia-link></li>
         <li><inertia-link href="#">Reporting</inertia-link></li>
         <li><inertia-link href="#">Customer Service</inertia-link></li>
         <li><inertia-link :href="route('customer.settings')" :class="{ selected: this.nav === 'settings' }">Settings</inertia-link></li>
      </MainNavigation>
   </section>
</template>

<style lang="scss" scoped>
@import "@@/abstract";
</style>
