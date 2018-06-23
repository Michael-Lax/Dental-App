<?php
  /*Author: David Doll
    Use: In order to add accounts into the database from the admin page. Only admins should
    have access to this page.
  */
  //keep the session going, and call databaseHandler to establish connection with database
  session_start();
  include("../includes/databaseHandler.inc.php");

  //if no session has been set for user, no one is logged in, do not allow access to the page.
  if(empty($_SESSION['user'])){
    $_SESSION['errormsg'] = "Please login first!";
    header("Location: ../index.php");
  }

  //if the session user_key == 1, the user is a patient, do not allow access
  //if the session user_key == 2 or 3, the user is a dentist/hygienist, do not allow access
  if($_SESSION['user_key'] == 1){
    header("Location: ../user_home.php");
  }elseif($_SESSION['user_key'] == 2 || $_SESSION['user_key'] == 3){
    header("Location: ../dentist_home.php");
  }
?>
<!doctype html>
<html lang = "en">
  <head>
    <!--Includes for all technologies used (jquery, bootstrap) and css files-->
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
    <title>Add an Account</title>
  </head>

  <body id="addFormBody">->

    <script type="text/javascript">
      $(document).ready(function() {
        //if the user has clicked on a different type of user to add to the database,
        //change the active radio button to the one clicked.
        $("input").on('change', function() {
          $("input").parents().removeClass('active');
          $(this).parents().addClass('active');
        });
    });
    </script>

    <!--navbar on top of each page. In this case, so the admin can go back to the homepage-->
    <div class="container" id="wholeBack">
      <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="../admin_home.php"><span class="glyphicon glyphicon-home"></span>MAD Dental</a>
          </div>
          <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
              <li><a href="../admin_home.php">Admin Home</a></li>
            </ul>
          </div>
        </div>
      </nav>

      <!--Form the admin will fill out to add a new user to the database-->
      <div class="container">
        <form class="form-signin" method = "POST" action = "../add_user.php" id="register-form">
          <h3 class="form-add-heading">Please fill out form to add a new account</h2>

          <label for="inputFirstName" class="sr-only">First Name</label>
          <input type="text" name = "firstname" id="inputFirstName" class="form-control" placeholder="First name" required autofocus>

          <label for="inputLastName" class="sr-only">Last Name</label>
          <input type="text" name ="lastname" id="inputLastName" class="form-control" placeholder="Last name" required>

          <label for="inputEmail" class="sr-only">Email address</label>
          <input type="email" name ="email" id="inputEmail" class="form-control" placeholder="Email address" required>

          <label for="inputPassword" class="sr-only">Password</label>
          <input type="password" name = "pwd" id="inputPassword" class="form-control" placeholder="Password" required>

          <label for="inputPhoneNumber" class="sr-only">Phone Number</label>
          <input type="tel" name = "phone" id="inputPhoneNumber" class="form-control" placeholder="Phone Number" required>

          <label for="inputPassword" class="sr-only">Street Address</label>
          <input type="text" name = "address" id="inputAddress" class="form-control" placeholder="Address" required>

          <label for="inputCity" class="sr-only">City</label>
          <input type="text" name="city" id="inputCity" class="form-control form-inline" placeholder="City" required/>

          <label for="inputState" class="col-xs-2 control-label" style="text-align:left; margin-top:7px">State:</label>
          <div class="col-xs-10">
            <select class="form-control" id="state" name="state" required>
              <option value="">N/A</option>
              <option value="AK">Alaska</option>
              <option value="AL">Alabama</option>
              <option value="AR">Arkansas</option>
              <option value="AZ">Arizona</option>
              <option value="CA">California</option>
              <option value="CO">Colorado</option>
              <option value="CT">Connecticut</option>
              <option value="DC">District of Columbia</option>
              <option value="DE">Delaware</option>
              <option value="FL">Florida</option>
              <option value="GA">Georgia</option>
              <option value="HI">Hawaii</option>
              <option value="IA">Iowa</option>
              <option value="ID">Idaho</option>
              <option value="IL">Illinois</option>
              <option value="IN">Indiana</option>
              <option value="KS">Kansas</option>
              <option value="KY">Kentucky</option>
              <option value="LA">Louisiana</option>
              <option value="MA">Massachusetts</option>
              <option value="MD">Maryland</option>
              <option value="ME">Maine</option>
              <option value="MI">Michigan</option>
              <option value="MN">Minnesota</option>
              <option value="MO">Missouri</option>
              <option value="MS">Mississippi</option>
              <option value="MT">Montana</option>
              <option value="NC">North Carolina</option>
              <option value="ND">North Dakota</option>
              <option value="NE">Nebraska</option>
              <option value="NH">New Hampshire</option>
              <option value="NJ">New Jersey</option>
              <option value="NM">New Mexico</option>
              <option value="NV">Nevada</option>
              <option value="NY">New York</option>
              <option value="OH">Ohio</option>
              <option value="OK">Oklahoma</option>
              <option value="OR">Oregon</option>
              <option value="PA">Pennsylvania</option>
              <option value="PR">Puerto Rico</option>
              <option value="RI">Rhode Island</option>
              <option value="SC">South Carolina</option>
              <option value="SD">South Dakota</option>
              <option value="TN">Tennessee</option>
              <option value="TX">Texas</option>
              <option value="UT">Utah</option>
              <option value="VA">Virginia</option>
              <option value="VT">Vermont</option>
              <option value="WA">Washington</option>
              <option value="WI">Wisconsin</option>
              <option value="WV">West Virginia</option>
              <option value="WY">Wyoming</option>
            </select>
          </div>
          <label for="inputZip" class="sr-only">Zip Code</label>
          <input type="text" name="zip" id="inputZip" class="form-control" placeholder="Zip Code" required/>

          <h3 id="addFormUserKeyHeader">What type of user would you like to add?</h3>
          <div class="btn-group-vertical col-xs-12" data-toggle="buttons" id="addFormRadio">
            <label class="btn btn-primary">
              <input class="col-xs-4" type="radio" name="userkey" id="option1" value=0 required>Admin
            </label>
            <label class="btn btn-primary">
              <input class="col-xs-4" type="radio" name="userkey" id="option2" value=1>Patient
            </label>
            <label class="btn btn-primary">
              <input class="col-xs-4" type="radio" name="userkey" id="option3" value=2>Dentist
            </label>
            <label class="btn btn-primary">
              <input class="col-xs-4" type="radio" name="userkey" id="option4" value=3>Hygienist
            </label>
          </div>
          <button class="btn btn-lg btn-primary btn-block" type="submit" id="submit">Register New Account</button>
        </form>
      </div>

      <?php
        //if the page gets redirected back with the message session set, then an error occured during the database query. Display the error here.
        if(isset($_SESSION['message'])){
          $error = $_SESSION['message'];
          unset($_SESSION['message']);
          echo '<div class="alert alert-warning alert-dismissible" role="alert" id="logError" style="width:600px; margin-left:auto; margin-right:auto;">
            <span type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></span><strong>' . $error . '</strong></div>';
        }else{
          $error = "";
        }
      ?>
  </body>

</html>
