# Understand the Table setup

Obviously, this is not **all** the tables you'll need for a project, but this is just the baseline for how the DB is set up to work. This is a mult-tenant/multi-db setup and we have two connections by default: `shared` is for data that is global to all accounts and projects and `workspace` is for the individual sites. 

However, there is something important to understand about this setup. There could be multiple workspaces inside a workspace connection. Huh? What? I know I need to work on the naming a bit, but here me out. 

## Connection: Shared

- Accounts
  - id
  - name
  - line1
  - line2
  - line3
  - unit_number
  - city
  - state
  - zip
  - country

- Workspaces
  - id
  - account_id
  - name
  - slug
  - domain
  - is_active
  - is_published
  
## Connection: Workspace

User_Workspace 
- id
- user_id
- workspace_id
- permission_level

Users
- id
- first_name
- last_name
- email
- password
- profile (JSON)

Addresses
- id
- line1
- line2
- line3
- unit_number
- city
- state
- zip


## Identity Concept

It wouldn't be too hard to have 3 connections. You could move all the User/Permissions stuff to a connection called `identity` and have all that be a central auth server for all your applications. In theory it would work?
