<script>
import Layout from "@/Templates/Rebase/Layout"
import Register from "@/Templates/Rebase/Page/Register"

export default {
   layout: Layout,
   metaInfo: { title: "Search" },

   components: {
      Register,
   },

   data() {
      return {
         sending: false,
         form: {
            search: null,
         },
      }
   },

   props: {},

   methods: {
      search() {
         this.sending = true

         this.$inertia.post(route("search.process"), this.form, {
            onStart: () => (this.sending = true),
            onFinish: () => (this.sending = false),
         })
      },
   },
}
</script>

<template>
   <Register>
      <form class="layout__main" action="post" @submit.prevent="search">
         <section class="grid">
            <FormField class="col-10--centered md::col-8--centered xw::col-6--centered" validate="search">
               <FieldLabel>Enter the name or address of your customer:</FieldLabel>
               <FormGroup>
                  <FormInput v-model="form.search" />
               </FormGroup>
            </FormField>
            <Button class="col-10--centered md::col-8--centered xw::col-6--centered button:block" type="submit" :disable="sending">Search</Button>
            <div class="col-10--centered md::col-8--centered xw::col-6--centered">
               <h3>Results</h3>
            </div>
         </section>
      </form>
      <template #sidebar> Use this search box to look up your log in page. You could enter the address or name. </template>
   </Register>
</template>
