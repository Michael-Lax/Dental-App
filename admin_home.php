<?php
/* Author: David Doll
Home page for admins
*/
session_start();
include("includes/databaseHandler.inc.php");

if(empty($_SESSION['user'])){
  $_SESSION['errormsg'] = "Please login first!";
  header("Location: index.php");
  exit();
}

if($_SESSION['user_key'] == 1){
  header("Location: user_home.php");
  exit();
}elseif($_SESSION['user_key'] == 2 || $_SESSION['user_key'] == 3){
  header("Location: dentist_home.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang = "en">
<head>
  <!--For bootstrap-->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content = "IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!--For fullcalendar-->
  <link rel='stylesheet' href='fullcalendar/fullcalendar.css' />
  <link rel="stylesheet" href="fullcalendar/scheduler/scheduler.min.css" />

  <script src='fullcalendar/lib/jquery.min.js'></script>
  <link rel="stylesheet" href='fullcalendar/lib/cupertino/jquery-ui.min.css'/>
  <script src='fullcalendar/lib/moment.min.js'></script>
  <script src='fullcalendar/fullcalendar.js'></script>
  <script src='fullcalendar/scheduler/scheduler.min.js'></script>
  <link type='text/css' rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/qtip2/3.0.3/basic/jquery.qtip.css" />
  <script type='text/javascript' src ="https://cdnjs.cloudflare.com/ajax/libs/qtip2/3.0.3/basic/jquery.qtip.min.js"></script>
  <!--For boostrap-->
  <link href = "Styles/style.css" rel= "stylesheet"/>
  <link href="https://bootswatch.com/superhero/bootstrap.min.css" rel="stylesheet" />
  <link rel="shortcut icon" href="css/favicon.ico" type="image/x-icon"/>
  <title>Admin Home</title>
  <script>
  $(document).ready(function() {
    $('#addEventModal').on('hidden.bs.modal', function () {
      $(this).find("input, text, textarea").val('').end();

    });
    MINUTES_FOR_SLOT = 60;
    var calendar = $('#calendar').fullCalendar({
      schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
      header:{
        left:'promptResource, prev, next, today',
        center:'title',
        right: 'month, agendaDay'
      },
      views: {
        month:{
          selectable: false
        }
      },
      slotMinutes: MINUTES_FOR_SLOT,
      //height: 1000,
      businessHours: {
        dow: [1, 2, 3, 4, 5],
        start: "09:00",
        end: "17:00",
      },
      events: "db/eventGetScript.php",
      eventRender: function(event, element) {
        element.append(
          "Patient: " + event.title + "<br />" +
          "Appt. Type: " + event.description + "<br />" +
          "Dentist: " + event.dentist + "<br />" +
          "Hygienist: " + event.hyg + "<br />" +
          "<span style='display:none;' id='patId'>" + event.pid + "</span>" +
          "<span style='display:none;' id='hygId'>" + event.hid + "</span>" +
          "<span style='display:none;' id='dentId'>" + event.did + "</span>"
        );
      },
      eventConstraint: {
        start: $.fullCalendar.moment(),
        end: $.fullCalendar.moment().startOf('month').add(6, 'month')
      },
      resources: "db/resourceGetScript.php",
      defaultView: "agendaDay",
      weekends: false,
      slotDuration: "01:00:00",
      allDaySlot: false,
      selectable: true,
      dragScroll: false,
      //contentHeight: 500,
      selectConstraint: {
        start: $.fullCalendar.moment(),
        end: $.fullCalendar.moment().startOf('month').add(6, 'month')
      },
      theme: true,
      eventOverlap: false,
      selectOverlap: false,
      eventStartEditable: false,
      //slotWidth: 100,
      minTime: "09:00:00",
      maxTime: "17:00:00",
      eventDurationEditable: false,
      resourceLabelText: 'Dentists/Hygienists',
      select: function(start, end, event, view, resource) {
        var dispStart = moment(start).format('MM-DD-YYYY hh:mm:ss A');
        var dispEnd = moment(end).format('MM-DD-YYYY hh:mm:ss A');
        $('#Time').text("Time: From " + dispStart + " to " + dispEnd);
        var st = start.format("YYYY-MM-DD kk:mm:ss");
        $('#patient').empty();
        $('#hygienist').empty();
        $('#dentist').empty();
        $.post('db/popPatientList.php', {startTime: st}, function(data) {
          $.each(data, function(index) {
            if(data != null){
              $('#patient').append('<option value = "' + data[index].pid + '">' + data[index].name + '</option>')
            }
          });
        });
        $.post('db/popDentList.php', {startTime: st}, function(data) {
          $.each(data, function(index) {
            if(data != null){
              $('#dentist').append('<option value = "' + data[index].dentid  + '">' + data[index].name +'</option>');
            }
          });
        });
        $.post('db/popHygList.php', {startTime: st}, function(data) {
          $.each(data, function(index) {
            if(data[index].name != null){
              $('#hygienist').append('<option value="'+ data[index].hid +'">' + data[index].name + '</option>');
            }
          });
        });
        var en = end.format("YYYY-MM-DD kk:mm:ss");
        var calDate = calendar.fullCalendar("getDate");
        calDate = moment(calDate).format("YYYY-MM-DD kk:mm:ss");
        var diffMinutes = end.diff(start, 'minutes');
        if(diffMinutes > MINUTES_FOR_SLOT) {
          $("#selectWarnModal").modal("show");
          return false;
        }
        $("#addEventModal").modal('show');
        $("#apptSubmit").on('click', function(e) {
          $("#apptSubmit").attr("disabled", true);
          e.preventDefault();
          e.stopImmediatePropagation();
          var description = $('#apptType').find(":selected").text();
          var patId = $('#patient').find(":selected").val();
          var patName = $('#patient').find(":selected").text();
          var dentId = $('#dentist').find(":selected").val();
          var dentName = $('#dentist').find(":selected").text();
          var hygId = $('#hygienist').find(":selected").val();
          var hygName = $('#hygienist').find(":selected").text();
          if(patName == null || dentName == null || hygName == null){
            $('#apptSubmit').attr('disabled', false);
            $('#apptSubmit').off();
            $('#addEventError').load('html/addStaffApptError.html');
            return false;
          }
          var formData = ({'apptType': description, 'title': patName, 'dentist': dentName, 'hyg': hygName, 'start': st, 'end': en, 'resourceId': resource.id, 'did': dentId, 'hid': hygId, 'pid': patId});
          console.log(formData);
          $.ajax({
            url: 'db/createAppt.php',
            type: 'POST',
            data: formData,
            success: function(data){
              $('#apptSubmit').off();
              $('#addEventModal').modal('hide');
              $('#apptSubmit').attr('disabled', false);
              calendar.fullCalendar('refetchEvents');
            }
          });

        });
      },
      eventClick: function(calEvent, jsEvent, view){
        var start = moment(calEvent.start).format('YYYY-MM-DD kk:mm:ss');
        var end = moment(calEvent.end).format('YYYY-MM-DD kk:mm:ss');
        var curDate = moment().format('YYYY-MM-DD kk:mm:ss');
        $('#selectEventFunctModal').modal('show');
        $('#deleteApptBut').on('click', function() {
          if(start <= curDate){
            $('#selectEventFunctModal').modal('hide');
            $('#deleteApptBut').off();
            $('#staffSignError').load("deleteError.html");
            return false;
          }else{
            $('#selectEventFunctModal').modal('hide');
            $('#deleteApptModal').modal('show');
            var name = $("#userName").text().substring(8);
            var showStart = moment(calEvent.start).format('MM-DD-YYYY hh:mm A');
            var showEnd = moment(calEvent.end).format('MM-DD-YYYY hh:mm A');
            var mytime = showStart + ' – ' + showEnd;
            $('#modalTitle').html(calEvent.title);
            $('#modalTime').text(mytime);
            var formData = ({'pid': calEvent.pid, 'hid': calEvent.hid, 'did': calEvent.did, 'start': start, 'end': end});
            $('#deleteButton').on('click', function () {
              $.ajax({
                url: 'db/deleteEvent.php',
                type: 'POST',
                data: formData,
                success: function(){
                  $('#deleteButton').off();
                  $('#deleteApptModal').modal('hide');
                  $('#deleteApptBut').off();
                  calendar.fullCalendar('refetchEvents');
                }
              });
            });
          }
        });
        $('#schedDentistsBut').on('click', function() {
          if(start <= curDate){
            $('#selectEventFunctModal').modal('hide');
            $('#schedDentistsBut').off();
            $('#staffSignError').load("staffError.html");
            return false;
          }
          $('#schedDentistsBut').attr('disabled', true);
          var prevDent = $('option.dentMessage').text();
          var prevHyg = $('option.hygMessage').text();
          var beginHyg = calEvent.hyg;
          var beginDent = calEvent.dentist;
          $('#dentists').empty();
          $('#hygienists').empty();
          $('#dentists').append('<option class = "dentMessage" value = "' + prevDent + '">Do not change the scheduled dentist</option>');
          $('#hygienists').append('<option class = "hygMessage" value = "' + prevHyg + '">Do not change the scheduled hygienist</option>')
          $.post('db/popDentList.php', {startTime: start}, function(data) {
            $.each(data, function(index) {
              if(data != null){
                $('#dentists').append('<option value = "' + data[index].dentid + '">' + data[index].name + '</option>');
              }
            });
          });
          $.post('db/popHygList.php', {startTime: start}, function(data) {
            $.each(data, function(index) {
              if(data[index].name != null){
                $('#hygienists').append('<option value="'+ data[index].hid +'">'  + data[index].name + '</option>');
              }
            });
          });
          $('#selectEventFunctModal').modal('hide');
          $('#schedDentistsBut').off();
          $('#schedDentistsBut').attr('disabled', false);
          $('#staffSignUp').modal('show');
          $('#staffSubmit').on('click', function(e) {
            $('#staffSubmit').attr('disabled', true);
            e.preventDefault();
            $('#staffSubmit').attr('disabled', true);
            var dent = $('#dentists').find(":selected").text();
            var hyg = $('#hygienists').find(":selected").text();
            var dentId = $('#dentists').find(":selected").val();
            var hygId = $('#hygienists').find(":selected").val();
            var formData = ({'id': calEvent.id, 'dent': dent, 'hyg': hyg, 'hid': calEvent.hid, 'did': calEvent.did, 'start': start, 'end': end, 'newHid': hygId, 'newDid': dentId});
            $.ajax({
              url: 'db/schedNewStaff.php',
              type: 'POST',
              data: formData,
              success: function(){
                $('#staffSubmit').attr('disabled', false);
                $('#staffSignUp').modal('hide');
                $('#staffSubmit').off();
                calendar.fullCalendar('refetchEvents');
              }
            });
          });
        });
      },
    })
  });
  </script>
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
        <a class="navbar-brand">MAD Dental</a>
      </div>
      <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
          <li class="active"><a href="admin_home.php"><span class="glyphicon glyphicon-home"></span>Home</a></li>
          <li><a href="logout.php">Logout</a></li>
          <li><a href="admin/add_account.php">Add Accounts</a></li>
          <li><a href="phone_book.php">Phone Book</a></li>
          <li><a href="admin/view_all_appointments.php">View Appointments</a></li>
          <li><a href="admin/timeOff.php">Time Off</a></li>
          <li><a href="admin_help.php">User Manual</a></li>
        </ul>
      </div><!--/.nav-collapse -->
    </div>
  </nav>

  <div class="container">
    <div class="starter-template">
      <h1 id = "userName"><?php echo "Welcome " . $_SESSION['user'];?> </h1>
    </div>
  </div><!-- /.container -->



  <div>
    <div id = "calendar"></div>
  </div>

  <div id="addEventModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Sign Up For Appointment</h4>
          <div id = "addEventError" >

          </div>
        </div>
        <div class="modal-body">
          <form id="addAppt" class='form-signin'>
            <span>Patient: </span>
            <select class='form-control' id='patient' name="patient" required>
            </select>
            <span>Appointment Type: </span>
            <select class='form-control' id='apptType' name='apptType' required>
              <option value="Cleaning">Cleaning</option>
              <option value="Root Canal">Root Canal</option>
              <option value="Extraction">Extraction</option>
              <option value="Filling">Filling</option>
            </select>

            <span>Dentists: </span>
            <select class="form-control" id="dentist" name="Dentist" required>
            </select>
            <span>Hygienists: </span>
            <select class="form-control" id="hygienist" name="Hygienist" required>
            </select>
          </form>
          <h5 id ='Time' style="text-align: center;"></h5>
        </div>
        <div class="modal-footer">
          <button id="apptSubmit" type="submit" class="btn btn-primary">Add</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>

  <div id="selectWarnModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="warnSign"><span class="glyphicon glyphicon-alert" ></span></h4>
        </div>
        <div class="modal-body">
          <p>Please select one time slot only</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>

  <div id="selectEventFunctModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-center: true">Would you like to Delete or <br />schedule a dentist/hygienist</h4>
        </div>
        <div class="modal-body">
          <button id="deleteApptBut" type="button" class = "btn btn-danger">Delete Appointment</button><br /><br />
          <button id="schedDentistsBut" type="button" class = "btn btn-primary">Schedule New Dentist/Hygienist</button>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <div id="staffSignUp" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="warnSign">Select a Doctor/Hygienist to assign to a room for the day</h4>
        </div>
        <div class="modal-body">
          <form class = "form-group" id = "stSignUp">
            <select class="form-control form-signin" id="dentists" name="Dentist" required>
              <option class = "dentMessage" value = "1" id = "noChangeDent">Do not change the scheduled dentist</option>
            </select>
            <select class="form-control form-signin" id="hygienists" name="Hygienist" required>
              <option class = "hygMessage" value = "1" id = "noChangeHyg">Do not change the scheudled hygienist</option>
            </select>
          </form>
          <div class="modal-footer">
            <button id="staffSubmit" type="submit" class="btn btn-primary">Sign Up</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div id="deleteApptModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h3 id="myModalLabel">Appointment Details</h3>
        </div>
        <div class="modal-body">
          <h4 id="modalTitle" class="modal-title"></h4>
          <div id="modalTime" style="margin-top:5px;"></div>
        </div>
        <input type="hidden" id="eventID"/>
        <div class="modal-footer">
          <button class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger" id="deleteButton">Delete</button>
        </div>
      </div>
    </div>
  </div>

  <script src="js/bootstrap.min.js"></script>
</body>

</html>
