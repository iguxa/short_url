<template>
    <div>
        <el-input :placeholder="placeholder" :value="value" @input="$emit('input', $event)"></el-input>
    </div>
</template>

<script>
    export default {
        props: {
            value: { default: null },
            placeholder: { type: String, default: '' },
        },
        data() {
            return {};
        },
        methods: {
        },
        mounted() {
        },
    };
</script>
