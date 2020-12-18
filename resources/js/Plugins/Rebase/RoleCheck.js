import {MemberRoles} from "@/Data/Rebase/consts";

const check = {
   account(roles, type) {
      console.log(roles[type] ?? false);
      return roles[type] ?? false
   },
   workspace(roles, type, workspaceID) {
      return roles[workspaceID] ? roles[workspaceID] === type : false;
   }
}

export default {
   install(Vue, options) {
      Vue.prototype.$RoleCheck = {
         eq: {
            super(roles) { return check.account(roles, MemberRoles["SUPER"]) },
            accountOwner(roles) { return check.account(roles, MemberRoles["ACCOUNT_OWNER"]) },
            accountAdmin(roles) { return check.account(roles, MemberRoles["ACCOUNT_ADMIN"]) },
            workspaceOwner(roles, workspaceID) { return check.workspace(roles, MemberRoles["WORKSPACE_OWNER"], workspaceID) },
            workspaceAdmin(roles, workspaceID) { return check.workspace(roles, MemberRoles["WORKSPACE_ADMIN"], workspaceID) },
            workspaceEditor(roles, workspaceID) { return check.workspace(roles, MemberRoles["EDITOR"], workspaceID) },
            workspaceElevatedMember(roles, workspaceID) { return check.workspace(roles, MemberRoles["ELEVATED"], workspaceID) },
            workspaceMember(roles, workspaceID) { return check.workspace(roles, MemberRoles["MEMBER"], workspaceID) },
            workspaceLimited(roles, workspaceID) { return check.workspace(roles, MemberRoles["LIMITED"], workspaceID) },
            workspaceAccess(roles, workspaceID) { return check.workspace(roles, MemberRoles["ACCESS_ONLY"], workspaceID) },
         },
         gte: {
            super(roles) { return check.account(roles, MemberRoles["SUPER"]) },
            accountOwner(roles) {
               return check.account(roles, MemberRoles["ACCOUNT_OWNER"]) || check.account(roles, MemberRoles["SUPER"])
            },
            accountAdmin(roles) {
               return check.account(roles, MemberRoles["ACCOUNT_ADMIN"]) || check.account(roles, MemberRoles["ACCOUNT_OWNER"]) || check.account(roles, MemberRoles["SUPER"])
            },
            workspaceOwner(roles, workspaceID) {
               return check.workspace(roles, MemberRoles["WORKSPACE_OWNER"], workspaceID) || check.account(roles, MemberRoles["ACCOUNT_ADMIN"]) || check.account(roles, MemberRoles["ACCOUNT_OWNER"]) || check.account(roles, MemberRoles["SUPER"])
            },
            workspaceAdmin(roles, workspaceID) {
               return check.workspace(roles, MemberRoles["WORKSPACE_ADMIN"], workspaceID) || check.workspace(roles, MemberRoles["WORKSPACE_OWNER"], workspaceID) || check.account(roles, MemberRoles["ACCOUNT_ADMIN"]) || check.account(roles, MemberRoles["ACCOUNT_OWNER"]) || check.account(roles, MemberRoles["SUPER"])
            },
            workspaceEditor(roles, workspaceID) {
               return check.workspace(roles, MemberRoles["EDITOR"], workspaceID) || check.workspace(roles, MemberRoles["WORKSPACE_ADMIN"], workspaceID) || check.workspace(roles, MemberRoles["WORKSPACE_OWNER"], workspaceID) || check.account(roles, MemberRoles["ACCOUNT_ADMIN"]) || check.account(roles, MemberRoles["ACCOUNT_OWNER"]) || check.account(roles, MemberRoles["SUPER"])
            },
            workspaceElevatedMember(roles, workspaceID) {
               return check.workspace(roles, MemberRoles["ELEVATED"], workspaceID) || check.workspace(roles, MemberRoles["EDITOR"], workspaceID) || check.workspace(roles, MemberRoles["WORKSPACE_ADMIN"], workspaceID) || check.workspace(roles, MemberRoles["WORKSPACE_OWNER"], workspaceID) || check.account(roles, MemberRoles["ACCOUNT_ADMIN"]) || check.account(roles, MemberRoles["ACCOUNT_OWNER"]) || check.account(roles, MemberRoles["SUPER"])
            },
            workspaceMember(roles, workspaceID) {
               return check.workspace(roles, MemberRoles["MEMBER"], workspaceID) || check.workspace(roles, MemberRoles["ELEVATED"], workspaceID) || check.workspace(roles, MemberRoles["EDITOR"], workspaceID) || check.workspace(roles, MemberRoles["WORKSPACE_ADMIN"], workspaceID) || check.workspace(roles, MemberRoles["WORKSPACE_OWNER"], workspaceID) || check.account(roles, MemberRoles["ACCOUNT_ADMIN"]) || check.account(roles, MemberRoles["ACCOUNT_OWNER"]) || check.account(roles, MemberRoles["SUPER"])
            },
            workspaceLimited(roles, workspaceID) {
               return check.workspace(roles, MemberRoles["LIMITED"], workspaceID) || check.workspace(roles, MemberRoles["MEMBER"], workspaceID) || check.workspace(roles, MemberRoles["ELEVATED"], workspaceID) || check.workspace(roles, MemberRoles["EDITOR"], workspaceID) || check.workspace(roles, MemberRoles["WORKSPACE_ADMIN"], workspaceID) || check.workspace(roles, MemberRoles["WORKSPACE_OWNER"], workspaceID) || check.account(roles, MemberRoles["ACCOUNT_ADMIN"]) || check.account(roles, MemberRoles["ACCOUNT_OWNER"]) || check.account(roles, MemberRoles["SUPER"])
            },
            workspaceAccess(roles, workspaceID) {
               return check.workspace(roles, MemberRoles["ACCESS_ONLY"], workspaceID) || check.workspace(roles, MemberRoles["LIMITED"], workspaceID) || check.workspace(roles, MemberRoles["MEMBER"], workspaceID) || check.workspace(roles, MemberRoles["ELEVATED"], workspaceID) || check.workspace(roles, MemberRoles["EDITOR"], workspaceID) || check.workspace(roles, MemberRoles["WORKSPACE_ADMIN"], workspaceID) || check.workspace(roles, MemberRoles["WORKSPACE_OWNER"], workspaceID) || check.account(roles, MemberRoles["ACCOUNT_ADMIN"]) || check.account(roles, MemberRoles["ACCOUNT_OWNER"]) || check.account(roles, MemberRoles["SUPER"])
            },
         }
      }

   }
 }
