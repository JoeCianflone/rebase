<script>
import Layout from "@/Templates/Rebase/Layout"

export default {
   layout: Layout,
   metaInfo: { title: "Welcome to Onboarding" },

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
      <h1 class="col-10--centered">Onboarding Start</h1>
      <div class="col-10--centered">
         <p><Button class="button:xsmall" type="submit" :disable="sending">Complete Onboarding</Button></p>
      </div>
   </form>
</template>
