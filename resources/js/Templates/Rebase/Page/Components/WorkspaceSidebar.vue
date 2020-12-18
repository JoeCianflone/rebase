<script>
import MainNavigation from "./MainNavigation"

export default {
   components: {
      MainNavigation,
   },

   methods: {},

   props: {
      nav: String,
   },
}
</script>

<template>
   <MainNavigation>
      <li><inertia-link :href="route('dashboard')" :class="{ selected: this.nav === 'dashboard' }">Dashboard</inertia-link></li>
      <li v-if="$RoleCheck.gte.accountOwner($page.props.auth.user.roles)"><inertia-link :href="route('workspace-members.index')" :class="{ selected: this.nav === 'members' }">Members</inertia-link></li>
   </MainNavigation>
</template>
