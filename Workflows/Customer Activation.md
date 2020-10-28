# Customer Activation
After a [[Customer Signup]] we need to activate the account AND the workspace. This maps out that process. 

## Important Notes

Notes: when a customers account is set up their whole account is  first put into a **PENDING** state. Once they pay, we change **PENDING** to **ACTIVE**. See [[Customer Activation]] for more details.

### New Customer FIRST Workspace

After the Customer has paid, we create their database. Databases are named after their **CUSTOMER_ID**. 


### Old Customer Create a NEW Workspace

No new database needs to be spun up, we can just insert data. 

## The Flow
+ Workspaces always start off as **INACTIVE**
+ Workspaces get an **ACTIVATION_TOKEN** inserted into the DB and the customer has **three (3) days** to go through the setup process. After 72 hours the token may be removed. 
+ Customer will get an email with a link to click on, this link has the **ACTIVATION_TOKEN** embedded 
+ Customer Clicks on link:
	+ Token cannot be found --> kick the user out with a "sorry" message
	+ Token is found
		+ Token expired --> REJECT token, tell customer the token in stale and ask them to generate a new token by clicking a button -- this send them a new email adds NEW **ACTIVATION_TOKEN** to the DB and gives them 3 more days
	+ Check to make sure the **CUSTOMER** is **ACTIVE**
		+ If the customer is inactive --> send them a follow up email to re-activate their account
	+ Mark the workspace as **VERIFIED**
	+ Attempt to log the user in
		+ If this is the customers *first login ever* they will not have a password so we need them to follow the [[First Login]]. 
	+ Once the Customer has logged in, we take them to the **ONBOARDING** section, once they "finish" the onboarding we mark the workspace as **ACTIVE** 
		+ Customer gets an email saying "welcome aboard" at this point too

