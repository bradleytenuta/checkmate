This repository contains the maven project used to test coursework submissions of type 'java' in the 'checkmate' website.

###### Version

- Maven: 3.6.2
- Junit: 4.12
- Java: 1.8

###### Testing

This repository uses Bitbucket pipelines and a Maven docker for testing. The test checks that the maven project has been configured correctly and runs exmaple tests that are provided from the `./resources` folder.

###### Unit Tests

Unit tests provided by an Admin or an Assessor will be placed inside the `src/test` folder of the child module.

###### User Submissions

User submissions are placed inside the `src/main` of the child module.

###### Producing a Report

A report of the tests can be produced with the following maven command: `mvn surefire-report:report`. Its prefered that this command is run from within the child module so a report is not created for the parent module. The report that is outputed is stored in: `./target/site/surefire-report.html`.