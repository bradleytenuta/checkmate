#### Database structure

----
Administrators is a type within a user, that is able to create modules and coursework within that module.
#
- User:
	- Email Address (Used to identify a user)
	- Password
	- First Name
	- Surname
	- Image (Path to icon)
	- Role
		- Admin
		- User

----
The email address is the 'user' that created the module. This user is able to create coursework within this module.
#
- Module
	- Name
	- Module ID
	- Email Address
	- image (Path to icon)

----
The email address is the user that owns the coursework. This user is able to mark the coursework and also assign other users to help mark this coursework. All users that have the ability to mark this coursework cannot be assigned this coursework.
#
- Coursework
	- Name
	- Coursework ID
	- Deadline
	- Email Address
	- Storage Location
	- Module ID
	- Maximum Score
	- Image (Path to icon)
	- Description

----
A marker is a user that has been assigned to help mark a specific coursework. A user cannot be assigned to a coursework they are a marker of. The owner of a piece of coursework is automatically assigned as a marker for that coursework.
#
- Marker
	- Email Address
	- Coursework ID

---
The email address is the user that submitted the coursework.
#
- Coursework Item
	- Email Address
	- Coursework Item ID
	- Coursework ID
	- Zip File Name
	- Score
#