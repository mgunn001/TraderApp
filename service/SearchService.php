<?php
	include_once  dirname(__DIR__)."/util/DatabaseConnection.php";
	include_once dirname(__DIR__)."/dao/Queries.php";
	include_once dirname(__DIR__)."/models/Vehicle.php";
	include_once dirname(__DIR__)."/models/MetaData.php";

	ini_set('display_startup_errors', 1);
	ini_set('display_errors', 1);
	error_reporting(-1);
	 // echo dirname(__DIR__);
	class SearchService
	{
		public function getAllVehiclesQuery()
		{
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
		  return var_dump($resultSet);
		}
	}
?>