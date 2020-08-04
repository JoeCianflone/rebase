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
      <FormField validate="slug">
         What's your workspace name:
         <FormGroup>
            <FormText v-model="form.slug" :slugify="true" />
            <template v-slot:post>
               .rebase.test
            </template>
         </FormGroup>
      </FormField>
      <p v-if="form.slug">
         <small>{{ form.slug }}.rebase.test</small>
      </p>
      <Button class="button--primary" type="submit">Let's Go</Button>
   </form>
</template>
