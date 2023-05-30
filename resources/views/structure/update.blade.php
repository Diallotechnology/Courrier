@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-8 mx-auto">
        <div class="card p-3">
            <x-form route="{{ route('structure.update',$structure) }}" type="update" url="{{ route('structure') }}">
                <div class="col-md-6">
                    <x-input type="text" name="nom" :value="$structure->nom" place="le nom de la structure" />
                </div>
                <div class="col-md-6">
                    <x-input type="text" name="contact" :value="$structure->contact"
                        place="le contact de la structure" />
                </div>

                <div class="col-md-6">
                    <x-input type="email" name="email" :value="$structure->email" place="email de la structure" />
                </div>
                <div class="col-md-6">
                    <x-input type="file" name="logo" label="Logo Faculatif" :required='false' />
                </div>
                <x-input type="text" name="adresse" :value="$structure->adresse" place="l'adresse de la structure" />
                <x-textarea :required='false' :value="$structure->description"
                    place="Fait une description de l'organisation ou de la structure" name="description"
                    label="description de la structure " />
            </x-form>
        </div>
    </div>
</div>
@endsection