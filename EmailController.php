<?php
 include_once "./service/MailService.php";
 include_once "./service/SearchService.php";
 ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

 	if(isset($_POST["mailbody"])){ //

 	  $sellerId = $_POST["sellerid"];
 	  $vehicleId = $_POST["vehicleid"];
 	  $buyerId = "1"; // hard coding the value as only one buyer exist
 	  $mailBody = $_POST["mailbody"];

 	  $mail_service = new MailService();
 	  //$sellerId,$vehicleId,$buyerId,$mailBody
	  $result= $mail_service->mailSeller($sellerId ,$vehicleId,$buyerId, $mailBody);
	  return $result;
 	}

 	if(isset($_POST["comment"])){ //

 	  $sellerId = $_POST["sellerid"];
 	  $buyerId = $_POST["buyerid"];
 	  // $buyerId = "1"; // hard coding the value as only one buyer exist
 	  $comment = $_POST["comment"];

 	  $mail_service = new SearchService();
 	  //$sellerId,$vehicleId,$buyerId,$mailBody
	  $result= $mail_service->writeSellerComments($sellerId,$buyerId,$comment);
	  return $result;
 	}

?>