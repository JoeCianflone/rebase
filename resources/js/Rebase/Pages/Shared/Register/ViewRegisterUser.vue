<script>
import Layout from "@/Rebase/Templates/Open"

export default {
   layout: Layout,
   metaInfo: { title: "ViewRegisterUser" },

   components: {},

   data: function () {
      return {
         sending: false,
         form: {
            validatedSlug: this.slug,
            name: null,
            email: null,
         },
      }
   },

   props: {
      slug: String,
   },

   methods: {
      test() {
         this.sending = true
         this.$inertia.post("/register/user", this.form).then(() => (this.sending = false))
      },
   },
}
</script>

<template>
   <section class="layout">
      <form class="layout__main" action="post" @submit.prevent="test">
         <section class="grid">
            <p v-if="form.validatedSlug" class="col-10--center md::col-8--center">
               <strong>{{ form.validatedSlug }}.rebase.test</strong> is available!
            </p>
            <FormField validate="name" class="col-10--center md::col-8--center">
               What's your name:
               <FormText v-model="form.name" />
            </FormField>
            <FormField validate="email" class="col-10--center md::col-8--center">
               What's your email address:
               <FormText v-model="form.email" type="email" />
            </FormField>
            <Button class="button--primary col-10--center md::col-4--center" type="submit" :sending="sending">Go Pay</Button>
         </section>
      </form>
      <aside class="layout__secondary">
         <ol class="step-counter">
            <li class="step-counter__item">Check your workspace</li>
            <li class="step-counter__item--current">Add your information</li>
            <li class="step-counter__item">Pay</li>
         </ol>
      </aside>
   </section>
</template>
