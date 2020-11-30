<script>
import SimpleMessage from "./SimpleMessage"
import isEmpty from "lodash/isEmpty"
import isUndefined from "lodash/isUndefined"
import isNull from "lodash/isNull"

export default {
   name: "Toast",

   components: {
      SimpleMessage,
   },

   props: {
      flash: Object,
      errors: Object | Array,
   },

   data: function () {
      return {
         isClosed: true,
      }
   },

   watch: {
      isClosed: function (isClosed) {
         if (!isClosed) {
            let vm = this
            setTimeout(function () {
               vm.isClosed = true
            }, 4000)
         }
      },
   },

   computed: {
      message: function () {
         if (!isEmpty(this.errors)) {
            if (isUndefined(this.errors[0])) {
               return "Please see the errors below"
            }
            return this.errors[0]
         }

         return this.flash.success || this.flash.message || this.flash.alerts || this.flash.errors
      },
      toastType: function () {
         if (!isNull(this.message)) {
            this.isClosed = false
         }

         return {
            "toast--success": this.flash.success,
            "toast--message": this.flash.message,
            "toast--alerts": this.flash.alerts,
            "toast--errors": this.flash.errors || !isEmpty(this.errors),
         }
      },
   },
}
</script>

<template>
   <transition name="slide" appear>
      <div class="toast" v-show="!isClosed" :class="toastType">
         <div class="grid--center">
            <div class="col-8:at-2" v-if="message">
               <SimpleMessage>{{ message }}</SimpleMessage>
            </div>
            <Button @click="isClosed = !isClosed" class="button--icon:xsmall col-2:end"><span class="material-icons">close</span></Button>
         </div>
      </div>
   </transition>
</template>

<style lang="scss" scoped>
$height: var(--px-48);
$inverse: calc(-1 * #{$height});
.slide-enter,
.slide-leave-to {
   transform: translateY($inverse);
}
.toast {
   background: var(--color-gray-800);
   color: var(--color-gray-100);
   padding: var(--px-8) 0;
   position: absolute;
   width: 100%;
   z-index: 12;
   transition: all 300ms ease-in-out;
   height: $height;
   overflow: hidden;

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
