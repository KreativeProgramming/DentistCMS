require('./bootstrap');

// Import modules...
import Vue from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue';
import PortalVue from 'portal-vue';
import { InertiaProgress } from '@inertiajs/progress';
import VueMeta from 'vue-meta'
import "@fortawesome/fontawesome-free/css/all.min.css";
import Vuelidate from "vuelidate";
import SmartTable from 'vuejs-smart-table'

Vue.mixin({ methods: { route } });
Vue.use(InertiaPlugin);
Vue.use(PortalVue);
Vue.use(Vuelidate);
Vue.use(VueMeta);
Vue.use(SmartTable);

InertiaProgress.init({
    color: '#2563eb',
})

const app = document.getElementById('app');

new Vue({
     metaInfo: {
        titleTemplate: (title) => title ? `${title} - DentistCMS` : 'DentistCMS'
      },
    render: (h) =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: (name) => require(`./Pages/${name}`).default,
            },
        }),
}).$mount(app);
