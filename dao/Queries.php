<?php

	class Queries
	{
	    public function getAllVehiclesQuery(){
	      $sql = 'SELECT * FROM `postedvehicles` where vehicleType';
	      return $sql;
	    }

	    public function getVehiclesByMandateFiltersQuery($vehicleType, $keyword, $zipCode,$miles){
	    //$sql = 'SELECT * FROM `postedvehicles` where vehicleType='.$vehicleType;
 		$sql = 'SELECT * FROM `postedvehicles`,`tagsonpostedvehicles`,`helpertags` where tagsonpostedvehicles.helpertagid=helpertags.helpertagid and helpertags.vehicletypeid='.$vehicleType.' and helpertags.keyword="'.$keyword.'" and tagsonpostedvehicles.vehicleid=postedvehicles.id';

	      return $sql;
	    }



	      // this one to be replaced with a stored proc, so as to filter based on meta data aswell 
	    public function getVehiclesByApplingAllFiltersQuery($inputObj){

	    	$sql = 'SELECT * FROM `postedvehicles`,`tagsonpostedvehicles`,`helpertags` where tagsonpostedvehicles.helpertagid=helpertags.helpertagid and helpertags.vehicletypeid='.$inputObj["vehicleTypeId"].' and helpertags.keyword="'.$inputObj["keyword"].'" and tagsonpostedvehicles.vehicleid=postedvehicles.id'; 

	    	$priceArry = explode(",",$inputObj["price"]);
	    	if($inputObj["price"] != ""){
	    			$priceIndex =  intval($priceArry[0]);
	    			$minPrice = (($priceIndex-1)*5) *1000;
	    			$maxPrice = ($priceIndex *5) *1000;
	    			$sql.=' and postedvehicles.price >'. $minPrice .' and postedvehicles.price <= '. $maxPrice;
	    	}

	    	
		    $mileageArry = explode(",",$inputObj["mileage"]);

		    if( $inputObj["mileage"] != ""){
		    	$mileageIndex =  intval($mileageArry[0]);
		    	$minMileage = (($mileageIndex-1)*5) *1000;
		    	$maxMileage = ($mileageIndex *5) *1000;
		    	$sql.=' and postedvehicles.milesDriven >'. $minMileage .' and postedvehicles.milesDriven <= '. $maxMileage;

		    }

	    	

	    	$makeArry = explode(",",$inputObj["make"]);
	    	if( $inputObj["make"] != ""){
	    		$makeList = join('","',$makeArry);
	    		$sql.=' and postedvehicles.make in ("'.$makeList .'")';
	    	}

	    

	    	$modelArry = explode(",",$inputObj["model"]);
			if( $inputObj["model"] != ""){
				$modelList = join('","',$modelArry);
				$sql.=' and postedvehicles.model in ("'.$modelList .'")';

	    	}

 			
		    return $sql;

	    }


	    public function getASpecificVehicleQuery($vehicleId){
	      $sql = 'SELECT * FROM `postedvehicles` where id='.$vehicleId  ;
	      return $sql;
	    }

	    public function getVehicleMetaData($vehicleId){
	      $sql = 'SELECT * FROM `vehiclemetadata` where vehicleId='.$vehicleId  ;
	      return $sql;
	    }

	    public function getVehicleImages($vehicleId){
	      $sql = 'SELECT * FROM `vehiclemedia` where vehicleId='.$vehicleId  ;
	      return $sql;
	    }

	    public function getSellerDetails($sellerId){
	      $sql = 'SELECT * FROM `sellerdetails` where id='.$sellerId  ;
	      return $sql;
	    }
	     public function getBuyerDetails($buyerId){
	      $sql = 'SELECT * FROM `buyerdetails` where id='.$buyerId  ;
	      return $sql;
	    }
	    public function getSellerId($vehicleId){
	      $sql = 'SELECT * FROM `postedvehicles` where id='.$vehicleId;
	      return $sql;
	    }

	     public function getSellerZip($vehicleId){
	      $sql = "SELECT selleraddress.zipcode FROM `postedvehicles`,`sellerdetails`,`selleraddress` where postedvehicles.sellerId=sellerdetails.id and sellerdetails.sellerAddress=selleraddress.id  and  postedvehicles.id=".$vehicleId  ;
	      return $sql;
	    }

	    public function getSellerComments($sellerId){
	      $sql = 'SELECT buyercomments.id,comment,timestamp,buyerdetails.buyerName FROM `buyercomments` join `buyerdetails` on buyercomments.buyerId=buyerdetails.id where sellerId='.$sellerId  ;
	      return $sql;
	    }
	    public function writeSellerComment($sellerId,$buyerId,$comment){
	      $sql = 'INSERT INTO `buyercomments` (`id`, `buyerId`, `sellerId`, `comment`) VALUES (NULL, '.$buyerId.', '.$sellerId.', "'.$comment.'")'  ;
	      return $sql;
	    }

	     public function getKeywordsOnVehicleType($keywordIp,$vehicleTypeId){
	     	 $sql = 'SELECT * FROM `helpertags` where LOWER(keyword) like "%'.strtolower($keywordIp).'%" and vehicletypeid='.$vehicleTypeId;
	      	return $sql;
	     }


// SELECT * FROM `postedvehicles` where price between 1000 and 10000 and make IN ('Honda') and year IN ('2010') and model IN ('Accord EX-L') and milesDriven BETWEEN 1000 and 100000 
	    
	}
?>