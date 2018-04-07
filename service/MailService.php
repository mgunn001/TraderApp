<?php
	include_once  dirname(__DIR__)."/util/DatabaseConnection.php";
	include_once dirname(__DIR__)."/dao/Queries.php";
	include_once dirname(__DIR__)."/models/Vehicle.php";
	include_once dirname(__DIR__)."/models/MetaData.php";
	include_once dirname(__DIR__)."/resource/php/class.phpmailer.php";

	ini_set('display_startup_errors', 1);
	ini_set('display_errors', 1);
	error_reporting(-1);
	 // echo dirname(__DIR__);
	class MailService
	{
		public function mailSeller($sellerId,$vehicleId,$buyerId,$mailBody)
		{
			// getSellerDetails($sellerId)
			// getBuyerDetails($buyerId)
			// getASpecificVehicleQuery($vehicleId)

		  $database_connection = new DatabaseConnection();
		  $conn = $database_connection->getConnection();
		  $queries = new Queries();
		  $sellerId= mysqli_real_escape_string($conn,$sellerId);;
		  $vehicleId = mysqli_real_escape_string($conn,$vehicleId);;
		  $buyerId = mysqli_real_escape_string($conn,$buyerId);;
		  $mailBody = mysqli_real_escape_string($conn,$mailBody);;


		  $getVehicleQuery = $queries->getASpecificVehicleQuery($vehicleId);
		  $vehicleQueryResult = $conn->query($getVehicleQuery);
		  $vehicleDetailsStr='Vehcile Details: <br />';
		   if ($vehicleQueryResult->num_rows > 0) {
		            	
		      while($eachRow = $vehicleQueryResult->fetch_assoc()) {
					
		      		// $vehicleDetailsStr.='Vehcile Details: <br />';
		      		$vehicleDetailsStr.='Year: '.$eachRow['year'].' <br />';
		      		$vehicleDetailsStr.='Make: '.$eachRow['make'].' <br />';
		      		$vehicleDetailsStr.='Model: '.$eachRow['model'].' <br />';
		      		$vehicleDetailsStr.='Miles: '.$eachRow['milesDriven'].' <br />';
		      		$vehicleDetailsStr.='Description: '.$eachRow['description'].' <br />';
		      }
			} else {
			    return 'fail';
			}

			$getSellerQuery = $queries->getSellerDetails($sellerId);
			  $sellerQueryResult = $conn->query($getSellerQuery);
			
		   if ($sellerQueryResult->num_rows > 0) {
		            	
		      while($eachRow = $sellerQueryResult->fetch_assoc()) {
					
		      		$sellerEmailId=$eachRow['sellerEmail'];
		      }
			} else {
			    return 'fail';
			}
			$getBuyerQuery = $queries->getBuyerDetails($buyerId);
			  $buyerQueryResult = $conn->query($getBuyerQuery);
			 $buyerDetailsStr='Buyer Details: <br />';
		   if ($buyerQueryResult->num_rows > 0) {
		            	
		      while($eachRow = $buyerQueryResult->fetch_assoc()) {
					
		      		$buyerDetailsStr.='Name: '.$eachRow['buyerName'].' <br />';
		      		$buyerDetailsStr.='Email: '.$eachRow['buyerEmail'].' <br />';
		      		$buyerDetailsStr.='Phone Number: '.$eachRow['buyerPhoneNumber'].' <br />';
		      }
			} else {
			    return 'fail';
			}


			  $mail = new PHPMailer();
		      $mail->SMTPDebug = false;                               // Enable verbose debug output
		      $mail->Port = '587';
		      $mail->isSMTP();                                      // Set mailer to use SMTP // Specify main and backup SMTP servers                                    // Set mailer to use SMTP
		      $mail->Host = gethostbyname('smtp.gmail.com');  // Specify main and backup SMTP servers
		      $mail->SMTPAuth = true; // Authentication must be disabled

		      $mail->Username = 'studentrecruitment.csodu@gmail.com';
		      $mail->Password = 'Srts@123';
		      $mail->SMTPSecure= 'tls';

		      $mail->setFrom("studentrecruitment.csodu@gmail.com","Trader");
		      $mail->AddAddress($sellerEmailId);     // Add a recipient
		      $mail->isHTML(true);                                  // Set email format to HTML                 // Set email format to HTML

		      $mail->Subject = 'New buyer for the car open for selling';

		      $mail->Body    =" A person is interested in the vehicle posted by you. <br />".$vehicleDetailsStr."<br />".$buyerDetailsStr."<br /> Message from buyer: '".$mailBody."'";

		      // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
 
		      if(!$mail->Send()){
		        return "fail";
		      }else{	      	
		        return "success";
		      }

		}
	}
?>