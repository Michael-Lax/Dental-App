<?php
  /*  Author: David Doll and Michael Pearson
      To delete appointments/events from the calendar
  */

  //keep the user session going and establish connection with database
  session_start();
  include("../includes/databaseHandler.inc.php");
  //if no user is logged in, and they try to gain access to this page, redirect them
  if(empty($_SESSION['user'])){
    header("Location: ../index.php");
  }

  //set variables for the data that was passed in from the ajax request
  $pid = $_POST['pid'];
  $hid = $_POST['hid'];
  $did = $_POST['did'];
  $start = $_POST['start'];
  $end = $_POST['end'];

  if($_SESSION['user'] == $name){

  }

    //delete the appointment from the dentSchedules table where the appointment that is being deleted contains the same start time, end time,
    //and dentist id as the data passed in from the ajax query
    $sql = "DELETE FROM dentSchedules WHERE dentSchedules.start = '$start' AND dentSchedules.endT = '$end' AND dentSchedules.did = '$did'";
    mysqli_query($conn, $sql);

    //delete the appointment from the hygSchedules table where the appointment that is being deleted contains the same start time, end time,
    //and hygienist id as the data passed in from the ajax query
    $sql = "DELETE FROM hygSchedules WHERE hygSchedules.start = '$start' AND hygSchedules.endT = '$end' AND hygSchedules.hid = '$hid'";
    mysqli_query($conn, $sql);

    //delete the appointment from the patappts (patient appointments) table where the appointment that is being deleted contains the same
    //start time, end time, patient id, hygienist id, and dentist id as the data passed in from the ajax query.
    $sql = "DELETE FROM patappts WHERE patappts.start = '$start' AND patappts.endT = '$end' AND patappts.hid = '$hid' AND patappts.pid = '$pid' AND patappts.did = '$did'";
    mysqli_query($conn, $sql);

    $messsage = "Due to a recent change in scheduling, one of your appointments was cancelled. Please sign up for a new appointment. We are sorry for the inconvenience.";
    $sql = "INSERT INTO patNotifications(message, pid, start, endT) VALUES ($message, $pid, $start, $end)";
    mysqli_query($conn, $sql);

 ?>
