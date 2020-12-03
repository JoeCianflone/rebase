<script>
export default {
   props: {
      step: Number,
   },

   components: {},
}
</script>

<template>
   <div class="layout--main">
      <main>
         <slot></slot>
      </main>
      <aside>
         <slot name="sidebar">
            <ol class="step-counter">
               <li class="step-counter--item" :class="{ selected: this.step === 1 }">
                  Register Your Workspace
                  <div class="helper-text">Your website needs a URL, what do you want to call your workspace? Don't worry you can change this later!</div>
               </li>
               <li class="step-counter--item" :class="{ selected: this.step === 2 }">
                  Create Your Email Address
                  <div class="helper-text">Well, how else are you going to log in? You'll set up a password later</div>
               </li>
               <li class="step-counter--item" :class="{ selected: this.step === 3 }">
                  Register Your Account and Pay
                  <div class="helper-text">Give us a few more details about your account and pick your plan. Once you pay, we'll create your app and send you an email when it's done</div>
               </li>
               <li class="step-counter--item" :class="{ selected: this.step === 4 }">
                  All Done, Check Your Email
                  <div class="helper-text">Last step! Before you can sign in, we're going to send you an email with a link to verify your email address AND set your pasword.</div>
               </li>
            </ol>
         </slot>
      </aside>
   </div>
</template>

<style lang="scss" scoped>
@import "@@/abstract";
.layout--main {
   display: grid;
   grid-gap: var(--px-16);
   grid-template-areas: "secondary" "main";
   grid-template-columns: 1fr;
   grid-template-rows: 1fr 2fr;
   height: 100vh;

   @media (map-get($mq, "md")) {
      align-items: center;
      grid-template-areas: "main secondary";
      grid-template-columns: 2fr 1fr;
      grid-template-rows: 1fr;
   }

   main {
      grid-area: main;
   }

   aside {
      background: var(--color-gray-800);
      color: var(--color-gray-400);
      grid-area: secondary;
      padding: var(--px-16);

      @media (map-get($mq, "md")) {
         align-items: center;
         display: flex;
         height: 100vh;
      }
   }
}

.step-counter {
   color: var(--color-gray-400);
   font-size: var(--px-20);
}
.step-counter--item {
   padding: var(--px-8) 0;

   &.selected {
      color: var(--color-gray-50);
      font-size: var(--px-30);
      padding: var(--px-8) 0;
   }
}
.helper-text {
   display: none;
}
.selected {
   > .helper-text {
      font-size: var(--px-18);
      display: block;
      padding: var(--px-16) 0 var(--px-20) 0;
      border-top: 1px solid var(--color-gray-50);
      line-height: var(--leading-loose);
   }
}
</style>
