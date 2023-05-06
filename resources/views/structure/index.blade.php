@extends('layouts.app')
@section('header')
<div class="col">
    <h2 class="page-title">
        Listes des structures
    </h2>
    <div class="text-muted mt-1">1-18 of 413 people</div>
</div>
<!-- Page title actions -->
<div class="col-auto ms-auto d-print-none">
    <div class="d-flex">
        <input type="search" class="form-control d-inline-block w-9 me-3" placeholder="Search user…" />
        <x-button-modal />
    </div>
</div>
@endsection
@section('content')
<div class="row row-cards">
    @forelse ($rows as $row)
    <div class="col-md-6 col-lg-3">
        <div class="card">
            <div class="card-header">
                <div class="card-actions">
                    <x-button-edit href="{{ route('structure.edit', ['structure' => $row]) }}" />
                    <x-button-show href="{{ route('structure.show', ['structure' => $row]) }}" />
                    <x-button-delete url="{{ url('structure/'.$row->id) }}" />
                </div>
            </div>
            <div class="card-body p-4 text-center">
                <span class="avatar avatar-xl mb-3 rounded"
                    style="background-image: url(./static/avatars/000m.jpg)"></span>
                <h3 class="m-0 mb-1"><a href="#">{{ $row->nom }}</a></h3>
                <div class="text-muted">{{ $row->email }}</div>
                <div class="text-muted">{{ $row->contact }}</div>
                <div class="text-muted">Total departement {{ $row->departements_count }}</div>
            </div>
        </div>
    </div>
    @empty
    <h2 class="text-center">Aucun element</h2>
    @endforelse
</div>
<x-modal title="nouvelle structure">
    <x-form route="{{ route('structure.store') }}">
        <div class="row">
            <div class="col-md-6">
                <x-input type="text" name="nom" place="le nom de la structure" />
            </div>
            <div class="col-md-6">
                <x-input type="text" name="contact" place="le contact de la structure" />
            </div>
        </div>
        <x-input type="email" name="email" place="email de la structure" />
        <x-input type="file" name="logo" label="Logo Faculatif" :required='false' />
        <x-textarea :required='false' place="Fait une description de l'organisation ou de la structure"
            name="description" label="description de la structure Faculatif" />
    </x-form>
</x-modal>
@endsection