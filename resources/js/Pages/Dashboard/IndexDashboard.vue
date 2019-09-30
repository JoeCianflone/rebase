<script>
import Layout from '@/Templates/Master';

export default {
    layout: Layout,
    metaInfo: { title: 'The Dashboard' },
    components: {},

    props: {
        dashboard: Object
    }
}
</script>

<template>
    <div class="container">
        <div class="row">
            <div class="xs::col-8-centered xs::text-align|right sm::text-align|center wd::text-align|left ">1</div>
        </div>
        <div class="row">
            <div class="xs::col-12-centered"> Hi there</div>
        </div>
    </div>
</template>
