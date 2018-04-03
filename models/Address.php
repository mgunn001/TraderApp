<?php

class Address
{
	private	$addressID;
	private	$addLine1;
	private	$addLine2;
	private	$city;
	private	$state;
	private	$zipCode;

	public function __construct($addressID,$addLine1,$addLine2,$city,$state, $zipCode){
		this->addressID = $addressID;
		this->addLine1 = $addLine1;
		this->addLine2 = $addLine2; 
		this->city = $city;
		this->state = $state;
		this->zipCode = $zipCode;
	}
	

	public function getAddressID(){
		return $this->addressID;
	}

	public function setAddressID($addressID){
		$this->addressID = $addressID;
	}

	public function getAddLine1(){
		return $this->addLine1;
	}

	public function setAddLine1($addLine1){
		$this->addLine1 = $addLine1;
	}

	public function getAddLine2(){
		return $this->addLine2;
	}

	public function setAddLine2($addLine2){
		$this->addLine2 = $addLine2;
	}

	public function getCity(){
		return $this->city;
	}

	public function setCity($city){
		$this->city = $city;
	}

	public function getState(){
		return $this->state;
	}

	public function setState($state){
		$this->state = $state;
	}

	public function getZipCode(){
		return $this->zipCode;
	}

	public function setZipCode($zipCode){
		$this->zipCode = $zipCode;
	}

}


?> 