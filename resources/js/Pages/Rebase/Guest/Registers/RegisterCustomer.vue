<script>
import Layout from "@/Templates/Rebase/Layout"
import Register from "@/Templates/Rebase/Page/Register"
import { CardNumber, CardExpiry, CardCvc, handleCardSetup } from "vue-stripe-elements-plus"
import { states } from "@/Data/Rebase/consts"

export default {
   layout: Layout,
   metaInfo: { title: "Register" },

   components: {
      Register,
      CardNumber,
      CardExpiry,
      CardCvc,
   },
   remember: "form",

   data: function () {
      return {
         sending: false,
         showAddress: false,
         states: states,
         form: {
            payment_method: null,
            plan: null,
            name: this.name,
            email: this.email,
            sub: this.sub,
            line1: null,
            line2: null,
            line3: null,
            unit_number: null,
            city: null,
            state: null,
            postal_code: null,
            agreed_to_terms: false,
            agreed_to_privacy: false,
         },
      }
   },

   props: {
      sub: String,
      name: String,
      email: String,
      stripe: String,
      options: Array | Object,
      stripe_key: String,
      intent: Object,
   },
   computed: {},
   methods: {
      pay() {
         this.sending = true
         let vm = this

         handleCardSetup(this.intent.client_secret, {
            payment_method_data: {
               billing_details: {
                  name: vm.form.name,
                  email: vm.form.email,
                  address: {
                     city: vm.form.city,
                     line1: vm.form.line1,
                     line2: vm.form.line2,
                     postal_code: vm.form.postal_code,
                     state: vm.form.state,
                  },
               },
            },
         }).then(function (result) {
            if (result.error) {
               alert("Your payment was declined for some reason")
               vm.sending = false
               return false
            }

            vm.form.payment_method = result.setupIntent.payment_method

            vm.$inertia.post(route("register.store"), vm.form, {
               onStart: () => (vm.sending = true),
               onFinish: () => (vm.sending = false),
            })
         })
      },
   },
}
</script>

<template>
   <Register :step="3">
      <form class="layout__main" action="post" @submit.prevent="pay">
         <section class="grid">
            <h1 class="col-10--centered md::col-8--centered">Please Pick a Plan</h1>

            <FormField class="col-10--centered md::col-8--centered" validation="plan">
               <FieldLabel>Please Select From One of the Following:</FieldLabel>
               <FormSelect v-model="form.plan" defaultText="Select an Option">
                  <option v-for="product in $page.props.app.pricing" :key="product.id" :value="product.id">{{ product.name }} ${{ product.price / 100 }}.00</option>
               </FormSelect>
            </FormField>

            <h1 class="col-10--centered md::col-8--centered">Billing Address</h1>
            <FormField validate="line1" class="col-10--centered md::col-6:at-3">
               <FieldLabel>Address Line 1:</FieldLabel>
               <FormInput v-model="form.line1" />
            </FormField>

            <FormField validate="unit_number" class="col-10--centered md::col-2">
               <FieldLabel>Unit Number:</FieldLabel>
               <FormInput v-model="form.unit_number" />
            </FormField>

            <template v-if="showAddress">
               <FormField validate="line2" class="col-10--centered md::col-8--centered">
                  <FieldLabel>Address Line 2:</FieldLabel>
                  <FormInput v-model="form.line2" />
               </FormField>

               <FormField validate="line3" class="col-10--centered md::col-8--centered">
                  <FieldLabel>Address Line 3:</FieldLabel>
                  <FormInput v-model="form.line3" />
               </FormField>
            </template>

            <div class="col-10--centered md::col-8--centered">
               <Button class="button--secondary:block:xsmall" @click="showAddress = showAddress ? false : true">{{ showAddress ? `Hide` : `Show Extra` }} Address Lines</Button>
            </div>

            <FormField validate="city" class="col-10--centered md::col-4:at-3">
               <FieldLabel>City:</FieldLabel>
               <FormInput v-model="form.city" />
            </FormField>

            <FormField validate="state" class="col-10--centered md::col-2">
               <FieldLabel>State:</FieldLabel>
               <FormSelect v-model="form.state" defaultText="Select" :options="states" />
            </FormField>

            <FormField validate="postal_code" class="col-10--centered md::col-2">
               <FieldLabel>Postal Code:</FieldLabel>
               <FormInput v-model="form.postal_code" maxlength="5" />
            </FormField>

            <h1 class="col-10--centered md::col-8--centered">Credit Card Information</h1>
            <FormField class="col-10--centered md::col-8--centered">
               <FieldLabel>Card Number:</FieldLabel>
               <card-number ref="cardNumber" :stripe="stripe_key" />
            </FormField>

            <FormField class="col-5:at-2 md::col-6:at-3">
               <FieldLabel>Expires:</FieldLabel>
               <card-expiry ref="cardExpiry" :stripe="stripe_key" />
            </FormField>

            <FormField class="col-5 md::col-2">
               <FieldLabel>CVC:</FieldLabel>
               <card-cvc ref="cardCvc" :stripe="stripe_key" />
            </FormField>

            <FormField validate="agreed_to_terms" class="col-10--centered md::col-8--centered">
               <FormCheckbox v-model="form.agreed_to_terms">I agree with the Terms of Service</FormCheckbox>
            </FormField>

            <FormField validate="agreed_to_privacy" class="col-10--centered md::col-8--centered">
               <FormCheckbox v-model="form.agreed_to_privacy">I agree with the Privacy Policy</FormCheckbox>
            </FormField>
            <Button class="col-10--centered md::col-4--centered button" type="submit" :disable="sending">Pay</Button>
         </section>
      </form>
   </Register>
</template>
