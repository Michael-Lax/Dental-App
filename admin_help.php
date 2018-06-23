<?php
/*Author: Michael Pearson
  Use: User manual for the admin user
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
          <li><a href="javascript:history.back()"><span class="glyphicon glyphicon-home"></span>Home</a></li>
          <li class='active'><a href="admin_help.php">User Manual</a></li>
        </ul>
      </div><!--/.nav-collapse -->
    </div>
  </nav>

  <div class="container">
    <h2 style="text-align: center"><u>Administrator Manual</u></h2>
    <div class="table-responsive">
    <table class="table">
      <tbody>
        <tr>
          <td>
            <p>
              <h3>Creating New Users:</h3>
            To create a new user simply click on the "Add Accounts" tab in the navigation bar, fill out the form, and click submit. The new user is then
            ready to start using their new account!
              <h3>Adding/Deleting an Appointment:</h3>
            To add an appointment, click on an open time slot in the default calendar view. You will then be prompted to assign a Dentist, Hygienist, and
            Patient to the appointment. Once you have filled out the form, click submit and the appointment is scheduled! To delete an appointment,
            click on the calendar event and click the delete button.
              <h3>Deleting a user:</h3>
            To delete a user go to the "Phone Book" tab in the navigation bar, hit the delete button on the top of the page, select a user ID to delete
            and click delete confirm the deletion.
              <h3>Giving Staff Time Off:</h3>
            To give staff time off, click on the "Time Off" tab in the navigation bar, choose a staff member, select the time they won't be working, and
            click submit.
            </p>
          </td>
        </tr>
        <tr>
          <td colspan="2" valign="top"><p>&nbsp;</p>
            <p></p><hr><p></p>
            <p style="text-align:center;">
              Here at MAD Dental we strive for excellence and complete customer satisfaction. If ever we don't meet your
              expectations, please feel free to <a href="db/contactAdmin.php" target="_self">contact us</a> for prompt assistance.
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
