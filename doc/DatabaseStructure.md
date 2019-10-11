#### Database structure

----

Users

Everyone who has an account is a user. The backend will automatically check for an uploaded icon, if one can't be found then the default is used. Student and staff is only used to help filter out the users when assigning coursework. A student can still be a marker or an admin. A member of staff can be an admin, a student on a module or a marker.

----

- Users:
	- EmailAddress (Used to identify a user) (Unique)
	- UserId (Used to identify a user) (Unique)
	- Password
	- FirstName
	- Surname
	- Student (Boolean)
	- Staff (Boolean)
	- YearOfStudy (Int, only filled out if Student is true. This value is useful for filtering students)

----

Modules

The UserId is the 'user' that created the module. This user is able to create coursework within this module. The backend will automatically check for an uploaded icon, if one can't be found then the default is used.

----

- Modules
	- Name
	- ModuleId (Unique)
	- UserId (The user that created the module)

----

Courseworks

The UserId is the user that owns the coursework. This user is able to mark the coursework and also assign other users to help mark this coursework. All users that have the ability to mark this coursework cannot be assigned this coursework. The backend will automatically check for an uploaded icon, if one can't be found then the default is used. The backend will automatically search for JUnit tests, if some are found then they are displayed, if not then non are displayed.

----

- Courseworks
	- Name
	- CourseworkId (Unique)
	- Deadline
	- UserId (The user that created the coursework)
	- ModuleId
	- MaximumScore
	- Description

----

Markers

A marker is a user that has been assigned to help mark a specific module. A user cannot be assigned to a module they are a marker of. The owner of a piece of module is automatically assigned as a marker for that module. This table can be used to check to see which users are markers for a given module. Markers can be assigned when the module is created. Markers can also be assigned later on, when a marker is assigned, if they are a student on that module they will be removed from being a student on that module and replaced with being a marker. Only the module owner can assign people as markers.

----

- Markers
	- UserId
	- ModuleId

----

CourseworkItems

The UserId is the user that submitted the coursework. Coursework items only take in zip files. They are stored in the coursework storage location.

----

- CourseworkItems
	- UserId
	- CourseworkItemId (Unique)
	- CourseworkId
	- Score

----

ModuleSignUps

This table contains a list of all the modules that all the students are signed up to.
This can be used to check what modules a student is signed up to. Students are assigned to modules when the module is created. Students can also be assigned to the module later on. Only the owner of the module can assign students to that module.

----

- ModuleSignUps
	- UserId
	- ModuleId

----

Admins

This table contains a list of all the users that are admins. Administrators is a type within a user, that is able to create modules and coursework within that module.

----

- Admins
	- UserId