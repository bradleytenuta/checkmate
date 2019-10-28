#### Installing Moss

1. In order to install moss you will need cygwin installed. Link to download can be found [here](https://www.cygwin.com/). Make sure to also install the whole perl package when you install cygwun.
1. Add 'cygwin' folder and its 'bin' folder to your environment variables.
1. Create a folder called 'moss'. 
1. Copy the below perl file called 'moss.pl', into the 'moss' directory.
1. Then from the directory above run this command: `chmod ug+x moss`.

#### Instructions
When you compare two or more files, the results are uploaded to the moss server. The results can be web scrapped from there. Here is a link to where the results will be [stored](http://moss.stanford.edu/results/). The exact URL will be printed out at the end of the command.

Here is an example of the one i used to compare two Java files:

`perl moss.pl -l java C:\Users\bradl\Desktop\test\test1.java C:\Users\bradl\Desktop\test\test2.java`

More instructions can be found within the 'moss.pl' file you copied over.