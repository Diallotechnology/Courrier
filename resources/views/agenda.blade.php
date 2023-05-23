@extends('layouts.app')
@section('content')
<div id="calendar"></div>
@endsection
@push('scripts')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.7/index.global.min.js'></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'timeGridWeek',
            timeZone: 'UTC',
            locale: 'fr',
            slotMinTime: '8:00:00',
            slotMaxTime: '19:00:00',
            events: @json($events),
            buttonText:{
            today:    "Aujourd'hui",
            month:    'Mois',
            week:     'Semaine',
            day:      'Jour',
            list:     'liste'
        },

        });
        calendar.render();
    });
</script>
@endpush