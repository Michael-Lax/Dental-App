<?php
/*Author: David Doll
  Use: Logs user into the website
*/
session_start();
include("includes/databaseHandler.inc.php");

$email = $_POST['email'];
if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
  $_SESSION['errormsg'] = "Please enter a valid e-mail!";
  header("Location: index.php");
  exit();
}
$pwd = $_POST['pwd'];

// Takes given username and password, checks if valid, and sends to the corresponding home page
if($stmt = mysqli_prepare($conn, "SELECT * FROM user WHERE email = ?")){
  mysqli_stmt_bind_param($stmt, "s", $email);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $result = mysqli_fetch_assoc($result);
  if(empty($result)){
    $_SESSION['errormsg'] = "User not found, make sure email is correct!";
    header("Location: index.php");
    exit();
  }elseif(password_verify($pwd, $result['pwd'])){
    $_SESSION['user'] = $result['firstname'] . " " . $result ['lastname'];
    $_SESSION['email'] = $email;
    $_SESSION['uid'] = $result['uid'];
    $_SESSION['user_key'] = $result['user_key'];
    $_SESSION['phone'] = $result['phone'];
    $_SESSION['address'] = $result['address'];
    $uid = $_SESSION['uid'];
    if($result['user_key'] == 0){
      $sql = "SELECT aid FROM admins WHERE id = '$uid'";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      $_SESSION['altid'] = $row['aid'];
      header("Location: admin_home.php");
      exit();
    }elseif($result['user_key'] == 1){
      $sql = "SELECT pid FROM patients WHERE id = '$uid'";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      $_SESSION['altid'] = $row['pid'];
      header("Location: user_home.php");
      exit();
    }elseif($result['user_key'] == 2){
      $sql = "SELECT did FROM dentists WHERE id = '$uid'";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      $_SESSION['altid'] = $row['did'];
      header("Location: dentist_home.php");
      exit();
    }elseif($result['user_key'] == 3){
      $sql = "SELECT hid FROM hygienists WHERE id = '$uid'";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      $_SESSION['altid'] = $row['hid'];
      header("Location: dentist_home.php");
      exit();
    }
  }else{
    $_SESSION['errormsg'] = "Wrong Password! Try again!";
    header("Location: index.php");
    exit();
  }
  mysqli_close($conn);
}
?>
