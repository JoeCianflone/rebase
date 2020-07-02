<script>
export default {
   name: "toast",

   components: {},

   props: {
      title: {
         type: String,
      },
      message: {
         type: String,
      },
      type: {
         type: String,
         default: "general",
      },
      listing: {
         type: Object | Array,
         default: () => [],
      },
   },

   data: () => ({}),

   methods: {},
}
</script>

<template v-if="title || message || listing.length">
   <div class="toast" :class="type">
      <h2 v-if="title">{{ title }}</h2>
      <p v-if="message">{{ message }}</p>
      <ul v-for="(item, key) in listing" :key="key">
         <li>{{ item }}</li>
      </ul>
   </div>
</template>

<style lang="scss"></style>
