<script>
import Layout from "@/Rebase/Templates/Open"

export default {
   layout: Layout,
   metaInfo: { title: "Please Log In" },

   components: {},

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
      test() {
         this.sending = true
         this.$inertia.post("/register/workspace", this.form).then(() => (this.sending = false))
      },
   },
}
</script>

<template>
   <section class="layout">
      <form class="layout__main" action="post" @submit.prevent="test">
         <section class="grid">
            <FormField class="col-10--centered md::col-8--centered" validate="slug">
               <FieldLabel>What's your workspace name:</FieldLabel>
               <FormGroup>
                  <FormInput v-model="form.slug" :slugify="true" />
                  <template #post> .{{ $page.app.domain }} </template>
               </FormGroup>
            </FormField>
            <Button class="col-10--centered md::col-4--centered" type="submit" :disable="sending">Check</Button>
         </section>
      </form>
      <aside class="layout__secondary">
         <ol class="step-counter">
            <li class="step-counter__item--current">Check your workspace</li>
            <li class="step-counter__item">Add your information</li>
            <li class="step-counter__item">Pay</li>
         </ol>
      </aside>
   </section>
</template>
