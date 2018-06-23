<?php
/*Author: Michael Pearson
  Use: User help page for new users
*/
  session_start();
  include("includes/databaseHandler.inc.php");

  $home = "Home";
  if(empty($_SESSION['user'])){
    $home = "Login";
  }
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>MAD Dental</title>
  <meta name= "Dental Coordination Scheduling Web-App">
  <meta name= "David Doll, Michael Pearson, Alexander Grunwald">
  <link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">

  <script src='fullcalendar/lib/jquery.min.js'></script>
  <link href = "Styles/style.css" rel= "stylesheet"/>
  <link href="https://bootswatch.com/superhero/bootstrap.min.css" rel="stylesheet"/>
</head>

<body>
  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">MAD Dental</a>
      </div>
      <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
          <li><a href="index.php"><span class="glyphicon glyphicon-home"></span>Home</a></li>
          <li class="active"><a href="index.php">Login Help</a></li>
        </ul>
      </div><!--/.nav-collapse -->
    </div>
  </nav>

  <div class="container">
    <h2 style="text-align: center"><u>Login Help</u></h2>
    <div class="table-responsive">
    <table class="table">
      <tbody>
        <tr>
          <td>
            <p>
              <h3>Getting an Account:</h3>
            To get an account to use for this website please <a href="db/contactAdmin.php" target="_self">contact us</a> to get an account set up.
              <h3>Logging in:</h3>
            To log in, use the E-mail you registered with MAD Dental and your password. If you've forgotten your password please
            <a href="db/contactAdmin.php" target="_self">contact us</a> for retrieval of your password.
            <br><br>
            </p>
          </td>
        </tr>
        <tr>
          <td colspan="2" valign="top"><p>&nbsp;</p>
            <p></p><hr><p></p>
            <p style="text-align:center;">
              Here at MAD Dental we strive for excellence and complete customer satisfaction. If ever we don't meet your
              expectations, please feel free to <a href="db/contactAdmin.php" >contact us</a> for prompt assistance.
            </p>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  </div>
</body>
</html>
