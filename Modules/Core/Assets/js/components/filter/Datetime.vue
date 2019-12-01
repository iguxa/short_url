<template>
    <div>
        <el-date-picker type="datetime" :placeholder="placeholder" :value="value" @input="$emit('input', $event)"
                        format="dd.MM.yyyy HH:mm" value-format="yyyy-MM-dd HH:mm:ss">
        </el-date-picker>
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
