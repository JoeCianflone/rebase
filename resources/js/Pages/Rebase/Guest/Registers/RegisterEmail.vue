<script>
import Layout from "@/Templates/Rebase/Layout"
import Register from "@/Templates/Rebase/Page/Register"

export default {
   layout: Layout,
   metaInfo: { title: "Register your email address" },

   components: {
      Register,
   },

   props: {
      slug: String,
   },
   data() {
      return {
         sending: false,
         form: {
            slug: this.slug,
            name: null,
            email: null,
         },
      }
   },

   methods: {
      submit() {
         this.$inertia.post(route("register.check.email"), this.form, {
            onStart: () => (this.sending = true),
            onFinish: () => (this.sending = false),
         })
      },
   },
}
</script>

<template>
   <Register :step="2">
      <form class="layout__main" action="post" @submit.prevent="submit">
         <section class="grid">
            <FormField class="col-10--centered md::col-8--centered xw::col-6--centered" validate="name">
               <FieldLabel>What's your name?</FieldLabel>
               <FormInput v-model="form.name" />
            </FormField>
            <FormField class="col-10--centered md::col-8--centered xw::col-6--centered" validate="email">
               <FieldLabel>What's your email address?</FieldLabel>
               <FormInput v-model="form.email" />
            </FormField>
            <Button class="col-10--centered md::col-8--centered xw::col-6--centered button:block" type="submit" :disable="sending">Next</Button>
         </section>
      </form>
   </Register>
</template>
