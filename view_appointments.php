<?php
/*  Author: Michael Pearson
    Page to view appointments for a patient
*/
  session_start();
  include("includes/databaseHandler.inc.php");

  if(empty($_SESSION['user'])){
    $_SESSION['errormsg'] = "Please login first!";
    header("Location: index.php");
  }

  if($_SESSION['user_key'] == 2){
    header("Location: dentist_home.php");
  }elseif($_SESSION['user_key'] == 0){
    header("Location: admin_home.php");
  }
?>

<!DOCTYPE html>
<html lang = "en">
  <head>
    <!--For bootstrap-->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content = "IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="fullcalendar/lib/jquery.min.js"></script>
    <script src='fullcalendar/lib/jquery-ui.min.js'></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href='fullcalendar/lib/cupertino/jquery-ui.min.css'/>
    <link href = "Styles/style.css" rel= "stylesheet"/>
    <link href="https://bootswatch.com/superhero/bootstrap.min.css" rel="stylesheet" />
    <link rel="shortcut icon" href="css/favicon.ico" type= "image/x-icon"/>
    <title>Your Appointments</title>
    <script>
    // If allowing user to delete
      /*$(document).ready(function() {

        //Show delete modal on click
        $('#delButton').on('click', function(e) {
          e.preventDefault();
          $('#deleteModal').modal("show");
        });

        //Delete event from database and refresh on click
        $('#deleteButton').on('click', function(e) {
          e.preventDefault();
          var aptID = $('#apptID').val();
          $('#deleteModal').modal('hide');
          $.ajax({
              url: '/dentist/db/deleteEvent.php',
              data: 'id='+aptID,
              type: "POST",
              success: function(json) {
                location.reload();
              }
          });
        });
      });
      */
    </script>
  </head>

  <body style="padding-top: 65px">

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="user_home.php">MAD Dental</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="user_home.php"><span class="glyphicon glyphicon-home"></span>Patient Home</a></li>
            <li class="active"><a href="view_appointments.php">View Appointments</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">
      <h2 style="text-align: center"><u>Appointments</u></h2>
        <div class="table-responsive">
        <?php
          $name = $_SESSION['user'];

          $sql = "SELECT id, description, title, start, endT, dentist, hyg FROM patappts WHERE title = '" . $name . "'";
          $result = mysqli_query($conn, $sql);

          if (mysqli_num_rows($result) > 0) {
              // output data of each row
              echo '<table class="table table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Appointment Type</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Dentist</th>
                    <th>Hygienist</th>
                  </tr>
                </thead>';

              while($row = mysqli_fetch_assoc($result)) {
                echo "<tr><td>" . $row['id'] . "</td><td>" . $row['title'] . "</td><td>" . $row['description'] .  "</td><td>" . $row['start'] . "</td><td>" . $row['endT'] . "</td><td>" . $row['dentist'] . "</td><td>"
                . $row['hyg'] . "</td></tr>";
              }
              echo "</table>";
            } else {
              echo '<h1 style="text-align: center">No appointments scheduled</h1>';
            }
        ?>
        </div>
      </div>

      <!--Modal to delete events if allowing delete
      <div id="deleteModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">×</button>
              <h3 id="myModalLabel">Choose an appointment</h3>
            </div>
            <div class="modal-body">
              <form class = "form-group" method = "POST" action = "/dentist/db/deleteEvent" id = "chooseDelete">
                <span>Appointment ID: </span>
                <select class="form-control" id="apptID" name="Appointment ID" required>
                  <//?php
                    $sql = "SELECT id, title, start, endT FROM patappts WHERE title = '" . $_SESSION['user'] . "'";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                      echo "<option>" . $row['id'] . "</option>";
                    }
                  ?>
                </select>
              </form>
            </div>
            <div class="modal-footer">
              <button class="btn" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-danger" id="deleteButton">Delete</button>
            </div>
          </div>
        </div>
      </div>
      -->
    </body>
  </html>
