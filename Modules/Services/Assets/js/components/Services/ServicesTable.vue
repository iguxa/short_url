<template>
    <div>
        <div class="content-header">
            <h1>
                {{ trans('services.title.services') }}
            </h1>
            <el-breadcrumb separator="/">
                <el-breadcrumb-item>
                    <a href="/backend">{{ trans('core.breadcrumb.home') }}</a>
                </el-breadcrumb-item>
                <el-breadcrumb-item :to="{name: 'admin.services.index'}">{{ trans('services.title.services') }}
                </el-breadcrumb-item>
            </el-breadcrumb>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="sc-table">
                            <div class="tool-bar el-row" style="padding-bottom: 20px;">
                                <div class="actions el-col el-col-8">
                                    <router-link :to="{name: 'admin.services.create'}">
                                        <el-button type="primary"><i class="el-icon-edit"></i>
                                            {{ trans('services.button.new-services') }}
                                        </el-button>
                                    </router-link>
                                </div>
                                <div class="actions el-col el-col-8">
                                    <router-link :to="{name: 'admin.services.service.generate'}">
                                        <el-button type="primary"><i class="el-icon-edit"></i>
                                            {{ trans('services.button.generate-services') }}
                                        </el-button>
                                    </router-link>
                                </div>
                                <div class="actions el-col el-col-8">
                                    <router-link :to="{name: 'admin.services.service.check'}">
                                        <el-button type="primary"><i class="el-icon-edit"></i>
                                            {{ trans('services.button.check-services') }}
                                        </el-button>
                                    </router-link>
                                </div>
                                <div class="search el-col el-col-5">
                                    <el-input prefix-icon="el-icon-search" @keyup.native="performSearch" v-model="searchQuery">
                                    </el-input>
                                </div>
                            </div>

                            <el-table
                                    :data="data"
                                    stripe
                                    style="width: 100%"
                                    ref="projectTable"
                                    v-loading.body="tableIsLoading"
                                    @sort-change="handleSortChange">
                                <el-table-column :label="trans('services.table.status')" width="100">
                                    <template slot-scope="scope">
                                        <i class="fa fa-circle" :class="(scope.row.state === true) ? 'text-success':'text-danger'"></i>
                                    </template>
                                </el-table-column>
                                <el-table-column prop="id" label="Id" width="75" sortable="custom">
                                </el-table-column>
                                <el-table-column prop="title" :label="trans('services.table.workflow')" sortable="custom">
                                    <template slot-scope="scope">
                                            {{ scope.row.workflow }}
                                    </template>
                                </el-table-column>
                                <el-table-column prop="actions" :label="trans('core.table.actions')">
                                    <template slot-scope="scope">
                                        <el-button-group>
                                            <edit-button
                                                    :to="{name: 'admin.services.edit', params: {servicesId: scope.row.id}}"></edit-button>
                                            <watch-button
                                                    :to="{name: 'admin.services.watch', params: {servicesId: scope.row.id}}"></watch-button>
                                            <delete-button :scope="scope" :rows="data"></delete-button>
                                        </el-button-group>
                                    </template>
                                </el-table-column>
                            </el-table>
                            <div class="pagination-wrap" style="text-align: center; padding-top: 20px;">
                                <el-pagination
                                        @size-change="handleSizeChange"
                                        @current-change="handleCurrentChange"
                                        :current-page.sync="meta.current_page"
                                        :page-sizes="[10, 20, 30, 50, 100]"
                                        :page-size="parseInt(meta.per_page)"
                                        layout="total, sizes, prev, pager, next, jumper"
                                        :total="meta.total">
                                </el-pagination>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button v-shortkey="['c']" @shortkey="pushRoute({name: 'api.services.service.create'})" v-show="false"></button>
    </div>
</template>

<script>
    import axios from 'axios';
    import _ from 'lodash';
    import ShortcutHelper from '../../../../../Core/Assets/js/mixins/ShortcutHelper';


    export default {
        mixins: [ShortcutHelper],
        data() {
            return {
                data: [],
                meta: {
                    current_page: 1,
                    per_page: 30,
                },
                order_meta: {
                    order_by: '',
                    order: '',
                },
                links: {},
                searchQuery: '',
                tableIsLoading: false,
            };
        },
        methods: {
            queryServer(customProperties) {
                const properties = {
                    page: this.meta.current_page,
                    per_page: this.meta.per_page,
                    order_by: this.order_meta.order_by,
                    order: this.order_meta.order,
                    search: this.searchQuery,
                };

                axios.get(route('api.services.service.index', _.merge(properties, customProperties)))
                    .then((response) => {
                        this.tableIsLoading = false;
                        this.data = response.data.data;
                        this.meta = response.data.meta;
                    });
            },
            fetchData() {
                this.tableIsLoading = true;
                this.queryServer();
            },
            handleSizeChange(event) {
                console.log(`per page :${event}`);
                this.tableIsLoading = true;
                this.queryServer({ per_page: event });
            },
            handleCurrentChange(event) {
                console.log(`current page :${event}`);
                this.tableIsLoading = true;
                this.queryServer({ page: event });
            },
            handleSortChange(event) {
                console.log('sorting', event);
                this.tableIsLoading = true;
                this.queryServer({ order_by: event.prop, order: event.order });
            },
            performSearch: _.debounce(function (query) {
                console.log(`searching:${query.target.value}`);
                this.tableIsLoading = true;
                this.queryServer({ search: query.target.value });
            }, 300),
            goToEdit(scope) {
                this.$router.push({ name: 'admin.services.edit', params: { services_id: scope.row.id } });
            },
        },
        mounted() {
            this.fetchData();
        },
    };
</script>
<style>
    .text-success {
        color: #13ce66;
    }
    .text-danger {
        color: #ff4949;
    }
</style>
