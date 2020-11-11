<script>
import Layout from "@/Templates/Rebase/WorkspaceGuest"

export default {
   layout: Layout,
   metaInfo: { title: "Please Log In" },

   components: {},

   props: {
      tokenEmail: String,
      token: String,
   },

   data: function () {
      return {
         sending: false,
         form: {
            email: this.tokenEmail,
            password: "",
            password_confirmation: "",
            token: this.token,
         },
      }
   },

   methods: {
      submit() {
         this.$inertia.post(route("password.update"), this.form, {
            onStart: () => (this.sending = true),
            onFinish: () => (this.sending = false),
         })
      },
   },
}
</script>

<template>
   <form class="grid" action="post" @submit.prevent="submit">
      <FormField validate="email" class="col-10--centered md::col-8--centered">
         <FieldLabel>Your Email:</FieldLabel>
         <FormInput v-model="form.email" type="email" readonly />
      </FormField>

      <FormField validate="password" class="col-10--centered md::col-8--centered">
         <FieldLabel>What's your password:</FieldLabel>
         <FormInput v-model="form.password" type="password" />
      </FormField>

      <FormField validate="password_confirmation" class="col-10--centered md::col-8--centered">
         <FieldLabel>Please type your password again:</FieldLabel>
         <FormInput v-model="form.password_confirmation" type="password" />
      </FormField>

      <Button type="submit" :disable="sending" class="button col-10--centered md::col-2--centered">Reset Password</Button>
   </form>
</template>
