<?php

	class Queries
	{
	    public function getAllVehiclesQuery(){
	      $sql = 'SELECT * FROM `postedvehicles`'  ;
	      return $sql;
	    }

	    public function getVehiclesByMandateFiltersQuery($vehicleTypeId){
	     $sql = 'SELECT * FROM `postedvehicles` where vehicleType='.$vehicleTypeId;
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
	    public function getSellerId($vehicleId){
	      $sql = 'SELECT * FROM `postedvehicles` where id='.$vehicleId  ;
	      return $sql;
	    }

	     public function getSellerZip($vehicleId){
	      $sql = "SELECT selleraddress.zipcode FROM `postedvehicles`,`postedvehicles`,`postedvehicles` where id=".$vehicleId  ;
	      return $sql;
	    }



	    public function getSellerComments($sellerId){
	      $sql = 'SELECT buyercomments.id,comment,timestamp,buyerdetails.buyerName FROM `buyercomments` join `buyerdetails` on buyercomments.buyerId=buyerdetails.id where sellerId='.$sellerId  ;
	      return $sql;
	    }
	    public function writeSellerComment($sellerId,$buyerId,$comment){
	      $sql = 'INSERT INTO `buyercomments` (`id`, `buyerId`, `sellerId`, `comment`, `timestamp`) VALUES (NULL, '.$buyerId.', '.$sellerId.', "'.$comment.'", "")'  ;
	      return $sql;
	    }

	    
	}
?>