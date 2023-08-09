@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-8 mx-auto">
        <div class="card p-3">
            <x-form route="{{ route('folder.update',$folder) }}" type="update" url="{{ route('document') }}">
                <x-input type="text" name="nom" :value="$folder->nom" place="le nom du dossier" />
            </x-form>
        </div>
    </div>
</div>
@endsection
