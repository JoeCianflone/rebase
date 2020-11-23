<script>
import Layout from "@/Templates/Rebase/Workspace"
import AdminPage from "@/Templates/Rebase/AdminPage"
import DataTable from "@/Components/Rebase/DataTable"
import ActionMenu from "@/Components/Rebase/Actions/ActionMenu"
import ActionLink from "@/Components/Rebase/Actions/ActionLink"
import ActionButton from "@/Components/Rebase/Actions/ActionButton"

export default {
   layout: Layout,
   metaInfo: { title: "Members" },

   components: {
      AdminPage,
      ActionMenu,
      ActionLink,
      ActionButton,
      DataTable,
   },

   props: {
      members: Array,
      links: Object,
   },

   data: () => ({
      sending: false,
      form: {},
   }),

   methods: {},
}
</script>

<template>
   <AdminPage nav="members">
      <template v-slot:header>Members</template>
      <template v-slot:body>
         <DataTable :links="links">
            <template v-slot:dataHeader>
               <th>&nbsp;</th>
               <th>Name</th>
               <th>Email</th>
               <th>Status</th>
               <th>Role</th>
               <th>&nbsp;</th>
            </template>
            <template v-slot:dataBody>
               <tr v-for="member in members" :key="member.id">
                  <td><input type="checkbox" /></td>
                  <td title="Name">{{ member.name }}</td>
                  <td title="Slug">{{ member.email }}</td>
                  <td>{{ member.email_activation == null ? "Active" : "Not Active" }}</td>
                  <td>{{ member.currentWorkspaceRole }}</td>
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
   </AdminPage>
</template>
