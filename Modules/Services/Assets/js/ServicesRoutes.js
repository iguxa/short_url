import ServicesTable from './components/Services/ServicesTable';
import ServicesForm from './components/Services/ServicesForm';
import ServicesWatch from './components/Services/ServicesWatch';
import WorkFlowTable from './components/WorkFlow/WorkFlowTable';
import WorkFlowForm from './components/WorkFlow/WorkFlowForm';
import WorkFlowWatch from './components/WorkFlow/WorkFlowWatch';
import WorkFlowGenerate from './components/WorkFlow/WorkFlowGenerate';

const locales = window.AsgardCMS.locales;

export default [
    // services
    {
        path: '/services/service',
        name: 'admin.services.index',
        component: ServicesTable,
    },
    {
        path: '/services/service/create',
        name: 'admin.services.create',
        component: ServicesForm,
        props: {
            locales,
            pageTitle: 'create services',
        },
    },
    {
        path: '/services/service/:servicesId/edit',
        name: 'admin.services.edit',
        component: ServicesForm,
        props: {
            locales,
            pageTitle: 'edit services',
        },
    },
    {
        path: '/services/service/:serviceslId/watch',
        name: 'admin.services.watch',
        component: ServicesWatch,
        props: {
            locales,
            pageTitle: 'watch services',
        },
    },
    // workflow
    {
        path: '/services/workflow',
        name: 'admin.services.workflow.index',
        component: WorkFlowTable,
    },
    {
        path: '/services/workflow/create',
        name: 'admin.services.workflow.create',
        component: WorkFlowForm,
        props: {
            locales,
            pageTitle: 'create workflow',
        },
    },
    {
        path: '/services/workflow/:workflowId/edit',
        name: 'admin.services.workflow.edit',
        component: WorkFlowForm,
        props: {
            locales,
            pageTitle: 'edit workflow',
        },
    },
    {
        path: '/services/workflow/:workflowlId/watch',
        name: 'admin.services.workflow.watch',
        component: WorkFlowWatch,
        props: {
            locales,
            pageTitle: 'watch workflow',
        },
    },
    {
        path: '/services/workflow/generate',
        name: 'admin.services.workflow.generate',
        component: WorkFlowGenerate,
    },
];
