<?php
include'hello.php';
// Establish a database connection
$host = 'localhost';
$mySQLusername = 'ty';
$mySQLpassword = '123';
$database = 'csaduersdatabase';

$conn = new mysqli($host, $mySQLusername, $mySQLpassword, $database);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

$fetch_event = "SELECT * FROM tbl_event";
$eventResult = $conn->query($fetch_event);

$events = [];
while ($row = $eventResult->fetch_assoc()) {
    $events[] = [
        'title' => $row['title'],
        'start' => $row['start_date'],
        'end' => $row['end_date'],
        'color' => 'yellow', // Example color
        'textColor' => 'black', // Example text color
    ];
}
?>

<html>
<head>
    <title>Fullcalendar</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <link href="stylessss.css" rel="stylesheet" type="text/css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
</head>
<style>
    body{
        background-color: #f8f8f8;
    }

</style>
<body>
    <h2><center>Calendar</center></h2>
    <div class="container">
        <div id="calendar"></div>
    </div>
    <br>
</body>
</html>
<script>
    $(document).ready(function() {
        $('#calendar').fullCalendar({
            events: <?php echo json_encode($events); ?>
        });
    });
</script>

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Create Event</h4>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>