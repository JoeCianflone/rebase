<script>
import Paginator from "@/Components/Rebase/Paginator"
import mapValues from "lodash/mapValues"
import pickBy from "lodash/pickBy"
import throttle from "lodash/throttle"

export default {
   data: function () {
      return {
         form: {
            s: null,
         },
      }
   },
   watch: {
      form: {
         handler: throttle(function () {
            let query = pickBy(this.form)
            this.$inertia.replace(this.route("members", Object.keys(query).length ? query : {}))
         }, 150),
         deep: true,
      },
   },
   methods: {
      reset() {
         this.form = mapValues(this.form, () => null)
      },
   },
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
      <form class="grid search-bar" action="get">
         <FormFieldInline class="col-6">
            <FieldLabel>Search:</FieldLabel>
            <FormInput v-model="form.s" />
         </FormFieldInline>
         <div class="col-6 text--column:start">
            <Button class="button--link:inline" @click="reset">Reset</Button>
         </div>
      </form>
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

.search-bar {
   padding-bottom: var(--px-20);
}
</style>
