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

	    
	}
?>