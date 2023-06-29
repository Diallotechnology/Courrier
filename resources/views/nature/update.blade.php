@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-8 mx-auto">
        <div class="card p-3">
            <x-form route="{{ route('nature.update',$nature) }}" type="update" url="{{ route('nature') }}">
                <x-input type="text" name="nom" :value="$nature->nom" place="le nom de la nature" />
            </x-form>
        </div>
    </div>
</div>
@endsection