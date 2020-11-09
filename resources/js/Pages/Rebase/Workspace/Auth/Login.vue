<script>
import Layout from "@/Templates/Rebase/WorkspaceMain"

export default {
   layout: Layout,
   metaInfo: { title: "Please Log In" },

   components: {},

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
         this.$inertia.post(route("login.process"), this.form, {
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
      <Button type="submit" class="button col-10--centered md::col-2--centered">Log In</Button>
      <div class="col-10--centered md::col-8--centered text--column:center">
         <a href="#">Forgot Password?</a>
      </div>
   </form>
</template>
