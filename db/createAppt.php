<?php
  /* Author: David Doll
    USE: to create appointments on the calendar
  */
  //keep the session going, and establish connection to database
  session_start();
  include("../includes/databaseHandler.inc.php");

  //set the variables for the associated data passed from the ajax request
  //to use for adding values into the database
  $description = htmlentities($_POST['apptType']);
  $name = htmlentities($_POST['title']);
  $start = htmlentities($_POST['start']);
  $end = htmlentities($_POST['end']);
  $resourceId = $_POST['resourceId'];
  $dentist = htmlentities($_POST['dentist']);
  $hyg = htmlentities($_POST['hyg']);
  $dentId = $_POST['did'];
  $hygId = $_POST['hid'];
  $patId = $_POST['pid'];

  if($_SESSION['user_key'] == 1){
    if($stmt = mysqli_prepare($conn, "SELECT pid FROM patappts WHERE start = ? AND endT = ? AND pid = ?")){
        mysqli_stmt_bind_param($stmt, "ssi", $start, $end, $patId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $rows = mysqli_num_rows($result);
        if($rows > 0){
          echo "notAvailable";
          exit();
        }
    }
  }

  //insert into the patient appointments (patappts) table the data that is asssociated with this appointment
  if($stmt = mysqli_prepare($conn, "INSERT INTO patappts (description, title, start, endT, resourceId, dentist, hyg, did, hid, pid) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")){
    mysqli_stmt_bind_param($stmt, "ssssissiii", $description, $name, $start, $end, $resourceId, $dentist, $hyg, $dentId, $hygId, $patId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
  }

  //insert into the dentSchedules table the data that is asssociated with this appointment
  if($stmt = mysqli_prepare($conn, "INSERT INTO dentSchedules(did, name, start, endT) VALUES (?, ?, ?, ?)")){
    mysqli_stmt_bind_param($stmt, "isss", $dentId, $dentist, $start, $end);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
  }

  //insert into the hygSchedules table the data that is asssociated with this appointment
  if($stmt = mysqli_prepare($conn, "INSERT INTO hygSchedules(hid, name, start, endT) VALUES (?, ?, ?, ?)")){
    mysqli_stmt_bind_param($stmt, "isss", $hygId, $hyg, $start, $end);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
  }
  exit();
  mysqli_close($conn);
 ?>
