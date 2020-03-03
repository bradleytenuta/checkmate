This file provides a step by step guide to set up Laravel on your PC. This guide is created based on this video: [Link](https://www.youtube.com/watch?v=MBWXfaX9Gus&t=524s).

#### Required Software
- Virtual Box
- Vigrant
- Homestead via github checkout: [Link](https://github.com/laravel/homestead/releases).

#### Notes
- Don't load the vm using virtual box. use vigrant in the homestead directory.
- 'init.bat' needs to be run in the homestead directory after checking out the homestead directory. This is to generate the non version control files required to run laravel.
- The homestead directory should be in the user home directory (e.g. Bradley tenuta user directory)
- The laravel projects directory should also be in the user home directory.
- Location of the hosts file: 'C:\Windows\System32\drivers\etc'.
- To create a new laravel project you have to:
	- Update the homestead.yaml file to contain a map to the new folder.
	- Update the hosts file to include the website name and IP.
	- Run 'vagrant up'
	- Then go into the vm using 'vagrant ssh' (use 'exit' to leave the vm).
	- Then create a new laravel project by going into the 'LaravelProjects' folder
	- Then run this command: 'laravel new {ProjectName}'.

#### Useful Commands inside Homestead directory
- 'vagrant box add laravel/homestead' - This command adds homestead as a vbox virtual machine.
- 'vagrant up' - This runs the homestead virtual box, this is how the virtual box should be started.
- 'vagrant destroy' - This removes the homestead virtual machine you created in virtual box. Only use this if you want to remove it from your PC not to shut down.
- 'vagrant halt' - This shuts down the virtual machine. This should be used when you are done with development for the day and want to just shut down the virtual machine.
- 'vagrant ssh' - allows us to use the command line inside the vm.

#### Set Up Guide
- Watch this video: [Link](https://www.youtube.com/watch?v=MBWXfaX9Gus&t=524s).

#### Version of Software I'm Using
- Bootstrap v4.3.1
- JQuery v3.4.1
- Popper v1.15.0