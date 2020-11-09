<script>
import Layout from "@/Templates/Rebase/WorkspaceMain"

export default {
   layout: Layout,
   metaInfo: { title: "Token Expired" },

   components: {},

   data: () => ({
      sending: false,
      form: {},
   }),
}
</script>

<template>
   <section class="grid">
      <h1 class="col-10--centered">Sorry your token expired, please check your email</h1>
   </section>
</template>
