<script>
import Logo from "./Components/Logo"
import WorkspaceSidebar from "./Components/WorkspaceSidebar"
import IdentityNavigation from "./Components/IdentityNavigation"

export default {
   props: {
      nav: String,
   },

   components: {
      WorkspaceSidebar,
      Logo,
      IdentityNavigation,
   },
}
</script>

<template>
   <section>
      <div class="layout--main">
         <header>
            <Logo />
            <div class="section-title">
               <slot name="header"></slot>
            </div>
            <div class="section-identity">
               <IdentityNavigation></IdentityNavigation>
            </div>
         </header>
         <main>
            <div class="content-container">
               <slot name="body"></slot>
            </div>
         </main>
         <aside class="js-sidebar">
            <WorkspaceSidebar :nav="nav" />
         </aside>
      </div>
   </section>
</template>

<style lang="scss" scoped>
@import "@@/abstract";

$sidebar-width: 240px;
$headerbar-height: 40px;

.layout--main {
   column-gap: var(--px-16);
   display: grid;
   grid-template-areas:
      "sidebar"
      "header"
      "main";
   grid-template-columns: 1fr;
   grid-template-rows: min($headerbar-height) min($headerbar-height) 1fr;
   height: 100vh;

   @media ($md-and-up) {
      grid-template-areas:
         "header header"
         "sidebar main";
      grid-template-columns: $sidebar-width 1fr;
      grid-template-rows: min($headerbar-height) 1fr;
   }

   header {
      align-items: center;
      align-content: center;
      background: var(--color-true-white);
      border-bottom: 3px solid var(--color-blueGray-300);
      column-gap: var(--px-16);
      padding: 0 var(--px-16);
      display: grid;
      grid-area: header;
      grid-template-columns: 1fr 1fr;
      z-index: 10;

      @media ($md-and-up) {
         grid-template-columns: $sidebar-width 2fr $sidebar-width;
      }
      .section-title {
         color: var(--color-coolGray-600);
         display: none;
         font-size: var(--px-18);

         @media ($md-and-up) {
            display: block;
            text-align: center;
         }
      }

      .section-identity {
         text-align: right;
      }
   }

   main {
      padding: 0;
      -ms-overflow-style: none;
      grid-area: main;
      overflow: scroll;
      scrollbar-width: none;

      &::-webkit-scrollbar {
         display: none;
      }

      @media ($md-and-up) {
         padding-top: var(--px-60);
         padding-right: var(--px-16);
      }
   }

   aside {
      padding: 0 var(--px-16);
      background: var(--color-blueGray-800);
      grid-area: sidebar;

      @media ($md-and-up) {
         padding-top: var(--px-60);
      }
   }
}
</style>
