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
            slug: null,
         },
      }
   },

   props: {
      slug: {
         type: String,
         default: null,
      },
   },

   methods: {
      check() {
         this.sending = true

         this.$inertia.post(route("register.check.slug"), this.form, {
            onStart: () => (this.sending = true),
            onFinish: () => (this.sending = false),
         })
      },
   },
}
</script>

<template>
   <Register :step="1">
      <form class="layout__main" action="post" @submit.prevent="check">
         <section class="grid">
            <FormField class="col-10--centered md::col-8--centered xw::col-6--centered" validate="slug">
               <FieldLabel>What's your workspace name:</FieldLabel>
               <FormGroup>
                  <FormInput v-model="form.slug" :slugify="true" />
                  <template #post> .{{ $page.props.app.domain }} </template>
               </FormGroup>
            </FormField>
            <Button class="col-10--centered md::col-8--centered xw::col-6--centered button:block" type="submit" :disable="sending">Check</Button>
         </section>
      </form>
   </Register>
</template>
