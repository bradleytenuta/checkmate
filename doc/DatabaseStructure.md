#### Database structure

----

Users

Everyone who has an account is a user. The backend will automatically check for an uploaded icon, if one can't be found then the default is used. Student and staff is only used to help filter out the users when assigning coursework. A student can still be a marker or an admin. A member of staff can be an admin, a student on a module or a marker.

----

- Users:
	- EmailAddress (Unique)
	- UserId (Used to identify a user) (Unique)
	- Password
	- FirstName
	- Surname

----

Modules

A module contains one or multiple courseworks. Roles are given when the module is created. Students are added when the module is created.

----

- Modules
	- Name
	- ModuleId (Unique)

----

Courseworks

Each module has a number of courseworks.

----

- Courseworks
	- Name
	- CourseworkId (Unique)
	- Deadline
	- ModuleId
	- MaximumScore
	- Description

----

Submissions

The UserId is the user that submitted the coursework. Coursework items only take in zip files. They are stored in the coursework storage location. The JSON column is simply taking a json file and turning it into a string and placing it into the database. Then when you want to read it, take it out and convert it to json again, Larvel has this support already.

----

- Submissions
	- UserId
	- SubmissionId (Unique)
	- CourseworkId
	- Score
	- MainFeedback (Can be empty)
	- JSON
		- Compilation
			- Passed (boolead)
			- OutputString
		- JUnitTests [] (This list can be empty)
			- JUnitTest
				- Passed (boolean)
				- OutputString
		- LineComments [] (This list can be empty)
			- LineComment
				- FileName
				- FileRelativePath
				- LineNumber
				- BeginingChar (The first char on the line selected)
				- EndingChar (The last char on the line selected)
				- Comment
		- MossComparisons [] (This list can be empty)
			- MossComparison
				- SubmissionId
				- Result

----

Permissions

A permission is an action a user can perform

Some Permissions:

- View all Students in Coursework
- View all student's submission
- View all Students in Module
- Edit Module
- Edit Coursework
- Edit submission result
- Mark Coursework
- Upload Coursework
- Create Module
- Create Coursework

----

- Permissions
	- PermissionId (Unique)
	- Name

----

Roles

Roles provide a certain number of permissions. Some roles:

- Student (Role)
	- Upload Coursework (Permissions)
- Marker
	- Edit submission result
	- Mark Coursework
- Admin
	- Edit Coursework
	- Create Coursework
	- Edit Module
	- Create Module
	- Create new user/s

----

- Roles
	- RoleId (Unique)
	- Name

----

Roles_Permissions

This table contains all the permissions that each role gets.

----

- Role_Permission
	- RoleId
	- PermissionId

----

Users_Roles

This table contains a list of all roles a user has for a specific module.
Module can only be null for admin role. 

----

- User_Roles
	- UserId
	- RoleId
	- ModuleId


----

Users_Modules

This table contains a list of all the users and the modules they are signed up to. This includes users with different types of permissions.

----

- Users_Modules
	- UserId
	- ModuleId