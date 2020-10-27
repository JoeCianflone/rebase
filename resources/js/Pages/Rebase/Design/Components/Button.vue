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
      <div class="grid--center">
         <div class="col-12">
            <h1>Buttons</h1>
            <p>Buttons come in a couple of different variants:</p>
         </div>

         <div class="col-12">
            <h3>Primary</h3>
            <p>This is your standard button, no extra classes needed</p>
         </div>
         <div class="col-8">
            <script type="text/plain" class="language-markup"><Button class="button">Click</Button></script>
         </div>
         <div class="col-4">
            <Button class="button">Button</Button>
         </div>
         <div class="col-12">
            <h3>Secondary</h3>
         </div>
         <div class="col-8">
            <script type="text/plain" class="language-markup"><Button class="button--secondary">Click</Button></script>
         </div>
         <div class="col-4">
            <Button class="button--secondary">Button</Button>
         </div>
         <div class="col-12">
            <h3>Success</h3>
         </div>
         <div class="col-8">
            <script type="text/plain" class="language-markup"><Button class="button--success">Click</Button></script>
         </div>
         <div class="col-4">
            <Button class="button--success">Button</Button>
         </div>
         <div class="col-12">
            <h3>Danger</h3>
         </div>
         <div class="col-8">
            <script type="text/plain" class="language-markup"><Button class="button--danger">Click</Button></script>
         </div>
         <div class="col-4">
            <Button class="button--danger">Button</Button>
         </div>
         <div class="col-12">
            <h2>Size Variants</h2>
            <p>Buttons can also use our size variants</p>
         </div>
         <div class="col-8"><script type="text/plain" class="language-markup"><Button class="button:xsmall">This is extra small</Button></script></div>
         <div class="col-4"><Button class="button:xsmall">Click Me</Button></div>
         <div class="col-8"><script type="text/plain" class="language-markup"><Button class="button:small">This is small</Button></script></div>
         <div class="col-4"><Button class="button:small">Click Me</Button></div>
         <div class="col-8"><script type="text/plain" class="language-markup"><Button class="button">This is normal</Button></script></div>
         <div class="col-4"><Button class="button">Click Me</Button></div>
         <div class="col-8"><script type="text/plain" class="language-markup"><Button class="button:large">This is large</Button></script></div>
         <div class="col-4"><Button class="button:large">Click Me</Button></div>
         <div class="col-8"><script type="text/plain" class="language-markup"><Button class="button:xlarge">This is extra large</Button></script></div>
         <div class="col-4"><Button class="button:xlarge">Click Me</Button></div>
      </div>




   </section>
</template>

<style lang="scss" scoped>
@import "@@/abstract";

</style>
