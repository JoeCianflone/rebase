<script>
    export default {
        components: { },
        props: {
            title: String,
        },

        data: () => ({
            showUserMenu: false,
        }),

        watch: {
            title: {
                immediate: true,
                handler(title) {
                    document.title = title
                },
            },
        },

        methods: {
            hideDropdownMenus() {
                this.showUserMenu = false
            },
        },
    }
</script>


<template>
    <section>
        <portal-target name="dropdown" slim />
        <portal-target name="overlay" slim />
        <slot name="default" />
    </section>
</template>
