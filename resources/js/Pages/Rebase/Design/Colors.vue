<script>
import Layout from "@/Templates/Rebase/Design"

export default {
   layout: Layout,
   metaInfo: { title: "Colors" },
   data: () => ({
      colorValues: [50, 100, 200, 300, 400, 500, 600, 700, 800, 900],
      colorSwatches: ["rose", "pink", "fuchsia", "purple", "violet", "indigo", "blue", "lightBlue", "cyan", "teal", "emerald", "green", "lime", "yellow", "amber", "orange", "red"],
      graySwatches: ["warmGray", "trueGray", "gray", "coolGray", "blueGray"],
   }),
}
</script>

<template>
   <section>
      <h1>Colors</h1>
      <p>FFS please don't use all of these, it'll look like a clown turd</p>
      <h2>Colors Swatches</h2>
      <p>These are all the colors we can pick from, no you don't need to use them all</p>
      <ul class="swatches" v-for="c in colorSwatches" :key="c">
         <li v-for="n in colorValues" :key="n" :style="`background: var(--color-${c}-${n})`"></li>
      </ul>

      <h2>Gray Swatches</h2>
      <ul class="swatches" v-for="c in graySwatches" :key="c">
         <li v-for="n in colorValues" :key="n" :style="`background: var(--color-${c}-${n})`"></li>
      </ul>
   </section>
</template>

<style lang="scss" scoped>
@import "@@/abstract";

.swatches {
   display: flex;
   width: 90%;
   list-style-type: none;
   padding: 0;
   margin: 0 0 var(--px-16) 0;

   li {
      width: 100%;
      min-height: var(--px-64);
   }
}
</style>
