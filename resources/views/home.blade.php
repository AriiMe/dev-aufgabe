
<!DOCTYPE html>
<html>
<head>
    <title>Employee Leave Management</title>
    <link href='fullcalendar/main.css' rel='stylesheet' />
    <script src="{{ asset('js/app.js') }}" type="module"></script>
    <!-- FullCalendar's core CSS -->
<link href="https://unpkg.com/fullcalendar@5/main.min.css" rel="stylesheet" />

<!-- FullCalendar's core JS -->
<script src="https://unpkg.com/fullcalendar@5/main.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<!-- retrieving csrf token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>
    <div id='calendar'></div>
    <!-- <script>
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: @json($events)
        });
        calendar.render();
    </script> -->

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        var calendarEl = document.getElementById("calendar");
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: {!! $events !!},
            selectable: true,
            select: function(info) {

            }
        });
        calendar.render();
    });
</script>
</body>
</html>
