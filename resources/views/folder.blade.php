@extends('layouts.app')
@section('header')
<div class="col">
    <div class="mb-1">
        <ol class="breadcrumb" aria-label="breadcrumbs">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Document</a></li>
        </ol>
    </div>
    <h2 class="page-title">
        <span class="text-truncate">Liste des documents</span>
    </h2>
</div>
@endsection
@section('content')
<div class="row py-2">
    @foreach ($rows->documents as $row)
    <div class="col-md-3">
        <x-card-document :row="$row" />
    </div>
    @endforeach
</div>
@endsection
