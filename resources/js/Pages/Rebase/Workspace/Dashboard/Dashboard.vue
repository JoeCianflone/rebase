<script>
import Layout from "@/Templates/Rebase/Workspace"
import AdminPage from "@/Templates/Rebase/AdminPage"

export default {
   layout: Layout,
   metaInfo: { title: "Dashboard" },

   components: {
      AdminPage,
   },

   data: () => ({
      sending: false,
      form: {},
   }),

   methods: {},
}
</script>

<template>
   <AdminPage nav="dashboard">
      <template v-slot:header>Dashboard</template>
      <template v-slot:body>
         <div class="grid"></div>
      </template>
   </AdminPage>
</template>
