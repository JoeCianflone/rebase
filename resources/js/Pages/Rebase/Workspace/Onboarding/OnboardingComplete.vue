<script>
import Layout from "@/Templates/Rebase/WorkspaceMain"

export default {
   layout: Layout,
   metaInfo: { title: "Complete Onboarding" },

   components: {},

   data: () => ({
      sending: false,
      form: {},
   }),

   methods: {
      submit() {
         this.$inertia.post(route("login.process"), this.form, {
            onStart: () => (this.sending = true),
            onFinish: () => (this.sending = false),
         })
      },
   },
}
</script>

<template>
   <form class="grid" action="post" @submit.prevent="submit">
      <h1 class="col-10--centered">Onboarding Complete</h1>
   </form>
</template>
