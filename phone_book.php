<?php
  session_start();
  include("includes/databaseHandler.inc.php");

  if(empty($_SESSION['user'])){
    $_SESSION['errormsg'] = "Please login first!";
    header("Location: index.php");
  }
?>

<!doctype html>
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
    <link href = "Styles/style.css" rel= "stylesheet"  />
    <link href="https://bootswatch.com/superhero/bootstrap.min.css" rel="stylesheet" />
    <link rel="shortcut icon" href="css/favicon.ico" type= "image/x-icon"/>
    <title>Phone Book</title>
    <script>
      $(document).ready(function() {

        //Brings up delete modal
        $('#delButton').on('click', function(e) {
          e.preventDefault();
          $('#deleteModal').modal("show");
        });

        //Delete button deletes selected user from database
        $('#deleteButton').on('click', function(e) {
          e.preventDefault();
          $('#deleteModal').modal('hide');
          var vals = $('#userID').val().split(" UserKey: ");
          var userID = vals[0];
          var userKey = vals[1];
          $.ajax({
              url: '/dentist/db/deleteUser.php',
              data: '&id=' + userID + '&userKey=' + userKey,
              type: "POST",
              success: function(json) {
                location.reload();
              }
          });
          //location.reload();
        });
      });
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
          <a class="navbar-brand" href="admin_home.php">MAD Dental</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="javascript:history.back()"><span class="glyphicon glyphicon-home"></span>Home</a></li>
            <li class="active"><a href="phone_book.php">Phone Book</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">
      <h2 style="text-align: center"><u>Phone Book</u></h2>
        <div class="table-responsive">
        <?php
          $id = $_SESSION['uid'];
          /* Show phone book */
          $sql = "SELECT uid, user_key, firstname, lastname, email, phone, address FROM user WHERE uid != '$id'";
          $result = mysqli_query($conn, $sql);

          if($_SESSION['user_key'] == 0){
             echo '<div style="text-align: center"><button id="delButton" type="submit" class="btn btn-danger">Delete</button></div>';
          }

          echo '<table class="table table-striped">
           <thead>
              <tr>
                <th>User ID</th>
                <th>User Type</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>E-Mail</th>
                <th>Phone Number</th>
                <th>Address</th>
              </tr>
            </thead>';
          if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
              echo "<tr><td>" . $row["uid"] . "</td>";
               if ($row["user_key"] == 0) {
                 echo "<td>Admin</td>";
               } elseif ($row["user_key"] == 1) {
                 echo "<td>Patient</td>";
               } elseif ($row["user_key"] == 2) {
                 echo "<td>Dentist</td>";
               } elseif($row["user_key"] == 3){
                 echo "<td>Hygienist</td>";
               }
               echo "<td>" . $row["firstname"]. "</td><td>" . $row["lastname"]. "</td><td>" . $row["email"]. "</td><td>" . $row["phone"]. "</td><td>" . $row["address"]. "</td></tr>";
            }
            echo "</table>";
          } else {
            echo "No users currently in database.";
          }
          //mysqli_close($conn);
        ?>
      </div>
    </div>

    <div id="deleteModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">×</button>
            <h3 id="myModalLabel">Choose a user ID to delete</h3>
          </div>
          <div class="modal-body">
            <form class = "form-group" id = "chooseDelete">
              <span>User ID: </span>
              <select class="form-control" id="userID" name="User ID" required>
                <?php
                  $sql = "SELECT uid, user_key FROM user WHERE uid != '$id'";
                  $result = mysqli_query($conn, $sql);
                  while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option>" . $row['uid'] . " UserKey: ". $row['user_key'] ."</option>";
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
  </body>
</html>
