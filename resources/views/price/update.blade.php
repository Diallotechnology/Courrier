@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-8 mx-auto">
        <div class="card p-3">
            <x-form route="{{ route('price.update',$price) }}" type="update" url="{{ route('price') }}">
                <div class="col-md-12">
                    <x-select name="type" label="type de structure">
                        @foreach (App\Enum\StructureTypeEnum::cases() as $row)
                        <option @selected($price->type === $row) value="{{ $row }}">{{ $row }}</option>
                        @endforeach
                    </x-select>
                </div>
                <div class="col-md-12">
                    <x-select name="temps" label="temps">
                        <option @selected($price->temps == 3) value="3">3 jours</option>
                        <option @selected($price->temps == 6) value="6">6 mois</option>
                        <option @selected($price->temps == 12) value="12">1 an</option>
                    </x-select>
                </div>
                <div class="col-md-12">
                    <x-input type="number" value="{{ $price->montant }}" name="montant" place="le  montant" />
                </div>
            </x-form>
        </div>
    </div>
</div>
@endsection
