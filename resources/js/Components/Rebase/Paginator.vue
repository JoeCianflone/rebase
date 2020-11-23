<script>
export default {
   props: {
      links: Array,
   },
}
</script>

<template>
   <ul class="paginator">
      <li class="paginator--item" v-for="(link, key) in links">
         <div v-if="link.url === null" :key="key" v-html="link.label"></div>
         <inertia-link v-else :key="key" :class="[link.active ? 'paginator--link__active' : 'paginator--link']" :href="link.url" v-html="link.label"></inertia-link>
      </li>
   </ul>
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
</style>
