<?php
	include_once "./service/MailService.php";
	include_once "./service/SearchService.php";
	ini_set('display_startup_errors', 1);
	ini_set('display_errors', 1);
	error_reporting(-1);

	if(isset($_POST["getKeywordsByInput"])){ 
		  $search_service = new SearchService();
		  $resultObj= $search_service->getKeywordsByVehicleType($_POST["getKeywordsByInput"],$_POST["vehicleTypeId"]);
		  echo Json_encode($resultObj);
	}
	if(isset($_POST["keyword"])){ 

		$inputObj = null;
		foreach ($_POST as $param_name => $param_val) {

			if(is_array($param_val)){
				 $param_val=implode(",", $param_val);
			}

		    $inputObj[$param_name] = $param_val;
		}

		//print_r( $inputObj);

		// instood of returning HTML as the content here, Object can be retunred and HTML is built on the UI, for time being utilized the existing mentod and returning the HTML constructed.
		$search_service = new SearchService();
		$resultantHTMLString= $search_service->getVehiclesByApplyingAllFilters($inputObj); 
		echo $resultantHTMLString;
	}

?>