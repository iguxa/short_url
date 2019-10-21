<template>
    <div>
        <div class="content-header">
            <h1>
                {{ trans('shorturl.title.shorturl') }} <small>{{ shorturl.name }}</small>
            </h1>
            <el-breadcrumb separator="/">
                <el-breadcrumb-item>
                    <a href="/backend">{{ trans('core.breadcrumb.home') }}</a>
                </el-breadcrumb-item>
                <el-breadcrumb-item :to="{name: 'shorturl.index'}">{{ trans('shorturl.title.shorturl') }}
                </el-breadcrumb-item>
                <el-breadcrumb-item :to="{name: 'shorturl.create'}">{{ trans(`shorturl.title.create`) }}
                </el-breadcrumb-item>
            </el-breadcrumb>
        </div>
        <el-form ref="form"
                 :model="shorturl"
                 label-width="120px"
                 label-position="top"
                 v-loading.body="loading"
                 @keydown="form.errors.clear($event.target.name);">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-body">
                            <el-tabs>
                                <el-tab-pane :label="trans('shorturl.title.data')">
                                    <!--title-->
                                    <el-form-item v-if="shorturl.title" :label="trans('shorturl.form.title')"
                                                  :class="{'el-form-item is-error': form.errors.has('title') }">
                                        <el-input
                                                disabled
                                                v-model="shorturl.title"></el-input>
                                        <div class="el-form-item__error" v-if="form.errors.has('title')"
                                             v-text="form.errors.first('title')"></div>
                                    </el-form-item>
                                    <!--description-->
                                    <el-form-item :label="trans('shorturl.form.description')"
                                                  :class="{'el-form-item is-error': form.errors.has('description') }">
                                        <el-input
                                                v-model="shorturl.description"></el-input>
                                        <div class="el-form-item__error" v-if="form.errors.has('description')"
                                             v-text="form.errors.first('description')"></div>
                                    </el-form-item>
                                    <!--redirect-->
                                    <el-form-item :label="trans('shorturl.form.redirect')"
                                                  :class="{'el-form-item is-error': form.errors.has('redirect') }">
                                        <el-input
                                                v-model="shorturl.redirect"></el-input>
                                        <div class="el-form-item__error" v-if="form.errors.has('redirect')"
                                             v-text="form.errors.first('redirect')"></div>
                                    </el-form-item>
                                    <!--state-->
                                    <el-form-item :label="trans('shorturl.form.state')"
                                                  :class="{'el-form-item is-error': form.errors.has('state') }">
                                        <el-checkbox
                                                v-model="shorturl.state" :value="shorturl.state">{{ trans('guide_categories.form.state') }}</el-checkbox>
                                        <div class="el-form-item__error" v-if="form.errors.has('state')"
                                             v-text="form.errors.first('state')"></div>
                                    </el-form-item>
                                </el-tab-pane>
                            </el-tabs>
                        </div>
                        <div class="box-footer">
                            <el-form-item>
                                <el-button type="primary" @click="onSubmit()" :loading="loading" :disabled="validateUrl()">
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
    import ShortcutHelper from '../../../../Core/Assets/js/mixins/ShortcutHelper';


    export default {
        mixins: [ShortcutHelper],
        props: {
            locales: { default: null },
            pageTitle: { default: null, String },
        },
        data() {
            return {
                shorturl: {
                    state: '',
                    description: '',
                    redirect: '',
                },
                form: new Form(),
                loading: false,
            };
        },
        methods: {
            onSubmit() {
                this.form = new Form(this.shorturl);
                this.loading = true;

                this.form.post(this.getRoute())
                    .then((response) => {
                        this.loading = false;
                        this.$message({
                            type: 'success',
                            message: response.message,
                        });
                        this.$router.push({ name: 'admin.shorturl.index' });
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
                this.$router.push({ name: 'admin.shorturl.index' });
            },
            validateUrl() {
                const regex = /^(http|https)/;
                return (!this.shorturl.redirect.match(regex));
            },
            fetchShortUrl() {
                if (this.$route.params.shorturlId !== undefined) {
                    this.loading = true;
                    const routeUri = route('api.shorturl.find', { shorturl_id: this.$route.params.shorturlId });
                    axios.get(routeUri)
                        .then((response) => {
                            this.loading = false;
                            this.shorturl = response.data.data;
                        });
                }
            },
            getRoute() {
                if (this.$route.params.shorturlId !== undefined) {
                    return route('api.shorturl.update', { shorturl_id: this.$route.params.shorturlId });
                }
                return route('api.shorturl.store');
            },
        },
        mounted() {
              this.fetchShortUrl();
        },
    };
</script>
