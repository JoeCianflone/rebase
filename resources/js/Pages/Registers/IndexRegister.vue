<script>
import Layout from '@/Templates/Master';

export default {
    components: {
        Layout,
    },

    data: () => ({
        form: { }
    }),

    methods: {
        test() {
            this.$inertia.post(URL, this.form)
                         .then(() => this.sending = false );
        }
    },
}
</script>

<template>
    <layout title="">
        <button @click="test">Test Data</button>
    </layout>
</template>
