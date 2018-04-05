<?php
  include_once "./service/SearchService.php";

  $search_service = new SearchService();
  $conn = $search_service->getAllVehiclesQuery();
  echo $conn;

  echo 'Helloo From Home Controller';

?>