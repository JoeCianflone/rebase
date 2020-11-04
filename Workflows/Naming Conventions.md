# Naming Conventions





|Verb 		|URI 					|Action 	|Route Name			|
|-----------|-----------------------|-----------|-------------------|
GET 		/photos 				index 		photos.index
GET 		/photos/create 			create 		photos.create
POST 		/photos 				store 		photos.store
GET 		/photos/{photo} 		show 		photos.show
GET 		/photos/{photo}/edit 	edit 		photos.edit
PUT/PATCH 	/photos/{photo} 		update 		photos.update
DELETE 		/photos/{photo} 		destroy 	photos.destroy



GET		/register				RegisterIndex::class				register.index
POST	/register				RegisterStore::class				register.store
GET 	/register/customer		RegisterCustomer::class				register.customer
POST	/register/customer		RegisterCustomerProcess::class		register.customer.process
GET 	/register/complete		RegisterComplete::class				register.complete
GET		/register/problem		RegisterProblem::class				register.problem


/customers


GET		/workspaces/validate/{token}		WorkspaceValidateToken::class			workspace.validate-token			
POST	/workspaces/validate/{token}		WorkspaceValidateTokenProcess::class	workspace.validate-token.process


/members



/login
/logout







/register/customer/check-workspace
/register/customer/setup
/register/customer/thank-you
/register/customer/problem

/customer/workspace/validate/{token}
/customer/workspace/validate/{token}/process
/customer/workspace/validate/{token}/approved
/customer/workspace/validate/{token}/rejected








this is a test