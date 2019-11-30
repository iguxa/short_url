<template>
    <div>
        <div class="content-header">
            <h1>
                {{ trans('shorturls.title.shorturls') }} <small>{{ shorturl.name }}</small>
            </h1>
            <el-breadcrumb separator="/">
                <el-breadcrumb-item>
                    <a href="/backend">{{ trans('core.breadcrumb.home') }}</a>
                </el-breadcrumb-item>
                <el-breadcrumb-item :to="{name: 'admin.shorturl.index'}">{{ trans('shorturls.title.shorturls') }}
                </el-breadcrumb-item>
                <el-breadcrumb-item :to="{name: 'admin.shorturl.watch'}">{{ trans(`shorturls.title.watch`) }}
                </el-breadcrumb-item>
            </el-breadcrumb>
        </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-body">
                                    <!--title-->
                                    <div>
                                        <h2>{{ trans('shorturls.form.title') }}</h2>
                                        <a :href="shorturl.title">{{shorturl.title}}</a>
                                    </div>
                                     <!--redirect-->
                                     <div>
                                         <h2>{{ trans('shorturls.form.redirect') }}</h2>
                                         <a :href="shorturl.redirect">{{shorturl.redirect}}</a>
                                     </div>
                                    <!--description-->
                                    <div>
                                        <h2>{{ trans('shorturls.form.description') }}</h2>
                                        {{shorturl.description}}
                                    </div>
                                    <!--state-->
                                    <div>
                                        <i class="fa fa-circle" :class="(shorturl.state === true) ? 'text-success':'text-danger'">
                                            {{(shorturl.state === true) ? trans('shorturls.form.state.true'):trans('shorturls.form.state.false')}}
                                        </i>
                                    </div>
                                    <!--visitors-->
                                    <div
                                            v-for="(visitor,index) in shorturl.visitors"
                                            :key=index
                                    >
                                        <div class="panel box box-primary">
                                            <div class="box-header">
                                                <h4 class="box-title">
                                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion"
                                                       :href="`#collapse-${visitor.id}`">
                                                        {{ trans('shorturls.visitor.title') +' '+ visitor.id}}
                                                    </a>
                                                </h4>
                                            </div>
                                            <div style="height: 0px;" :id="`collapse-${visitor.id}`"
                                                 class="panel-collapse collapse">
                                                <div class="box-body">
                                                    <b>HTTP_USER_AGENT</b> : {{JSON.parse(visitor.server)['HTTP_USER_AGENT']}}<br>
                                                    <b>REMOTE_ADDR</b> : {{JSON.parse(visitor.server)['REMOTE_ADDR']}}<br>
                                                    <b>{{ trans('shorturls.visitor.counter') }}</b> : {{visitor.counter}}<br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        </div>
                    </div>
                </div>
            </div>
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
                    visitors: {},
                },
                form: new Form(),
                loading: false,
                id: 'id',
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
