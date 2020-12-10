<script>
import Layout from "@/Templates/Rebase/Layout"
import Admin from "@/Templates/Rebase/Page/Admin"
import ActionMenu from "@/Components/Rebase/Actions/ActionMenu"
import ActionLink from "@/Components/Rebase/Actions/ActionLink"
import ActionButton from "@/Components/Rebase/Actions/ActionButton"

export default {
   layout: Layout,
   metaInfo: { title: "Pick a Workspace" },

   components: {
      Admin,
      ActionMenu,
      ActionLink,
      ActionButton,
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
   <Admin nav="settings">
      <template #header>Switch Workspaces</template>
      <template v-slot:body>
         <div class="grid">
            <div class="col-10--centered">
               <ul>
                  <li v-for="workspace in workspaces" :key="workspace.id">
                     <a :href="`//${workspace.slug}.rebase.test/dashboard`">{{ workspace.name }}</a>
                  </li>
               </ul>
            </div>
         </div>
      </template>
   </Admin>
</template>
