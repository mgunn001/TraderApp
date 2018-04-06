<?php

	class Queries
	{
	    public function getAllVehiclesQuery(){
	      $sql = 'SELECT * FROM `postedVehicles`'  ;
	      return $sql;
	    }

	    public function getASpecificVehicleQuery($vehicleId){
	      $sql = 'SELECT * FROM `postedVehicles` where id='.$vehicleId  ;
	      return $sql;
	    }

	    public function getVehicleMetaData($vehicleId){
	      $sql = 'SELECT * FROM `vehicleMetaData` where vehicleId='.$vehicleId  ;
	      return $sql;
	    }

	    public function getVehicleImages($vehicleId){
	      $sql = 'SELECT * FROM `vehicleMedia` where vehicleId='.$vehicleId  ;
	      return $sql;
	    }

	    public function getSellerDetails($sellerId){
	      $sql = 'SELECT * FROM `sellerDetails` where id='.$sellerId  ;
	      return $sql;
	    }
	    public function getSellerId($vehicleId){
	      $sql = 'SELECT * FROM `postedvehicles` where id='.$vehicleId  ;
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