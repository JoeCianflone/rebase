<script>
export default {
   components: {},
   data: () => ({}),
   methods: {
      url() {
         return location.pathname.substr(1)
      },
   },
}
</script>

<template>
   <section>
      <portal-target name="dropdown" slim />
      <portal-target name="overlay" slim />

      <slot></slot>
   </section>
</template>
