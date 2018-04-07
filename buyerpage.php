<!DOCTYPE html>
<html lang="en">
<head>
  <title>Buyer Page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <script src="./resource/scripts/sitescript.js"></script>
  <script src="./resource/scripts/buyerscript.js"></script>

  <link rel="stylesheet" href="./resource/css/site.css">
   <link rel="stylesheet" href="./resource/css/buyerpage.css">
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">Logo</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Buy</a></li>
        <li><a href="#">Sell</a></li>
      </ul>
     <!--  <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul> -->
    </div>
  </div>
</nav>



 <?php
      include_once "./service/SearchService.php";
      include_once "./models/Vehicle.php";
      include_once "./models/MetaData.php";

        ini_set('display_startup_errors', 1);
        ini_set('display_errors', 1);
        error_reporting(-1);

      if(isset($_POST['mandatoryFilterSubmit'])){
        //echo "Echoing details for vehicle with ID: -> ".$_POST['vehicleType'];
        $search_service = new SearchService();
        // this has to be modified by sending the params: Vehicle type, Zip and radius 
        $resultObj= $search_service->getVehiclesByMandateFilters($_POST['vehicleType'],$_POST['keyword'], $_POST['zipCode'],$_POST['miles']);
        $vehiclesListing = $resultObj;
        //echo var_dump($vehiclesListing[0]);
		//echo var_dump($vehiclesListing[0]->getMetaData());



        constructMandateFiltersFrom($_POST['vehicleType'],$_POST['keyword'], $_POST['zipCode'],$_POST['miles']);
		constructFiltersToDisplay();
       	constructFilteredVehicleListingHTML($vehiclesListing);
      } else{
      	echo '<div class="container-fluid mandatory-filter-items-wrapper" >
		    <div class="mandatory-filter-items well">
		    	<form class="form-inline mandatory-filter-items-form" action="buyerpage.php" method="post">
		    		  <input type="hidden" name="mandatoryFilterSubmit" value="true"></input>

		    		 <div class="form-group">
					  	<select class="form-control vehicleTypeSel" name="vehicleType" class="vehicleType">			<option value="1">Motor Cycle</option>
					  		<option value="2" selected="">Car</option>
					  		<option value="3">RV</option>
					  		<option value="4">Truck</option>
						</select>
					  </div>

					  <div class="form-group">
					    <input type="text" class="form-control keyword-identifier-vehicle" placeholder="Keyword" title="Enter keyword for vehicle" name="keyword" id="keywordIP">
					  </div>
					  <div class="form-group">		  
					    <input type="text" class="form-control zip-code" placeholder="Zip Code" title="Enter Zip Code" name="zipCode" id="zipcode">
					  </div>
					  <div class="form-group">		  
					    <input type="text" class="form-control within-miles" placeholder="50 Miles" name="miles" title="look with in miles" id="withinmiles">
					  </div>
					  <button type="submit" title="Click to Search" class="btn btn-default">Search</button>
				</form>
		    </div>
		</div>';
      }



      function constructMandateFiltersFrom($selVehicleTypeId,$keyword,$zipcode,$miles){
      	$selVehicleTypeId = $_POST['vehicleType'];
		$vehicleTypeArr =["Motor Cycle","Car","RV","Truck"];
      	echo '<div class="container-fluid mandatory-filter-items-wrapper" >
		    <div class="mandatory-filter-items well">
		    	<form class="form-inline mandatory-filter-items-form" action="buyerpage.php" method="post">
		    		  <input type="hidden" name="mandatoryFilterSubmit" value="true"></input>

		    		 <div class="form-group">
					  	<select class="form-control vehicleTypeSel" name="vehicleType" class="vehicleType">'.constructOptions($vehicleTypeArr,$selVehicleTypeId)					   
						.'</select>
					  </div>

					  <div class="form-group">
					    <input type="text" class="form-control keyword-identifier-vehicle" placeholder="Keyword" title="Enter keyword for vehicle" name="keyword" id="keywordIP" value="'.htmlspecialchars($keyword).'">
					  </div>
					  <div class="form-group">		  
					    <input type="text" class="form-control zip-code" placeholder="Zip Code" title="Enter Zip Code" name="zipCode" id="zipcode" value='.$zipcode.'>
					  </div>
					  <div class="form-group">		  
					    <input type="text" class="form-control within-miles" placeholder="50 Miles" name="miles" title="look with in miles" id="withinmiles" value='.$miles.'>
					  </div>
					  <button type="submit" title="Click to Search" class="btn btn-default">Search</button>
				</form>
		    </div>
		</div>';
      }


      // Method to construct, the options for the Manatory from, this can be more dynamic, right now the vehicleTypeIds are hardcoded
      function constructOptions($vehicleTypeArr,$selVehicleTypeId){
      	$optionStr = "";
      	// var_dump($vehicleTypeArr);
      	// echo $selVehicleTypeId;
      	$i =1;
      	foreach($vehicleTypeArr as $curVehType) {
  			if ($i == $selVehicleTypeId){
				$optionStr .= '<option value="'.$i.'" selected>'.$curVehType .'</option>';
  			}else{
  				$optionStr .= '<option value="'.$i .'">'. $curVehType.'</option>';
  			}
  			$i++;
		}
      	return $optionStr;
      }




      // this method has to construct the suitable filters to be chosen by user according to the Type of vehicle selected, simply throwing out fixed filters for now.
      function constructFiltersToDisplay(){
      	echo '<div class="container-fluid additional-filter-items-wrapper additional-filter-items well" style="margin-top:-1%;">
				<div class="additional-filter-items">
					<form class="form-inline additional-filter-items-form" name="additionalFilters"  action="dummy.php" method="post">
						  <input type="hidden" name="additionalFilterSubmit" value="true"></input>
						  <div class="form-group dropdown price-dropdown">
							  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"> Price
							  <span class="caret"></span></button>
							  <ul class="dropdown-menu">
							    <li> <a href="#"><label>Below $5K<input type="checkbox"  name="price_checkedList[]" value=1> </label></a></li>
							    <li class="divider"></li>
							   	<li> <a href="#"><label>$5k to $10k<input type="checkbox" name="price_checkedList[]" value=2> </label></a></li>
							    <li class="divider"></li>
							    <li> <a href="#"><label>$10k to $15k<input type="checkbox" name="price_checkedList[]" value=3> </label></a></li>
							    <li class="divider"></li>
							    <li> <a href="#"><label>$15k to $20<input type="checkbox" name="price_checkedList[]" value=4> </label></a></li>
							    <li class="divider"></li>
							    <li> <a href="#"><label>Above $20k<input type="checkbox"  name="price_checkedList[]" value=5> </label></a></li>
							  </ul>
						  </div>
						  <div class="form-group dropdown mileage-driven-dropdown">
						  	<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"> Mileage
							  <span class="caret"></span></button>
							  <ul class="dropdown-menu">
							    <li> <a href="#"><label>Up to 5K<input type="checkbox" name="mileage_checkedList[]" value=1> </label></a></li>
							    <li class="divider"></li>
							   	<li> <a href="#"><label>5k to 10k<input type="checkbox" name="mileage_checkedList[]" value=2> </label></a></li>
							    <li class="divider"></li>
							    <li> <a href="#"><label>10k to 15k<input type="checkbox" name="mileage_checkedList[]" value=3> </label></a></li>
							    <li class="divider"></li>
							    <li> <a href="#"><label>15k to 20K<input type="checkbox" name="mileage_checkedList[]" value=4> </label></a></li>
							    <li class="divider"></li>
							    <li> <a href="#"><label> 20K+<input type="checkbox" name="mileage_checkedList[]"  value=5> </label></a></li>
							  </ul>
						  </div>
						  
						  <div class="form-group dropdown make-dropdown">		  			  
						  	<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"> Make
							  <span class="caret"></span></button>
							  <ul class="dropdown-menu">
							    <li> <a href="#"><label>BMW<input type="checkbox" name="make_checkedList[]" value=1> </label></a></li>
							    <li class="divider"></li>
							   	<li> <a href="#"><label>Audi<input type="checkbox" name="make_checkedList[]" value=2> </label></a></li>
							    <li class="divider"></li>
							  </ul>
						  </div>

						   <div class="form-group dropdown model-dropdown">		  			  
						  	<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"> Model
							  <span class="caret"></span></button>
							  <ul class="dropdown-menu">
							    <li> <a href="#"><label>A7<input type="checkbox" name="model_checkedList[]" value=1> </label></a></li>
							    <li class="divider"></li>
							   	<li> <a href="#"><label>Q5<input type="checkbox" name="model_checkedList[]" value=2> </label></a></li>
							    <li class="divider"></li>
							    <li> <a href="#"><label>S4<input type="checkbox" name="model_checkedList[]" value=3> </label></a></li>
							    <li class="divider"></li>
							  </ul>
						  </div>

						  <div class="form-group dropdown year-dropdown">		  			  
						  	<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"> Year
							  <span class="caret"></span></button>
							  <ul class="dropdown-menu">
							    <li> <a href="#"><label>2018 And Newer<input type="checkbox" name="year_checkedList[]" value=1> </label></a></li>
							    <li class="divider"></li>
							   	<li> <a href="#"><label>2008-2018<input type="checkbox" name="year_checkedList[]" value=2> </label></a></li>
							  </ul>
						  </div>

						  <div class="form-group dropdown bodytype-dropdown">		  			  
						  	<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"> Body Type
							  <span class="caret"></span></button>
							  <ul class="dropdown-menu">
							    <li> <a href="#"><label>Sedan<input type="checkbox" name="body_checkedList[]" value=1> </label></a></li>
							    <li class="divider"></li>
							   	<li> <a href="#"><label>SUV<input type="checkbox" name="body_checkedList[]" value=2> </label></a></li>
							    <li class="divider"></li>
							    <li> <a href="#"><label>Convertable<input type="checkbox" name="body_checkedList[]" value=3> </label></a></li>
							    <li class="divider"></li>
							  </ul>
						  </div>


						   <div class="form-group dropdown color-dropdown">		  			  
						  	<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"> Color
							  <span class="caret"></span></button>
							  <ul class="dropdown-menu">
							    <li> <a href="#"><label>Blue<input type="checkbox" name="color_checkedList[]" value=1> </label></a></li>
							    <li class="divider"></li>
							   	<li> <a href="#"><label>Red<input type="checkbox" name="color_checkedList[]" value=2> 	</label></a></li>
							   	<li class="divider"></li>
							   	<li> <a href="#"><label>Black<input type="checkbox" name="color_checkedList[]" value=3> </label></a></li>
							   	<li class="divider"></li>
							   	<li> <a href="#"><label>Black<input type="checkbox" name="color_checkedList[]"  value=4> </label></a></li>
							   	<li class="divider"></li>
							   	<li> <a href="#"><label>White<input type="checkbox" name="color_checkedList[]" value=5> </label></a></li>
							  </ul>
						  </div>

						  <div class="form-group dropdown transmission-dropdown">		  			  
						  	<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"> Transmission
							  <span class="caret"></span></button>
							  <ul class="dropdown-menu">
							    <li> <a href="#"><label>Manual<input type="checkbox" name="transmission_checkedList[]" value=1> </label></a></li>
							    <li class="divider"></li>
							   	<li> <a href="#"><label>Automatic<input type="checkbox" name="transmission_checkedList[]" value=2> </label></a></li>
							  </ul>
						  </div>

						  <button type="submit" title="Click to apply filters" class="btn btn-default">Apply Filters</button>
					</form>
				</div>
			</div>';
      }

      function constructFilteredVehicleListingHTML($vehiclesListing){
      	if( count($vehiclesListing) < 1 || $vehiclesListing == null){
      		echo "<h2 style='text-align:center;'> No Vehicles found </h2>";
      		return;
      	}
      	$htmlContent ='';

      	$htmlContent .= '<div class="row filters-applied-wrapper"> <h4>Applied filters go here</h4></div><br/>';
      	$htmlContent .= '<div class="container-fluid filtered-results text-center"> 
							<div class="row filtered-vehicles-wrapper">';

			foreach ($vehiclesListing as $vehicle){
	            $htmlContent .= '<div class="col-sm-6 col-lg-3">
		        <div class="card" carid="'.htmlspecialchars($vehicle->getId()).'">';
		        $firstImgSrc = $vehicle->getImages()[0];
		        if( $firstImgSrc == null){
		        	$firstImgSrc = 'http://sifatit.com/wp-content/uploads/2012/07/dummy.jpg';
		        }
		        $htmlContent .= '<img class="card-img-top" src="'. htmlspecialchars($firstImgSrc).'">';
	         	$htmlContent .= '<div class="card-block">
		                <h4 class="card-title mt-3"><a href="./vehicledetails.php?vehicleID='.htmlspecialchars($vehicle->getId()).'"><span class="make">'.htmlspecialchars($vehicle->getMake()).'</span><span class="model">'.htmlspecialchars($vehicle->getModel()).'</span><span class="year">('.htmlspecialchars($vehicle->getYear()).')</span></a></h4>';
		         $propsToShowOnCard=['owners','fuel'];

		        $htmlContent .='<div class="card-text">
		                	<ul>
		                		<li> <span class="price" style="font-weight: bold">$'.htmlspecialchars($vehicle->getPrice()).'</span></li>
		                		<li> <span class="mileage">'.htmlspecialchars($vehicle->getMilesDriven()) .'Miles</span>'.getSpecificAttributeFromMetaData($vehicle->getMetaData(),$propsToShowOnCard) .'</li>
		                	</ul>
		                	</div>
							</div>
							            <div class="card-footer">
							                <small>click to know more info and contact seller</small>
							                <button class="btn btn-primary float-right btn-sm">More Info</button>
							            </div>
							        </div>
							    </div>';
	       }

	   		$htmlContent .='</div></div>';
	   		echo $htmlContent;
     }

     // this method deals with fetching the imp props and value that are decided to be shown on the card
     function getSpecificAttributeFromMetaData($metaDataList, $propList){
 		$htmlPropSpanToReturn = '';
 		foreach ($metaDataList as $metaData){
 			if(in_array(strtolower($metaData -> getProperty()) , $propList)){
 				$htmlPropSpanToReturn.= '<span class="divider">|</span><span class="'.htmlspecialchars($metaData -> getProperty()).'">'.htmlspecialchars($metaData -> getProperty()).':&nbsp;'.htmlspecialchars($metaData -> getPropertyValue()).'</span>';
 			}
 		}
 		return $htmlPropSpanToReturn;
     }

  ?>
<div class="resSuggDiv" style="position: absolute;"></div>
</body>
</html>
