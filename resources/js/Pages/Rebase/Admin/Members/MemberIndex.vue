<script>
import Layout from "@/Templates/Rebase/Layout"
import Admin from "@/Templates/Rebase/Page/Admin"
import DataTable from "@/Components/Rebase/DataTable"
import ActionMenu from "@/Components/Rebase/Actions/ActionMenu"
import ActionLink from "@/Components/Rebase/Actions/ActionLink"
import ActionButton from "@/Components/Rebase/Actions/ActionButton"
import Badge from "@/Components/Rebase/Badge"

export default {
   layout: Layout,
   metaInfo: { title: "Members" },

   components: {
      Admin,
      ActionButton,
      ActionMenu,
      ActionLink,
      DataTable,
      Badge,
   },

   props: {
      members: Array | Object,
      links: Array | Object,
   },
   data() {
      return {
         sending: false,
         form: {},
      }
   },

   methods: {
      toggleRoleView(event) {
         let el = event.target.parentNode.parentNode.nextElementSibling
         if (el.style.display === "table-row") {
            el.style.display = "none"
         } else {
            el.style.display = "table-row"
         }
      },
   },
}
</script>

<template>
   <Admin nav="members">
      <template #header>Members</template>
      <template v-slot:body>
         <div class="grid">
            <div class="col-10--centered sm::col-12">
               <h2>All Members</h2>
               <DataTable :links="links" routeName="member.index" :routeParams="{ customerID: $page.props.customer_id }">
                  <template #header>
                     <th>Name</th>
                     <th>Email</th>
                     <th>Roles</th>
                     <th>Has Logged In?</th>
                     <th>&nbsp;</th>
                  </template>
                  <template #contents>
                     <template v-for="member in members">
                        <tr>
                           <td>{{ member.name }}</td>
                           <td>{{ member.email }}</td>
                           <td class="center">
                              <Button class="button--link" @click="toggleRoleView">See All Roles</Button>
                           </td>
                           <td>
                              <Badge :type="member.email_verified_at === null ? `danger` : `success`">
                                 {{ member.email_verified_at === null ? `No` : `Yes` }}
                              </Badge>
                           </td>
                           <td>
                              <ActionMenu>
                                 <ActionLink link="#">Edit</ActionLink>
                                 <ActionButton>Delete</ActionButton>
                              </ActionMenu>
                           </td>
                        </tr>
                        <tr class="drawer">
                           <td colspan="100">
                              <div class="grid">
                                 <FormField validate="state" class="col-10 sm::col-6" v-for="role in member.roles" :key="role.id">
                                    <FieldLabel>Role in {{ role.workspace ? role.workspace.name : "" }}:</FieldLabel>
                                    <FormSelect :value="role.type" defaultText="Select a Role" :options="$page.props.app.roles" />
                                 </FormField>
                              </div>
                           </td>
                        </tr>
                     </template>
                  </template>
               </DataTable>
            </div>
         </div>
      </template>
   </Admin>
</template>

<style lang="scss" scoped>
@import "@@/abstract";
</style>
