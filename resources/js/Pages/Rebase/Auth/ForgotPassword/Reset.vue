<script>
import Layout from "@/Templates/Rebase/Layout"
import passwordMeter from "vue-simple-password-meter"

export default {
   layout: Layout,
   metaInfo: { title: "Please Log In" },

   components: {
      passwordMeter,
   },

   props: {
      token: String,
      customer_id: String,
   },

   data: function () {
      return {
         sending: false,
         form: {
            email: null,
            password: null,
            password_confirmation: null,
            token: this.token,
         },
      }
   },

   methods: {
      submit() {
         this.$inertia.post(route("password.update", { customer_id: this.customer_id }), this.form, {
            onStart: () => (this.sending = true),
            onFinish: () => (this.sending = false),
         })
      },
   },
}
</script>

<template>
   <form class="grid" action="post" @submit.prevent="submit">
      <FormField validate="email" class="col-10--centered md::col-8--centered sm::col-6--centered">
         <FieldLabel>Your Email:</FieldLabel>
         <FormInput v-model="form.email" type="email" />
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

      <Button type="submit" :disable="sending" class="button col-10--centered md::col-2--centered">Reset Password</Button>
   </form>
</template>
