<script>
export default {
   components: {},

   data: function () {
      return {
         isOpen: false,
      }
   },

   created: function () {
      let vm = this
      window.addEventListener("resize", function () {
         vm.isOpen = false
      })
   },

   watch: {
      isOpen: function () {
         this.toggleNavigation()
      },
   },

   methods: {
      toggleNavigation() {
         let aside = document.querySelector(".js-sidebar")
         let nav = document.querySelector(".js-nav")

         aside.style.height = this.isOpen ? "100vh" : ""
         aside.style.zIndex = this.isOpen ? "12" : ""
         nav.style.display = this.isOpen ? "block" : ""
      },
   },
}
</script>

<template>
   <section>
      <Button class="button--icon nav-button js-button" @click="isOpen = !isOpen"><span class="material-icons">menu</span></Button>
      <nav class="navigation--main js-nav">
         <ul>
            <slot></slot>
         </ul>
      </nav>
   </section>
</template>

<style lang="scss" scoped>
@import "@@/abstract";

.nav-button {
   @media ($sm-and-up) {
      display: none;
   }
}

.navigation--main {
   display: none;
   font-size: var(--px-18);
   letter-spacing: var(--kerning-tighter);
   color: var(--color-trueGray-500);

   a {
      text-decoration: none;
      transition: 350ms all ease-in;
      border-bottom: 4px solid transparent;
      display: block;
      line-height: 0.85;
      padding: var(--px-24) 0 0 0;

      &:hover,
      &.selected {
         color: var(--color-trueGray-700);
         border-bottom: 4px solid var(--color-trueGray-400);
      }
   }

   @media ($sm-and-up) {
      display: block;
   }
}
</style>
