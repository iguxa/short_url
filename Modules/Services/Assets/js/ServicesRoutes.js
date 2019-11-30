import ShortUrlTable from './components/ShortUrlTable.vue';
import ShortUrlForm from './components/ShortUrlForm.vue';
import ShortUrWatch from './components/ShortUrWatch.vue';

const locales = window.AsgardCMS.locales;

export default [
    {
        path: '/services',
        name: 'admin.services.index',
        component: ShortUrlTable,
    },
    {
        path: '/services/create',
        name: 'admin.services.create',
        component: ShortUrlForm,
        props: {
            locales,
            pageTitle: 'create services',
        },
    },
    {
        path: '/shorturl/:servicesId/edit',
        name: 'admin.services.edit',
        component: ShortUrlForm,
        props: {
            locales,
            pageTitle: 'edit services',
        },
    },
    {
        path: '/shorturl/:serviceslId/watch',
        name: 'admin.services.watch',
        component: ShortUrWatch,
        props: {
            locales,
            pageTitle: 'watch services',
        },
    },
];
