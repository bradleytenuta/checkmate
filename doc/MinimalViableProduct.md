This file contains the contents of the minimal viable product for the 'checkmate' web application. The requirements below should be completed first before attempting any additional requirements.

#### Minimum Requirements

###### User Requirements
- The user shall be able to change their password.
- The user shall be able to change their image.

###### Coursework Requirements
- Coursework shall have a name.
- Coursework shall have a deadline.
- Coursework shall have a total mark (int).
- Coursework shall have an owner.
- Coursework shall have a list of users with professor permissions.
- Coursework shall have a list of assignees (People who do the coursework).
- The owner of the coursework (The user that creates the coursework) can assign users as professors for that coursework.
- The user shall be able to mark coursework items that have been submitted after the deadline of the coursework, if they have professor permission on that coursework. This means submitting a result.
- A user that has professor permissions for a coursework cannot be assigned to that coursework.
- A user that has professor permissions for a coursework can create overall comments
- A user that has professor permissions for a coursework can create line specific comments.
- A user with professor permissions shall be able to overwrite a result of a coursework that has been completed and submitting with a result.
- A coursework owner shall be able to choose between a manual review or an automatic review (by unit tests, will be implemented as an additional).
- A coursework shall have a location on disk where all coursework item zips are uploaded to.

###### Home Page Requirements
- The user shall be able to view a list of all the coursework's they are assigned to.
- The user shall be able to view a list of courseworks's they have professor permission in.

###### Login Page Requirements
- The user shall be able to log into their account
- The user shall be able to change their password.
- The user shall be able to create an account.
- The user can view information about the web application: what it is, what it does, who it is for, who created it.

###### Create Account Page
- The user shall enter their first name.
- The user shall enter their second name.
- The user shall enter their email address.
- The user shall enter their password for the account.
- The user shall have the option to upload an image of themselves. If not then a default one will be used.
- The user shall be able to select if they are an admin. This gives the user permissions to create coursework and modules.
- The user shall be able to select the year they are in, if they select themselves as students and not as admin.

###### Create Module Page
- The user shall be able to enter a module name.
- The user shall be able to upload an icon for the module.

##### Create Coursework Page


###### Navbar
- The navbar shall allow the user to log out.
- The navbar will only be displayed when a user is logged in.
- The navbar will provide a link to a page where the user can edit their account.
- The navbar shall allow the user to navigate back to the home page.
- The navbar shall provide an extra menu item to those with admin rights. This extra menu item shall allow the user to:
	- create coursework.
	- create modules.

#### Additional Requirements
These shall only be completed once all the minimal requirements have been completed

- An admin user can upgrade another user who is not admin, to admin.
- A coursework owner shall be able to create Java unit tests and use these to automatically mark coursework.
- A coursework shall have the ability to hid or show unit tests so users can view some of the unit tests that the coursework will be marked with.