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
   color: var(--color-blueGray-400);
   @media ($sm-and-up) {
      display: none;
   }
}

.navigation--main {
   display: none;
   font-size: var(--px-16);
   letter-spacing: var(--kerning-tighter);
   color: var(--color-blueGray-400);

   a {
      text-decoration: none;
      transition: 350ms all ease-in;
      display: block;
      line-height: 3;

      &:hover,
      &.selected {
         color: var(--color-blueGray-100);
      }
   }

   @media ($sm-and-up) {
      display: block;
   }
}
</style>
