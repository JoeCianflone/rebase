<script>
import Layout from "@/Templates/Rebase/Web"

export default {
   layout: Layout,
   metaInfo: { title: "Register your Workspace" },

   components: {},

   data() {
      return {
         sending: false,
         form: {},
      }
   },

   props: {
      slug: {
         type: String,
         default: null,
      },
   },

   methods: {
      test() {
         this.sending = true

         this.$inertia.post(route("register.workspace.process"), this.form, {
            onStart: () => (this.sending = true),
            onFinish: () => (this.sending = false),
         })
      },
   },
}
</script>

<template>
   <section class="layout">
      <div class="layout__main">
         <section class="grid">
            <h1 class="col-10--centered">All Done, Check your email</h1>
         </section>
      </div>
      <aside class="layout__secondary">
         <ol class="step-counter">
            <li class="step-counter__item">Check your workspace</li>
            <li class="step-counter__item">Add your information</li>
            <li class="step-counter__item">Pay</li>
            <li class="step-counter__item--current">Finished</li>
         </ol>
      </aside>
   </section>
</template>
