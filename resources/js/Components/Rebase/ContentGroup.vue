<script>
export default {
   props: {
      userCanEdit: Boolean,
      default: false,
   },

   data() {
      return {
         isEditing: false,
      }
   },

   methods: {
      toggleEdit() {
         if (this.$slots.contentEdit) {
            this.isEditing = !this.isEditing
         }
      },
   },
}
</script>

<template>
   <dl class="content-group" :class="[{ editing: isEditing }]">
      <dt class="content-group--title">
         <slot name="contentTitle"></slot>
         <Button class="button--secondary:xsmall" v-if="userCanEdit" @click="toggleEdit">
            <span v-if="!isEditing">Edit</span>
            <span v-else>Hide Edit</span>
         </Button>
      </dt>
      <dd class="content-group--content">
         <slot></slot>
      </dd>
      <dd class="content-group--edit">
         <slot name="contentEdit"></slot>
      </dd>
   </dl>
</template>
<style lang="scss" scoped>
@import "@@/abstract";

.content-group {
   &.editing {
      .content-group--content {
         display: none;
      }
      .content-group--edit {
         display: block;
      }
   }

   .content-group--title {
      color: var(--color-coolGray-700);
      font-size: var(--px-24);
      font-weight: var(--weight-bold);
      border-bottom: 1px solid var(--color-trueGray-300);
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: var(--px-8) 0;
   }
   .content-group--content,
   .content-group--edit {
      padding: var(--px-12) 0 var(--px-60) 0;
   }

   .content-group--edit {
      display: none;
   }
}
</style>
