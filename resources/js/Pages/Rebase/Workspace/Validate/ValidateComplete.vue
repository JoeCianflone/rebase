<script>
import Layout from "@/Templates/Rebase/Layout"

export default {
   layout: Layout,
   metaInfo: { title: "Validation is Complete" },

   components: {},

   data: () => ({
      sending: false,
      form: {},
   }),
}
</script>

<template>
   <section class="grid">
      <h1 class="col-10--centered">Thanks you are good now</h1>
   </section>
</template>
