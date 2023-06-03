@extends('layouts.app')
@section('header')
<div class="col">
    <div class="mb-1">
        <ol class="breadcrumb" aria-label="breadcrumbs">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Filtre avancé</a></li>
        </ol>
    </div>
    <h2 class="page-title">
        <span class="text-truncate">Filtre avancée</span>
    </h2>
</div>
@endsection
@section('content')
@livewire('advandced-search')
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/litepicker/2.0.12/js/main.min.js"
    integrity="sha512-2ZCMKBFziFWe/FnKORBGFo77WCMedx3B37yFyj0trigxShzXLMSgOFR8epX48rkRK8aenlJ45pKrzBrnRhBvJw=="
    crossorigin="anonymous" referrerpolicy="no-referrer">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/litepicker/2.0.12/litepicker.js"
    integrity="sha512-ZbnsrTCJAJWynwgi3ndt7jcjwrJfHNzUh/mZakBRhZG8lYgMVtZLxY2CG4GuONoER9E8iiuupt4fnrNfXy+aGA=="
    crossorigin="anonymous" referrerpolicy="no-referrer">
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
    window.Litepicker &&
        new Litepicker({
            element: document.getElementById("datepicker"),
            buttonText: {
                previousMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>`,
                nextMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>`,
            },
            singleMode: true,
        });
});

</script>
@endsection