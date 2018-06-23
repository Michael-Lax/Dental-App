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

  <style>
  p.bio {
    padding-left: 50px;
    padding-right: 50px;
  }
  </style>
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
          <li class="active"><a href="about.php">About</a></li>
        </ul>
      </div><!--/.nav-collapse -->
    </div>
  </nav>

  <div id="About">
    <table border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
      <tbody>
        <tr>
          <td height="100" colspan="2">
            <p>
              <font size="+2"><strong>About Us</strong></font>
              <em><strong><br>______________________________</strong></em>
            </p>
          </td>
        </tr>
        <tr>
          <td width="280" valign="top"><div align="left">
            <p class="bio">
            David Doll, Alex Grunwald, and Michael Pearson came together
            to form MAD Dental in 2017 in order streamline the scheduling process for dental offices around the world.<br> All three
            attend the University of Wisconsin - La Crosse and are majoring in Computer Science.
            <br><br>
            </p>
          </div></td>
        </tr>
        <tr>
          <td colspan="2" valign="top">
            <p class="bio"><strong><font size="+1">&emsp;David Doll</font></strong><br>
              Enter bio here!
            </p>
          </td>
        </tr>
        <tr>
          <td colspan="2" valign="top">
            <p class="bio"><strong><font size="+1">&emsp;Alex Grunwald</font></strong><br>
              Enter bio here!
            </p>
          </td>
        </tr>
        <tr>
          <td colspan="2" valign="top">
            <p class="bio"><strong><font size="+1">&emsp;Michael Pearson</font></strong><br>
              Hailing from White Bear Lake, Minnesota, Michael is a current sophomore at UW-L majoring in computer science with a
              minor in mathematics. In his spare time he enjoys playing and watching a variety of sports, mountain biking, cooking,
              and playing the guitar.
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
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  </div>
</body>
</html>
