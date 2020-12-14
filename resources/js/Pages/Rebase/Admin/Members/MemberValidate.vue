<script>
import Layout from "@/Templates/Rebase/Layout"
import passwordMeter from "vue-simple-password-meter"
import Register from "@/Templates/Rebase/Page/Register"

export default {
   layout: Layout,
   metaInfo: { title: "Validate" },

   components: {
      Register,
      passwordMeter,
   },

   props: {
      customerID: String,
      memberID: String,
      token: String,
   },
   data() {
      return {
         sending: false,
         form: {
            email: null,
            password: null,
            password_confirmation: null,
            token: this.token,
            memberID: this.memberID,
            customerID: this.customerID,
         },
      }
   },

   methods: {
      submit() {
         this.$inertia.post(
            route("member.verify", {
               customerID: this.customerID,
               memberID: this.memberID,
               token: this.token,
            }),
            this.form,
            {
               onStart: () => (this.sending = true),
               onFinish: () => (this.sending = false),
            }
         )
      },
   },
}
</script>

<template>
   <Register>
      <form class="layout__main" action="post" @submit.prevent="submit">
         <section class="grid">
            <FormField class="col-10--centered md::col-8--centered sm::col-6--centered" validate="email">
               <FieldLabel>What's your email address?</FieldLabel>
               <FormInput v-model="form.email" />
            </FormField>
            <FormField class="col-10--centered md::col-8--centered sm::col-6--centered" validate="password">
               <FieldLabel>Set a Password</FieldLabel>
               <FormInput v-model="form.password" type="password" />
               <password-meter :password="form.password" />
            </FormField>
            <div class="col-10--centered md::col-8--centered sm::col-6--centered">
               <small>
                  <p>Passwords must be 12 characters long and contain:</p>
                  <ul>
                     <li>English uppercase and lowercase characters (A – Z)</li>
                     <li>have at least 1 special character (Example: ! @ # $ % ^)</li>
                     <li>have at least 1 number 0 - 9</li>
                  </ul>
               </small>
            </div>
            <FormField class="col-10--centered md::col-8--centered sm::col-6--centered" validate="password_confirmation">
               <FieldLabel>Type it Again</FieldLabel>
               <FormInput v-model="form.password_confirmation" type="password" />
            </FormField>
            <Button class="col-10--centered md::col-8--centered sm::col-6--centered button:block" type="submit" :disable="sending">Confirm</Button>
         </section>
      </form>
   </Register>
</template>
