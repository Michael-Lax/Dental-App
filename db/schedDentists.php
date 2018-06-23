<?php
/*Author: David Doll
  Use: Assign a dentist to a scheduled appointment
*/
  session_start();
  include("../includes/databaseHandler.inc.php");

  $id = $_POST['id'];
  $dentist = htmlentities($_POST['dentist']);
  $hyg = htmlentities($_POST['hyg']);

  if($stmt = mysqli_prepare($conn, "UPDATE patappts SET dentist = ?, hyg = ? WHERE id = ?")){
    mysqli_stmt_bind_param($stmt, "sss", $dentist, $hyg, $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
  }

  mysqli_close($conn);
 ?>
