<?php
/*Author: David Doll
  Use: In order to add accounts into the database from the admin page. Only admins should
  have access to this page.
*/
  session_start();
  include("../includes/databaseHandler.inc.php");
  $start = $_POST['startTime'];
  //$sql = "SELECT hygienists.name FROM hygienists INNER JOIN hygSchedules ON hygSchedules.start = '$start'";
  $sql = "SELECT patients.name, patients.pid FROM patients WHERE patients.name NOT IN (SELECT patappts.title FROM patappts WHERE start = '$start')";
  /*$sql = "SELECT hyg FROM hygienist
          UNION SELECT hyg FROM patappts WHERE start != '$start'";*/
  $result = mysqli_query($conn, $sql);
  $tableHygienists = array();

  // Assigns row information into variables that will be encoded into a JSON object
  while($row = mysqli_fetch_assoc($result)){
      $name = $row['name'];
      $id = $row['pid'];
      $patArray['name'] = $name;
      $patArray['pid'] = $id;
      $patients[] = $patArray;
  }
    header('Content-type: application/json');
    echo json_encode($patients);
    mysqli_close($conn);
 ?>
