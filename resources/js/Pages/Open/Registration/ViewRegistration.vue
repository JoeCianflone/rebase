<script>
import Layout from "@/Templates/Public"
import RebaseInput from "@/Components/Form/RebaseInput"
import RebaseFormItem from "@/Components/Form/RebaseFormItem"
import Toast from "@/Components/Toast"

export default {
   layout: Layout,
   metaInfo: { title: "Please Register" },

   components: {
      RebaseInput,
      RebaseFormItem,
      Toast,
   },

   props: {
      errors: Object,
      alerts: Object,
   },

   data: () => ({
      sending: true,
      form: {},
   }),

   methods: {
      send() {
         console.log(this.form)
      },
   },
}
</script>

<template>
   <form action="post" @submit.prevent>
      <fieldset>
         <legend>Please Register Your Account</legend>

         <h2>Registration Workflow</h2>

         <ol>
            <li>Whats the name of their company/team</li>
            <li>Slugify their company/team name and give them the option to edit it</li>
            <li>Get the users name, email, and password</li>
            <li>Take payment</li>
            <li>If payment goes through spin up new account -- send welcome email</li>
            <li>If payment does not go through kick them back</li>
            <li>Send user to their example.foo.com subdomain have them log in</li>
         </ol>
      </fieldset>
   </form>
</template>

<style lang="scss"></style>
