
import { App, plugin } from '@inertiajs/inertia-vue'
import PortalVue from "portal-vue"
import VueMeta from "vue-meta"
import Vue from "vue"
import { InertiaProgress } from '@inertiajs/progress/src'

InertiaProgress.init({
   delay: 250,
   color: "#29d",
   includeCSS: true,
   showSpinner: false,
})

// Global Components
import FormFieldInline from "@/Components/Rebase/Form/FormFieldInline"
import FormCheckbox from "@/Components/Rebase/Form/FormCheckbox"
import FormTextArea from "@/Components/Rebase/Form/FormTextArea"
import FormSelect from "@/Components/Rebase/Form/FormSelect"
import FormField from "@/Components/Rebase/Form/FormField"
import FormGroup from "@/Components/Rebase/Form/FormGroup"
import FormRadio from "@/Components/Rebase/Form/FormRadio"
import FormInput from "@/Components/Rebase/Form/FormInput"
import FieldLabel from "@/Components/Rebase/Form/FieldLabel"
import Button from "@/Components/Rebase/Form/Button"
import RoleCheck from "@/Plugins/Rebase/RoleCheck"

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

Vue.use(plugin)
Vue.use(PortalVue)
Vue.use(VueMeta)
Vue.use(RoleCheck)

let el = document.getElementById("app")

Vue.mixin({ methods: { route: window.route } })

new Vue({
   metaInfo: {
      title: "Loading...",
      titleTemplate: "%s | Rebase App",
   },
   render: h => h(App, {
     props: {
       initialPage: JSON.parse(el.dataset.page),
       resolveComponent: name => require(`.${name}`).default,
     },
   }),
 }).$mount(el)
