<script>
import Layout from "@/Rebase/Templates/Primary"

export default {
   layout: Layout,
   metaInfo: { title: "ViewDesign" },

   components: {},

   data: () => ({
      form: {
         id: 1,
         name: "",
         email: "",
         checkbox: [],
         checkbox2: [],
      },
   }),

   props: {},

   methods: {
      test() {
         this.$inertia.post("/", this.form).then(() => (this.sending = false))
      },
   },
}
</script>

<template>
   <form action="post" @submit.prevent="test">
      <fieldset>
         <legend>Please Register Your Account</legend>

         <h2>Registration Workflow</h2>

         <FormField validate="name">
            Hi there this is a label for my form name:
            <FormInput v-model="form.name" type="text" :slugify="true" />
         </FormField>

         <FormFieldInline validate="checkbox">
            <FormCheckbox :disable-after="1" value="11" v-model="form.checkbox">
               checkbox 1 - 1
            </FormCheckbox>
            <FormCheckbox :disable-after="1" value="21" v-model="form.checkbox">checkbox 2 - 1</FormCheckbox>
            <FormCheckbox :disable-after="1" value="31" v-model="form.checkbox">checkbox 3 - 1</FormCheckbox>
         </FormFieldInline>

         <FormFieldInline validate="checkbox2">
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

         <FormField validate="field">
            <FormGroup class="-pre -post">
               <template v-slot:pre>
                  $
               </template>
               <FormInput v-model="form.field" />
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

         <Button icon="user" class="button--primary" type="submit">Submit This Shit</Button>
         <Button class="button--secondary">Just a button</Button>
      </fieldset>
   </form>
</template>
