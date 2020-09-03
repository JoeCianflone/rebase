<script>
import Layout from "@/Rebase/Templates/Open"
import { states } from "@/Rebase/consts"

export default {
   layout: Layout,
   metaInfo: { title: "Register Part 2" },

   components: {},
   remember: "form",

   data: function () {
      return {
         sending: false,
         showAddress: false,
         states: states,
         form: {
            name: null,
            email: null,
            business_name: null,
            is_business: "",
            address_line1: null,
            address_line2: null,
            address_line3: null,
            unit_number: null,
            city: null,
            state: null,
            postal_code: null,
         },
      }
   },

   props: {
      slug: String,
   },
   computed: {},
   methods: {
      test() {
         this.sending = true
         this.$inertia.post("/register/user", this.form).then(() => (this.sending = false))
      },
   },
}
</script>

<template>
   <section class="layout">
      <form class="layout__main" action="post" @submit.prevent="test">
         <section class="grid">Thanks!</section>
      </form>
      <aside class="layout__secondary">
         <ol class="step-counter">
            <li class="step-counter__item">Check your workspace</li>
            <li class="step-counter__item">Add your information</li>
            <li class="step-counter__item">Pay</li>
         </ol>
      </aside>
   </section>
</template>
