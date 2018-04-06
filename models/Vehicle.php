<?php
    ini_set('display_startup_errors', 1);
	ini_set('display_errors', 1);
	error_reporting(-1);

class Vehicle
{
	private	$id;
	private	$year;
	private	$make;
	private	$model;
	private $milesDriven;
	private $price;
	private $vehicleType;
	private $description;
	private $metaData;
	private $images;

	
	public function __construct($id,$year,$make, $model,$milesDriven, $price,$vehicleType,$description,$metaData,$images)
	{
		 $this->id = $id;
		 $this->year = $year;
		 $this->make = $make;
		 $this->model = $model;
		 $this->milesDriven = $milesDriven;
		 $this->price = $price;
		 $this->vehicleType = $vehicleType;
		 $this->description = $description;
		 $this->metaData = $metaData;
		 $this->images = $images;
	}
	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}
	public function getYear(){
		return $this->year;
	}

	public function setYear($year){
		$this->year = $year;
	}

	public function getMake(){
		return $this->make;
	}

	public function setMake($make){
		$this->make = $make;
	}

	public function getModel(){
		return $this->model;
	}

	public function setModel($model){
		$this->model = $model;
	}

	public function getMilesDriven(){
		return $this->milesDriven;
	}

	public function setMilesDriven($milesDriven){
		$this->milesDriven = $milesDriven;
	}

	public function getPrice(){
		return $this->price;
	}

	public function setPrice($price){
		$this->price = $price;
	}

	public function getVehicleType(){
		return $this->vehicleType;
	}

	public function setVehicleType($vehicleType){
		$this->vehicleType = $vehicleType;
	}

	public function getDescription(){
		return $this->description;
	}

	public function setDescription($description){
		$this->description = $description;
	}

	public function getMetaData(){
		return $this->metaData;
	}

	public function setMetaData($metaData){
		$this->metaData = $metaData;
	}

	public function getImages(){
		return $this->images;
	}

	public function setImages($images){
		$this->images = $images;
	}

}

?>