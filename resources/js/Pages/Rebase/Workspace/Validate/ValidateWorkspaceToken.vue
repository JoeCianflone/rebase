<script>
import Layout from "@/Templates/Rebase/WorkspaceMain"

export default {
   layout: Layout,
   metaInfo: { title: "VerifyCustomer" },

   components: {},

   data: () => ({
      sending: false,
      form: {
         email: "",
         password: "",
         password_confirmation: "",
      },
   }),

   props: {
      token: String,
   },

   methods: {
      submit() {
         this.$inertia.post(route("validate.workspace.process", { token: this.token }), this.form, {
            onStart: () => (this.sending = true),
            onFinish: () => (this.sending = false),
         })
      },
   },
}
</script>

<template>
   <div>
      <form class="layout__main" action="post" @submit.prevent="submit">
         <section class="grid">
            <FormField class="col-10--centered md::col-6--centered" validate="email">
               <FieldLabel>Almost there, please enter your email address:</FieldLabel>
               <FormInput v-model="form.email" />
            </FormField>

            <FormField class="col-10--centered md::col-6--centered" validate="password">
               <FieldLabel>Password:</FieldLabel>
               <FormInput type="password" v-model="form.password" />
            </FormField>

            <FormField class="col-10--centered md::col-6--centered" validate="password_confirmation">
               <FieldLabel>Confirm your password:</FieldLabel>
               <FormInput type="password" v-model="form.password_confirmation" />
            </FormField>

            <Button class="button col-10--centered md::col-2--centered" type="submit" :disable="sending">Verify</Button>
         </section>
      </form>
   </div>
</template>
