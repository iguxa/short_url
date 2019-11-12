<template>
    <el-button
            size="mini"
            @click.prevent="goToWatchPage()">
        <i class="fa fa-eye"></i>
    </el-button>
</template>

<script>
    export default {
        props: {
            to: { type: Object, required: true },
        },
        methods: {
            goToWatchPage() {
                this.$router.push(this.to);
            },
        },
    };
</script>
