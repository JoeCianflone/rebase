<script>
import Layout from "@/Templates/Rebase/Layout"
import Simple from "@/Templates/Rebase/Page/Simple"
import ActionMenu from "@/Components/Rebase/Actions/ActionMenu"
import ActionLink from "@/Components/Rebase/Actions/ActionLink"
import ActionButton from "@/Components/Rebase/Actions/ActionButton"

export default {
   layout: Layout,
   metaInfo: { title: "Pick a Workspace" },

   components: {
      Simple,
      ActionMenu,
      ActionLink,
      ActionButton,
   },

   props: {
      workspaces: Array,
   },

   data: function () {
      return {
         sending: false,
      }
   },

   methods: {},
}
</script>

<template>
   <Simple>
      <template #header>Switch Workspaces</template>
      <template v-slot:body>
         <div class="grid">
            <div class="col-10--centered">
               <h1 class="display-1">Pick a Workspace</h1>
               <p class="lead">Pick a workspace and we'll take you there. If you need to switch over to another workspace later on, you can come back here and switch.</p>
               <ul class="workspace-picker">
                  <li v-for="workspace in workspaces" :key="workspace.id">
                     <a class="workspace-picker--item" :href="`//${workspace.slug}.rebase.test/dashboard`">{{ workspace.name }}</a>
                  </li>
               </ul>
            </div>
         </div>
      </template>
   </Simple>
</template>

<style lang="scss" scoped>
.workspace-picker {
   list-style-type: none;
   text-align: center;
   font-size: var(--px-24);
   line-height: 1;
}
.workspace-picker--item {
   padding: var(--px-24) 0;
   display: flex;
   justify-content: center;
}
</style>
