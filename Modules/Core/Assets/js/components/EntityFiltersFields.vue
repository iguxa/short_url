<template>
    <div>
        <el-form-item :key="filter.name" v-for="filter in filters" :label="filter.title" v-if="isActive(filter)">
            <component
              :is="getComponentName(filter)"
              @input="onInput(filter, $event)"
              :value="values[filter.name]"
              v-bind="filter.meta"
              @change="fetch"
            ></component>
        </el-form-item>
    </div>
</template>

<script>
    import axios from 'axios';
    import _ from 'lodash';
    export default {
        props: {
            entity: { type: String, required: true },
            value: { type: Object, default: () => { return {} } },
            exclude: {type: Array, default: () => { return [] }},
        },
        data() {
            return {
                filters: [],
                values: this.value,
            };
        },
        methods: {
            isActive(filter) {
                return _.indexOf(this.exclude, filter.name)===-1;
            },

            fetch() {
                axios.post(route('backend::core.api.entity.filters'),_.merge({entity:this.entity},this.values))
                    .then((response) => {
                        response.data.data.forEach(filter => {
                            if(typeof(this.values[filter.name])==='undefined' && this.isActive(filter)) {
                                this.values[filter.name] = '';
                            }
                        });
                        this.filters = response.data.data;
                    });
                this.$emit('change');
            },
            getComponentName(filter) {
                return _.startCase(_.toLower(filter.type))+'Filter';
            },
            onInput(filter, value) {
                this.values[filter.name] = value;
                this.getName(filter.name);
                this.$forceUpdate();
                this.$emit('input', this.values);
            },
            getName(name){
                this.$emit('getName',name);
            },
        },
        mounted() {
            this.fetch();
        },
    };
</script>
