This folder contains a list of folders of all the coursework on the application. Its used to store icon images for each coursework. The file type '.jpg' is used as it takes up the less space and we dont want there to be transparent images used.

Inside each coursework there is an items folder. This folder contains all the zip files of all the submitted coursework for that piece of coursework. The zip when uploaded are given whatever name. But they are renamed and saved as the courework item ID. These uploaded files must be zips.

Each coursework will also have a 'tests' folder. This is where the junit tests a professor makes will be stored. These are optional and are not required but below is the location they will be stored at.

The folder structure is: 

- 'coursework/{CourseworkId}/icon.jpg'
- 'coursework/{CourseworkId}/items/{CourseworkItemId}.zip'
- 'coursework/{CourseworkId}/tests/{TEST_NAME}.java'