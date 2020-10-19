<script>
export default {
   name: "Modal",

   components: {},

   props: {
      title: {
         type: String,
      },
      message: {
         type: String,
      },
      type: {
         type: String,
         default: "general",
      },
      listing: {
         type: Object | Array,
         default: () => [],
      },
   },

   data: () => ({}),

   methods: {},
}
</script>

<template>
   <section class="modal">
      <div class="modal__container">
         <div class="modal__header">
            <slot name="header"></slot>
         </div>
         <div class="modal__body">
            <slot name="body"></slot>
         </div>
         <div class="modal__footer">
            <slot name="footer"></slot>
         </div>
      </div>
      <div class="modal__shade"></div>
   </section>
</template>
