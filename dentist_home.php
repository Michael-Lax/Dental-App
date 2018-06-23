<?php
/* Author: David Doll
   Home page for dentists
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
}elseif($_SESSION['user_key'] == 0){
  header("Location: admin_home.php");
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
      height: 1000,
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
      selectable: false,
      dragScroll: false,
      contentHeight: 1000,
      selectConstraint: {
        start: $.fullCalendar.moment(),
        end: $.fullCalendar.moment().startOf('month').add(6, 'month')
      },
      theme: true,
      eventOverlap: false,
      selectOverlap: false,
      eventStartEditable: false,
      slotWidth: 100,
      minTime: "09:00:00",
      maxTime: "17:00:00",
      eventDurationEditable: false,
      resourceLabelText: 'Dentists/Hygienists',
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
                success: function(data){
                  if(data == 'notBelong'){
                    $('errorBox').load('html/dentDeleteError.html')
                  }
                  $('#deleteButton').off();
                  $('#deleteApptModal').modal('hide');
                  $('#deleteApptBut').off();
                  calendar.fullCalendar('refetchEvents');
                }
              });
            });
          }
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
          <li><a href="phone_book.php">Phone Book</a></li>
          <li><a href="dentist_help.php">User Manual</a></li>
          <?php
            if ($_SESSION['user_key'] == 2) {
              echo '<li><a href="view_dentist_appointments.php">View Appointments</a></li>';
            } elseif ($_SESSION['user_key'] == 3) {
              echo '<li><a href="view_hygienist_appointments.php">View Appointments</a></li>';
            }
          ?>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
    <div class="starter-template">
      <h1 id = "userName"><?php echo "Welcome " . $_SESSION['user'];?> </h1>
    </div>
  </div>

  <div class = 'container' id = "errorBox">

  </div>

  <div>
    <div id = "calendar"></div>
  </div>

  <div id="selectWarnModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
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
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-center: true">Would you like to Delete or <br />schedule a dentist/hygienist</h4>
        </div>
        <div class="modal-body">
          <button id="deleteApptBut" type="button" class = "btn btn-danger">Delete Appointment</button><br /><br />
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
