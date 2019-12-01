<template>
    <div>
        <el-form ref="form"
                 label-width="120px"
                 label-position="top">
            <div class="box box-primary">
                <div class="box-body">
                    <entity-filters-fields
                      :entity="entity"
                      :value="value"
                      @input="$emit('input', $event)"
                      :exclude="exclude"
                    ></entity-filters-fields>
                </div>
                <div class="box-footer">
                    <el-form-item>
                        <el-button type="primary" @click="$emit('submit')">
                            {{ trans('core.button.apply') }}
                        </el-button>
                        <el-button @click="onFilterReset()">{{ trans('core.button.reset') }}
                        </el-button>
                    </el-form-item>
                </div>
            </div>
        </el-form>
    </div>
</template>

<script>
    import EntityFiltersFields from "./EntityFiltersFields";

    export default {
        components: {EntityFiltersFields},
        props: {
            entity: { type: String, required: true },
            value: { type: Object, default: () => { return {} } },
            exclude: {type: Array, default: () => { return [] }}
        },
        data() {
            return {};
        },
        methods: {
            onFilterReset() {
                this.$emit('input', {});
                this.$emit('submit');
                this.$forceUpdate();
            },
        },
    };
</script>
