<script>
import Badge from "@/Components/Rebase/Badge"
import Layout from "@/Templates/Rebase/Layout"
import Admin from "@/Templates/Rebase/Page/Admin"
import DataTable from "@/Components/Rebase/DataTable"
import ActionLink from "@/Components/Rebase/Actions/ActionLink"
import ActionMenu from "@/Components/Rebase/Actions/ActionMenu"
import ActionButton from "@/Components/Rebase/Actions/ActionButton"

export default {
   layout: Layout,
   metaInfo: { title: "Workspaces" },

   components: {
      Admin,
      ActionButton,
      ActionMenu,
      ActionLink,
      DataTable,
      Badge,
   },

   props: {
      workspaces: Array | Object,
   },

   data() {
      return {
         sending: false,
         form: {},
      }
   },

   methods: {},
}
</script>

<template>
   <Admin nav="workspaces">
      <template #header>Workspaces</template>
      <template v-slot:body>
         <div class="grid">
            <div class="col-10--centered md::col-12">
               <DataTable :links="workspaces.links" routeName="workspace.index" :routeParams="{ customerID: $page.props.customer_id }">
                  <template #header>
                     <th>&nbsp;</th>
                     <th>Name</th>
                     <th>URL</th>
                     <th>Active Members</th>
                     <th>Total Users</th>
                     <th>&nbsp;</th>
                  </template>
                  <template #contents>
                     <tr v-for="workspace in workspaces.data" :key="workspace.id">
                        <td><input type="checkbox" /></td>
                        <td title="Name">{{ workspace.name }}</td>
                        <td title="sub">{{ workspace.sub }}</td>
                        <td>{{ workspace.active_users }}</td>
                        <td>{{ workspace.total_users }}</td>
                        <td>
                           <ActionMenu>
                              <ActionLink link="#">Update</ActionLink>
                              <ActionButton @click="dangerArchive(workspace.id, workspace.name)">Archive</ActionButton>
                           </ActionMenu>
                        </td>
                     </tr>
                  </template>
               </DataTable>
            </div>
         </div>
      </template>
   </Admin>
</template>
