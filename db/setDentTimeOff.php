<?php
/*Author: David Doll
  Use: Give a dentist time off
*/
  session_start();
  include("../includes/databaseHandler.inc.php");

  $name = $_POST['name'];
  $start = $_POST['start'];
  $end = $_POST['end'];
  $did = $_POST['did'];

  $sql = "INSERT INTO dentTimeOff (name, start, endT, did) VALUES ('$name', '$start', '$end', '$did')";
  mysqli_query($conn, $sql);
  exit();
  mysqli_close($conn);
 ?>
