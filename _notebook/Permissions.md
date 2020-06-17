# What do Permissions look like?

Accounts are the main control in the system. A person sets up an `account` and that allows them to set up multiple `workspaces`. A `user` can sign up under a particular `workspace` and they can be part of that workspace only. If the `account` happens to have multiple workspaces the account owner or someone else could give a particular `user` access to another `workspace`. 

Permissions are on the account level AND workspace level. 

Permissions:
- account_owner
- account_admin
- workspace_admin
- workspace_editor
- workspace_designer
- workspace_elevated_member
- workspace_member
- workspace_limited_member


You can be an editor in one workspace and an elevated_member in another, but once you're elevated to account_admin level you have access to ALL the accounts. If you want to give someone admin access to multiple workspaces, but limit their ability to see ALL the workspaces then you'd want to make them a `workspace_admin` of just those particular workspaces. I might add the concept of a `workspace_owner` but I'm not sure what they would do/have that would be more than an admin. Maybe they're just the point person of a particular workspace? Why would we need this?
