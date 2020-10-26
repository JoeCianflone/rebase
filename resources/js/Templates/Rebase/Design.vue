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
   <section class="design-page">
      <main class="page-main">
         <div class="page-main--content">
            <slot />
         </div>
      </main>
      <aside class="page-sidebar">
         <nav>
            <inertia-link href="/design">Home</inertia-link>
            <h1>Foundation</h1>
            <ul>
               <li><inertia-link href="/design/colors">Colors</inertia-link></li>
               <li><inertia-link href="/design/layout">Layout</inertia-link></li>
               <li><inertia-link href="/design/spacing">Spacing</inertia-link></li>
               <li><a href="#">Typography</a></li>
            </ul>
            <h1>Components</h1>
            <ul>
               <li><a href="#">Buttons</a></li>
               <li><a href="#">Errors</a></li>
               <li><a href="#">Form Elements</a></li>
               <li><a href="#">Overlays</a></li>
               <li><a href="#">Tables</a></li>
               <li><a href="#">Toasts</a></li>
            </ul>
         </nav>
      </aside>
   </section>
</template>

<style lang="scss" scoped>
.design-page {
   display: grid;
   grid-template-columns: minmax(200px, 20vw) 1fr;
   grid-template-rows: auto;
   grid-template-areas: "sidebar main";
   min-height: 100vh;
   grid-gap: 1.2em 1.2em;
   overflow: hidden;
}

.page-main {
   overflow: hidden;
   height: 100vh;

   &--content {
      overflow: scroll;
      height: 100vh;
   }
}

.page-sidebar {
   background-color: #ccc;
   border-right: 1px solid #aaa;
   grid-area: sidebar;
}
</style>
