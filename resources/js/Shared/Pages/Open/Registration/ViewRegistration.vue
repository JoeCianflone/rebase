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
         op: null,
         checkbox: [],
         checkbox2: ["22"],
         radio: "three",
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

         <FormFieldInline>
            <FormCheckbox :disable-after="1" value="11" v-model="form.checkbox">
               checkbox 1 - 1
            </FormCheckbox>
            <FormCheckbox :disable-after="1" value="21" v-model="form.checkbox">checkbox 2 - 1</FormCheckbox>
            <FormCheckbox :disable-after="1" value="31" v-model="form.checkbox">checkbox 3 - 1</FormCheckbox>
         </FormFieldInline>

         <FormFieldInline>
            <FormCheckbox :disable-after="2" value="12" v-model="form.checkbox2">
               checkbox 1 - 2
            </FormCheckbox>
            <FormCheckbox value="22" v-model="form.checkbox2">2checkbox 2 - 2 </FormCheckbox>
            <FormCheckbox :disable-after="2" value="32" v-model="form.checkbox2">checkbox 3 - 2</FormCheckbox>
         </FormFieldInline>

         <FormFieldInline>
            <FormRadio v-model="form.radio" value="one">Value Number 1</FormRadio>
            <FormRadio v-model="form.radio" value="two">Value Number 2</FormRadio>
            <FormRadio v-model="form.radio" value="three">Value Number 3</FormRadio>
         </FormFieldInline>

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
