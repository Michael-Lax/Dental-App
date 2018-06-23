<?php
  /*  Author: David Doll
      Use: To schedule new staff (dentists/hygienists) for an appointment slot,
      this is a function only available by the admins.
  */
  session_start();
  include("../includes/databaseHandler.inc.php");

  if(empty($_SESSION['user'])){
    header("Location: ../index.php");
  }elseif($_SESSION['user_key'] == 1){
    header("Location: ../user_home.php");
  }elseif($_SESSION['user_key'] == 2 || $_SESSION['user_key'] == 3){
    header("Location: ../dentist_home.php");
  }

  $hyg = htmlentities($_POST['hyg']);
  $dent = htmlentities($_POST['dent']);
  $id = htmlentities($_POST['id']);
  $hid = htmlentities($_POST['hid']);
  $did = htmlentities($_POST['did']);
  $start = htmlentities($_POST['start']);
  $end = htmlentities($_POST['end']);
  $newHid = htmlentities($_POST['newHid']);
  $newDid = htmlentities($_POST['newDid']);
  $dentMessage = "Do not change the scheduled dentist";
  $hygMessage = "Do not change the scheduled hygienist";

  // Update staff's schedules and update the appointment to include the staff members
  if(strcmp($dent, $dentMessage) == 0){
    $sql = "UPDATE hygSchedules SET name = '$hyg', hid = '$newHid' WHERE hid = '$hid' AND start = '$start' AND endT = '$end'";
    mysqli_query($conn, $sql);

    $sql = "UPDATE patappts SET hyg = '$hyg', hid = '$newHid' WHERE id = '$id'";
    mysqli_query($conn, $sql);

  }elseif(strcmp($hyg, $hygMessage) == 0){
    $sql = "UPDATE dentSchedules SET name = '$dent', did = '$newDid' WHERE did = '$did' AND start = '$start' AND endT = '$end'";
    mysqli_query($conn, $sql);

    $sql = "UPDATE patappts SET dentist = '$dent', did = '$newDid' WHERE id = '$id'";
    mysqli_query($conn, $sql);

  }elseif(strcmp($hyg, $hygMessage) != 0 && strcmp($dent, $dentMessage) != 0){
    $sql = "UPDATE dentSchedules SET name = '$dent', did = '$newDid' WHERE did = '$did' AND start = '$start' AND endT = '$end'";
    mysqli_query($conn, $sql);

    $sql = "UPDATE hygSchedules SET name = '$hyg', hid = '$newHid' WHERE hid = '$hid' AND start = '$start' AND endT = '$end'";
    mysqli_query($conn, $sql);

    $sql = "UPDATE patappts SET dentist = '$dent', hyg = '$hyg', hid = '$newHid', did = '$newDid' WHERE id = '$id'";
    mysqli_query($conn, $sql);
  }
  mysqli_close($conn);
 ?>
