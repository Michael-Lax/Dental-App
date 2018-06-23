<?php
/*Author: David Doll
  Use: Adds a new user into the database
*/
  session_start();

  include("includes/databaseHandler.inc.php");
  if($_SESSION['user_key'] == 1){
    header("Location: user_home.php");
  }elseif($_SESSION['user_key'] == 2 || $_SESSION['user_key'] == 3){
    header("Location: dentist_home.php");
  }
  $response_array['message'] = "";
  $fname = htmlentities($_POST['firstname']);
  $lname = htmlentities($_POST['lastname']);
  $name = $fname . " " . $lname;
  $email = htmlentities($_POST['email']);
  $password = password_hash($_POST['pwd'], PASSWORD_BCRYPT);
  $phone = htmlentities($_POST['phone']);
  if($_POST['state'] == 'N/A'){
    $_SESSION['message'] = "Please enter a state";
    header("Location: admin/add_account.php");
  }
  $address = htmlentities($_POST['address']) . " " . htmlentities($_POST['city']) . ", " . $_POST['state'] . " " . htmlentities($_POST['zip']);

  // Makes sure a user type is selected
  if($_POST['userkey'] != 0 || $_POST['userkey'] != 1 || $_POST['userkey'] != 2 || $_POST['userkey'] != 3){
    $_SESSION['message'] = "Please select a type of user to add!";
    header("Location: admin/add_account.php");
  }

  // Inserts user into the database
  if($stmt = mysqli_prepare($conn, "INSERT INTO user (firstname, lastname, email, pwd, phone, address, user_key) VALUES (?, ?, ?, ?, ?, ?, ?)")){
    mysqli_stmt_bind_param($stmt, "ssssssi", $fname, $lname, $email, $password, $phone, $address, $_POST['userkey']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $_SESSION['message'] = "Account was successfully added to the database";

    // Gives new user the correct type and adds them to corresponding tables
    if($_POST['userkey'] == 0){
      $sql = "SELECT uid FROM user WHERE firstname = '$fname' AND lastname = '$lname' AND email = '$email'";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      $id = $row['uid'];
      if($stmt = mysqli_prepare($conn, "INSERT INTO admins (name, email, phone, address, id) VALUES (?, ?, ?, ?, ?)")){
        mysqli_stmt_bind_param($stmt, "ssssi", $name, $email, $phone, $address, $id);
        mysqli_stmt_execute($stmt);
      }
    }elseif($_POST['userkey'] == 1){
      $sql = "SELECT uid FROM user WHERE firstname = '$fname' AND lastname = '$lname' AND email = '$email' AND phone ='$phone'";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      $id = $row['uid'];
      if($stmt = mysqli_prepare($conn, "INSERT INTO patients (name, email, phone, address, id) VALUES (?, ?, ?, ?, ?)")){
        mysqli_stmt_bind_param($stmt, "ssssi", $name, $email, $phone, $address, $id);
        mysqli_stmt_execute($stmt);
      }
    }elseif($_POST['userkey'] == 2){
      $sql = "SELECT uid FROM user WHERE firstname = '$fname' AND lastname = '$lname' AND email = '$email'";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      $id = $row['uid'];
      if($stmt = mysqli_prepare($conn, "INSERT INTO dentists (name, email, phone, address, id) VALUES (?, ?, ?, ?, ?)")){
        mysqli_stmt_bind_param($stmt, "ssssi", $name, $email, $phone, $address, $id);
        mysqli_stmt_execute($stmt);
      }
    }elseif($_POST['userkey'] == 3){
      $sql = "SELECT uid FROM user WHERE firstname = '$fname' AND lastname = '$lname' AND email = '$email'";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      $id = $row['uid'];
      if($stmt = mysqli_prepare($conn, "INSERT INTO hygienists (name, email, phone, address, id) VALUES (?, ?, ?, ?, ?)")){
        mysqli_stmt_bind_param($stmt, "ssssi", $name, $email, $phone, $address, $id);
        mysqli_stmt_execute($stmt);
      }
    }
    header("Location: admin/add_account.php");
  }else{
    $_SESSION['message'] = "User was not added, make sure information is correct";
    header("Location: admin/add_account.php");
  }
  mysqli_close($conn);
?>
