# DevNotes
Below is a bunch of random notes that I have gathered from researching different topics and trying to understand the development process of this project.

#### General Notes
- Use XAMPP control panel and start Apache to open the localhost server.
	- Type: 127.0.0.1 in browser to get in.
- Router (York 2019) Does not give me rights to allow external access to this PC IP address and so currently can't display web server to outside world.
	- Once I can, Need to create a static IP.
	- Buy Domain that points to the static IP.
	- Setup router settings so the router can point to the server when a request to that domain is made.
- Set up SQL first. Learn how to use it and practice a few times. Then decide what the Database will have. Then never change it once it is created.
- Using git to keep source control.
- Revise PHP, JS, Laravel, MySQL and Apache.
- Look at webcat for inspiration.
- Wed development for mobile, tablet and desktop. Start from mobile and style upwards.
- Look at Auth2. This is a framework for authentication.


#### SQL
- Students:
	- Email Address (Unique)
	- Password (The password text will be hashed using a 'salt' then this hash will be stored in the database.)
	- First Name
	- Last Name
	- Year (int)
- Staff:
	- Email Address (Unique)
	- Password (The password text will be hashed using a 'salt' then this hash will be stored in the database.)
	- First Name
	- Last Name
- Coursework:
	- Location on disk (Unique)
	- Email Address - Staff reviewer
	- Email Address - Student
	- Coursework ID (Unique)


#### How will I handle dependencies?


#### How will I test this?
- Look at Laravel test suits or test environments.
- Look at php unit tests and other ways to test.
- Is there a software project management and comprehension tool that I can use for PHP, JS and Laravel.

