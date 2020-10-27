<script>
import Layout from "@/Templates/Rebase/Design"

export default {
   layout: Layout,
   metaInfo: { title: "Components - Button" },
   data: () => ({}),
}
</script>

<template>
   <section>
      <h1>Buttons</h1>
      <p>Buttons come in a couple of different variants:</p>
      <h3>Primary</h3>
      <p>This is your standard button, no extra classes needed</p>
      <script type="text/plain" class="language-markup">
         <Button class="button">This is a button</Button>
      </script>

      <h3>Secondary</h3>
      <p>This is your standard button, no extra classes needed</p>
      <script type="text/plain" class="language-markup">
         <Button class="button--secondary">This is a button</Button>
      </script>

      <h3>Success</h3>
      <p>This is your standard button, no extra classes needed</p>
      <script type="text/plain" class="language-markup">
         <Button class="button--success">This is a button</Button>
      </script>
      <h3>Danger</h3>
      <p>This is your standard button, no extra classes needed</p>
      <script type="text/plain" class="language-markup">
         <Button class="button--danger">This is a button</Button>
      </script>

      <h2>Size Variants</h2>
      <p>Buttons can also use our size variants</p>
      <script type="text/plain" class="language-markup">
         <Button class="button:xsmall">This is extra small</Button>
         <Button class="button:small">This is small</Button>
         <Button class="button">This is normal (medium)</Button>
         <Button class="button:large">This is large</Button>
         <Button class="button:xlarge">This is extra large</Button>
      </script>
      <p>Size variants are always apended to the <em>end</em> of a button class</p>
      <script type="text/plain" class="language-markup">
         <Button class="button--secondary:xsmall">This is secondary style extra small</Button>
      </script>
   </section>
</template>

<style lang="scss" scoped>
@import "@@/abstract";
</style>
