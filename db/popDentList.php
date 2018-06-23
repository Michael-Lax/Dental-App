<?php
  /* Author: David Doll
    Use: to only show the dentists that are available at the selected timeslot in the dropdown menu
  */
  //keep the session going and establish connection to database
  session_start();
  include("../includes/databaseHandler.inc.php");
  //set variable for the data passed in from the ajax request
  $start = $_POST['startTime'];
  /*query the database only to get the names and id's of the dentists that do not already
  have an appointments/requested time off when a user/admin selects a timeslot
  to set up an appointment*/
  $sql = "SELECT dentists.name, dentists.dentid FROM dentists WHERE dentists.name NOT IN (SELECT dentSchedules.name FROM dentSchedules WHERE start = '$start') AND dentists.dentid NOT IN (SELECT dentTimeOff.did FROM dentTimeOff WHERE dentTimeOff.start <= '$start' and dentTimeOff.endT >= '$start') ";
  $result = mysqli_query($conn, $sql);
  $tableHygienists = array();
  //loop through each row of data retrieved from the database and store each
  //dentist's name and id in an array
  while($row = mysqli_fetch_assoc($result)){
      $name = $row['name'];
      $id = $row['dentid'];
      $hygArray['name'] = $name;
      $hygArray['dentid'] = $id;
      $tableHygienists[] = $hygArray;
  }
    //return to the page calling this file, the array of dentists as a JSON object
    header('Content-type: application/json');
    echo json_encode($tableHygienists);
    mysqli_close($conn);
 ?>
