<?php
  /* Author: David Doll

  All users are allowed access to this page, but if a user is logged in,
  keep their session going and establish connection with database*/
  session_start();
  include("../includes/databaseHandler.inc.php");
?>

<!doctype html>
<html lang = "en">
  <!--included technologies on this page and css files-->
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content = "IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="../fullcalendar/lib/jquery.min.js"></script>
    <script src='../fullcalendar/lib/jquery-ui.min.js'></script>
    <script src="../js/bootstrap.min.js"></script>
    <link rel="stylesheet" href='../fullcalendar/lib/cupertino/jquery-ui.min.css'/>
    <link href = "../Styles/style.css" rel= "stylesheet"  />
    <link href="https://bootswatch.com/superhero/bootstrap.min.css" rel="stylesheet" />
    <link rel="shortcut icon" href="../css/favicon.ico" type= "image/x-icon"/>
    <title>Contact an Admin</title>
  </head>

  <body style="padding-top: 65px">
    <!--Navigation bar that is at the top of every page, so the user's can get back to the pages they originally came from-->
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
            <li class="active"><a href="contactAdmin.php">Contact Us</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container">
      <h2 style="text-align: center"><u>Contact an Admin</u></h2>
        <div class="table-responsive">
        <?php

          // Select the information from the table of user's in the database to display
          $sql = "SELECT firstname, lastname, email FROM user WHERE user_key = 0";
          $result = mysqli_query($conn, $sql);

          //print out a table of all the user data that was retrieved from the database
          echo '<table class="table table-striped">
           <thead>
              <tr>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>E-Mail</th>
              </tr>
            </thead>';

            // output the data from each row entry of user data queried from the database
            while($row = mysqli_fetch_assoc($result)) {
               echo "<tr><td>" . $row["firstname"]. "</td><td>" . $row["lastname"]. "</td><td>" . $row["email"]. "</td></tr>";
            }
            echo "</table>";
          mysqli_close($conn);
        ?>
      </div>
    </div>
  </body>
