@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Informations du departementement {{ $departement->nom }}</h3>
    </div>
    <div class="card-body">
        <div class="datagrid">
            <div class="datagrid-item">
                <div class="datagrid-title">Nom du departement</div>
                <div class="datagrid-content">{{ $departement->nom }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Code du departement</div>
                <div class="datagrid-content">{{ $departement->code }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Sous departement lié</div>
                <div class="datagrid-content">
                    @forelse ($departement->subdepartements as $item)
                    <div> {{ $item->nom }}</div>
                    @empty
                    aucun
                    @endforelse
                </div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Utilisateur lié</div>
                <div class="datagrid-content">
                    @forelse ($departement->users as $item)
                    <div>{{ $item->email }}</div>
                    @empty
                    aucun
                    @endforelse
                </div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Date de creation</div>
                <div class="datagrid-content">{{ $departement->created_at }}</div>
            </div>
        </div>
    </div>
</div>
@endsection