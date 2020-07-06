<script>
import Layout from "@/Shared/Templates/Open"

export default {
   layout: Layout,
   metaInfo: { title: "Please Register" },

   components: {},

   props: {
      errors: Object,
      alerts: Object,
   },

   data: () => ({
      sending: true,
      form: {
         name: null,
         op: "",
      },
   }),

   methods: {
      send() {
         console.log("SENDING")
      },
   },
}
</script>

<template>
   <form action="post" @submit.prevent="send">
      <fieldset>
         <legend>Please Register Your Account</legend>

         <h2>Registration Workflow</h2>

         <FormField>
            Hi there this is a label for my form name:
            <FormText v-model="form.name" type="text" :slugify="true" />
         </FormField>

         <FormField>
            <FormGroup class="-pre -post">
               <template v-slot:pre>
                  $
               </template>
               <FormText v-model="form.name" />
               <template v-slot:post>
                  .00
               </template>
            </FormGroup>
         </FormField>

         <FormField :errors="$page.errors.options">
            Please Select From One of the Following:
            <FormSelect v-model="form.op" defaultText="Select an Option" :options="['A', 'B', 'C']" />
         </FormField>

         <FormField>
            Give us a Message:
            <FormTextArea v-model="form.message" rows="5" />
         </FormField>

         <Button icon="user" class="-primary" type="submit">Submit This Shit</Button>
         <Button class="-secondary">Just a button</Button>
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
