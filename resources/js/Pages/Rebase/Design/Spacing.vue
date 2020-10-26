<script>
import Layout from "@/Templates/Rebase/Design"

export default {
   layout: Layout,
   metaInfo: { title: "Layout" },
   data: () => ({
      spacing: [0, 4, 8, 12, 14, 16, 18, 20, 24, 30, 32, 36, 40, 48, 60, 64, 72, 80, 96, 128, 160, 192, 224, 256],
   }),
}
</script>

<template>
   <section>
      <h1>Spacing System</h1>
      <p>These are the values we use for various spaces on our sites. You can also use them as min-heights if needed. All values are converted to REMs</p>
      <ul class="spacers">
         <li v-for="space in spacing" :key="space" :style="`height: var(--px-${space})`">{{ space }}</li>
      </ul>
   </section>
</template>

<style lang="scss" scoped>
.spacers {
   display: flex;
   width: 95%;
   list-style-type: none;
   padding: 0;
   margin: var(--px-16) 0 var(--px-16) 0;

   li {
      width: 100%;
      background-color: var(--color-rose-100);
      margin: 0 var(--px-4);
      text-align: center;
   }
}

.cell > div {
   background: var(--color-rose-100);
}
</style>
