@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-8 mx-auto">
        <div class="card p-3">
            <x-form route="{{ route('licence.update',$licence) }}" type="update" url="{{ route('licence') }}">
                <x-select name="structure_id" label="liste des structures">
                    @foreach ($structure as $row)
                    <option @selected($licence->structure_id == $row->id) value="{{ $row->id }}">{{ $row->nom }}
                    </option>
                    @endforeach
                </x-select>
                <div class="col-md-6">
                    <x-select name="version" label="type de licence">
                        @foreach (App\Enum\LicenceEnum::cases() as $row)
                        <option @selected($licence->version == $row) value="{{ $row }}">{{ $row }}</option>
                        @endforeach
                    </x-select>
                </div>
                <div class="col-md-6">
                    <x-select name="temps" label="temps">
                        <option @selected($licence->temps == 15) value="6">15 jours</option>
                        <option @selected($licence->temps == 6) value="6">6 mois</option>
                        <option @selected($licence->temps == 12) value="12">1 an</option>
                    </x-select>
                </div>
            </x-form>
        </div>
    </div>
</div>
@endsection