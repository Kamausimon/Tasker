@extends('task.index')

@section('content')
<div class="container mx-auto p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-4">Projects and Tasks Calendar</h2>
    <!-- Embed JSON data into a hidden div using data-* attributes -->
    <div id="calendar" data-projects="{{ json_encode($projects) }}" data-tasks="{{ json_encode($tasks) }}"></div>
</div>

<!-- Include FullCalendar and Dependencies -->
<link href='https://cdn.jsdelivr.net/npm/@fullcalendar/core/main.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/core/main.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid/main.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/interaction/main.min.js'></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Verify that the calendar element exists
        var calendarEl = document.getElementById('calendar');
        if (!calendarEl) {
            console.error('Calendar element not found!');
            return;
        }

        // Retrieve JSON data from data-* attributes
        var projectsData = calendarEl.getAttribute('data-projects');
        var tasksData = calendarEl.getAttribute('data-tasks');

        // Check if data is correctly passed
        if (!projectsData || !tasksData) {
            console.error('Projects or tasks data not found!');
            return;
        }

        // Parse JSON data
        var projects = JSON.parse(projectsData);
        var tasks = JSON.parse(tasksData);

        // Prepare events array
        var events = [];

        // Add projects to events
        projects.forEach(function(project) {
            events.push({
                title: project.name,
                start: project.start_date,
                end: project.end_date ? project.end_date : project.start_date,
                color: '#1E40AF' // Color for projects
            });
        });

        // Add tasks to events
        tasks.forEach(function(task) {
            events.push({
                title: task.title,
                start: task.due_at,
                color: '#F59E0B' // Color for tasks
            });
        });

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
    });
</script>
@endsection
