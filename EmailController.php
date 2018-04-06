<?php
 include_once "./service/MailService.php";

  $mail_service = new MailService();
  //$resultObj= $search_service->getAllVehicles();
  $resultObj= $mail_service->mailSeller("1","1","1","1");

  echo $resultObj;

  echo 'Helloo From Email Controller';

?>