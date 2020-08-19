<script>
import Layout from "@/Rebase/Templates/Open"
import { states } from "@/Rebase/consts"

export default {
   layout: Layout,
   metaInfo: { title: "ViewRegisterUser" },

   components: {},

   data: function () {
      return {
         sending: false,
         showAddress: false,
         states: states,
         form: {
            name: null,
            email: null,
            is_business: false,
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
            <p v-if="form.validatedSlug" class="col-10--centered md::col-8--centered">
               Great news <strong>{{ form.validatedSlug }}.{{ $page.app.domain }}</strong> is available!
            </p>
            <FormField class="col-10--centered md::col-8--centered" validate="is_business">
               This account is for:
               <FormSelect v-model="form.is_business" defaultText="Select an Account Type">
                  <option :value="false">Personal Use</option>
                  <option :value="true">A Business</option>
               </FormSelect>
            </FormField>

            <FormField validate="name" class="col-10--centered md::col-8--centered">
               What's your name:
               <FormText v-model="form.name" />
            </FormField>

            <FormField validate="email" class="col-10--centered md::col-8--centered">
               What's your email address:
               <FormText v-model="form.email" type="email" />
            </FormField>

            <FormField validate="address_line1" class="col-10--centered md::col-6 md::col-at-3">
               Account Address Line 1:
               <FormText v-model="form.address_line1" />
            </FormField>
            <FormField validate="unit_number" class="col-10--centered md::col-2">
               Unit Number:
               <FormText v-model="form.unit_number" />
            </FormField>

            <template v-if="showAddress">
               <FormField validate="address_line2" class="col-10--centered md::col-8--centered">
                  Account Address Line 2:
                  <FormText v-model="form.address_line2" />
               </FormField>

               <FormField validate="address_line3" class="col-10--centered md::col-8--centered">
                  Account Address Line 3:
                  <FormText v-model="form.address_line3" />
               </FormField>
            </template>
            <div class="col-10--centered md::col-8--centered">
               <Button class="button--primary-small" @click="showAddress = showAddress ? false : true">{{ showAddress ? `Hide` : `Show Extra` }} Address Lines</Button><br /><br />
            </div>

            <FormField validate="city" class="col-10--centered md::col-4 md::col-at-3">
               Account City:
               <FormText v-model="form.city" />
            </FormField>

            <FormField validate="state" class="col-10--centered md::col-2">
               Account State:
               <FormSelect v-model="form.state" defaultText="Select" :options="states" />
            </FormField>

            <FormField validate="address_line3" class="col-10--centered md::col-2">
               Postal Code:
               <FormText v-model="form.postal_code" />
            </FormField>
            <Button class="button--primary col-10--centered md::col-4--centered" type="submit" :disable="sending">Go Pay</Button>
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
