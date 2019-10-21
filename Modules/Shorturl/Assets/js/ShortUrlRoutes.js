import ShortUrlTable from './components/ShortUrlTable.vue';
import ShortUrlForm from './components/ShortUrlForm.vue';
import ShortUrWatch from './components/ShortUrWatch.vue';

const locales = window.AsgardCMS.locales;

export default [
    {
        path: '/shorturl',
        name: 'admin.shorturl.index',
        component: ShortUrlTable,
    },
    {
        path: '/shorturl/create',
        name: 'admin.shorturl.create',
        component: ShortUrlForm,
        props: {
            locales,
            pageTitle: 'create shorturl',
        },
    },
    {
        path: '/shorturl/:shorturlId/edit',
        name: 'admin.shorturl.edit',
        component: ShortUrlForm,
        props: {
            locales,
            pageTitle: 'edit shorturl',
        },
    },
    {
        path: '/shorturl/:shorturlId/watch',
        name: 'admin.shorturl.watch',
        component: ShortUrWatch,
        props: {
            locales,
            pageTitle: 'watch shorturl',
        },
    },
];
