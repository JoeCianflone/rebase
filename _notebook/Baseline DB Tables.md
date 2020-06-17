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
