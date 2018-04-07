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

		public function getVehiclesByMandateFilters($vehicleType,$zipCode,$miles)
		{
		  $resultSet = [];
		  $database_connection = new DatabaseConnection();
		  $conn = $database_connection->getConnection();

		  // to to be done in a seperate method which accepts the raw request object and retuns after applying escape string
		   $vehicleTypeId=mysqli_real_escape_string($conn,$vehicleType);
		   $zipCode=mysqli_real_escape_string($conn,$zipCode);
		   $miles=mysqli_real_escape_string($conn,$miles);

		  $queries = new Queries();
		 // $getVehiclesQuery = $queries->getVehiclesByMandateFiltersQuery($vehicleTypeId);
		  $getVehiclesQuery = $queries->getAllVehiclesQuery();
		 //echo $getVehiclesQuery;

		  $vehiclesQueryResult = $conn->query($getVehiclesQuery);
		  
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
					} else {
					    return 'fail';
					}

					$getVehicleImagesQuery = $queries->getVehicleImages($eachRow['id']);
		            $vehicleImagesQueryResult = $conn->query($getVehicleImagesQuery);
		            $imagesList=[];
		            if ($vehicleImagesQueryResult->num_rows > 0) {
		            	
				      while($imageEachRow = $vehicleImagesQueryResult->fetch_assoc()) {
						$imagesList[]=$imageEachRow['Path'];			            

				      }
					} else {
					    return 'fail';
					}



					$vehicle = new Vehicle($eachRow['id'],$eachRow['year'],$eachRow['make'],$eachRow['model'],$eachRow['milesDriven'],$eachRow['price'],$eachRow['vehicleType'],$eachRow['description'],$metaDataList,$imagesList);


					// filterting the vehicles based on miles and zipcode, happening at serverside, If we use NoSQL like elasticsearch in here, this can be done at the Database level it self.
					// if($zipCode != "" && $miles != ""){
					// 	// if(){ // with in range

					// 	// }
					// }else{
					// 	$resultSet[]= $vehicle; //though the Zip is given and Miles aren't given, all the vehicles are shown
					// }

					$resultSet[]= $vehicle; 
					
		      }
		  } else {

		      return 'fail';
		  }
		  $conn->close();
		  return $resultSet;
		}



		// this has to be modified that the same method is called for both Manatory and additional ones
		public function getVehiclesByApplyingAllFilters()
		{
		   $resultSet = [];
		  $database_connection = new DatabaseConnection();
		  $conn = $database_connection->getConnection();
		  $queries = new Queries();
		  $getVehiclesQuery = $queries->getAllVehiclesQuery();
		  $vehiclesQueryResult = $conn->query($getVehiclesQuery);
		  
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
					} else {
					    return 'fail';
					}

					$getVehicleImagesQuery = $queries->getVehicleImages($eachRow['id']);
		            $vehicleImagesQueryResult = $conn->query($getVehicleImagesQuery);
		            $imagesList=[];
		            if ($vehicleImagesQueryResult->num_rows > 0) {
		            	
					      while($imageEachRow = $vehicleImagesQueryResult->fetch_assoc()) {
								$imagesList[]=$imageEachRow['Path'];			            

					      }
					} else {
					    return 'fail';
					}

					$vehicle = new Vehicle($eachRow['id'],$eachRow['year'],$eachRow['make'],$eachRow['model'],$eachRow['milesDriven'],$eachRow['price'],$eachRow['vehicleType'],$eachRow['description'],$metaDataList,$imagesList);
					$resultSet[]= $vehicle;



		      }
		  } else {

		      return 'fail';
		  }
		  $conn->close();
		  return $resultSet;
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
		  echo $writeSellerCommentQuery;
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
		  // echo $getVehicleQuery;
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
					} else {
					    return 'fail';
					}

					$getVehicleImagesQuery = $queries->getVehicleImages($eachRow['id']);
		            $vehicleImagesQueryResult = $conn->query($getVehicleImagesQuery);
		            $imagesList=[];
		            if ($vehicleImagesQueryResult->num_rows > 0) {
		            	
					      while($imageEachRow = $vehicleImagesQueryResult->fetch_assoc()) {
								$imagesList[]=$imageEachRow['Path'];			            

					      }
					} else {
					    return 'fail';
					}

					$vehicle = new Vehicle($eachRow['id'],$eachRow['year'],$eachRow['make'],$eachRow['model'],$eachRow['milesDriven'],$eachRow['price'],$eachRow['vehicleType'],$eachRow['description'],$metaDataList,$imagesList);
					$resultSet[]= $vehicle;

		      }
		  } else {
		      return 'fail';
		  }
		  $conn->close();
		  return $resultSet;
		}

	}
?>