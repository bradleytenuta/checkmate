#### Database structure

----
Everyone who has an account is a user. 
#
- User:
	- EmailAddress (Used to identify a user) (Unique)
	- UserId (Used to identify a user) (Unique)
	- Password
	- FirstName
	- Surname
	- Student (Boolean)
	- Staff (Boolean)
	- YearOfStudy (Int, only filled out if Student is true. This value is useful for filtering users)

----
The UserId is the 'user' that created the module. This user is able to create coursework within this module.
#
- Module
	- Name
	- ModuleId (Unique)
	- UserId (The user that created the module)

----
The UserId is the user that owns the coursework. This user is able to mark the coursework and also assign other users to help mark this coursework. All users that have the ability to mark this coursework cannot be assigned this coursework.
#
- Coursework
	- Name
	- CourseworkId (Unique)
	- Deadline
	- UserId (The user that created the coursework)
	- ModuleId
	- MaximumScore
	- Description

----
A marker is a user that has been assigned to help mark a specific coursework. A user cannot be assigned to a coursework they are a marker of. The owner of a piece of coursework is automatically assigned as a marker for that coursework. This table can be used to check to see which users are markers for a given coursework.
#
- Marker
	- UserId
	- CourseworkId

----
The UserId is the user that submitted the coursework. Coursework items only take in zip files. They are stored in the coursework storage location.
#
- Coursework Item
	- UserId
	- CourseworkItemId (Unique)
	- CourseworkId
	- Score

----
This table contains a list of all the modules that all the students are signed up to.
This can be used to check what modules a student is signed up to.
#
- ModuleSignUp
	- UserId
	- ModuleId

----
This table contains a list of all the users that are admins. Administrators is a type within a user, that is able to create modules and coursework within that module.
#
- Admin
	- UserId