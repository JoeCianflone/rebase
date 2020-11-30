<script>
import ActionMenu from "@/Components/Rebase/Actions/ActionMenu"
import ActionLink from "@/Components/Rebase/Actions/ActionLink"
import ActionButton from "@/Components/Rebase/Actions/ActionButton"

export default {
   components: {
      ActionMenu,
      ActionLink,
      ActionButton,
   },
   props: {
      nav: String,
   },
}
</script>

<template>
   <ActionMenu>
      <template v-slot:buttonText> <span class="material-icons">account_circle</span> {{ $page.props.auth.user.email }} <span class="material-icons">expand_more</span> </template>
      <ActionLink :inertia="false" :link="route('customer.settings', $page.props.auth.user.customerId)">Customer Settings</ActionLink>
      <ActionLink :link="route('logout')">Profile</ActionLink>
      <ActionLink :inertia="false" :link="route('switch', $page.props.auth.user.customerId)">Switch Workspace</ActionLink>
      <ActionLink :link="route('logout')">Logout</ActionLink>
   </ActionMenu>
</template>

<style lang="scss" scoped>
@import "@@/abstract";
</style>
