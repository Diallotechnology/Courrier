@extends('layouts.app')
@section('header')
<div class="col">
    <div class="mb-1">
        <ol class="breadcrumb" aria-label="breadcrumbs">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Courrier arrivé</a></li>
        </ol>
    </div>
    <h2 class="page-title">
        <span class="text-truncate">Liste des courriers arrivés</span>
    </h2>
</div>
@endsection
@section('content')
@livewire('courrier-arriver')
@endsection