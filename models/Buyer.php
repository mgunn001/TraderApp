<?php
class Buyer extends User{

   Public function Buyer($name, $email,$phone,$buyerID)
	{
		  parent::__construct($name, $email,$phone,$buyerID);	
	}

}
?>