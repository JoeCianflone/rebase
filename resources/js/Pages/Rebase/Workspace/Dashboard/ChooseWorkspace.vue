<script>
import Layout from "@/Templates/Rebase/WorkspaceGuest"

export default {
   layout: Layout,
   metaInfo: { title: "Dashboard" },

   components: {},

   data: () => ({
      sending: false,
      form: {},
   }),

   methods: {},
}
</script>

<template>
   <form class="grid" action="post" @submit.prevent="submit">
      <h1 class="col-10--centered">Pick a Page</h1>
   </form>
</template>
