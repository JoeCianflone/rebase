<script>
import Sidebar from "./PageComponents/Sidebar"
import ActionMenu from "@/Components/Rebase/Actions/ActionMenu"
import ActionLink from "@/Components/Rebase/Actions/ActionLink"
import ActionButton from "@/Components/Rebase/Actions/ActionButton"

export default {
   props: {
      nav: String,
   },

   components: {
      Sidebar,
      ActionMenu,
      ActionLink,
      ActionButton,
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
               <ActionMenu>
                  <template v-slot:buttonText> <span class="material-icons">account_circle</span> {{ $page.props.auth.user.email }} <span class="material-icons">expand_more</span> </template>
                  <ActionLink :link="route('logout')">Profile</ActionLink>
                  <ActionLink :link="route('logout')">Switch Workspace</ActionLink>
                  <ActionLink :link="route('logout')">Logout</ActionLink>
               </ActionMenu>
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

$base-gap: var(--px-16);
$sidebar-width: 240px;
$headerbar-height: 40px;

.layout--main {
   column-gap: $base-gap;
   display: grid;
   grid-template-areas:
      "sidebar"
      "header"
      "main";
   grid-template-columns: 1fr;
   grid-template-rows: min($headerbar-height) min($headerbar-height) 1fr;
   height: 100vh;

   @media ($sm-and-up) {
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
      column-gap: $base-gap;
      padding: 0 var(--px-16);
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
      }

      .section-title {
         color: var(--color-coolGray-600);
         display: none;
         font-size: var(--px-18);

         @media ($sm-and-up) {
            display: block;
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

      @media ($sm-and-up) {
         padding-top: var(--px-60);
         padding-right: var(--px-16);
      }
   }

   aside {
      padding: 0 var(--px-16);
      background: var(--color-blueGray-800);
      grid-area: sidebar;

      @media ($sm-and-up) {
         padding-top: var(--px-60);
      }
   }
}
</style>
