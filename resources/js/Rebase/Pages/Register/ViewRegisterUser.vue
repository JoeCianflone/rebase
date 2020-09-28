<script>
import Layout from "@/Rebase/Templates/Open"
import { states } from "@/Rebase/consts"

export default {
   layout: Layout,
   metaInfo: { title: "Register Part 2" },

   components: {},
   remember: 'form',

   data: function () {
      return {
         sending: false,
         showAddress: false,
         states: states,
         form: {
            name: null,
            email: null,
            business_name: null,
            is_business: '',
            address_line1: null,
            address_line2: null,
            address_line3: null,
            unit_number: null,
            city: null,
            state: null,
            postal_code: null,
         },
      }
   },

   props: {
      slug: String,
   },
   computed: {},
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
            <p v-if="slug" class="col-10--centered md::col-8--centered">
               Great news <strong>{{ slug }}.{{ $page.app.domain }}</strong>&nbsp;is available!
            </p>

            <FormField validate="name" class="col-10--centered md::col-8--centered">
               <FieldLabel>What's your name:</FieldLabel>
               <FormInput v-model="form.name" />
            </FormField>

            <FormField v-if="form.is_business" validate="business_name" class="col-10--centered md::col-8--centered">
               <FieldLabel>What's your businesses name:</FieldLabel>
               <FormInput v-model="form.business_name" />
            </FormField>

            <FormField validate="is_business" class="col-10--centered md::col-8--centered">
               <FormCheckbox v-model="form.is_business">This is a business account</FormCheckbox>
            </FormField>

            <FormField validate="email" class="col-10--centered md::col-8--centered">
               <FieldLabel>What's your email address:</FieldLabel>
               <FormInput v-model="form.email" type="email" />
            </FormField>

            <FormField validate="address_line1" class="col-10--centered md::col-6 md::col-at-3">
               <FieldLabel>Address Line 1:</FieldLabel>
               <FormInput v-model="form.address_line1" />
            </FormField>

            <FormField validate="unit_number" class="col-10--centered md::col-2">
               <FieldLabel>Unit Number:</FieldLabel>
               <FormInput v-model="form.unit_number" />
            </FormField>

            <template v-if="showAddress">
               <FormField validate="address_line2" class="col-10--centered md::col-8--centered">
                  <FieldLabel>Address Line 2:</FieldLabel>
                  <FormInput v-model="form.address_line2" />
               </FormField>

               <FormField validate="address_line3" class="col-10--centered md::col-8--centered">
                  <FieldLabel>Address Line 3:</FieldLabel>
                  <FormInput v-model="form.address_line3" />
               </FormField>
            </template>

            <div class="col-10--centered md::col-8--centered">
               <Button as="secondary" size="sm"  @click="showAddress = showAddress ? false : true">{{ showAddress ? `Hide` : `Show Extra` }} Address Lines</Button><br /><br />
            </div>

            <FormField validate="city" class="col-10--centered md::col-4 md::col-at-3">
               <FieldLabel>City:</FieldLabel>
               <FormInput v-model="form.city" />
            </FormField>

            <FormField validate="state" class="col-10--centered md::col-2">
               <FieldLabel>State:</FieldLabel>
               <FormSelect v-model="form.state" defaultText="Select" :options="states" />
            </FormField>

            <FormField validate="postal_code" class="col-10--centered md::col-2">
               <FieldLabel>Postal Code:</FieldLabel>
               <FormInput v-model="form.postal_code" />
            </FormField>

            <Button class="col-10--centered md::col-4--centered" type="submit" :disable="sending">Go Pay</Button>
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
