@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-8 mx-auto">
        <div class="card p-3">
            <x-form route="{{ route('correspondant.update',$correspondant) }}" type="update"
                url="{{ route('correspondant') }}">

                <div class="col-md-6">
                    <x-input type="text" :value="$correspondant->prenom" name="prenom"
                        place="le prenom du correspondant" />
                </div>
                <div class="col-md-6">
                    <x-input type="text" :value="$correspondant->nom" name="nom" place="le nom du correspondant" />
                </div>
                <div class="col-md-6">
                    <x-input type="text" :value="$correspondant->fonction" name="fonction"
                        place="la fonction du correspondant" />
                </div>
                <div class="col-md-6">
                    <x-input type="text" :value="$correspondant->contact" name="contact" :required="false"
                        label="contact facultatif" place="le contact du correspondant" />
                </div>
                <x-input type="email" :value="$correspondant->email" name="email" place="l'email du correspondant" />
                @if(Auth::user()->isSuperadmin())
                <x-select name='structure_id' label="structure">
                    @foreach ($structure as $row)
                    <option @selected($row->id == $correspondant->structure_id) value="{{ $row->id }}">{{ $row->nom }}
                    </option>
                    @endforeach
                </x-select>
                @else
                <input type="hidden" value="{{ Auth::user()->structure_id }}" name="structure_id">
                @endif
            </x-form>
        </div>
    </div>
</div>
@endsection