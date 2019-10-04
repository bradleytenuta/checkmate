Route
-------
A route is used to redirect a URL request to the correct View. For example, if someone enters in the root url for the webpage, we want to give them the welcome or log in view.

Routes can be used to return other things, not just views. They can be used to return a string and so just a string on a new page will be loaded. Can also return Json if you return an array.

Views
-------
Views are just the html part of laravel. They are stored in the resource folder.
Blade is a template engine used in laravel.

Can send data to a view by adding it as an array parameter. Then using this: '<?= $param; ?>' inside the html. You can avoid people hacking this approach by placing 2 anchor brackets around the variable in HTML, dont have to use php at all. This converts whatever was inputted as just a string and nothing more. The double brackets are from blade. 

Blade templates are found in the 'storage/framework/views' folder. This is where the blade template functionality is, as PHP does not understand it by default so has to be compiled down. '{!! !!}' is used if you dont want to escape the variable. Use blade for pretty much all things that would require php in html code.

Controllers
-------
Controllers can be used instead of writing the logic in the route php files. Controllers handle the logic behind the scenes and passes the information processed by the controller back to a view. Controllers are stored in the 'app/http/Controllers' folder.

Generators
-------
Generators are just command line tools to create php files quickly rather than creating them manually yourself.

.env
-------
This is where you will install important information such as keys, values and configuration settings. The 'config' folder contains php scripts which create the default values for the .env file.

Model
-------
This translates a database row into a class.
This is so that row can be accessed easily. Model classes are stored in 'app/'.

Migration
-------
Allows us to not have to make a database manually. First you use a generator to create a migration php class. You usually use a certain naming convention: 'create_*something*_table'. Laravel already has some created for you by default. They can be found in the 'Database/migrations' folder. Migration is like version control but for databases. It provides a programmatical way to define the structure to a table or even make a change to an existent one. 

You can then run another generator command. This migrates the migration php file you just made. This is the command: 'php artisan migrate'. This command creates all the tables based on all the migration files it can find.

If you want to remove the tables you have created then you can use the rollback command. This basically runs the down function in all the migration php files.
The command is: 'php artisan migrate:rollback'. This removes the data so don't do this in production.

Tinker
-------
This is a command line tool. It is activated in the command line like so: 'php artisan tinker'. Its basically like a PHP playground. You can use it to test operations or functions.

Layout Files
-------
These are files that can contain html code.
These can then be pulled into your views so you don't have to duplicate code for each view you make. This is useful when creating navbars. This way you only need to create the navbar once. These are stored in the 'resources\views' folder.

Public folder
-------
All Assets such as images and fonts that we want to use have to be stored in the 'public' folder. So when accessing local JS files or local CSS files, the root directory it looks in is 'public'. So if you want to create CSS or JS files, they need to be stored in there.

Resource folder
-------
This folder contains stuff that will be compiled down to vanilla CSS / JavaScript and then appear in the public directory. This is useful if your using some CSS templates or special frameworks (like sass) that require the ability to be compiled down to JavaScript / CSS.
