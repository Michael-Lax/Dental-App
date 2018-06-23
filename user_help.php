<?php
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
          <li><a href="about.php">About</a></li>
          <li class="active"><a href="user_help.php">User Help</a></li>
        </ul>
      </div><!--/.nav-collapse -->
    </div>
  </nav>

  <div class="container">
    <h2 style="text-align: center"><u>User Help</u></h2>
    <div class="table-responsive">
    <table class="table">
      <tbody>
        <tr>
          <td>
            <p>
              <h3>Scheduling an Appointment:</h3>
            To schedule an appointment, click on an open time slot and room in the default calendar view. You will then be prompted to choose a dentist
            and hygienist. Once you have selected your dentist and hygienist, click the schedule button and your appointment is made!
              <h3>Viewing your appointments:</h3>
            To view all of your currently scheduled appointments click on the "View Appointments" tab in the navigation bar. This will bring up a list
            of all of your appointments including information on time, appointment type, and staff assigned to your appointment.
              <h3>Canceling an Appointment:</h3>
            To cancel an appointment please <a href="contact.php" target="_self">contact us</a>.
            <br><br>
            </p>
          </td>
        </tr>
        <tr>
          <td colspan="2" valign="top"><p>&nbsp;</p>
            <p></p><hr><p></p>
            <p style="text-align:center;">
              Here at MAD Dental we strive for excellence and complete customer satisfaction. If ever we don't meet your
              expectations, please feel free to <a href="contact.php" target="_self">contact us</a> for prompt assistance.
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
