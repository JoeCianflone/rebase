<script>
export default {
   props: {
      nav: String,
   },

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
      <div class="layout--main">
         <header>
            <h1 class="site-logo">REBASE</h1>
            <div class="section-title">
               <slot name="header"></slot>
            </div>
            <nav class="navigation--secondary">
               <ul>
                  <li><inertia-link :href="route('logout')">Logout</inertia-link></li>
               </ul>
            </nav>
         </header>
         <main>
            <div class="content-container">
               <slot name="body"></slot>
            </div>
         </main>
         <aside class="js-sidebar">
            <Button class="button--icon nav-button js-button" @click="isOpen = !isOpen"><span class="material-icons">menu</span></Button>
            <nav class="navigation--main js-nav">
               <ul>
                  <li><inertia-link :href="route('dashboard')" :class="{ selected: this.nav === 'dashboard' }">Dashboard</inertia-link></li>
                  <li><inertia-link href="#">Manage Members</inertia-link></li>
                  <li><inertia-link href="#">Manage Workspaces</inertia-link></li>
               </ul>
               <ul>
                  <li><inertia-link href="#">Billing</inertia-link></li>
                  <li><inertia-link href="#">Manage Custom URL</inertia-link></li>
               </ul>
            </nav>
            <nav class="navigation--secondary">
               <ul>
                  <li><inertia-link :href="route('logout')">Logout</inertia-link></li>
               </ul>
            </nav>
         </aside>
      </div>
   </section>
</template>

<style lang="scss" scoped>
@import "@@/abstract";

.layout--main {
   display: grid;
   column-gap: var(--px-12);
   grid-template-rows: 50px 50px 1fr;
   grid-template-columns: 240px 1fr;
   height: 100vh;
   grid-template-areas:
      "sidebar sidebar"
      "header header"
      "main main";

   @media ($sm-and-up) {
      grid-template-rows: 50px 1fr;
      grid-template-areas:
         "header header"
         "sidebar main";
   }

   header {
      grid-area: header;
      display: grid;
      align-items: center;
      column-gap: var(--px-12);
      border-bottom: 1px solid #979797;
      background: var(--color-coolGray-100);
      box-shadow: 0 1px 3px 0 rgba(#000, 0.5);
      z-index: 10;
      grid-template-columns: 1fr;

      @media ($sm-and-up) {
         grid-template-columns: 240px 2fr 1fr;
      }

      .site-logo {
         color: var(--color-coolGray-600);
         font-size: var(--px-24);
         padding: 0 var(--px-12);
         text-align: center;

         @media ($sm-and-up) {
            text-align: left;
         }
      }

      .section-title {
         padding: 0 var(--px-12);
         font-size: var(--px-18);
         color: var(--color-coolGray-600);
         display: none;

         @media ($sm-and-up) {
            display: block;
         }
      }

      .navigation--secondary {
         display: none;
         font-size: var(--px-14);
         padding: 0 var(--px-12);
         text-align: right;
         margin-top: 0;
         @media ($sm-and-up) {
            display: block;
         }
      }
   }

   main {
      grid-area: main;
      overflow: scroll;
      scrollbar-width: none;
      -ms-overflow-style: none;
      padding: var(--px-12);

      &::-webkit-scrollbar {
         display: none;
      }
   }

   .content-container {
      height: 1000vh;
   }

   aside {
      grid-area: sidebar;
      background: var(--color-coolGray-300);
      padding: var(--px-12);
   }

   .navigation--secondary {
      color: var(--color-coolGray-600);
      margin-top: var(--px-40);
      @media ($sm-and-up) {
         display: none;
      }
      a {
         text-decoration: none;
         &:hover {
            color: var(--color-coolGray-800);
            text-decoration: underline;
         }
      }
   }

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
}
</style>
