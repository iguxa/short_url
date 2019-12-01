<template>
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
                                    <!--title-->
                                    <el-form-item :label="trans('services.form.title')"
                                                  :class="{'el-form-item is-error': form.errors.has('title') }">
                                        <el-input
                                                v-model="services.title"></el-input>
                                        <div class="el-form-item__error" v-if="form.errors.has('title')"
                                             v-text="form.errors.first('title')"></div>
                                    </el-form-item>
                                    <!--description-->
                                    <el-form-item :label="trans('services.form.description')"
                                                  :class="{'el-form-item is-error': form.errors.has('description') }">
                                        <el-input
                                                v-model="services.description"></el-input>
                                        <div class="el-form-item__error" v-if="form.errors.has('description')"
                                             v-text="form.errors.first('description')"></div>
                                    </el-form-item>
                                    <!--redirect-->
                                    <!--<el-form-item :label="trans('services.form.redirect')"
                                                  :class="{'el-form-item is-error': form.errors.has('redirect') }">
                                        <el-input
                                                v-model="services.redirect"></el-input>
                                        <div class="el-form-item__error" v-if="form.errors.has('redirect')"
                                             v-text="form.errors.first('redirect')"></div>
                                    </el-form-item>-->
                                    <!--categories_type-->
                                    <el-form-item :label="trans('workflows.form.workflow_id')"
                                                  :class="{'el-form-item is-error': form.errors.has('workflow_id') }"><br>
                                        <el-select v-model="services.workflow_id">
                                            <el-option v-for="workflowItem in categorieslist" :key="workflowItem.id" :label="workflowItem.title" :value="workflowItem.id"></el-option>
                                        </el-select>
                                        <div class="el-form-item__error" v-if="form.errors.has( 'workflow_id')"
                                             v-text="form.errors.first('workflow_id')"></div>
                                    </el-form-item>

                                    <!--state-->
                                    <el-form-item :label="trans('services.form.state.title')"
                                                  :class="{'el-form-item is-error': form.errors.has('state') }">
                                        <el-checkbox
                                                v-model="services.state" :value="services.state">{{ trans('services.form.state.state') }}</el-checkbox>
                                        <div class="el-form-item__error" v-if="form.errors.has('state')"
                                             v-text="form.errors.first('state')"></div>
                                    </el-form-item>
                                    <!--api_url-->
                                    <el-form-item :label="trans('services.form.api_url')"
                                                  :class="{'el-form-item is-error': form.errors.has('api_url') }">
                                        <el-input
                                                v-model="services.api_url"></el-input>
                                        <div class="el-form-item__error" v-if="form.errors.has('api_url')"
                                             v-text="form.errors.first('api_url')"></div>
                                    </el-form-item>
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
                    state: '',
                    description: '',
                    title: '',
                    api_url: '',
                    related_services: [],
                    workflow_id: ''
                },
                form: new Form(),
                loading: false,
                api_dates: [],
                categorieslist:[]
            };
        },
        methods: {
            deleteVariant(index,offer) {
                this.services[offer].splice(index, 1);
            },
            validateUrl() {
                const regex = /^(http|https)/;
                return (!this.services.api_url.match(regex));
            },
            fetchCategories() {
                axios.get(route('api.services.workflow.index'))
                    .then((response) => {
                        this.categorieslist = response.data.data;
                    });
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
                        this.$router.push({ name: 'admin.services.index' });
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
            fetchServices() {
                if (this.$route.params.servicesId !== undefined) {
                    this.loading = true;
                    const routeUri = route('api.services.service.find', { services: this.$route.params.servicesId });
                    axios.get(routeUri)
                        .then((response) => {
                            this.loading = false;
                            this.services = response.data.data;
                        });
                }
            },
            getRoute() {
                if (this.$route.params.servicesId !== undefined) {
                    return route('api.services.service.update', { services: this.$route.params.servicesId });
                }
                return route('api.services.service.store');
            },
            fetchByUrl(url) {
                return axios.get(url)
                    .then((response) => {
                        this.api_dates = response.data;
                    });
            },
            updateServices() {
                this.form = new Form(this.api_dates);
                this.loading = true;

                this.form.post(route('api.services.service.updateservices'))
                    .then((response) => {
                        this.loading = false;
                        this.$message({
                            type: 'success',
                            message: response.message,
                        });
                        this.services.related_services = response;
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
        },
        watch:{
            'services.api_url': function(val, oldVal){
                if (val !== oldVal) {
                    if(val){
                        this.fetchByUrl(val).then(() => {
                            this.updateServices();
                        });
                    }
                }
            },
        },
        mounted() {
              this.fetchServices();
              this.fetchCategories();
        },
    };
</script>
