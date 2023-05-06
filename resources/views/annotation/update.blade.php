@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-8 mx-auto">
        <div class="card p-3">
            <x-form route="{{ route('annotation.update',$annotation) }}" type="update" url="{{ route('annotation') }}">
                <x-input type="text" name="nom" :value="$annotation->nom" place="le nom de l'annotation" />
            </x-form>
        </div>
    </div>
</div>
@endsection