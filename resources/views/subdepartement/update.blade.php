@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-8 mx-auto">
        <div class="card p-3">
            <x-form route="{{ route('departement.update',$departement) }}" type="update"
                url="{{ route('departement') }}">
                <x-input type="text" name="nom" :value="$departement->nom" place="le nom du departement" />
                <x-input type="text" name="code" :value="$departement->code" place="le code du departement" />
                @if(Auth::user()->isSuperadmin())
                <x-select name='structure_id' label="structure">
                    @foreach ($structure as $row)
                    <option @selected($departement->structure_id == $row->id) value="{{ $row->id }}">{{ $row->nom }}
                    </option>
                    @endforeach
                </x-select>
                @else
                <input type="hidden" value="{{ Auth::user()->departement->structure_id }}" name="structure_id">
                @endif
            </x-form>
        </div>
    </div>
</div>
@endsection