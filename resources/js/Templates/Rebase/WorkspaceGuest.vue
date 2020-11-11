<script>
import Toast from "@/Components/Rebase/Toast/Toast"

export default {
   components: {
      Toast,
   },

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
      <Toast :flash="$page.props.flash" />
      <slot></slot>
   </section>
</template>
