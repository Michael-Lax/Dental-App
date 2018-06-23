<?php
/*Author: David Doll
  Use: In order to add accounts into the database from the admin page. Only admins should
  have access to this page.
*/
  session_start();
  include("../includes/databaseHandler.inc.php");;
  $sql = "SELECT name, hid FROM hygienists";

  // Gets all hygienists along with their information
  $result = mysqli_query($conn, $sql);
  $hygienists = array();
  while($row = mysqli_fetch_assoc($result)){
      $name = $row['name'];
      $id = $row['hid'];
      $hygArray['name'] = $name;
      $hygArray['hid'] = $id;
      $hygienists[] = $hygArray;
  }
    header('Content-type: application/json');
    echo json_encode($hygienists);
    mysqli_close($conn);
 ?>
