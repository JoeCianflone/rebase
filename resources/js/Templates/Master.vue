<script>

export default {
    components: { },
    data() {
        return {
            showUserMenu: false,
        }
    },
    methods: {
        url() {
            return location.pathname.substr(1)
        },
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
        <slot />
    </section>
</template>
