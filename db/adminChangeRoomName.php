<?php
/*Author: David Doll
  Use: To change a room's name
*/
session_start();
include("../includes/databaseHandler.inc.php");

// Assigns POST data to variables
$title = $_POST['title'];
$newTitle = $_POST['newTitle'];
$id = $_POST['id'];
$dent = '%'.$_POST['dent'].'%';
$hyg =  '%'.$_POST['hyg'].'%';

if($stmt = mysqli_prepare($conn, "SELECT title FROM rooms WHERE title LIKE ?")){
  mysqli_stmt_bind_param($stmt, 's', $dent);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  if($row = mysqli_fetch_assoc($result)){
    echo 'redirectUser';
    exit();
  }
}

if($stmt = mysqli_prepare($conn, "SELECT title FROM rooms WHERE title LIKE ?")){
  mysqli_stmt_bind_param($stmt, 's', $hyg);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  if($row = mysqli_fetch_assoc($result)){
    echo 'redirectUser';
    exit();
  }
}

if($stmt = mysqli_prepare($conn, "UPDATE rooms SET title = ? WHERE title = ? AND id = ?" )){
  mysqli_stmt_bind_param($stmt, "sss", $newTitle, $title, $id);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
}

mysqli_close($conn);
?>
