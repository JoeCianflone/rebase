import { InertiaApp } from "@inertiajs/inertia-vue"
import PortalVue from "portal-vue"
import VueMeta from "vue-meta"
import Vue from "vue"
import VueCompositionApi from "@vue/composition-api"

// Global Components
import FormText from "@/Shared/Components/Form/FormText"
import FormSelect from "@/Shared/Components/Form/FormSelect"
import FormField from "@/Shared/Components/Form/FormField"
import FormGroup from "@/Shared/Components/Form/FormGroup"
import FormTextArea from "@/Shared/Components/Form/FormTextArea"
import Button from "@/Shared/Components/Form/Button"

Vue.component("FormText", FormText)
Vue.component("FormSelect", FormSelect)
Vue.component("FormField", FormField)
Vue.component("FormGroup", FormGroup)
Vue.component("FormTextArea", FormTextArea)
Vue.component("Button", Button)

Vue.config.productionTip = false

Vue.use(InertiaApp)
Vue.use(PortalVue)
Vue.use(VueMeta)
Vue.use(VueCompositionApi)

let app = document.getElementById("app")

new Vue({
   metaInfo: {
      title: "Loading...",
      titleTemplate: "%s | Rebase App",
   },
   render: (h) =>
      h(InertiaApp, {
         props: {
            initialPage: JSON.parse(app.dataset.page),
            resolveComponent: (name) => import(`@/${name}`).then((module) => module.default),
         },
      }),
}).$mount(app)
