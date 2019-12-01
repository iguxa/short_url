<template>
    <div>
        <component
          v-bind:key="widget"
          v-for="widget in widgets"
          :is="widget"
          @input="onInput"
          :entity="entity"
          :entityId="entityId"
        ></component>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        props: {
            entity: { type: String, required: true },
            entityId: { default: null },
        },
        watch: {
        },
        data() {
            return {
                widgets: [],
            };
        },
        methods: {
            fetch() {
                axios.get(route('backend::core.api.entity.widgets', {
                        entity: this.entity,
                        entity_id: this.entityId,
                    }))
                    .then((response) => {
                        this.widgets = response.data;
                    });
            },
            onInput(data) {
                this.$emit('input', data);
            }
        },
        mounted() {
            this.fetch();
        },
    };
</script>
