<script>
import Layout from '@/Templates/Master';

export default {
    components: {
        Layout,
    },

    props: {
        dashboard: Object|Array
    }
}
</script>


<template>
    <layout title="Test">
        <div class="container">
            <div class="row">
                <div class="xs::col-8-centered xs::text-align|right sm::text-align|center wd::text-align|left ">1</div>
            </div>
            <div class="row">
                <div class="xs::col-12-centered"> Hi there</div>
            </div>
        </div>
    </layout>
</template>
