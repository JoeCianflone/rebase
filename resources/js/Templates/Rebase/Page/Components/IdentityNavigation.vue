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
      <ActionLink :inertia="false" :link="route('pick', $page.props.auth.user.customerId)">Switch</ActionLink>
      <ActionLink :inertia="false" :link="route('customer.index', $page.props.auth.user.customerId)">Settings</ActionLink>
      <ActionLink link="#">Your Profile</ActionLink>
      <ActionLink :inertia="false" :link="route('logout', { customer_id: $page.props.auth.user.customerId })">Logout</ActionLink>
   </ActionMenu>
</template>

<style lang="scss" scoped>
@import "@@/abstract";
</style>
