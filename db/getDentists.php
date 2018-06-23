<?php
  session_start();
  include("../includes/databaseHandler.inc.php");
  $sql = "SELECT name, dentid FROM dentists";
  $result = mysqli_query($conn, $sql);
  $dentists = array();
  while($row = mysqli_fetch_assoc($result)){
      $name = $row['name'];
      $id = $row['dentid'];
      $dentArray['name'] = $name;
      $dentArray['did'] = $id;
      $dentists[] = $dentArray;
  }
    header('Content-type: application/json');
    echo json_encode($dentists);
    mysqli_close($conn);
 ?>
