<?php
  /*  Author: David Doll and Michael Pearson
      Use: To delete user accounts from the database;
  */
  //only allow user's logged in as an admin to access this page
  if(empty($_SESSION['user'])){
    header("Location: ../index.php");
  }elseif($_SESSION['user_key'] == 1){
    header("Location: ../user_home.php");
  }elseif($_SESSION['user_key'] == 2 || $_SESSION['user_key'] == 3){
    header("Location: ../dentist_home.php");
  }

  //keep session going, and establish connection with database
  session_start();
  include("../includes/databaseHandler.inc.php");
  //set the variables for the data that got passed in from the ajax request
  $id = $_POST['id'];
  $userKey = $_POST['userKey'];

  //delete the user from the user's table where the id matches the id passed in from
  //the ajax request
  if($stmt = mysqli_prepare($conn, "DELETE FROM user WHERE uid = ?")){
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    if($userKey == 0){
      //if the userKey = 0, then the user is an admin, so their info must also
      //be deleted from the admins table.
      $sql = "DELETE FROM admins WHERE id = '$id'";
      mysqli_query($conn, $sql);
    }elseif($userKey == 1){
      //if the userKey = 1, then the user is a patient, so their info must also
      //be deleted from the patients table.
      $sql = "DELETE FROM patients WHERE id = '$id'";
      mysqli_query($conn, $sql);
    }elseif($userKey == 2){
      //if the userKey = 2, then the user is a dentist, so their info must also
      //be deleted from the dentists table.
      $sql = "DELETE FROM dentists WHERE id = '$id'";
      mysqli_query($conn, $sql);
    }elseif($userKey == 3){
      //if the userKey = 3, then the user is a hygienist, so their info must also
      //be deleted from the admins table.
      $sql = "DELETE FROM hygienists WHERE id = '$id'";
      mysqli_query($conn, $sql);
    }
  }

  mysqli_close($conn);
 ?>
