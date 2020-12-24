<script>
import Layout from "@/Templates/Rebase/Layout"
import Register from "@/Templates/Rebase/Page/Register"

export default {
   layout: Layout,
   metaInfo: { title: "Register your Workspace" },

   components: {
      Register,
   },

   data() {
      return {
         sending: false,
         form: {
            sub: null,
         },
      }
   },

   props: {
      sub: {
         type: String,
         default: null,
      },
   },

   methods: {
      check() {
         this.sending = true

         this.$inertia.post(route("register.check.sub"), this.form, {
            onStart: () => (this.sending = true),
            onFinish: () => (this.sending = false),
         })
      },
   },
}
</script>

<template>
   <Register :step="4">
      <section class="grid">
         <div class="col-10--centered">
            <h1>All Done!</h1>
            <p>We'll be sending you an email in a few minutes.</p>
         </div>
      </section>
   </Register>
</template>
