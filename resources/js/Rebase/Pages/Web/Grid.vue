<script>
import Layout from "@/Rebase/Templates/WorkspaceMain"

export default {
   layout: Layout,
   metaInfo: { title: "Grid Test" },
   data: () => ({
      counter: 0,
      gridRows: [],
      form: {},
   }),
   methods: {
      addRow(colSize) {
         this.gridRows.push({
            name: "grid",
            cols: colSize,
            locked: false,
         })
      },
      lock(col) {
         this.gridRows[col].locked = !this.gridRows[col].locked
      },
      remove(col) {
         this.gridRows.splice(col, 1)
      },
   },
}
</script>

<template>
   <div>
      <section class="template-page">
         <div class="area" v-for="(row, key) in gridRows" :key="key">
            <div class="grid" :class="{ 'grid-locked': row.locked }">
               <div class="col-12" v-for="(colWidth, colKey) in row.cols" :class="`md::col-${colWidth}`" :key="`row-${key}-col-${colKey}`"></div>
            </div>
            <div class="button-overlay">
               <button class="button" @click="lock(key)">
                  <span v-if="row.locked">Unlock</span>
                  <span v-else>Lock</span>
                  Content</button
               >&nbsp;
               <button class="button" @click="remove(key)">Remove</button>
            </div>
         </div>
      </section>

      <button class="button js-add-row-button" @click="addRow([12])">Add 1x12 Row</button>
      <button class="button js-add-row-button" @click="addRow([6, 6])">Add 6x6 Row</button>
      <button class="button js-add-row-button" @click="addRow([4, 8])">Add 4x8 Row</button>
      <button class="button js-add-row-button" @click="addRow([8, 4])">Add 8x4 Row</button>
      <button class="button js-add-row-button" @click="addRow([3, 3, 3, 3])">Add 3x3x3x3 Row</button>
      <button class="button js-add-row-button" @click="addRow([4, 4, 4])">Add 4x4x4 Row</button>
   </div>
</template>

<style lang="scss">
.template-grid {
   display: none;
}
.template-page {
   display: flex;
   flex-direction: column;
   width: 100vw;

   .grid {
      margin: 8px auto;

      &.grid-locked {
         @media (min-width: 640px) {
            width: 80%;
         }
      }
   }

   .area {
      position: relative;

      &:hover .button-overlay {
         display: flex;
      }
   }

   .button-overlay {
      background: rgba(0, 0, 0, 0.4);
      position: absolute;
      top: 0;
      right: 0;
      bottom: 0;
      left: 0;
      display: none;
      justify-content: center;
      align-items: center;
   }

   @for $col from 1 through 12 {
      .col-#{$col} {
         border: 1px dashed #444;
         min-height: 64px;
         background: #ccc;
      }
   }
}
</style>
