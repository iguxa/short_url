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
                <el-breadcrumb-item :to="{name: 'admin.services.index'}">{{ trans('service.title.services.workflow') }}
                </el-breadcrumb-item>
                <el-breadcrumb-item :to="{name: 'admin.services.create'}">{{ trans(`service.title.services.create`) }}
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
                                        <div v-if=workflow.doc_src>
                                            <img :src=workflow.doc_src alt="">
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
    import ShortcutHelper from '../../../../../Core/Assets/js/mixins/ShortcutHelper';


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
                workflow: {
                    generate: '',
                    doc_src: '',
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
            generateWorkFlow() {
                    this.loading = true;
                    const routeUri = route('api.services.service.generate');
                    axios.get(routeUri)
                        .then((response) => {
                            this.loading = false;
                            this.workflow.generate = response.data.generate;
                        });
            },
            getDoc(){
                this.loading = true;
                const routeUri = route('api.services.service.getdoc');
                axios.get(routeUri)
                    .then((response) => {
                        this.loading = false;
                        this.workflow.doc_src = response.data.src;
                    });
            },
            getRoute() {
                if (this.$route.params.shorturlId !== undefined) {
                    return route('api.shorturl.update', { shorturl_id: this.$route.params.shorturlId });
                }
                return route('api.shorturl.store');
            },
        },
        watch:{
            'workflow.generate': function(val, oldVal){
                if (val !== oldVal){
                    if(val){
                        this.getDoc();
                    }
                }
            },
        },
        mounted() {
              this.generateWorkFlow();
        },
    };
</script>
