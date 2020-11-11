<script>
import Sidebar from "./PageComponents/Sidebar"
import SecondaryNavigation from "./PageComponents/SecondaryNavigation"

export default {
   props: {
      nav: String,
   },

   components: {
      Sidebar,
      SecondaryNavigation,
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
            <div class="section-identity">
               <SecondaryNavigation />
            </div>
         </header>
         <main>
            <div class="content-container">
               <slot name="body"></slot>
            </div>
         </main>
         <aside class="js-sidebar">
            <Sidebar :nav="nav" />
         </aside>
      </div>
   </section>
</template>

<style lang="scss" scoped>
@import "@@/abstract";

$base-gap: var(--px-12);
$sidebar-width: 240px;
$headerbar-height: 50px;

.layout--main {
   column-gap: $base-gap;
   display: grid;
   grid-template-areas:
      "sidebar"
      "header"
      "main";
   grid-template-columns: 1fr;
   grid-template-rows: $headerbar-height $headerbar-height 1fr;
   height: 100vh;

   @media ($sm-and-up) {
      grid-template-areas:
         "header header"
         "sidebar main";
      grid-template-columns: $sidebar-width 1fr;
      grid-template-rows: $headerbar-height 1fr;
   }

   header {
      align-items: center;
      background: var(--color-coolGray-100);
      border-bottom: 1px solid #979797;
      box-shadow: 0 1px 3px 0 rgba(#000, 0.5);
      column-gap: $base-gap;
      display: grid;
      grid-area: header;
      grid-template-columns: 1fr 1fr;
      z-index: 10;

      @media ($sm-and-up) {
         grid-template-columns: $sidebar-width 2fr 1fr;
      }

      .site-logo {
         color: var(--color-coolGray-600);
         font-size: var(--px-24);
         padding: 0 var(--px-12);
      }

      .section-title {
         color: var(--color-coolGray-600);
         display: none;
         font-size: var(--px-18);
         padding: 0 var(--px-12);

         @media ($sm-and-up) {
            display: block;
         }
      }

      .section-identity {
         text-align: right;
         padding: 0 var(--px-12);
      }
   }

   main {
      -ms-overflow-style: none;
      grid-area: main;
      overflow: scroll;
      padding: var(--px-12);
      scrollbar-width: none;

      &::-webkit-scrollbar {
         display: none;
      }
   }

   aside {
      background: var(--color-coolGray-300);
      grid-area: sidebar;
      padding: var(--px-12);
   }
}
</style>
