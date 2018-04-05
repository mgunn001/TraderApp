<?php

class MetaData
{
	private	$property;
	private	$propertyValue;
	
	public function __construct($property, $propertyValue)
	{
		 $this->property = $property;
		 $this->propertyValue = $propertyValue;	  
	}

	public function getProperty(){
		return $this->property;
	}

	public function setProperty($property){
		$this->property = $property;
	}

	public function getPropertyValue(){
		return $this->propertyValue;
	}

	public function setPropertyValue($propertyValue){
		$this->propertyValue = $propertyValue;
	}
}

?>