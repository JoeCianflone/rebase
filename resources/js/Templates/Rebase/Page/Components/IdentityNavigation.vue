<script>
import ActionMenu from "@/Components/Rebase/Actions/ActionMenu"
import ActionLink from "@/Components/Rebase/Actions/ActionLink"
import ActionButton from "@/Components/Rebase/Actions/ActionButton"
import Icon from "@/Components/Rebase/Icon"

export default {
   components: {
      ActionMenu,
      ActionLink,
      ActionButton,
      Icon,
   },
   props: {
      nav: String,
   },
}
</script>

<template>
   <ActionMenu>
      <template v-slot:buttonText>
         <Icon name="person" /> <span class="identity-name">{{ $page.props.auth.user.email }}</span> <Icon name="chevron-down" />
      </template>
      <ActionLink :inertia="false" :link="route('pick', $page.props.customer_id)">Switch</ActionLink>
      <ActionLink :inertia="false" :link="route('customer.index', $page.props.customer_id)">Settings</ActionLink>
      <ActionLink link="#">Your Profile</ActionLink>
      <ActionLink :inertia="false" :link="route('logout', { customer_id: $page.props.customer_id })">Logout</ActionLink>
   </ActionMenu>
</template>

<style lang="scss" scoped>
@import "@@/abstract";

.identity-name {
   display: none;

   @media ($sm-and-up) {
      display: inline;
   }
}
</style>
