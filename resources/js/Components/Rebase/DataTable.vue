<script>
export default {
   props: {},
}
</script>

<template>
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
</template>

<style lang="scss">
@import "@@/abstract";

.table--data {
   background: var(--color-true-white);
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
         display: table-header-group;
      }
   }

   td,
   th {
      font-size: var(--px-18);
      padding: var(--px-12);
   }

   tr:nth-of-type(2n + 1) td {
      background: var(--color-blueGray-100);
   }

   tbody {
      tr {
         display: flex;
         flex-wrap: wrap;
         justify-content: space-between;

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
