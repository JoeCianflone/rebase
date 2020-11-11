<script>
import SimpleMessage from "./SimpleMessage"

export default {
   name: "Toast",

   components: {
      SimpleMessage,
   },

   props: {
      flash: Object,
   },

   data: function () {
      return {
         isClosed: true,
      }
   },

   computed: {
      toastType: function () {
         if (this.flash.success || this.flash.message || this.flash.alerts || this.flash.errors) {
            this.isClosed = false
         }
         return {
            "toast--success": this.flash.success,
            "toast--message": this.flash.message,
            "toast--alerts": this.flash.alerts,
            "toast--errors": this.flash.errors,
         }
      },
   },

   methods: {
      close() {
         this.isClosed = !this.isClosed
      },
   },
}
</script>

<template>
   <div class="toast" :class="[{ closed: isClosed }, toastType]">
      <div class="grid--center">
         <div class="col-8:at-2">
            <SimpleMessage v-if="flash.success">{{ flash.success }}</SimpleMessage>
            <SimpleMessage v-if="flash.errors">{{ flash.errors }}</SimpleMessage>
            <SimpleMessage v-if="flash.alert">{{ flash.alert }}</SimpleMessage>
            <SimpleMessage v-if="flash.message">{{ flash.message }}</SimpleMessage>
         </div>
         <Button @click="close()" class="button--icon:xsmall col-2"><span class="material-icons">close</span></Button>
      </div>
   </div>
</template>

<style lang="scss" scoped>
.toast {
   background: var(--color-gray-800);
   color: var(--color-gray-100);
   padding: var(--px-8) 0;

   &.closed {
      display: none;
   }

   &.toast--success {
      background-color: var(--color-green-600);
      color: var(--color-gray-100);
   }
   &.toast--errors {
      background-color: var(--color-red-600);
      color: var(--color-gray-100);
   }
   &.toast--alert {
      background-color: var(--color-orange-600);
      color: var(--color-gray-100);
   }
   &.toast--message {
      background-color: var(--color-blue-600);
      color: var(--color-gray-100);
   }
}
</style>
