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
All Assets such as images and fonts that we want to use have to be stored in the 'public' folder. So when accessing local JS files or local CSS files, the root directory it looks in is 'public'. So if you want to create CSS or JS files, they need to be stored in there. Files stored in this folder will be accessable by everyone at any time by typing in the url: 'checkmate.com/images/myimage.png'. A helper function to access that folder: 'asset("images/myimage.png")'

Resource folder
-------
This folder contains stuff that will be compiled down to vanilla CSS / JavaScript and then appear in the public directory. This is useful if your using some CSS templates or special frameworks (like sass) that require the ability to be compiled down to JavaScript / CSS.

Seeders
-------
Seeders produce test data for a database. All seed classes are found in the directory 'database/seeds'. A seeder class is needed for each table. You can use generators to make your own seeder class, like so: 'php artisan make:seeder UsersTableSeeder'.

Seeder classes only contain one function 'run'. This is called when the function 'php artisan db:seed' is called. Inside the run function you should write code that inserts data into the table. It would be easier to create a factory class and then call the factory class inside this run function rather than manually adding the data into the table yourself. Here is a link to the seed documentation: [link]( https://laravel.com/docs/master/seeding).

Your seeder classes get called by a DatabaseSeeder class. This class also contains a run function. You should update this function to add the calls to your new seeder classes you just made.

Factories
-------
Link to doc about making factories: [Link](https://laravel.com/docs/master/database-testing#writing-factories).
Factory classes are stored in 'database/factories/', there is already a example one there for you to use. You should make a factory for each table.

Storage folder
-------
This folder is a public folder to hold files that can be used by your app. These files are not open to everyone to see but can be used by your app. Laravel has a 'php artisan storage:link' command that adds a symlink to 'public' from 'storage/app/public'. The reason for this is that your storage may not be your local filesystem, but rather an Amazon S3 bucket or a Rackspace CDN (or anything else). Helper function to access this folder: 'storage_path("images/myimage.png")'.

This storage folder should be used for coursework, user icons, cousework icons.

Multiple Projects
-------
In order to get multiple projects working you need to make sure you destroy the vagrant virtual machine. Whenever you edit the 'homestead' directory, you need to destroy the virtual machine to refresh it. 

The commands needed are: 'vagrant destroy' then after you have made your changes to the homestead directory: 'vagrant up --provision'

Other
-------

- `composer dump-autoload` can be used inside the 'vagrant ssh' to refresh your seeder files. If when seeding or migrating, php can't find your classes, then run the command and try again.
- Migration files that only have a single primary key that is an incrementing integer will get automatically claimed as a PK when migrating, this means you do not have to specify it in the migration file, if you do, it will break it.
- `$table->unique('[val]')` is used when you want to specify something as unique but not used as a primary key, just like an email.
- Don't need to include the id in the factory as it is incremented automatically when that model object is created.
- `Timestamps` in migration files creates two columns, one for the date of creation and one for the date of last updated.
- use `php artisan migrate:fresh` instead of `php artisan migrate:reset` also can combine it with seeding to speed things up: `php artisan migrate:fresh --seed`. This also stops problems with removing data occurring which is helpful.