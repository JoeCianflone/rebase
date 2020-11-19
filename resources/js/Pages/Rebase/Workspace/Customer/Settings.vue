<script>
import Layout from "@/Templates/Rebase/Workspace"
import AdminPage from "@/Templates/Rebase/AdminPage"
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
      AdminPage,
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
   },

   data: function () {
      return {
         states: states,
         sending: false,
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
            route("customer.update", "address"),
            {
               billingAddress: this.billingAddressForm,
            },
            {
               onStart: () => (this.sending = true),
               onFinish: () => (this.sending = false),
            }
         )
      },
   },
}
</script>

<template>
   <AdminPage nav="settings">
      <template v-slot:header>Customer Settings</template>
      <template v-slot:body>
         <div class="grid">
            <div class="col-10--centered sm::col-6">
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
            </div>
            <ContentGroup class="col-10--centered sm::col-5:at-8">
               <template v-slot:contentTitle>Product Name</template>
               <p>This is my generic product details.</p>
               <p>Hey, this would be awesome if there was a products_table that showed some stuff.</p>
            </ContentGroup>
         </div>
         <div class="grid">
            <div class="col-10--centered sm::col-12">
               <h2>Workspaces</h2>
               <DataTable>
                  <template v-slot:dataHeader>
                     <th>&nbsp;</th>
                     <th>Name</th>
                     <th>URL</th>
                     <th>Active Members</th>
                     <th>Total Users</th>
                     <th>&nbsp;</th>
                  </template>
                  <template v-slot:dataBody>
                     <tr v-for="workspace in workspaces" :key="workspace.id">
                        <td><input type="checkbox" /></td>
                        <td title="Name">{{ workspace.name }}</td>
                        <td title="Slug">{{ workspace.slug }}</td>
                        <td>{{ workspace.active_users }}</td>
                        <td>{{ workspace.total_users }}</td>
                        <td>
                           <ActionMenu>
                              <ActionLink link="#">Update</ActionLink>
                              <ActionButton @click="dangerDelete(workspace.id, workspace.name)">Close Account</ActionButton>
                           </ActionMenu>
                        </td>
                     </tr>
                  </template>
               </DataTable>
            </div>
         </div>
      </template>
   </AdminPage>
</template>
