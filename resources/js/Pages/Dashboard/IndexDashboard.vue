<script>
import Layout from '@/Templates/Master';

export default {
    layout: Layout,
    metaInfo: { title: 'Title' },

    components: {},

    data: () => ({
        form: {
            id: 1,
            name: 'Joe Cianflone',
            email: 'joe@cianflone.co',
        }
    }),

    props: {
        user: Object
    },

    methods: {
        test() {
            this.$inertia.post('/', this.form)
                         .then(() => this.sending = false );
        }
    },
}
</script>

<template>
    <div>
        <button @click="test">Test</button>

        <span v-if="user"> {{user.data[0].email}} </span>

    </div>
</template>

<style lang="scss" scoped>

</style>
