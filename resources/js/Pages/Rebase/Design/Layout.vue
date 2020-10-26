<script>
import Layout from "@/Templates/Rebase/Design"

export default {
   layout: Layout,
   metaInfo: { title: "Layout" },
   data: () => ({}),
}
</script>

<template>
   <section>
      <h1>Layout System</h1>
      <h2>General Grid</h2>
      <p>The grid is 12 columns, by default, the columns do not wrap</p>
      <div class="grid cell">
         <div class="col-1">1</div>
         <div class="col-1">1</div>
         <div class="col-1">1</div>
         <div class="col-1">1</div>
         <div class="col-1">1</div>
         <div class="col-1">1</div>
         <div class="col-1">1</div>
         <div class="col-1">1</div>
         <div class="col-1">1</div>
         <div class="col-1">1</div>
         <div class="col-1">1</div>
         <div class="col-1">1</div>
      </div>
      <p>Columns can be mixed and matched, but cannot exceed 12 when added up</p>
      <div class="grid cell">
         <div class="col-12">Full 12 Columns</div>
      </div>
      <div class="grid cell">
         <div class="col-11">11</div>
         <div class="col-1">1</div>
      </div>
      <div class="grid cell">
         <div class="col-10">10</div>
         <div class="col-2">2</div>
      </div>
      <div class="grid cell">
         <div class="col-9">9</div>
         <div class="col-3">3</div>
      </div>
      <div class="grid cell">
         <div class="col-8">8</div>
         <div class="col-4">4</div>
      </div>
      <div class="grid cell">
         <div class="col-7">7</div>
         <div class="col-5">5</div>
      </div>
      <div class="grid cell">
         <div class="col-6">6</div>
         <div class="col-6">6</div>
      </div>
      <div class="grid cell">
         <div class="col-5">5</div>
         <div class="col-7">7</div>
      </div>
      <div class="grid cell">
         <div class="col-4">4</div>
         <div class="col-8">8</div>
      </div>
      <div class="grid cell">
         <div class="col-3">3</div>
         <div class="col-9">9</div>
      </div>
      <div class="grid cell">
         <div class="col-2">2</div>
         <div class="col-10">10</div>
      </div>
      <div class="grid cell">
         <div class="col-1">1</div>
         <div class="col-11">11</div>
      </div>

      <h2>Centered Columns</h2>
      <p>We also have the ability to center columns</p>
      <div class="grid cell">
         <div class="col-10--centered">10</div>
      </div>
      <div class="grid cell">
         <div class="col-8--centered">8</div>
      </div>
      <div class="grid cell">
         <div class="col-6--centered">6</div>
      </div>
      <div class="grid cell">
         <div class="col-4--centered">4</div>
      </div>
      <div class="grid cell">
         <div class="col-2--centered">2</div>
      </div>
   </section>
</template>

<style lang="scss" scoped>
@import "@@/abstract";

.cell > div {
   background: var(--color-rose-100);
   min-height: 5vh;
}
</style>
