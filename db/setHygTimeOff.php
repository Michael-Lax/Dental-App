<?php
/*Author: David Doll
  Use: Give a hygienist time off
*/
  session_start();
  include("../includes/databaseHandler.inc.php");

  $name = $_POST['name'];
  $start = $_POST['start'];
  $end = $_POST['end'];
  $did = $_POST['hid'];

  $sql = "INSERT INTO hygTimeOff (name, start, endT, hid) VALUES ('$name', '$start', '$end', '$did')";
  mysqli_query($conn, $sql);
  exit();
  mysqli_close($conn);
 ?>
