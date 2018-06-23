<?php
/*Author: David Doll
  Use: Allows a user to create a new appointment
*/
session_start();
include("../includes/databaseHandler.inc.php");

$description = htmlentities($_POST['description']);
$name = htmlentities($_POST['title']);
$start = htmlentities($_POST['start']);
$end = htmlentities($_POST['end']);
$resourceId = $_POST['resourceId'];

if($stmt = mysqli_prepare($conn, "INSERT INTO patappts (description, title, start, endT, resourceid) VALUES (?, ?, ?, ?, ?)")){
  mysqli_stmt_bind_param($stmt, "ssssi", $description, $name, $start, $end, $resourceId);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
}
?>
