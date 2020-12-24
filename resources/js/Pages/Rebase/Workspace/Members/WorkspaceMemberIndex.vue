<script>
import Layout from "@/Templates/Rebase/Layout"
import Workspace from "@/Templates/Rebase/Page/Workspace"
import DataTable from "@/Components/Rebase/DataTable"
import ActionMenu from "@/Components/Rebase/Actions/ActionMenu"
import ActionLink from "@/Components/Rebase/Actions/ActionLink"
import ActionButton from "@/Components/Rebase/Actions/ActionButton"

export default {
   layout: Layout,
   metaInfo: { title: "Members" },

   components: {
      Workspace,
      ActionMenu,
      ActionLink,
      ActionButton,
      DataTable,
   },

   props: {
      members: Array,
      links: Array,
   },

   data: () => ({
      sending: false,
      form: {},
   }),

   methods: {},
}
</script>

<template>
   <Workspace nav="members">
      <template #header>Members</template>
      <template v-slot:body>
         <DataTable :links="links">
            <template #header>
               <th>&nbsp;</th>
               <th>Name</th>
               <th>Email</th>
               <th>Status</th>
               <th>Role</th>
               <th>&nbsp;</th>
            </template>
            <template #contents>
               <tr v-for="member in members" :key="member.id">
                  <td><input type="checkbox" /></td>
                  <td title="Name">{{ member.name }}</td>
                  <td title="sub">{{ member.email }}</td>
                  <td>{{ member.email_activation == null ? "Active" : "Not Active" }}</td>
                  <td>x</td>
                  <td>
                     <ActionMenu>
                        <ActionLink link="#">Edit</ActionLink>
                        <ActionButton>Delete</ActionButton>
                     </ActionMenu>
                  </td>
               </tr>
            </template>
         </DataTable>
      </template>
   </Workspace>
</template>
