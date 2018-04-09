# TraderApp 
Developer Excersice [Live Site](http://www.cs.odu.edu/~mgunnam/TraderApp/buyerpage.php)(http://www.cs.odu.edu/~mgunnam/TraderApp/buyerpage.php)

As a solution for the following problem - [Problem Statement](http://www.cs.odu.edu/~mgunnam/TraderApp/misc/DeveloperExercise_MaheedharGunnam.pdf)



### DataBase Schema Design
![DB Schema Design](http://www.cs.odu.edu/~mgunnam/TraderApp/misc/DBDesign.JPG)


### Project structure and Tech Stack Stuff
* The porject is very well modularized and is being segregating into neat folder structure, plain PHP is used as the server and RelationalDatabase (MySQL) is used as the DB. 

* All the Entity models are put up in **models** directoy, each php file in here is dedicated for an unique entity, OOPs properties like Inheritance and Abstraction are being used.

* All the UI pages that are constructed at the PHP end are put up in the root level example **buyerpage.php && vehicledetails.php**, internally the html content is created by using the methods in the service class **service/SearchService.php**

* DB Connection is get from DatabaseConnection class written under **util/DatabaseConnection.php**, All the static and dynamic queries are written in **dao/Queries.php**

* All the java scripts(Used JQuery) for UI are placed inside **resource/scripts** folder, Stylesheets are put up under folder **resource/css**.

* This project can be hosted on Nginix, Apache Tomcat (All servers tha can support PHP), MYSQL is the database used, **DBDumps/Trader_DBDumpV5.sql** has all the SQL create queries and dummy data needed to brig up the Database schema.


### Features Implemented and Future Enhancements
* All the features implemented are mainly oriented towards Buyer, A Buyer will select the Vechile type and enters the Tag name(Keywords) which are auto suggested will actually ease up the search to quickly narrow down to the desired list. Filling up Zipcode and Miles radius is optional.

* To filter down based on Miles radius the Zipcode input by the Buyer is used to calculate the distance with respect to the Vehicle Seller Zipcode. Third party API [ZipCode API](https://www.zipcodeapi.com/) is incorporated in the code for this, but it is temporarly brought down as there is a Quota limit under Free Key subscription. To ingerate with more advannced Googles Map Distance Matrix API is a futre enhancement.

* Once the Search button is clicked, the buyer is presented with a initial list of vechiles which ofcourse has to be done through pagination so as to reduce the response time, and to save the network usage. Pagination is to be implmented yet.

* Buyer is now free to set the desired values under each of the filters provided (Price, Mileage, Make, Model etc.,) and the desired results get updated instantly folowing the filtering rules. In addition to this high level filters, an attempt is make to filter even through the optional Meta Data that might be present on each of the Vehicle like (Body Type, Color and Trasmission etc.,) using a more dynamic query, but it is left unimplmented by the time this read me is written. This will surely be a future Enhancement.

* Result contains the List of Cards with the basic details of the vehicle, on the click of More Info or on the Image, Buyer is now navigated to the more detailed page, where in the carousel for the list of aviable images is provided. In adition to View, Submit a review on the seller of the vehicle, Emailing the Seller is also possible.

* Making the site more appealing and most user friendly is another important aspect for the future enhancements. Making it more usebale wise, clearing the checkbox on a filter at one shot, having a keybord Down arrow to be able to select the auto suggested Keywords would make much of a sense.



























