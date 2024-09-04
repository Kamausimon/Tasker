@extends('task.index')

@section('content')
<div id="calendar" data-events='@json($events)'></div>
@endsection

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.min.css" />
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        // Retrieve the events data from the data attribute
        var eventsData = calendarEl.getAttribute('data-events');
        console.log('Events Data:', eventsData); // Log the events data

        try {
            var events = JSON.parse(eventsData);
            console.log('Parsed Events:', events); // Log parsed events to verify structure

            // Initialize FullCalendar
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                selectable: true,
                events: events,
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
            });

            calendar.render();
            console.log('Calendar Initialized'); // Log calendar initialization
        } catch (error) {
            console.error('Error parsing events data:', error); // Log any JSON parsing errors
        }
    });
</script>
@endsection
