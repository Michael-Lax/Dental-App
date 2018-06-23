<?php
/*Author: David Doll
  Use: Logs user out
*/
  session_start();
  session_unset();
  session_destroy();

  header("Location: index.php");
  exit();
?>
