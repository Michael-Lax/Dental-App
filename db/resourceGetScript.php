<?php
/*Author: David Doll
  Use: Retrieves room names
*/
  session_start();
  include("../includes/databaseHandler.inc.php");

  if($stmt = mysqli_prepare($conn, "SELECT * FROM rooms")){
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $resources = array();
    while ($row = mysqli_fetch_assoc($result)){
      $resourcesArray['id'] = $row['id'];
      $resourcesArray['title'] = $row['title'];
      $resources[] = $resourcesArray;
    }

    header('Content-type: application/json');
    echo json_encode($resources);
  }
 ?>
