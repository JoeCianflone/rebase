<script>
import Paginator from "@/Components/Rebase/Paginator"

export default {
   components: {
      Paginator,
   },
   props: {
      links: Array,
   },
}
</script>

<template>
   <section>
      <table class="table--data">
         <thead>
            <tr>
               <slot name="dataHeader" />
            </tr>
         </thead>
         <tbody>
            <slot name="dataBody" />
         </tbody>
      </table>
      <Paginator :links="links" />
   </section>
</template>

<style lang="scss">
@import "@@/abstract";

.table--data {
   border: 1px solid var(--color-gray-200);
   width: 100%;

   thead,
   tbody {
      border-bottom: 2px solid var(--color-gray-200);
      font-size: var(--px-14);
   }

   thead {
      display: none;

      @media ($sm-and-up) {
         background: var(--color-true-white);
         display: table-header-group;
      }
   }

   td,
   th {
      font-size: var(--px-18);
      padding: var(--px-12);
   }

   tbody {
      tr {
         background: var(--color-true-white);
         display: flex;
         flex-wrap: wrap;
         justify-content: space-between;

         &:nth-of-type(2n + 1) {
            background: var(--color-blueGray-50);
         }

         &:hover {
            background: var(--color-yellow-50);
         }

         @media ($sm-and-up) {
            display: table-row;
         }
      }

      td {
         width: 100%;

         @media ($sm-and-up) {
            width: auto;
         }
      }
   }
}
</style>
