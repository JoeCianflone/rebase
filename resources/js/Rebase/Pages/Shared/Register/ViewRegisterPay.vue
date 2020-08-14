<script>
import Layout from "@/Rebase/Templates/Open"

import { CardNumber, CardExpiry, CardCvc, createToken, handleCardSetup, createPaymentMethod } from "vue-stripe-elements-plus"

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
         number: false,
         expiry: false,
         cvc: false,
         form: {
            validatedName: this.name,
            validatedEmail: this.email,
            validatedSlug: this.slug,
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
         handleCardSetup(this.intent.client_secret).then(function (result) {
            this.form.payment_method = result.setupIntent.payment_method
            this.$inertia.post("/registration/pay", this.form)
         })
      },
   },
}
</script>

<template>
   <section class="layout">
      <form class="layout__main" action="post" @submit.prevent="pay">
         <section class="grid">
            <FormField validate="name" class="col-10--center md::col-8--center">
               What's your name:
               <FormText v-model="form.name" />
            </FormField>

            <FormField class="col-10--center md::col-8--center">
               Card Number:
               <card-number ref="cardNumber" :stripe="stripe_key" @change="number = $event.complete" />
            </FormField>

            <FormField class="col-8 col-at-2 md::col-6 md::col-at-3">
               Expires:
               <card-expiry ref="cardExpiry" :stripe="stripe_key" @change="expiry = $event.complete" />
            </FormField>

            <FormField class="col-2">
               CVC:
               <card-cvc ref="cardCvc" :stripe="stripe_key" @change="cvc = $event.complete" />
            </FormField>

            <Button class="button--primary col-10--center md::col-4--center" type="submit" :sending="sending">Pay</Button>
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
