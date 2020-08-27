import { InertiaApp } from "@inertiajs/inertia-vue"
import PortalVue from "portal-vue"
import VueMeta from "vue-meta"
import Vue from "vue"

// Global Components
import FormFieldInline from "@/Rebase/Components/Form/FormFieldInline"
import FormCheckbox from "@/Rebase/Components/Form/FormCheckbox"
import FormTextArea from "@/Rebase/Components/Form/FormTextArea"
import FormSelect from "@/Rebase/Components/Form/FormSelect"
import FormField from "@/Rebase/Components/Form/FormField"
import FormGroup from "@/Rebase/Components/Form/FormGroup"
import FormRadio from "@/Rebase/Components/Form/FormRadio"
import FormInput from "@/Rebase/Components/Form/FormInput"
import FieldLabel from "@/Rebase/Components/Form/FieldLabel"
import Button from "@/Rebase/Components/Form/Button"

Vue.component("FormFieldInline", FormFieldInline)
Vue.component("FormCheckbox", FormCheckbox)
Vue.component("FormTextArea", FormTextArea)
Vue.component("FormSelect", FormSelect)
Vue.component("FormField", FormField)
Vue.component("FormGroup", FormGroup)
Vue.component("FormRadio", FormRadio)
Vue.component("FormInput", FormInput)
Vue.component("FieldLabel", FieldLabel)
Vue.component("Button", Button)

Vue.config.productionTip = false

Vue.use(InertiaApp)
Vue.use(PortalVue)
Vue.use(VueMeta)

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
