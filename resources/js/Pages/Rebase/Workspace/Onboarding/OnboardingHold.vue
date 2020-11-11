<script>
import Layout from "@/Templates/Rebase/WorkspaceGuest"

export default {
   layout: Layout,
   metaInfo: { title: "HOOLLLD" },

   components: {},

   data: () => ({
      sending: false,
      form: {},
   }),

   methods: {
      submit() {
         this.$inertia.post(route("onboarding.complete"), this.form, {
            onStart: () => (this.sending = true),
            onFinish: () => (this.sending = false),
         })
      },
   },
}
</script>

<template>
   <form class="grid" action="post" @submit.prevent="submit">
      <h1 class="col-10--centered">Whoops!</h1>
      <div class="col-10--centered">Sorry the owner must finish the onboarding process before we can let you in.</div>
   </form>
</template>
