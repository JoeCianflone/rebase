<script>
import Layout from "@/Rebase/Templates/Open"

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
         slug: null,
      },
   }),

   methods: {
      send() {
         this.$inertia.post("registration", this.form)
      },
   },
}
</script>

<template>
   <form action="post" @prevent.submit="send">
      <legend>First, what do you want to name your website?</legend>

      <FormField validate="slug">
         <FormGroup>
            <FormText v-model="form.slug" :slugify="true" />
            <template v-slot:post>
               .rebase.test
            </template>
         </FormGroup>
      </FormField>
      <p v-if="form.slug">
         <small>Your web address will be {{ form.slug }}.rebase.test</small>
      </p>

      <FormField validate="name">
         What's your name?
         <FormText v-model="form.name" />
      </FormField>

      <FormField validate="email">
         What's your email address?
         <FormText v-model="form.email" type="email" />
      </FormField>

      <FormField validate="password">
         Please set a password
         <FormText v-model="form.password" type="password" />
      </FormField>
      <button class="button--primary">Next</button>

      <ol>
         <li>Whats the name of their company/team</li>
         <li>Slugify their company/team name and give them the option to edit it</li>
         <li>Get the users name, email, and password</li>
         <li>Take payment</li>
         <li>If payment goes through spin up new account -- send welcome email</li>
         <li>If payment does not go through kick them back</li>
         <li>Send user to their example.foo.com subdomain have them log in</li>
      </ol>
   </form>
</template>
