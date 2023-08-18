@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Informations du rapport N° {{ $rapport->numero }}</h3>
    </div>
    <div class="card-body">
        <div class="datagrid">
            <div class="datagrid-item">
                <div class="datagrid-title">Utilisateur Initiateur</div>
                <div class="datagrid-content">
                    <x-user-avatar :row="$rapport" />
                </div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">reference du rapport</div>
                <div class="datagrid-content">{{ $rapport->numero }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Type de rapport</div>
                <div class="datagrid-content">{{ $rapport->type }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Objet du rapport</div>
                <div class="datagrid-content">{{ $rapport->objet }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Date de creation</div>
                <div class="datagrid-content">{{ $rapport->created_at }}</div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-2">
    @if ($rapport->folder)
          @foreach ($rapport->folder->documents as $row)
            <div class="col-md-3">
                <x-card-document :row="$row" />
            </div>
        @endforeach
    @endif
</div>

@empty(!$rapport->contenu)
<div class="card card-lg">
    <h2 class="text-center my-2">Contenu du rapport</h2>
    <div class="card-body markdown">
        {!! $rapport->contenu !!}
    </div>
</div>
@endempty
@endsection
