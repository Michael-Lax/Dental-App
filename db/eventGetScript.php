<?php
  /* Author: David Doll
      Use: to get all the appointments from the database that are scheduled
           to display on the calendar
  */

  //keep the session going if a user is logged in, and connect to database
  session_start();
  include("../includes/databaseHandler.inc.php");

  //select all fields from the patappts table to be displayed
  //and then store the data in an array
  if($stmt = mysqli_prepare($conn, "SELECT * FROM patappts")){
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $events = array();
    while ($row = mysqli_fetch_assoc($result)){
      $eventArray['id'] = $row['id'];
      $eventArray['description'] = $row['description'];
      $eventArray['dentist'] = $row['dentist'];
      $eventArray['hyg'] = $row['hyg'];
      $eventArray['title'] = $row['title'];
      $eventArray['start'] = $row['start'];
      $eventArray['end'] = $row['endT'];
      $eventArray['resourceId'] = $row['resourceId'];
      $eventArray['did'] = $row['did'];
      $eventArray['hid'] = $row['hid'];
      $eventArray['pid'] = $row['pid'];
      $events[] = $eventArray;
    }

    //return the array of appointment data
    //as a JSON object
    header('Content-type: application/json');
    echo json_encode($events);
  }
 ?>
