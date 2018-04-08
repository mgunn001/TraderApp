<?php
	include_once  dirname(__DIR__)."/util/DatabaseConnection.php";
	include_once dirname(__DIR__)."/dao/Queries.php";
	include_once dirname(__DIR__)."/models/Vehicle.php";
	include_once dirname(__DIR__)."/models/MetaData.php";
	include_once dirname(__DIR__)."/models/SellerComment.php";

	ini_set('display_startup_errors', 1);
	ini_set('display_errors', 1);
	error_reporting(-1);
	 // echo dirname(__DIR__);
	class SearchService
	{

		public function getVehiclesByMandateFilters($vehicleType, $keyword, $zipCode,$miles)
		{
		  $resultSet = [];
		  $database_connection = new DatabaseConnection();
		  $conn = $database_connection->getConnection();

		  // to to be done in a seperate method which accepts the raw request object and retuns after applying escape string
		   $vehicleType= mysqli_real_escape_string($conn,$vehicleType);
		   $keyword = mysqli_real_escape_string($conn,$keyword);
		   $zipCode= mysqli_real_escape_string($conn,$zipCode);
		   $miles= mysqli_real_escape_string($conn,$miles);

		  $queries = new Queries();
		  $getVehiclesQuery = $queries->getVehiclesByMandateFiltersQuery($vehicleType, $keyword, $zipCode,$miles);
		 // $getVehiclesQuery = $queries->getAllVehiclesQuery();
		   // echo $getVehiclesQuery;
		  // return;
		  $vehiclesQueryResult = $conn->query($getVehiclesQuery);
		  
		  if ($vehiclesQueryResult!=null &&  $vehiclesQueryResult->num_rows > 0) {
		      while($eachRow = $vehiclesQueryResult->fetch_assoc()) {
		           
		      		$SearchServiceObj = new SearchService();

		      		// to get the zipcode for seller based on vehicle ID 
		      	 	$getZipcodeQuery = $queries->getSellerZip($eachRow['id']);
		      	 	//echo $getZipcodeQuery;
		      	 	//return;
		      	 	$curVehicleZipcodeObj = $conn->query($getZipcodeQuery);

		      		// filterting the vehicles based on miles and zipcode, happening at serverside, If we use NoSQL like elasticsearch in here, this can be done at the Database level it self.
					if($zipCode != "" && $miles != ""){
						if(!$SearchServiceObj->doesFallWithInMileRangeUsingZipCodes($zipCode,"23508",$miles)){ // with in range
							continue;
						}
					}

		            // $resultSet[]= $eachRow;
		            $getVehicleMetaDataQuery = $queries->getVehicleMetaData($eachRow['id']);
		            $vehicleMetaDataQueryResult = $conn->query($getVehicleMetaDataQuery);
		            $metaDataList=[];
		            if ($vehicleMetaDataQueryResult->num_rows > 0) {		            	
				      while($metaDataEachRow = $vehicleMetaDataQueryResult->fetch_assoc()) {
						$metaData = new MetaData($metaDataEachRow['property'],$metaDataEachRow['propertyValue']);
						$metaDataList[]=$metaData;			            
				      }
					} 

					$getVehicleImagesQuery = $queries->getVehicleImages($eachRow['id']);
		            $vehicleImagesQueryResult = $conn->query($getVehicleImagesQuery);
		            $imagesList=[];
		            if ($vehicleImagesQueryResult->num_rows > 0) {
		            	
				      while($imageEachRow = $vehicleImagesQueryResult->fetch_assoc()) {
						$imagesList[]=$imageEachRow['Path'];			            

				      }
					} 

					if(count($imagesList) == 0){
						$imagesList[] = 'http://sifatit.com/wp-content/uploads/2012/07/dummy.jpg';
					}

					$vehicle = new Vehicle($eachRow['id'],$eachRow['year'],$eachRow['make'],$eachRow['model'],$eachRow['milesDriven'],$eachRow['price'],$eachRow['vehicleType'],$eachRow['description'],$metaDataList,$imagesList);
					$resultSet[]= $vehicle; 
					
		      }
		  } else {

		      return null;
		  }
		  $conn->close();
		  return $resultSet;
		}





		// this has to be modified that the same method can be  called for both Manatory and additional ones
		public function getVehiclesByApplyingAllFilters($inputObj)
		{
		  $resultSet = [];
		  $database_connection = new DatabaseConnection();
		  $conn = $database_connection->getConnection();
		  $queries = new Queries();

 		// to be replaced with StoredProc Call later
		  // $getVehiclesQuery = $queries->getVehiclesByMandateFiltersQuery($inputObj["vehicleTypeId"], $inputObj["keyword"], "23508","50");
		  foreach ($inputObj as $param_name => $param_val) {
		    $inputObj[$param_name] = mysqli_real_escape_string($conn,$param_val);
		  }
		 
		  $getVehiclesQuery = $queries->getVehiclesByApplingAllFiltersQuery($inputObj);
		//return $getVehiclesQuery;
		  
		  $vehiclesQueryResult = $conn->query($getVehiclesQuery);
		  $SearchServiceObj = new SearchService();
		  if ($vehiclesQueryResult->num_rows > 0) {
		  	

		      while($eachRow = $vehiclesQueryResult->fetch_assoc()) {
		            // $resultSet[]= $eachRow;

		            $getVehicleMetaDataQuery = $queries->getVehicleMetaData($eachRow['id']);
		            $vehicleMetaDataQueryResult = $conn->query($getVehicleMetaDataQuery);
		            $metaDataList=[];
		            if ($vehicleMetaDataQueryResult->num_rows > 0) {
		            	
					      while($metaDataEachRow = $vehicleMetaDataQueryResult->fetch_assoc()) {
								$metaData = new MetaData($metaDataEachRow['property'],$metaDataEachRow['propertyValue']);
								$metaDataList[]=$metaData;			            

					      }
					} 

					$getVehicleImagesQuery = $queries->getVehicleImages($eachRow['id']);
		            $vehicleImagesQueryResult = $conn->query($getVehicleImagesQuery);
		            $imagesList=[];
		            if ($vehicleImagesQueryResult->num_rows > 0) {
		            	
					      while($imageEachRow = $vehicleImagesQueryResult->fetch_assoc()) {
								$imagesList[]=$imageEachRow['Path'];			            

					      }
					} 

					if(count($imagesList) == 0){
						$imagesList[] = 'http://sifatit.com/wp-content/uploads/2012/07/dummy.jpg';
					}

					$vehicle = new Vehicle($eachRow['id'],$eachRow['year'],$eachRow['make'],$eachRow['model'],$eachRow['milesDriven'],$eachRow['price'],$eachRow['vehicleType'],$eachRow['description'],$metaDataList,$imagesList);
					$resultSet[]= $vehicle;

		      }
		  } 
		  $conn->close();
		  return $SearchServiceObj -> constructFilteredVehicleListingHTML($resultSet);
		}


		public function constructFilteredVehicleListingHTML($vehiclesListing)
		{
			$SearchServiceObj = new SearchService();
			$htmlContent ='';

	      	if( count($vehiclesListing) < 1 || $vehiclesListing == null){
	      		$htmlContent .='<h2 style="text-align:center;""> No Vehicles found </h2>';
	      		return $htmlContent;
	      	}
	      
	      	// $htmlContent .= '<div class="row filters-applied-wrapper"> <h4>Applied filters go here</h4></div><br/>';
	      	// $htmlContent .= '<div class="container-fluid filtered-results text-center"> 
								// <div class="row filtered-vehicles-wrapper">';

			foreach ($vehiclesListing as $vehicle){
	            $htmlContent .= '<div class="col-sm-6 col-lg-3">
		        <div class="card" carid="'.htmlspecialchars($vehicle->getId()).'">';
		        $firstImgSrc = null;
		        if(count($vehicle->getImages()) >0 ){
		        	  $firstImgSrc = $vehicle->getImages()[0];
		        }
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
		                		<li> <span class="mileage">'.htmlspecialchars($vehicle->getMilesDriven()) .'Miles</span>'. $SearchServiceObj -> getSpecificAttributeFromMetaData($vehicle->getMetaData(),$propsToShowOnCard) .'</li>
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

	   		// $htmlContent .='</div></div>';
	   		return $htmlContent;
     	}


          // this method deals with fetching the imp props and value that are decided to be shown on the card
	    public function getSpecificAttributeFromMetaData($metaDataList, $propList){
	 		$htmlPropSpanToReturn = '';
	 		foreach ($metaDataList as $metaData){
	 			if(in_array(strtolower($metaData -> getProperty()) , $propList)){
	 				$htmlPropSpanToReturn.= '<span class="divider">|</span><span class="'.htmlspecialchars($metaData -> getProperty()).'">'.htmlspecialchars($metaData -> getProperty()).':&nbsp;'.htmlspecialchars($metaData -> getPropertyValue()).'</span>';
	 			}
	 		}
	 		return $htmlPropSpanToReturn;
	     }

	     //this method does yields the proper results, using a thirdparty service to calculate
	     //  the distance in miles between two zipcodes, but itisn't supporting bulks request, so commiting it for now
	     // may be could try google Map Distance  Matrix API
		public function doesFallWithInMileRangeUsingZipCodes($from,$to,$miles){
			// $url='http://www.zipcodeapi.com/rest/JLXi98W5gX428RfOFL1sF7tjBpGhLt5xxUfS5NW7I1q4Axhotojpy3R7OuMkGIF1/distance.json/'.$from.'/'.$to.'/miles';
	 		// 	$resultDistObj = file_get_contents($url);
	 		// 	$distance = Json_decode($resultDistObj,true)['distance'];

	 		// 	if($distance > intval($miles)){
	 		// 		return false;
	 		// 	}else{
	 		// 		return true;
	 		// 	}
	 			return true;
		}



		public function getSpecificSellerId($vehicleId)
		{
			 $database_connection = new DatabaseConnection();
		  $conn = $database_connection->getConnection();
		   $vehicleId=mysqli_real_escape_string($conn,$vehicleId);
		  $queries = new Queries();
		  $getSellerQuery = $queries->getSellerId($vehicleId);
		  $sellerQueryResult = $conn->query($getSellerQuery);
		  
		  if ($sellerQueryResult->num_rows > 0) {

		      while($eachRow = $sellerQueryResult->fetch_assoc()) {
		      	return $eachRow['sellerId'];
		      }
		    }
		    else
		    {
		    	return 'fail';
		    }
		    $conn->close();
		}



		public function getSpecificSellerZip($vehicleId)
		{
			 $database_connection = new DatabaseConnection();
		  $conn = $database_connection->getConnection();
		   $vehicleId=mysqli_real_escape_string($conn,$vehicleId);
		  $queries = new Queries();
		  $getSellerQuery = $queries->getSellerZip($vehicleId);
		  $sellerQueryResult = $conn->query($getSellerQuery);
		  
		  if ($sellerQueryResult->num_rows > 0) {
		      while($eachRow = $sellerQueryResult->fetch_assoc()) {
		      	return $eachRow['zipcode'];
		      }
		    }
		    else
		    {
		    	return 'fail';
		    }
		    $conn->close();
		}


		public function getKeywordsByVehicleType($keywordIp,$vehicleTypeId){
		  $database_connection = new DatabaseConnection();
		  $conn = $database_connection->getConnection();
		  $vehicleTypeId= mysqli_real_escape_string($conn,$vehicleTypeId);
		  $keywordIp= mysqli_real_escape_string($conn,$keywordIp);
		  $queries = new Queries();

		  $getKeywordsQuery = $queries->getKeywordsOnVehicleType($keywordIp,$vehicleTypeId);
		 // echo  $getKeywordsQuery;
		  $keywordsQueryResult = $conn->query($getKeywordsQuery);
		  $resultSet =[];
		    if ($keywordsQueryResult->num_rows > 0) {
		      while($eachRow = $keywordsQueryResult->fetch_assoc()) {
		      	$resultSet[] = $eachRow['keyword'];
		      }
		    }  
		    $conn->close();
		    return  $resultSet;

		}




		public function getSellerComments($sellerId)
		{
			 $database_connection = new DatabaseConnection();
		  $conn = $database_connection->getConnection();
		   $sellerId=mysqli_real_escape_string($conn,$sellerId);
		  $queries = new Queries();
		  $getSellerCommentsQuery = $queries->getSellerComments($sellerId);
		  $sellerCommentsQueryResult = $conn->query($getSellerCommentsQuery);
		  
		  if ($sellerCommentsQueryResult->num_rows > 0) {

		      while($eachRow = $sellerCommentsQueryResult->fetch_assoc()) {
		      	$comment = new SellerComment($eachRow['id'],$eachRow['comment'],$eachRow['timestamp'],$eachRow['buyerName']);
				$resultSet[]= $comment;
		      }
		    }
		    else
		    {
		    	return 'fail';
		    }
		    $conn->close();
		    return $resultSet;
		}




		public function writeSellerComments($sellerId,$buyerId,$comment)
		{
		  $database_connection = new DatabaseConnection();
		  $conn = $database_connection->getConnection();
		   $sellerId=mysqli_real_escape_string($conn,$sellerId);
		   $buyerId=mysqli_real_escape_string($conn,$buyerId);
		   $comment=mysqli_real_escape_string($conn,$comment);
		  $queries = new Queries();
		  $writeSellerCommentQuery = $queries->writeSellerComment($sellerId,$buyerId,$comment);
		  $sellerCommentQueryResult = $conn->query($writeSellerCommentQuery);
		   if ($sellerCommentQueryResult === TRUE) {
		        return 'comment created';
		    } else {
		        return 'fail';
		    }
		  
		    $conn->close();
		    // return $resultSet;
		    
		}





		public function getASpecificVehicle($vehicleId)
		{
		  $resultSet = [];
		  $database_connection = new DatabaseConnection();
		  $conn = $database_connection->getConnection();
		  $vehicleId=mysqli_real_escape_string($conn,$vehicleId);
		  $queries = new Queries();
		  $getVehicleQuery = $queries->getASpecificVehicleQuery($vehicleId);
		  $vehicleQueryResult = $conn->query($getVehicleQuery);

		  if ($vehicleQueryResult->num_rows > 0) {

		      while($eachRow = $vehicleQueryResult->fetch_assoc()) {
		            // $resultSet[]= $eachRow;


		            $getVehicleMetaDataQuery = $queries->getVehicleMetaData($eachRow['id']);
		            $vehicleMetaDataQueryResult = $conn->query($getVehicleMetaDataQuery);
		            $metaDataList=[];
		            if ($vehicleMetaDataQueryResult->num_rows > 0) {
		            	
					      while($metaDataEachRow = $vehicleMetaDataQueryResult->fetch_assoc()) {
								$metaData = new MetaData($metaDataEachRow['property'],$metaDataEachRow['propertyValue']);
								$metaDataList[]=$metaData;			            

					      }
					}
					
					$getVehicleImagesQuery = $queries->getVehicleImages($eachRow['id']);
		            $vehicleImagesQueryResult = $conn->query($getVehicleImagesQuery);
		            $imagesList=[];
		            if ($vehicleImagesQueryResult->num_rows > 0) {
		            	
					      while($imageEachRow = $vehicleImagesQueryResult->fetch_assoc()) {
								$imagesList[]=$imageEachRow['Path'];			            

					      }
					} 
					$vehicle = new Vehicle($eachRow['id'],$eachRow['year'],$eachRow['make'],$eachRow['model'],$eachRow['milesDriven'],$eachRow['price'],$eachRow['vehicleType'],$eachRow['description'],$metaDataList,$imagesList);
					$resultSet[]= $vehicle;

		      }
		  } else {
		      return null;
		  }
		  $conn->close();
		  return $resultSet;
		}

	}
?>