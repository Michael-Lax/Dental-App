<?php
/*Author: David Doll
  Use: To give dentists or hygienists time off from work.
*/
session_start();
include("../includes/databaseHandler.inc.php");

if(empty($_SESSION['user'])){
  $_SESSION['errormsg'] = "Please login first!";
  header("Location: ../index.php");
}

if($_SESSION['user_key'] == 1){
  header("Location: ../user_home.php");
}elseif($_SESSION['user_key'] == 2 || $_SESSION['user_key'] == 3){
  header("Location: ../dentist_home.php");
}
?>
<!doctype html>
<html lang = "en">
<head>
  <!--For bootstrap-->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content = "IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <script src="../fullcalendar/lib/jquery.min.js"></script>
  <script src='../fullcalendar/lib/jquery-ui.min.js'></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/DateTimePicker.js"></script>
  <script src="../fullcalendar/lib/moment.min.js"></script>
  <link rel='stylesheet' href='../css/DateTimePicker.css' />
  <link rel="stylesheet" href='../fullcalendar/lib/cupertino/jquery-ui.min.css'/>
  <link href = "../Styles/style.css" rel= "stylesheet"  />
  <link href="https://bootswatch.com/superhero/bootstrap.min.css" rel="stylesheet" />
  <link rel="shortcut icon" href="../css/favicon.ico" type= "image/x-icon"/>
  <title>Set Staff Vacation</title>
</head>

<body id="addFormBody">

  <script type="text/javascript">
  $(document).ready(function() {
    // Formats date and time
    $('#dtBox').DateTimePicker({
      dateTimeFormat: "yyyy-MM-dd hh:mm AA",
    });

    // Gets hygienist data and adds it to options and displays hygienist time modal
    $('#hyg').on('click', function(){
      $('#hygNames').empty();
      $.post('../db/getHygienists.php', function(data) {
        $.each(data, function(index) {
          if(data != null){
            $('#hygNames').append('<option value = "' + data[index].hid + '">' + data[index].name +'</option>');
          }
        });
      });
      $('#hygTimeModal').modal('show');

      // Submits data from the hygienist time modal
      $('#hygTimeSubmit').on('click', function () {
        $('#hygTimeSubmit').attr('disabled', true);
        var hygId = $('#hygNames').find(":selected").val();
        var name = $('#hygNames').find(":selected").text();
        var startVal = $('#hygStartDate').val();
        var startTime = moment(startVal).format("YYYY-MM-DD kk:mm:ss");
        var endVal = $('#hygEndDate').val();
        var endTime = moment(endVal).format("YYYY-MM-DD kk:mm:ss");

        if(endTime < startTime){
          $('#timeOffError').load('../html/timeOffError.html');
          $('#hygTimeModal').modal('hide');
          $('#hygTimeSubmit').attr('disabled', false);
          return false;
        }
        var formData = ({'name': name, 'start': startTime, 'end': endTime, 'hid': hygId});
        console.log(formData);
        $.ajax({
          url: '../db/setHygTimeOff.php',
          type: 'POST',
          data: formData,
          success: function(data){
            $('#hygTimeSubmit').attr('disabled', false);
            $('#hygTimeSubmit').off();
            $('#hygTimeModal').modal('hide');
          }
        });
      });
    });

    // Gets dentist data and adds it to options and displays dentist time modal
    $('#dent').on('click', function(){
      $('#dentNames').empty();
      $.post('../db/getDentists.php', function(data) {
        $.each(data, function(index) {
          if(data != null){
            $('#dentNames').append('<option value = "' + data[index].did + '">' + data[index].name +'</option>');
          }
        });
      });
      $('#dentTimeModal').modal('show');

      // Submits data from the dentist time modal
      $('#dentTimeSubmit').on('click', function () {
        $('#dentTimeSubmit').attr('disabled', true);
        var dentId = $('#dentNames').find(":selected").val();
        var name = $('#dentNames').find(":selected").text()
        var startVal = $('#dentStartDate').val();
        var startTime = moment(startVal).format("YYYY-MM-DD kk:mm:ss");
        var endVal = $('#dentEndDate').val();
        var endTime = moment(endVal).format("YYYY-MM-DD kk:mm:ss");

        if(endTime < startTime){
          $('#timeOffError').load('../html/timeOffError.html');
          $('#dentTimeModal').modal('hide');
          $('#dentTimeSubmit').attr('disabled', false);
          return false;
        }

        var formData = ({'name': name, 'start': startTime, 'end': endTime, 'did': dentId});
        $.ajax({
          url: '../db/setDentTimeOff.php',
          type: 'POST',
          data: formData,
          success: function(data){
            $('#dentTimeSubmit').attr('disabled', false);
            $('#dentTimeSubmit').off();
            $('#dentTimeModal').modal('hide');
          }
        });
      });

    });


  });
  </script>

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
    <br />
    <br />

    <div class='container'>
      <button type="button" class='btn btn-primary inline-block' id='hyg'>Hygienist Time Off</button>

      <button type="button" class='btn btn-primary inline-block' style="margin-left: 20px;" id='dent'>Dentist Time Off</button>
    </div>
    <br /><br />
    <div id="timeOffError" class='container' style="width: 50%"></div>

    <div id="dtBox"></div>
    <!-- Hygienist Modal -->
    <div id="hygTimeModal" class="modal fade" role="dialog">
      <div class='modal-dialog'>
        <div class='modal-content'>
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Set time off for a hygienist</h3>
            <div id="timeOffError1"></div>
          </div>
          <div class="modal-body">
            <form class ='form-group' id='hygTimeForm'>
              <select class='form-control' id='hygNames' name='dentist' required>

              </select>
              <p>Start Date/Time: </p>
              <input id= 'hygStartDate' type='text' data-field="datetime" readonly />

              <p>End Date/Time: </p>
              <input id='hygEndDate' type='text' data-field="datetime" readonly />
            </form>
          </div>
          <div class="modal-footer">
            <button class="btn btn-primary" id="hygTimeSubmit">Submit</button>
            <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Close</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Dentist Modal -->
    <div id="dentTimeModal" class="modal fade" role="dialog">
      <div id="timeOffError1"></div>
      <div class=modal-dialog>
        <div class='modal-content'>
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Set time off for a dentist</h3>
          </div>
          <div class="modal-body">
            <form class ='form-group' id='hygTimeForm'>
              <select class='form-control' id='dentNames' name='dentist' required>

              </select>
              <p>Start Date/Time: </p>
              <input id= 'dentStartDate' type='text' data-field="datetime" readonly />

              <p>End Date/Time: </p>
              <input id='dentEndDate' type='text' data-field="datetime" readonly />
            </form>
          </div>
          <div class="modal-footer">
            <button class="btn btn-primary" id="dentTimeSubmit">Submit</button>
            <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Close</button>
          </div>
        </div>
      </div>
    </div>

  </body>

  </html>
