<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">
    <div>
        <div class="content-header">
            <h1>
                {{ trans('services.title.services') }} <small>{{ services.name }}</small>
            </h1>
            <el-breadcrumb separator="/">
                <el-breadcrumb-item>
                    <a href="/backend">{{ trans('core.breadcrumb.home') }}</a>
                </el-breadcrumb-item>
                <el-breadcrumb-item :to="{name: 'admin.services.index'}">{{ trans('services.title.services') }}
                </el-breadcrumb-item>
                <el-breadcrumb-item :to="{name: 'admin.services.create'}">{{ trans(`services.title.create`) }}
                </el-breadcrumb-item>
            </el-breadcrumb>
        </div>
        <el-form ref="form"
                 :model="services"
                 label-width="120px"
                 label-position="top"
                 v-loading.body="loading"
                 @keydown="form.errors.clear($event.target.name);">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-body">
                            <el-tabs>
                                <el-tab-pane :label="trans('services.title.data')">
                                    <!--related_offers-->
                                    <div class="panel box box-primary">
                                        <div class="box-header">
                                            <h4 class="box-title">
                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion"
                                                   :href="`#collapse-related_services`">
                                                    {{ trans('services.form.related_services') }}
                                                </a>
                                            </h4>
                                        </div>
                                        <div style="height: 0px;" :id="`collapse-related_services`"
                                             class="panel-collapse collapse">
                                            <div class="box-body">
                                                <el-form-item :label="trans('services.form.related_services')" :class="{'el-form-item is-error': form.errors.has('related_services') }">
                                                    <div  v-for="(id, key) in services.related_services" :key="key">
                                                        <entity-filter entity="Modules\Services\Entities\Services" v-model="services.related_services[key]">
                                                            <template v-slot:btn>
                                                                <el-button type="danger" @click="deleteVariant(key,'related_services')" size="mini"><i class="fa fa-trash"></i></el-button>
                                                            </template>
                                                        </entity-filter>
                                                    </div>
                                                    <el-form-item >
                                                        <el-button type="primary" @click="services.related_services.push({})" >
                                                            {{ trans('core.form.add') }}
                                                        </el-button>
                                                    </el-form-item>
                                                </el-form-item>
                                            </div>
                                        </div>
                                        <div class="el-form-item__error" v-if="form.errors.has('related_offers')"
                                             v-text="form.errors.first('related_offers')"></div>
                                    </div>
                                    <div v-if="doubles">
                                        <ul  class="list-group list-group-flush">
                                            <li class="list-group-item" v-for="(double,index) in doubles">
                                                <router-link :to="{name: 'admin.services.edit', params: { servicesId: double.id}}">{{ double.title }}</router-link>
                                            </li>
                                        </ul>
                                    </div>
                                </el-tab-pane>
                            </el-tabs>
                        </div>
                        <div class="box-footer">
                            <el-form-item>
                                <el-button type="primary" @click="onSubmit()" :loading="loading">
                                    {{ trans('core.button.save') }}
                                </el-button>
                                <el-button @click="onCancel()">{{ trans('core.button.cancel') }}
                                </el-button>
                            </el-form-item>
                        </div>
                    </div>
                </div>
            </div>
        </el-form>
        <button v-shortkey="['b']" @shortkey="pushRoute({name: 'backend::block.blocks.index'})" v-show="false"></button>
    </div>
</template>

<script>
    import axios from 'axios';
    import Form from 'form-backend-validation';
    import ShortcutHelper from '../../../../../Core/Assets/js/mixins/ShortcutHelper';


    export default {
        mixins: [ShortcutHelper],
        props: {
            locales: { default: null },
            pageTitle: { default: null, String },
        },
        data() {
            return {
                services: {
                    title: '',
                    related_services: [],
                },
                form: new Form(),
                loading: false,
                doubles: [],
            };
        },
        methods: {
            deleteVariant(index, offer) {
                this.services[offer].splice(index, 1);
            },
            validateUrl() {
                const regex = /^(http|https)/;
                return (!this.services.api_url.match(regex));
            },
            onSubmit() {
                this.form = new Form(this.services);
                this.loading = true;

                this.form.post(this.getRoute())
                    .then((response) => {
                        this.loading = false;
                        this.$message({
                            type: 'success',
                            message: response.message,
                        });
                        this.doubles = response;
                        // this.$router.push({ name: 'admin.services.index' });
                    })
                    .catch((error) => {
                        console.log(error);
                        this.loading = false;
                        this.$notify.error({
                            title: 'Error',
                            message: 'There are some errors in the form.',
                        });
                    });
            },
            onCancel() {
                this.$router.push({ name: 'admin.services.index' });
            },
            getRoute() {
                /*if (this.$route.params.servicesId !== undefined) {
                    return route('api.services.service.update', { services: this.$route.params.servicesId });
                }*/
                return route('api.services.service.check');
            },
            fetchByUrl(url) {
                return axios.get(url)
                    .then((response) => {
                        this.api_dates = response.data;
                    });
            },
        },
        mounted() {
        },
    };
</script>
