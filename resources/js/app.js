import { InertiaApp } from '@inertiajs/inertia-vue';
import PortalVue from 'portal-vue';
import VueMeta from 'vue-meta';

import Vue from 'vue';

Vue.config.productionTip = false;

Vue.use(InertiaApp);
Vue.use(PortalVue);
Vue.use(VueMeta);

let app = document.getElementById('app');

new Vue({
    metaInfo: {
        title: 'Loading...',
        titleTemplate: '%s | Rebase App',
      },
  render: h => h(InertiaApp, {
    props: {
      initialPage: JSON.parse(app.dataset.page),
      resolveComponent: name => import(`@/Pages/${name}`).then(module => module.default),
    },
  }),
}).$mount(app);
