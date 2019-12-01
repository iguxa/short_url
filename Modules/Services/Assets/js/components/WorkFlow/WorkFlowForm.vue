<template>
    <div class="div">
        <div class="content-header">
            <h1>
                {{ trans('workflow.title.workflow') }}
            </h1>
            <el-breadcrumb separator="/">
                <el-breadcrumb-item>
                    <a href="/backend">{{ trans('core.breadcrumb.home') }}</a>
                </el-breadcrumb-item>
                <el-breadcrumb-item :to="{name: 'admin.services.workflow.index'}">{{ trans('workflow.title.services.workflow') }}
                </el-breadcrumb-item>
                <el-breadcrumb-item :to="{name: 'admin.services.workflow.create'}">{{ trans(`workflow.title.services.create`) }}
                </el-breadcrumb-item>
            </el-breadcrumb>
        </div>
        <el-form ref="form" workflow-width="120px" workflow-position="top"
                 v-loading.body="loading"
                 @keydown="form.errors.clear($event.target.name);">
            <div class="row">
                <div class="col-md-10">
                    <div class="box box-primary">
                        <div class="box-body">
                            <!--title-->
                            <el-form-item :label="trans('workflow.form.title')"
                                          :class="{'el-form-item is-error': form.errors.has('title') }">
                                <el-input v-model="workflow.title"></el-input>
                                <div class="el-form-item__error" v-if="form.errors.has('title')"
                                     v-text="form.errors.first('title')"></div>
                            </el-form-item>
                            <!--slug-->
                            <!--<el-form-item :label="trans('workflow.form.slug')"
                                          :class="{'el-form-item is-error': form.errors.has('slug') }">
                                <el-input v-model="workflow.slug">
                                    <el-button slot="prepend" @click="generateSlug($event )">Generate</el-button>
                                </el-input>
                                <div class="el-form-item__error" v-if="form.errors.has('slug')"
                                     v-text="form.errors.first('slug')"></div>
                            </el-form-item>-->
                            <!--description-->
                            <el-form-item :label="trans('workflow.form.description')"
                                          :class="{'el-form-item is-error': form.errors.has('description') }">
                                <el-input type="textarea"
                                          v-model="workflow.description"></el-input>
                                <div class="el-form-item__error" v-if="form.errors.has( 'description')"
                                     v-text="form.errors.first('description')"></div>
                            </el-form-item>
                            <!--categories_type-->
                            <el-form-item :label="trans('workflow.form.parent_workflow')"
                                          :class="{'el-form-item is-error': form.errors.has('parent') }"><br>
                                <el-select v-model="workflow.id">
                                    <el-option label="Родительская категория" :value="null"></el-option>
                                    <el-option v-for="workflowItem in categorieslist" :key="workflowItem.id" :label="workflowItem.title" :value="workflowItem.id"></el-option>
                                </el-select>
                                <div class="el-form-item__error" v-if="form.errors.has( 'parent')"
                                     v-text="form.errors.first('parent')"></div>
                            </el-form-item>
                            <!--meta-->
                            <!--<div class="panel box box-primary">
                                <div class="box-header">
                                    <h4 class="box-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion"
                                           :href="`#collapseMeta-article`">
                                            {{ trans('workflow.form.meta_data') }}
                                        </a>
                                    </h4>
                                </div>
                                <div style="height: 0px;" :id="`collapseMeta-article`"
                                     class="panel-collapse collapse">
                                    <div class="box-body">
                                        <el-form-item :workflow="trans('workflow.form.meta_title')"
                                                      :class="{'el-form-item is-error': form.errors.has('meta_title') }">
                                            <el-input v-model="workflow.meta_title"></el-input>
                                            <div class="el-form-item__error" v-if="form.errors.has( 'meta_title')"
                                                 v-text="form.errors.first('meta_title')"></div>
                                        </el-form-item>
                                        <el-form-item :workflow="trans('workflow.form.meta_description')"
                                                      :class="{'el-form-item is-error': form.errors.has('meta_description') }">
                                            <el-input type="textarea"
                                                      v-model="workflow.meta_description"></el-input>
                                            <div class="el-form-item__error" v-if="form.errors.has( 'meta_description')"
                                                 v-text="form.errors.first('meta_description')"></div>
                                        </el-form-item>
                                        <el-form-item :workflow="trans('workflow.form.meta_keywords')"
                                                      :class="{'el-form-item is-error': form.errors.has('meta_keywords') }">
                                            <el-input type="textarea"
                                                      v-model="workflow.meta_keywords"></el-input>
                                            <div class="el-form-item__error" v-if="form.errors.has( 'meta_keywords')"
                                                 v-text="form.errors.first('meta_keywords')"></div>
                                        </el-form-item>
                                    </div>
                                </div>
                            </div>-->
                            <!--related_offers-->
                            <div class="panel box box-primary">
                                <div class="box-header">
                                    <h4 class="box-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion"
                                           :href="`#collapse-related_workflow`">
                                            {{ trans('workflow.form.related_workflow') }}
                                        </a>
                                    </h4>
                                </div>
                                <div style="height: 0px;" :id="`collapse-related_workflow`"
                                     class="panel-collapse collapse">
                                    <div class="box-body">
                                        <el-form-item :label="trans('workflow.form.related_workflow')" :class="{'el-form-item is-error': form.errors.has('related_workflow') }">
                                            <div  v-for="(id, key) in workflow.related_workflow" :key="key">
                                                <entity-filter entity="Modules\Services\Entities\WorkFlows" v-model="workflow.related_workflow[key]">
                                                    <template v-slot:btn>
                                                        <el-button type="danger" @click="deleteVariant(key,'related_workflow')" size="mini"><i class="fa fa-trash"></i></el-button>
                                                    </template>
                                                </entity-filter>
                                            </div>
                                            <el-form-item >
                                                <el-button type="primary" @click="workflow.related_workflow.push({})" >
                                                    {{ trans('core.form.add') }}
                                                </el-button>
                                            </el-form-item>
                                        </el-form-item>
                                    </div>
                                </div>
                                <div class="el-form-item__error" v-if="form.errors.has('related_offers')"
                                     v-text="form.errors.first('related_offers')"></div>
                            </div>
                            <!--state-->
                            <el-form-item :workflow="trans('workflow.form.status')"
                                          :class="{'el-form-item is-error': form.errors.has('state') }">
                                <el-checkbox v-model="workflow.state">{{ trans('workflow.form.state') }}</el-checkbox>
                                <div class="el-form-item__error" v-if="form.errors.has( 'state')"
                                     v-text="form.errors.first('state')"></div>
                            </el-form-item>
                            <el-form-item>
                                <el-button type="primary" @click="onSubmit()" :loading="loading">
                                    {{ trans('core.save') }}
                                </el-button>
                                <el-button @click="onCancel()">{{ trans('core.button.cancel') }}
                                </el-button>
                            </el-form-item>
                        </div>
                    </div>
                </div>
            </div>
        </el-form>
        <!--<button v-shortkey="['b']" @shortkey="pushRoute({name: 'backend::articles.articles.index'})" v-show="false"></button>-->
    </div>
</template>

<script>
    import axios from 'axios';
    import Form from 'form-backend-validation';
    import Slugify from '../../../../../Core/Assets/js/mixins/Slugify';
    import ShortcutHelper from '../../../../../Core/Assets/js/mixins/ShortcutHelper';
    import ActiveEditor from '../../../../../Core/Assets/js/mixins/ActiveEditor';
    import SingleFileSelector from '../../../../../Media/Assets/js/mixins/SingleFileSelector';


    export default {
        mixins: [Slugify, ShortcutHelper, ActiveEditor, SingleFileSelector],

        data() {
            return {
                workflow: {
                    id: '',
                    title: '',
                    description: '',
                    state: '',
                    parent: '',
                    related_workflow: [],
                },
                form: new Form(),
                loading: false,
                loaded: false,
                categorieslist: [],
            };
        },
        methods: {
            deleteVariant(index,offer) {
                this.workflow[offer].splice(index, 1);
            },
            fetchCategories() {
                axios.get(route('api.services.workflow.index'))
                    .then((response) => {
                        this.categorieslist = response.data.data;
                    });
            },
            fetchWorkflow() {
                if (this.$route.params.workflowId !== undefined) {
                    this.loading = true;
                    const routeUri = route('api.services.workflow.find', { workflow: this.$route.params.workflowId });
                    return axios.get(routeUri)
                        .then(response => this.workflow = response.data.data);
                }
            },
            makeBeforeSend() {
                // this.addContentFormEditors();
            },
            onSubmit() {
                this.makeBeforeSend();
                this.form = new Form(this.workflow);
                this.loading = true;

                this.form.post(this.getRoute())
                    .then((response) => {
                        this.loading = false;
                        this.$message({
                            type: 'success',
                            message: response.message,
                        });
                        this.$router.push({ name: 'admin.services.workflow.index' });
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
                this.$router.push({ name: 'admin.services.workflow.index' });
            },
            generateSlug(workflow) {
                this.workflow.slug = this.slugify(this.workflow.title);
            },
            getRoute() {
                if (this.$route.params.workflowId !== undefined) {
                    return route('api.services.workflow.update', { workflow: this.$route.params.workflowId });
                }
                return route('api.services.workflow.store');
            },
        },
        watch: {
        },
        mounted() {
            if (this.$route.params.workflowId !== undefined) {
                this.fetchWorkflow().then(() => {
                    this.fetchCategories();
                    this.loading = false;
                    this.loaded = true;
                });
            } else {
                this.fetchCategories();
                this.loaded = true;
            }
        },
        destroyed() {
            $('.publicUrl').hide();
        },
    };
</script>
