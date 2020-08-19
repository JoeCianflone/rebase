<script>
import Layout from "@/Rebase/Templates/Open"

import { CardNumber, CardExpiry, CardCvc, createToken, handleCardSetup, createPaymentMethod } from "vue-stripe-elements-plus"
import _ from "lodash"

export default {
   layout: Layout,
   metaInfo: { title: "ViewRegisterPay" },

   components: {
      CardNumber,
      CardExpiry,
      CardCvc,
   },

   data: function () {
      return {
         sending: false,
         form: {
            payment_method: null,
            plan: null,
         },
      }
   },

   props: {
      slug: String,
      email: String,
      name: String,
      stripe: String,
      options: Array | Object,
      stripe_key: String,
      intent: Object,
   },

   methods: {
      pay() {
         this.sending = true
         let vm = this

         handleCardSetup(this.intent.client_secret).then(function (result) {
            vm.form.payment_method = result.setupIntent.payment_method
            vm.$inertia.post("/register/pay", vm.form).then(() => (vm.sending = false))
         })
      },
   },
}
</script>

<template>
   <section class="layout">
      <form class="layout__main" action="post" @submit.prevent="pay">
         <section class="grid">
            <FormField class="col-10--centered md::col-8--centered" validation="plan">
               Please Select From One of the Following:
               <FormSelect v-model="form.plan" defaultText="Select an Option">
                  <option v-for="product in $page.app.pricing" :key="product.id" :value="product.id">{{ product.name }} ${{ product.price / 100 }}.00</option>
               </FormSelect>
            </FormField>

            <FormField class="col-10--centered md::col-8--centered">
               Card Number:
               <card-number ref="cardNumber" :stripe="stripe_key" />
            </FormField>

            <FormField class="col-8 col-at-2 md::col-6 md::col-at-3">
               Expires:
               <card-expiry ref="cardExpiry" :stripe="stripe_key" />
            </FormField>

            <FormField class="col-2">
               CVC:
               <card-cvc ref="cardCvc" :stripe="stripe_key" />
            </FormField>

            <Button class="button--primary col-10--centered md::col-4--centered" type="submit" :disable="sending">Pay</Button>
         </section>
      </form>
      <aside class="layout__secondary">
         <ol class="step-counter">
            <li class="step-counter__item">Check your workspace</li>
            <li class="step-counter__item">Add your information</li>
            <li class="step-counter__item--current">Pay</li>
         </ol>
      </aside>
   </section>
</template>
