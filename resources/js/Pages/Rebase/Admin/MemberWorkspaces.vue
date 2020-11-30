<script>
import Layout from "@/Templates/Rebase/Workspace"
import CustomerPage from "@/Templates/Rebase/CustomerPage"
import ActionMenu from "@/Components/Rebase/Actions/ActionMenu"
import ActionLink from "@/Components/Rebase/Actions/ActionLink"
import ActionButton from "@/Components/Rebase/Actions/ActionButton"
import DataTable from "@/Components/Rebase/DataTable"
import ContentGroup from "@/Components/Rebase/ContentGroup"

export default {
   layout: Layout,
   metaInfo: { title: "Pick a Workspace" },

   components: {
      CustomerPage,
      ActionMenu,
      ActionLink,
      ActionButton,
      DataTable,
      ContentGroup,
   },

   props: {
      workspaces: Array,
   },

   data: function () {
      return {
         sending: false,
      }
   },

   methods: {},
}
</script>

<template>
   <CustomerPage nav="settings">
      <template v-slot:header>Switch Workspaces</template>
      <template v-slot:body>
         <div class="grid">
            <div class="col-10--centered">
               <ul>
                  <li v-for="workspace in workspaces" :key="workspace.id">
                     <inertia-link href="#">{{ workspace.name }}</inertia-link>
                  </li>
               </ul>
            </div>
         </div>
      </template>
   </CustomerPage>
</template>
