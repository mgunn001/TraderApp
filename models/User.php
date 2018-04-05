<?php

class User
{
	private	$name;
	private	$email;
	private	$phone;
	private $userID;
	

	Public	function __construct($name, $email,$phone,$userID)
	{
		$this->name = $name;
		$this->email = $email;
		$this->phone = $phone; 
		$this->userID = $userID;
	}
	public function getName(){
		return $this->name;
	}

	public function setName($name){
		$this->name = $name;
	}

	public function getEmail(){
		return $this->email;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function getPhone(){
		return $this->phone;
	}

	public function setPhone($phone){
		$this->phone = $phone;
	}

	public function getUserID(){
		return $this->userID;
	}

	public function setuserID($userID){
		$this->userID = $userID;
	}
}


?> 