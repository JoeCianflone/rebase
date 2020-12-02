# Class Names and Folders

## Guest

-  Legal::class
-  Privacy::class
-  Registration
   -  Check::class
   -  Register::class
   -  RegisterProcess::class
-  CustomerSearch
   -  SearchIndex::class
   -  SearchProcess::class

## Admin

-  Pick::class
-  Auth
   -  Login::class
   -  LoginProcess::class
   -  LogoutProcess::class
- ForgotPassword
  - Forgot::class
  - Reset::class
-  Customers
   -  CustomerIndex::class
   -  CustomerSubscription::class
   -  CustomerInvoices::class
- Subscriptions
  - SubscriptionIndex::class
  - SubscriptionUpdate::class
-  Workspaces
   -  WorkspaceIndex::class
   -  WorkspaceShow::class
   -  WorkspaceCreate::class
-  Members
   -  MemberIndex::class
   -  MemberShow::class

## Workspace

-  Members
   -  WorkspaceMemberIndex::class
   -  WorkspaceMemberShow::class
-  Notifications
   -  NotificationIndex::class
   -  NotificationCreate::class
   -  NotificationShow::class
   -  NotifictionEdit::class
   -  NotificationPublish::class
-  Payments

## Workspace -- MCS Specific

-  Pages
-  Posts
-  Events
-  Themes
-  Forms
-  Templates
-  Components
-  Media
-  Documents
-  Voting & Surveys
-  Conferences

# URI's and Link Structure

## Admin

-  (login) my.rebase.test/{id}/login?to=joecianflone
-  (logout) my.rebase.test/{id}/logout
-  (pick) my.rebase.test/{id}/pick

-  (customer.index) my.rebase.test/{id}/customer
-  (customer.subscription) my.rebase.test/{id}/customer/subscription
-  (customer.invoices) my.rebase.test/{id}/customer/invoices

-  (workspace.index) my.rebase.test/{id}/workspaces
-  (workspace.create) my.rebase.test/{id}/workspaces/create
-  (workspace.show) my.rebase.test/{id}/workspaces/{wid}
-  (workspace.edit) my.rebase.test/{id}/workspaces/{wid}/edit
-  (workspace.remove) my.rebase.test/{id}/workspaces/{wid}/remove
-  (workspace.archive) my.rebase.test/{id}/workspaces/{wid}/archive

-  (member.index) my.rebase.test/{id}/members
-  (member.create) my.rebase.test/{id}/members/create
-  (member.show) my.rebase.test/{id}/members/{mid}
-  (member.edit) my.rebase.test/{id}/members/{mid}/edit
-  (member.roles) my.rebase.test/{id}/members/{mid}/roles

## Workspace

-  (workspace-member.index) workspace.rebase.test/members
-  (workspace-member.create) workspace.rebase.test/members/create
-  (workspace-member.show) workspace.rebase.test/members/{mid}
-  (workspace-member.edit) workspace.rebase.test/members/{mid}/edit
-  (workspace-member.roles) workspace.rebase.test/members/{mid}/roles

## Notifications

-  (notification.index) workspace.rebase.test/notifications
-  (notification.create) workspace.rebase.test/notifications/create
-  (notification.show) workspace.rebase.test/notifications/{nid}
-  (notification.edit) workspace.rebase.test/notifications{nid}/edit
-  (notification.publish) workspace.rebase.test/notifications/{nid}/publish
-  (notification.unpublish) workspace.rebase.test/notifications/{nid}/unpublish
-  (notification.destroy) workspace.rebase.test/notifications/{nid}/
