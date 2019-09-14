<template>
  <section>
    <portal-target name="dropdown" slim />
    <portal-target name="overlay" slim />
    <flash-messages :flash="$page.flash" :errors="$page.errors" />

  </section>
</template>

<script>
    export default {
        components: {
        },
        props: {
            title: String,
        },
        data: () => ({
            showUserMenu: false,
        }),

        watch: {
            title(title) {
                this.updatePageTitle(title);
            },
        },

        mounted() {
            this.updatePageTitle(this.title);
        },

        methods: {
            updatePageTitle(title) {
                document.title = title ? `${title} | ${this.$page.app.name}` : this.$page.app.name;
            },

            hideDropdownMenus() {
                this.showUserMenu = false
            },
        },
    }
</script>
