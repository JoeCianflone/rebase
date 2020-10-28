# First Log In
This differs a bit depending on what we mean by "first log in" so lets go through them all to make it clear.

## Customer Set Up New Account
When a customer creates a new account, they do not have a password. The system will attempt to log them in after they've verifed their account and that should fail.

+ Once login fails the customer will be redirected to password creation
	+ We're OK doing a redirect here because the only way to get to this page, at this point was from the [[Customer Activation]] flow.
+ Customer is asked to enter their email address, a password and to verify their password again. 
+ Once they pass -- their password is Hashed and saved
+ Customer is logged into the site

## Customer Creates a New Workspace
If a customer already has an account and all they've done is create a new workspace then this workflow is not needed.

Passwords are stored for each member and **not** on the workspace itself, this means that the person can be logged into the new workspace and not need to change their password. 

However, when a user creates or adds a new workspace a **NEW_WORKSPACE** and **ADDED_TO_WORKSPACE** event should be fired so they get an emails alerting them about this. 


