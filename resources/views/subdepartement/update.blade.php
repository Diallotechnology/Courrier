@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-8 mx-auto">
        <div class="card p-3">
            <x-form route="{{ route('subdepartement.update',$subdepartement) }}" type="update"
                url="{{ route('subdepartement') }}">
                <x-input type="text" name="nom" :value="$subdepartement->nom" place="le nom du departement" />
                <x-input type="text" name="code" :value="$subdepartement->code" place="le code du departement" />
                <x-select name='departement_id' label="departement">
                    @foreach ($departement as $row)
                    <option @selected($subdepartement->departement_id == $row->id) value="{{ $row->id }}">{{ $row->nom
                        }}
                    </option>
                    @endforeach
                </x-select>
            </x-form>
        </div>
    </div>
</div>
@endsection