<script>
import MainNavigation from "./MainNavigation"

export default {
   components: {
      MainNavigation,
   },
   props: {
      nav: String,
   },
}
</script>

<template>
   <section>
      <MainNavigation> </MainNavigation>
   </section>
</template>

<style lang="scss" scoped>
@import "@@/abstract";
</style>
