<script>
import Dropdown from "@/Components/Rebase/Dropdown"

export default {
   name: "ActionMenu",
   inheritAttrs: false,
   components: { Dropdown },
}
</script>

<template>
   <Dropdown>
      <slot name="buttonText">
         <span class="material-icons">more_horiz</span>
      </slot>
      <template v-slot:dropdown>
         <ul class="navigation--actions">
            <slot></slot>
         </ul>
      </template>
   </Dropdown>
</template>

<style lang="scss">
@import "@@/abstract";

.navigation--actions {
   list-style-type: none;
   margin: 0;
   padding: 0;

   li {
      border-bottom: 1px solid var(--color-gray-200);
      margin: 0;

      a,
      button {
         width: 100%;
         background: none;
         border: none;
         border-radius: 0;
         display: flex;
         text-decoration: none;
         padding: var(--px-12) var(--px-24);
         font-size: var(--px-18);
         line-height: var(--leading-tight);

         &:hover {
            background: var(--color-blueGray-100);
         }
      }
   }
}
</style>
