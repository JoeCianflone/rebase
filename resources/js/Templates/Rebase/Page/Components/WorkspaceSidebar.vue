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
      <li v-if="$RoleCheck.gte.workspaceAdmin($page.props.auth.user.roles, $page.props.workspace_id)"><inertia-link href="#" :class="{ selected: this.nav === 'members' }">Members</inertia-link></li>
   </MainNavigation>
</template>
