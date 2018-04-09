# TraderApp 
Developer Excersice [Live Site](http://www.cs.odu.edu/~mgunnam/TraderApp/buyerpage.php)(http://www.cs.odu.edu/~mgunnam/TraderApp/buyerpage.php)

As a solution for the following problem - [Problem Statement](http://www.cs.odu.edu/~mgunnam/TraderApp/misc/DeveloperExercise._MaheedharGunnam.pdf)



### DataBase Schema Design
![DB Schema Design](http://www.cs.odu.edu/~mgunnam/TraderApp/misc/DBDesign.JPG)

### TechStuff
* The porject is very well modularized and is being segregating into neat folder structure, plain PHP is used as the server and RelationalDatabase (MYSQL) is used as the DB. 

* All the Entity models are put up in **models** directoy, each php file in here is dedicated for an unique entity, OOPs properties like Inheritance and Abstraction are being used.

* All the UI pages that are constructed at the PHP end are put up in the root level example **buyerpage.php && vehicledetails.php**, internally the html content is created by using the methods in the service class **service/SearchService.php**

* DB Connection is get from DatabaseConnection class written under **util/DatabaseConnection.php**, All the static and dynamic queries are written in **dao/Queries.php**

* All the UI scripts are placed inside **resource/scripts** folder, Stylesheets are put up under folder **resource/css**.

* This project can be hosted on Nginix, Apache Tomcat (All servers tha can support PHP), MYSQL is the database used, **DBDumps/Trader_DBDumpV5.sql** has all the SQL create queries and dummy data needed to brig up the Database schema.













