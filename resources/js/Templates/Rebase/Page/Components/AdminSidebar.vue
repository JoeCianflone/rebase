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
   <MainNavigation>
      <li><inertia-link :href="route('customer.index', $page.props.customer_id)" :class="{ selected: this.nav === 'customer' }">Customer Settings</inertia-link></li>
      <li><inertia-link href="#" :class="{ selected: this.nav === 'workspaces' }">Workspaces</inertia-link></li>
      <li><inertia-link :href="route('member.index', $page.props.customer_id)" :class="{ selected: this.nav === 'members' }">Members</inertia-link></li>
   </MainNavigation>
</template>
