<template>
    <div>
        <el-select
                :multiple="multiple"
                :value="value"
                @input="$emit('input', $event)"
                :placeholder="placeholder"
                @change="on_change"
        >
            <el-option v-if="!multiple" key="" :label="trans('core.label.all')" value=""></el-option>
            <el-option v-for="variant in values" :key="variant.id" :label="variant.title" :value="variant.id"></el-option>
        </el-select>
    </div>
</template>

<script>
    export default {
        props: {
            multiple: { type: Boolean },
            values: { type: Array, required: true },
            value: { default: null },
            placeholder: { type: String, default: 'Select' },
        },
        data() {
            return {};
        },
        methods: {
            on_change(){
                this.$emit('change');
                this.$store.getters.allPosts;
            },

            delValueByName(name){
                console.log('AAAAAAAAAAAAAAAAAAAAAAAAAAa');
                console.log(this.values[name]);

                this.values[name] = '';
                console.log(this.values[name]);

            }
        },
        mounted() {
        },
    };
</script>
