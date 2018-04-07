<?php
	include_once "./service/MailService.php";
	include_once "./service/SearchService.php";
	ini_set('display_startup_errors', 1);
	ini_set('display_errors', 1);
	error_reporting(-1);

	if(isset($_POST["getKeywordsByInput"])){ //route to MailService based on this attribute
		  $search_service = new SearchService();
		  $resultObj= $search_service->getKeywordsByVehicleType($_POST["getKeywordsByInput"],$_POST["vehicleTypeId"]);
		  echo Json_encode($resultObj);
	}

?>