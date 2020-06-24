<script>
import Layout from "@/Templates/Master"
import RebaseInput from "@/Components/Form/RebaseInput"
import RebaseFormItem from "@/Components/Form/RebaseFormItem"
import Toast from "@/Components/Toast"

export default {
   layout: Layout,
   metaInfo: { title: "Please Register" },

   components: {
      RebaseInput,
      RebaseFormItem,
      Toast,
   },

   props: {
      errors: Object,
      alerts: Object,
   },

   data: () => ({
      sending: true,
      form: {
         id: 1,
         name: "",
         email: "",
      },
   }),

   methods: {
      send() {
         console.log(this.form)
      },
   },
}
</script>

<template>
   <form action="post" @submit.prevent>
      <fieldset>
         <legend>Please Register Your Account</legend>

         <toast title="Holy Canolli" :listing="$page.errors" type="error" />
         <toast title="Holy Non-Canolli" message="Look what do you want me to say?" type="message" />

         <rebase-form-item :errors="$page.errors.name">
            Enter your name:
            <rebase-input v-model="form.name" type="text" />
         </rebase-form-item>
      </fieldset>
      <button @click="send">Test</button>
   </form>
</template>

<style lang="scss"></style>
