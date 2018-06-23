<?php
  /*  Author: David Doll
      Use: to only show the hygienists that are available at the selected timeslot
      in the dropdown menu
  */
  //keep the session going and establish connection with database
  session_start();
  include("../includes/databaseHandler.inc.php");
  //set the variable for the data passed in from the ajax request
  $start = $_POST['startTime'];
  /*query the database to only get the names and id's of the hygienists that do not
  already have appointments/requested time off when a user/admin selects a timeslot to
  set up an appointment*/
  $sql = "SELECT hygienists.name, hygienists.hid FROM hygienists WHERE name NOT IN (SELECT hygSchedules.name FROM hygSchedules WHERE start = '$start') AND hygienists.hid NOT IN (SELECT hygTimeOff.hid FROM hygTimeOff WHERE hygTimeOff.start <= '$start' AND hygTimeOff.endT >= '$start')";
  $result = mysqli_query($conn, $sql);
  $tableHygienists = array();
  //Loop through each row of data retrieved from the database and store each
  //hygienist name/id in an array
  while($row = mysqli_fetch_assoc($result)){
      $name = $row['name'];
      $id = $row['hid'];
      $hygArray['name'] = $name;
      $hygArray['hid'] = $id;
      $tableHygienists[] = $hygArray;
  }
    //return to the page calling this file, the array of hygienists as a JSON object
    header('Content-type: application/json');
    echo json_encode($tableHygienists);
    mysqli_close($conn);
 ?>
