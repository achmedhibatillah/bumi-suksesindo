<link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/main.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.js'></script>

<style>
    #calendar {
      width: 100%;
      height: 80vh;
      max-width: 1200px;
      margin: 0 auto;
    }

    .fc-daygrid-day a {
      text-decoration: none;
    }

    .fc-daygrid-day-number {
      color: black;
    }

    .fc-daygrid-day-top {
      color: black;
    }

    /* CSS untuk mengubah warna background event */
    .event-rapat {
      background-color: red; 
      color: white; 
    }

    .event-outing {
      background-color: blue; 
      color: white; 
    }
</style>

<div class="w-100">
    <div id='calendar'></div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: [
        @foreach($kalender as $x)
          {
            title: {!!'\'' . $x['kalender_kegiatan'] . '\''!!},
            start: {!!'\'' . $x['kalender_tgl'] . '\''!!},
            className: {!!'\'' . $x['kalender_style'] . '\''!!}
          },
        @endforeach
        ]
    });

    calendar.render();
    });
</script>
