<script>
export default {
   props: {
      links: Array,
   },
}
</script>

<template>
   <div class="grid--center">
      <div class="col-10 sm::col-9">
         <ul class="paginator">
            <li class="paginator--item" v-for="(link, key) in links">
               <div v-if="link.url === null" :key="key" v-html="link.label"></div>
               <inertia-link v-else :key="key" :class="[link.active ? 'paginator--link__active' : 'paginator--link']" :href="link.url" v-html="link.label"></inertia-link>
            </li>
         </ul>
      </div>
      <div class="col-10 sm::col-3">
         <div class="paginator--page-size">
            <h3 class="paginator--page-label">Show:</h3>
            <ul class="paginator--page-list">
               <li class="paginator--page-list-item"><inertia-link href="?count=10">10</inertia-link></li>
               <li class="paginator--page-list-item"><inertia-link href="?count=25">25</inertia-link></li>
               <li class="paginator--page-list-item"><inertia-link href="?count=50">50</inertia-link></li>
            </ul>
         </div>
      </div>
   </div>
</template>

<style lang="scss">
@import "@@/abstract";
.paginator {
   list-style-type: none;
   margin-top: var(--px-20);
   margin: var(--px-20) 0;
   padding: 0;
}
.paginator--item {
   display: inline-flex;
   margin: 0 var(--px-4);
}
.paginator--link {
   align-items: center;
   border: 1px solid var(--color-gray-300);
   display: flex;
   justify-content: center;
   padding: var(--px-8);
   text-decoration: none;
}
.paginator--link__active {
   align-items: center;
   background: var(--color-true-white);
   border: 1px solid var(--color-gray-300);
   display: flex;
   justify-content: center;
   padding: var(--px-8);
   text-decoration: none;
}

.paginator--view {
   list-style-type: none;
   margin-top: var(--px-20);
   margin: var(--px-20) 0;
   padding: 0;
}
.paginator--page-size {
   align-content: space-between;
   align-items: center;
   display: inline-flex;
   justify-content: end;
}
.paginator--page-list {
   list-style-type: none;
   text-decoration: none;
}

.paginator--page-label {
   padding-right: var(--px-8);
}

.paginator--page-list-item {
   align-items: center;
   border: 1px solid var(--color-gray-300);
   display: inline-flex;
   justify-content: center;
   padding: var(--px-8);
   text-decoration: none;
}
</style>
