<?php
	include_once  dirname(__DIR__)."/util/DatabaseConnection.php";
	include_once dirname(__DIR__)."/dao/Queries.php";
	include_once dirname(__DIR__)."/models/Vehicle.php";
	include_once dirname(__DIR__)."/models/MetaData.php";

	ini_set('display_startup_errors', 1);
	ini_set('display_errors', 1);
	error_reporting(-1);
	 // echo dirname(__DIR__);
	class MailService
	{
		public function mailSeller($sellerId,$vehicleId,$buyerId,$mailBody)
		{

			  $mail = new PHPMailer();
		      // $toarraymail=$email_id;
		      $mail->SMTPDebug = false;                               // Enable verbose debug output
		      $mail->Port = '587';
		      $mail->isSMTP();                                      // Set mailer to use SMTP // Specify main and backup SMTP servers                                    // Set mailer to use SMTP
		      $mail->Host = gethostbyname('smtp.gmail.com');  // Specify main and backup SMTP servers
		      $mail->SMTPAuth = true; // Authentication must be disabled

		      $mail->Username = 'studentrecruitment.csodu@gmail.com';
		      $mail->Password = 'Srts@123';
		      $mail->SMTPSecure= 'tls';


		      $mail->setFrom("studentrecruitment.csodu@gmail.com","IBHER");
		      $mail->AddAddress($email);     // Add a recipient
		      $mail->isHTML(true);                                  // Set email format to HTML                 // Set email format to HTML

		      $mail->Subject = 'Forgot Password';
		      $tempPassword = $this->generateTempPassword();
		      $database_connection = new DatabaseConnection();
		      $conn = $database_connection->getConnection();
		      $sql_service = new CommonSql();
		      $insertPasswordQuery = $sql_service->updateTempPassword($email,$tempPassword);
		      $conn -> query($insertPasswordQuery);
		      echo "Password updated "+$tempPassword+" for "+$email;
		      $conn->close();
		      $mail->Body    =" Hello $firstName $lastName,
		                        <br /><br /><br />
		                        Username: $email,<br />
		                        Password: $tempPassword.<br /><br />

		                        You can change the password once you <a href ='https://ibhert.org'>login</a>.


		                        <br /><br />
		                        Regards,<br />
		                        IBHER Team.";

		      $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		      if(!$mail->Send()){
		        return false;
		      }else{
		        return true;
		      }
		      echo "Sending email";
		}
	}
?>