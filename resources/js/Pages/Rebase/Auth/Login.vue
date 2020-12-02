<script>
import Layout from "@/Templates/Rebase/Layout"

export default {
   layout: Layout,
   metaInfo: { title: "Please Log In" },

   components: {},

   props: {
      to: {
         type: String,
         default: null,
      },
      customer_id: {
         type: String,
         default: null,
      },
   },

   data: () => ({
      sending: false,
      form: {
         email: "",
         password: "",
         remember: false,
      },
   }),

   methods: {
      submit() {
         let params = new URLSearchParams({
            to: this.to,
            customer_id: this.customer_id,
         }).toString()

         this.$inertia.post(`login?${params}`, this.form, {
            onStart: () => (this.sending = true),
            onFinish: () => (this.sending = false),
         })
      },
   },
}
</script>

<template>
   <form class="grid" action="post" @submit.prevent="submit">
      <h1 class="col-10--centered md::col-8--centered">Please Log In</h1>
      <FormField validate="email" class="col-10--centered md::col-8--centered">
         <FieldLabel>What's your email address:</FieldLabel>
         <FormInput v-model="form.email" type="email" />
      </FormField>
      <FormField validate="password" class="col-10--centered md::col-8--centered">
         <FieldLabel>What's your password:</FieldLabel>
         <FormInput v-model="form.password" type="password" />
      </FormField>
      <FormField class="col-10--centered md::col-8--centered text--column:end">
         <FormCheckbox v-model="form.remember">Remember Me</FormCheckbox>
      </FormField>
      <Button type="submit" :disable="sending" class="button col-10--centered md::col-2--centered">Log In</Button>
      <div class="col-10--centered md::col-8--centered text--column:center">
         <inertia-link :href="route('password.request')">Forgot Password?</inertia-link>
      </div>
   </form>
</template>
