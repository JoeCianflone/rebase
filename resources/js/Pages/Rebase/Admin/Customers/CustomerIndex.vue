<script>
import Layout from "@/Templates/Rebase/Layout"
import Admin from "@/Templates/Rebase/Page/Admin"
import ActionMenu from "@/Components/Rebase/Actions/ActionMenu"
import ActionLink from "@/Components/Rebase/Actions/ActionLink"
import ActionButton from "@/Components/Rebase/Actions/ActionButton"
import DataTable from "@/Components/Rebase/DataTable"
import ContentGroup from "@/Components/Rebase/ContentGroup"
import { states } from "@/Data/Rebase/consts"

export default {
   layout: Layout,
   metaInfo: { title: "Customer Billing Information" },

   components: {
      Admin,
      ActionMenu,
      ActionLink,
      ActionButton,
      DataTable,
      ContentGroup,
   },

   props: {
      customer: Object,
      invoices: Object | Array,
      workspaces: Array,
      owners: Array,
   },

   data: function () {
      return {
         states: states,
         sending: false,
         workspaceStatus: null,
         billingAddressForm: {
            line1: this.customer.line1,
            line2: this.customer.line2,
            line3: this.customer.line3,
            unit_number: this.customer.unit_number,
            city: this.customer.city,
            state: this.customer.state,
            postal_code: this.customer.postal_code,
         },
      }
   },

   methods: {
      editBillingAddress() {
         this.$inertia.post(
            route("customer.update", [this.$page.props.customer_id, "address"]),
            {
               billingAddress: this.billingAddressForm,
            },
            {
               onStart: () => (this.sending = true),
               onFinish: () => (this.sending = false),
            }
         )
      },
      dangerArchive(id, name) {
         if (confirm("Are you sure you want to archive " + name)) {
            this.$inertia.post(
               route("customer.workspaces.archive", [this.$page.props.customer_id, id]),
               {},
               {
                  onStart: () => (this.sending = true),
                  onFinish: () => (this.sending = false),
               }
            )
         }
      },
   },
}
</script>

<template>
   <Admin nav="customer">
      <template #header>Customer Settings</template>
      <template v-slot:body>
         <div class="grid">
            <div class="col-10--centered md::col-6">
               <ContentGroup>
                  <template v-slot:contentTitle>Account Owner Details</template>
                  <ul>
                     <li v-for="owner in owners" :key="owner.id">{{ owner.name }}</li>
                  </ul>
               </ContentGroup>

               <ContentGroup :userCanEdit="true">
                  <template v-slot:contentTitle>Billing Address</template>
                  <address>
                     {{ customer.line1 }} {{ customer.unit_number }}<br />
                     {{ customer.line2 }}<br v-if="customer.line2" />
                     {{ customer.line3 }}<br v-if="customer.line3" />
                     {{ customer.city }}, {{ customer.state }} {{ customer.postal_code }}
                  </address>
                  <template v-slot:contentEdit>
                     <form method="post" class="grid" @submit.prevent="editBillingAddress">
                        <FormField validate="line1" class="col-12 md::col-10">
                           <FieldLabel>Address Line 1:</FieldLabel>
                           <FormInput v-model="billingAddressForm.line1" />
                        </FormField>

                        <FormField validate="unit_number" class="col-12 md::col-2">
                           <FieldLabel>Unit Number:</FieldLabel>
                           <FormInput v-model="billingAddressForm.unit_number" />
                        </FormField>

                        <FormField validate="line2" class="col-12">
                           <FieldLabel>Address Line 2:</FieldLabel>
                           <FormInput v-model="billingAddressForm.line2" />
                        </FormField>

                        <FormField validate="line3" class="col-12">
                           <FieldLabel>Address Line 3:</FieldLabel>
                           <FormInput v-model="billingAddressForm.line3" />
                        </FormField>

                        <FormField validate="city" class="col-12 md::col-6">
                           <FieldLabel>City:</FieldLabel>
                           <FormInput v-model="billingAddressForm.city" />
                        </FormField>

                        <FormField validate="state" class="col-12 md::col-3">
                           <FieldLabel>State:</FieldLabel>
                           <FormSelect v-model="billingAddressForm.state" defaultText="Select" :options="states" />
                        </FormField>

                        <FormField validate="postal_code" class="col-12 md::col-3">
                           <FieldLabel>Postal Code:</FieldLabel>
                           <FormInput v-model="billingAddressForm.postal_code" maxlength="5" />
                        </FormField>

                        <Button type="submit" class="col-12 button" :disable="sending">Update</Button>
                     </form>
                  </template>
               </ContentGroup>

               <ContentGroup :userCanEdit="true">
                  <template v-slot:contentTitle>Card Details</template>
                  {{ customer.card_brand }}<br />
                  **** **** **** {{ customer.card_last_four }}<br />
               </ContentGroup>

               <ContentGroup>
                  <template v-slot:contentTitle>Your Invoices</template>
                  <ul>
                     <li v-for="invoice in invoices" :key="invoice.id">Paid: {{ invoice.total }} on {{ invoice.invoice_date }} <a :href="invoice.link">Download Invoice</a></li>
                  </ul>
               </ContentGroup>
            </div>
            <ContentGroup class="col-10--centered md::col-5:at-8">
               <template v-slot:contentTitle>Product Name</template>
               <p>This is my generic product details.</p>
               <p>Hey, this would be awesome if there was a products_table that showed some stuff.</p>
            </ContentGroup>
         </div>
         <div class="grid">
            <div class="col-10--centered md::col-12">
               <h2>Workspaces</h2>
               <DataTable>
                  <template #header>
                     <th>&nbsp;</th>
                     <th>Name</th>
                     <th>URL</th>
                     <th>Active Members</th>
                     <th>Total Users</th>
                     <th>&nbsp;</th>
                  </template>
                  <template #contents>
                     <tr v-for="workspace in workspaces" :key="workspace.id">
                        <td><input type="checkbox" /></td>
                        <td title="Name">{{ workspace.name }}</td>
                        <td title="Slug">{{ workspace.slug }}</td>
                        <td>{{ workspace.active_users }}</td>
                        <td>{{ workspace.total_users }}</td>
                        <td>
                           <ActionMenu>
                              <ActionLink link="#">Update</ActionLink>
                              <ActionButton @click="dangerArchive(workspace.id, workspace.name)">Archive</ActionButton>
                           </ActionMenu>
                        </td>
                     </tr>
                  </template>
               </DataTable>
            </div>
         </div>
      </template>
   </Admin>
</template>
