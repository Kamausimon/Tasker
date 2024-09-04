@extends('task.index')

@section('content')
<div class="container mx-auto p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-4">Projects and Tasks Calendar</h2>
    <div id="calendar"></div>
</div>

<!-- Include FullCalendar and Dependencies -->
<link href='https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.6/main.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.6/main.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.6/main.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@6.1.6/main.min.js'></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            selectable: true,
            events: [
                @foreach($projects as $project) {
                    title: '{{ $project->name ',
                    start: '{{ $project->start_date->format('
                    Y - m - d ') }}',
                    end: '{{ $project->end_date ? $project->end_date->format('
                    Y - m - d ') : $project->start_date->format('
                    Y - m - d ') }}',
                    color: '#1E40AF', // Customize the color for projects
                },
                @endforeach

                @foreach($tasks as $task) {
                    title: '{{ $task->title }}',
                    start: '{{ $task->due_at->format('
                    Y - m - d ') }}',
                    color: '#F59E0B', // Customize the color for tasks
                },
                @endforeach
            ],
        });

        calendar.render();
    });
</script>
@endsection
