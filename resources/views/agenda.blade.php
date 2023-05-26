@extends('layouts.app')
@section('header')
<div class="col">
    <div class="mb-1">
        <ol class="breadcrumb" aria-label="breadcrumbs">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Agenda</a></li>
        </ol>
    </div>
    <h2 class="page-title">
        <span class="text-truncate">Liste des agandas</span>
    </h2>
</div>
<div class="col-auto">
    <div class="btn-list">
        <x-button-modal />
    </div>
</div>
@endsection
@section('content')
<div id="calendar"></div>
<x-modal title="nouveau évènement">
    <x-form route="{{ route('task.store') }}">
        <input type="hidden" name="type" value="event">
        <div class="col-md-12">
            <x-input type="text" name="nom" place="le nom de l'évènement" />
        </div>
        <div class="col-md-6">
            <x-input type="datetime-local" name="debut" label="Debut de l'évènement" />
        </div>
        <div class="col-md-6">
            <x-input type="datetime-local" name="fin" label="Fin de l'évènement" />
        </div>
        <x-textarea place="Fait une description de l'évènement" name="description" label="description de l'évènement" />
    </x-form>
</x-modal>
@endsection
@section('scripts')
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
@endsection