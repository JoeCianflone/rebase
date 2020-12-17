const check = {
   account(roles, type) {
      return roles[type] ?? false
   },
   workspace(roles, type, workspaceID) {
      return roles[workspaceID] ? roles[workspaceID] === type : false;
   }
}


export default {
   install(Vue, options) {
      Vue.prototype.$is = {
         eq: {
            super(roles) { return check.account(roles, window.MemberRole["SUPER"]) },
            accountOwner(roles) { return check.account(roles, window.MemberRole["ACCOUNT_OWNER"]) },
            accountAdmin(roles) { return check.account(roles, window.MemberRole["ACCOUNT_ADMIN"]) },
            workspaceOwner(roles, workspaceID) { return check.workspace(roles, window.MemberRole["WORKSPACE_OWNER"], workspaceID) },
            workspaceAdmin(roles, workspaceID) { return check.workspace(roles, window.MemberRole["WORKSPACE_ADMIN"], workspaceID) },
            workspaceEditor(roles, workspaceID) { return check.workspace(roles, window.MemberRole["EDITOR"], workspaceID) },
            workspaceElevatedMember(roles, workspaceID) { return check.workspace(roles, window.MemberRole["ELEVATED"], workspaceID) },
            workspaceMember(roles, workspaceID) { return check.workspace(roles, window.MemberRole["MEMBER"], workspaceID) },
            workspaceLimited(roles, workspaceID) { return check.workspace(roles, window.MemberRole["LIMITED"], workspaceID) },
            workspaceAccess(roles, workspaceID) { return check.workspace(roles, window.MemberRole["ACCESS_ONLY"], workspaceID) },
         },
         gte: {
            super(roles) { return check.account(roles, window.MemberRole["SUPER"]) },
            accountOwner(roles) {
               return check.account(roles, window.MemberRole["ACCOUNT_OWNER"]) || check.account(roles, window.MemberRole["SUPER"])
            },
            accountAdmin(roles) {
               return check.account(roles, window.MemberRole["ACCOUNT_ADMIN"]) || check.account(roles, window.MemberRole["ACCOUNT_OWNER"]) || check.account(roles, window.MemberRole["SUPER"])
            },
            workspaceOwner(roles, workspaceID) {
               return check.workspace(roles, window.MemberRole["WORKSPACE_OWNER"], workspaceID) || check.account(roles, window.MemberRole["ACCOUNT_ADMIN"]) || check.account(roles, window.MemberRole["ACCOUNT_OWNER"]) || check.account(roles, window.MemberRole["SUPER"])
            },
            workspaceAdmin(roles, workspaceID) {
               return check.workspace(roles, window.MemberRole["WORKSPACE_ADMIN"], workspaceID) || check.workspace(roles, window.MemberRole["WORKSPACE_OWNER"], workspaceID) || check.account(roles, window.MemberRole["ACCOUNT_ADMIN"]) || check.account(roles, window.MemberRole["ACCOUNT_OWNER"]) || check.account(roles, window.MemberRole["SUPER"])
            },
            workspaceEditor(roles, workspaceID) {
               return check.workspace(roles, window.MemberRole["EDITOR"], workspaceID) || check.workspace(roles, window.MemberRole["WORKSPACE_ADMIN"], workspaceID) || check.workspace(roles, window.MemberRole["WORKSPACE_OWNER"], workspaceID) || check.account(roles, window.MemberRole["ACCOUNT_ADMIN"]) || check.account(roles, window.MemberRole["ACCOUNT_OWNER"]) || check.account(roles, window.MemberRole["SUPER"])
            },
            workspaceElevatedMember(roles, workspaceID) {
               return check.workspace(roles, window.MemberRole["ELEVATED"], workspaceID) || check.workspace(roles, window.MemberRole["EDITOR"], workspaceID) || check.workspace(roles, window.MemberRole["WORKSPACE_ADMIN"], workspaceID) || check.workspace(roles, window.MemberRole["WORKSPACE_OWNER"], workspaceID) || check.account(roles, window.MemberRole["ACCOUNT_ADMIN"]) || check.account(roles, window.MemberRole["ACCOUNT_OWNER"]) || check.account(roles, window.MemberRole["SUPER"])
            },
            workspaceMember(roles, workspaceID) {
               return check.workspace(roles, window.MemberRole["MEMBER"], workspaceID) || check.workspace(roles, window.MemberRole["ELEVATED"], workspaceID) || check.workspace(roles, window.MemberRole["EDITOR"], workspaceID) || check.workspace(roles, window.MemberRole["WORKSPACE_ADMIN"], workspaceID) || check.workspace(roles, window.MemberRole["WORKSPACE_OWNER"], workspaceID) || check.account(roles, window.MemberRole["ACCOUNT_ADMIN"]) || check.account(roles, window.MemberRole["ACCOUNT_OWNER"]) || check.account(roles, window.MemberRole["SUPER"])
            },
            workspaceLimited(roles, workspaceID) {
               return check.workspace(roles, window.MemberRole["LIMITED"], workspaceID) || check.workspace(roles, window.MemberRole["MEMBER"], workspaceID) || check.workspace(roles, window.MemberRole["ELEVATED"], workspaceID) || check.workspace(roles, window.MemberRole["EDITOR"], workspaceID) || check.workspace(roles, window.MemberRole["WORKSPACE_ADMIN"], workspaceID) || check.workspace(roles, window.MemberRole["WORKSPACE_OWNER"], workspaceID) || check.account(roles, window.MemberRole["ACCOUNT_ADMIN"]) || check.account(roles, window.MemberRole["ACCOUNT_OWNER"]) || check.account(roles, window.MemberRole["SUPER"])
            },
            workspaceAccess(roles, workspaceID) {
               return check.workspace(roles, window.MemberRole["ACCESS_ONLY"], workspaceID) || check.workspace(roles, window.MemberRole["LIMITED"], workspaceID) || check.workspace(roles, window.MemberRole["MEMBER"], workspaceID) || check.workspace(roles, window.MemberRole["ELEVATED"], workspaceID) || check.workspace(roles, window.MemberRole["EDITOR"], workspaceID) || check.workspace(roles, window.MemberRole["WORKSPACE_ADMIN"], workspaceID) || check.workspace(roles, window.MemberRole["WORKSPACE_OWNER"], workspaceID) || check.account(roles, window.MemberRole["ACCOUNT_ADMIN"]) || check.account(roles, window.MemberRole["ACCOUNT_OWNER"]) || check.account(roles, window.MemberRole["SUPER"])
            },
         }
      }

   }
 }
