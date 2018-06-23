<?php
/*Author: David Doll
  Use: Dentist notifications
*/
session_start();
include("../includes/databaseHandler.inc.php");
if(empty($_SESSION['user'])){
  header("Location: ../index.php");
}

$id = $_POST['id'];

if($_SESSION['user_key'] == 1){
  header('Location: user_home.php');
}elseif($_SESSION['user_key'] == 0){
  header('Location: admin_home.php');
}

if($_SESSION['user_key'] == 2){
    $sql = "SELECT messages FROM dentNotifications WHERE ";
}elseif($_SESSION['user_key'] == 3){

}
?>
