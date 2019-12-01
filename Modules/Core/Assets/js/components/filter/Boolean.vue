<template>
    <div>
        <el-select :value="value" @input="$emit('input', $event)" :placeholder="placeholder">
            <el-option key="" :label="trans('core.label.all')" value=""></el-option>
            <el-option :key="1" :label="trans('core.label.yes')" :value="1"></el-option>
            <el-option :key="0" :label="trans('core.label.no')" :value="0"></el-option>
        </el-select>
    </div>
</template>

<script>
    export default {
        props: {
            multiple: { type: Boolean },
            value: { default: null },
            placeholder: { type: String, default: 'Select' },
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
