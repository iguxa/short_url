<template>
    <div>
        <el-select :class="{'select-wide':wide}" :value="value" @input="$emit('input', $event)" :multiple="multiple" filterable allow-create remote :remote-method="performSearch" default-first-option>
            <el-option label="Не выбрано" value=""></el-option>
            <el-option v-for="entity in enums"
                       :key="entity[field]"
                       :label="entity.title"
                       :value="entity[field]"
            ></el-option>
        </el-select>
        <slot name="btn"></slot>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        props: {
            entity: { type: String, required: true },
            value: { default: null },
            placeholder: { type: String, default: '' },
            multiple: { type: Boolean, default: false },
            field: { type: String, default: 'id' },
            wide: { type: Boolean, default: false },
            additional:{ type:Object, default: () => {}}
        },
        data() {
            return {
                enums:[],
                visibleEnum: false,
            };
        },
        methods: {
            fetchSelected() {
                if (this.value && (!this.multiple || this.value.length)) {
                    axios.post(route('core.api.entity.find'), {
                        entity: this.entity,
                        entity_id: this.value,
                        field: this.field,
                    }).then((response) => {
                        this.enums = response.data.data;
                    });
                } else {
                    this.enums = [];
                }
            },
            performSearch: _.debounce(function (value) {
                if(value) {
                    axios.post(route('core.api.entity.search'), {
                        entity: this.entity,
                        field: this.field,
                        q: value,
                        additional: this.additional,
                    }).then((response) => {
                        this.enums = response.data.data;
                    });
                } else {
                    this.enums = [];
                }
            }, 300),
        },
        mounted() {
            this.fetchSelected();
        },
        watch: {
            value() {
                this.fetchSelected();
            },
        },
    };
</script>

<style type="text/css">
    .select-wide {
        width:100%;
    }
</style>
