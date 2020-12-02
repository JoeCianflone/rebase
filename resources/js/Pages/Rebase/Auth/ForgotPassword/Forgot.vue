<script>
import Layout from "@/Templates/Rebase/Layout"

export default {
   layout: Layout,
   metaInfo: { title: "Please Log In" },

   components: {},

   data: () => ({
      sending: false,
      form: {
         email: "",
      },
   }),

   methods: {
      submit() {
         this.$inertia.post(route("password.email"), this.form, {
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
      <Button type="submit" :disable="sending" class="button col-10--centered md::col-2--centered">Reset Password</Button>
      <div class="col-10--centered md::col-8--centered text--column:center">
         <inertia-link :href="route('signin')">Go Back</inertia-link>
      </div>
   </form>
</template>
