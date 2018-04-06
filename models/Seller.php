<?php
class Seller extends User{

	private $type;
	private $site;
	private Address $address;
	

   Public function __construct(Address $add,	$name, $email,$phone, $site,$sellerId)
	{
		 parent::__construct($name, $email,$phone,$sellerId);
		 $this->address = $add;
		 $this->site = $site;
	}

	public function getType(){
		return $this->type;
	}

	public function settype($type){
		$this->type = $type;
	}

	public function getSite(){
		return $this->site;
	}

	public function setSite($site){
		$this->site = $site;
	}



	public function getAddress(){
		return $this->address;
	}

	public function setAddress($address){
		$this->address = $address;
	}


}
?>