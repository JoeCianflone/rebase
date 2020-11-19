<script>
export default {
   name: "ActionLink",
   inheritAttrs: false,
   props: {
      link: String,
   },
}
</script>

<template>
   <li>
      <inertia-link :href="link"><slot></slot></inertia-link>
   </li>
</template>
