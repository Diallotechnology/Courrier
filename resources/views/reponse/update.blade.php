@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-8 mx-auto">
        <div class="card p-3">
            <x-form route="{{ route('reponse.update',$reponse) }}" type="update"
                url="{{ route('interne.show', ['interne' => $reponse->interne]) }}">
                <x-textarea name="message" :value="$reponse->message" place="reponse" />
            </x-form>
        </div>
    </div>
</div>
@endsection