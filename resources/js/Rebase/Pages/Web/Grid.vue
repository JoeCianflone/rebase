<script>
import Layout from "@/Rebase/Templates/WorkspaceMain"
import Editor from "@/Rebase/Components/Form/Editor"

export default {
   layout: Layout,
   metaInfo: { title: "Grid Test" },
   components: {
      Editor,
   },
   data: () => ({
      reorder: false,
      dragging: {
         elKey: null,
         el: null,
         tempKey: null,
         tempEl: null,
      },
      counter: -1,
      gridRows: [
         {
            name: "grid",
            cols: [12],
            locked: false,
         },
      ],
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
      toggleReorder() {
         this.reorder = !this.reorder
      },
      lock(col) {
         this.gridRows[col].locked = !this.gridRows[col].locked
      },
      remove(col) {
         this.gridRows.splice(col, 1)
      },

      start(e, key) {
         e.srcElement.style.opacity = "0.4"
         e.dataTransfer.effectAllowed = "move"
         this.dragging.elKey = key
         this.counter = key
         this.dragging.el = this.gridRows[key]

         this.setTemp(key)
      },
      end(e, key) {
         e.preventDefault()
         e.srcElement.style.opacity = 1
         let lastOver = document.querySelector(".over")
         if (lastOver) {
            lastOver.classList.remove("over")
         }
      },
      over(e, key) {
         if (this.counter !== key) {
            this.counter = key
            let lastOver = document.querySelector(".over")
            if (lastOver) {
               lastOver.classList.remove("over")
            }
            e.currentTarget.classList.add("over")
         }

         e.preventDefault()
      },
      dropAt(e, key) {
         let lastOver = document.querySelector(".over")
         if (lastOver) {
            lastOver.classList.remove("over")
         }
         this.arrayRemove(this.dragging.tempKey)
         this.arrayInsert(key, this.dragging.el)
      },

      setTemp(key) {
         this.dragging.tempKey = key
         this.dragging.tempEl = this.gridRows[key]
      },
      arrayInsert(key, item) {
         this.gridRows.splice(key, 0, item)
      },
      arrayRemove(key) {
         this.gridRows.splice(key, 1)
      },
   },
}
</script>

<template>
   <div>
      <button @click="toggleReorder">
         <span v-if="!reorder">Reorder</span>
         <span v-else>Lock</span> Rows
      </button>
      <section class="template-page">
         <div class="area" v-for="(row, key) in gridRows" :key="key">
            <div class="grid" :class="{ 'grid-locked': row.locked }" :data-row="key" :draggable="reorder" @dragstart="start($event, key)" @dragend="end($event, key)" @dragover="over($event, key)" @drop="dropAt($event, key)">
               <div class="col-12" v-for="(colWidth, colKey) in row.cols" :class="`md::col-${colWidth}`" :key="`row-${key}-col-${colKey}`">
                  <Editor />
               </div>
            </div>
            <div class="button-overlay">
               <button class="button" @click="lock(key)">
                  <span v-if="row.locked">Unlock</span>
                  <span v-else>Lock</span>
                  Content
               </button>
               <button class="button" @click="remove(key)">Remove</button>
            </div>
         </div>
      </section>

      <button class="button" @click="addRow([12])">Add 1x12 Row</button>
      <button class="button" @click="addRow([6, 6])">Add 6x6 Row</button>
      <button class="button" @click="addRow([4, 8])">Add 4x8 Row</button>
      <button class="button" @click="addRow([8, 4])">Add 8x4 Row</button>
      <button class="button" @click="addRow([3, 3, 3, 3])">Add 3x3x3x3 Row</button>
      <button class="button" @click="addRow([4, 4, 4])">Add 4x4x4 Row</button>
   </div>
</template>

<style lang="scss">
.template-grid {
   display: none;
}
.template-page {
   display: flex;
   flex-direction: column;

   .grid {
      padding: 8px 0;
      margin: 0 auto;
      min-height: 100px;
      height: 100%;
      &[draggable="true"] {
         cursor: move;

         position: relative;
         transition: all 300ms;
         user-select: none;
         will-change: transform;
      }

      &.grid-locked {
         @media (min-width: 640px) {
            width: 80%;
         }
      }
   }

   .area {
      position: relative;
      min-height: 20px;
      overflow: hidden;
      resize: vertical;

      &:hover .button-overlay {
         display: flex;
      }
   }

   .button-overlay {
      align-items: center;
      background: rgba(#092f3b, 0.4);
      display: none;
      justify-content: center;
      left: 0;
      position: absolute;
      right: 0;
      top: 0;
   }

   .over {
      background: rgba(#444, 0.7);
      border: 5px dotted #444;
   }

   @for $col from 1 through 12 {
      .col-#{$col} {
         height: 100%;
         background: rgba(#ddd, 0.5);
         border: 3px dotted #444;
         height: 100%;
         display: flex;
         justify-content: center;
         align-items: center;
      }
   }
}
</style>
