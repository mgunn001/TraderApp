<?php
  include_once "./service/SearchService.php";

  $search_service = new SearchService();
  //$resultObj= $search_service->getAllVehicles();
  $resultObj= $search_service->getASpecificVehicle("1");

  echo $resultObj;

  echo 'Helloo From Home Controller';
?>