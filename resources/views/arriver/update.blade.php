@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12 mx-auto">
        <div class="card p-3">
            <x-form route="{{ route('arriver.update',$arriver) }}" type="update" url="{{ route('arriver') }}" enctype="multipart/form-data">

                <div class="row">
                    <div class="col-md-3">
                        <x-input type="text" :value="$arriver->reference" name="reference" place="la reference du courrier" label="reference du courrier" />
                    </div>
                    <div class="col-md-3">
                        <x-select name="nature_id" label="Nature de courrier">
                            @foreach ($type as $row)
                            <option @selected($arriver->nature_id == $row->id) value="{{ $row->id }}">{{ $row->nom }}
                            </option>
                            @endforeach
                        </x-select>
                    </div>

                    <div class="col-md-6">
                        <x-select name="correspondant_id" label="Correspondant(Expediteur)">
                            @foreach ($correspondant as $row)
                            <option @selected($arriver->correspondant_id == $row->id) value="{{ $row->id }}">{{
                                $row->nom }}</option>
                            @endforeach
                        </x-select>
                    </div>

                    <div class="col-md-6">
                        <x-select name="priorite" label="Priorité">
                            <option @selected($arriver->Normal()) value="Normal">Normal</option>
                            <option @selected($arriver->Urgent()) value="Urgent">Urgent</option>
                        </x-select>
                    </div>
                    <div class="col-md-6">
                        <x-select name="confidentiel" label="confidentiel">
                            <option @selected($arriver->Privacy()) value="OUI">OUI</option>
                            <option @selected(!$arriver->Privacy()) value="NON">NON</option>
                        </x-select>
                    </div>
                    <div class="col-md-6">
                        <x-input type="file" multiple name="files[]" label="Pièces jointe (PDF,DOC,IMAGE) facultatif" :required='false' />
                    </div>
                    <div class="col-md-3">
                        <x-input type="date" name="date" :value="$arriver->date->format('Y-m-d')" label="Date d'arriver" />
                    </div>
                    @if(Auth::user()->isAdmin() || Auth::user()->isSuperadmin())
                    <div class="col-md-3">
                        <x-select label="Etat" :required='false' name='etat'>
                            @foreach (App\Enum\CourrierEnum::cases() as $row)
                            <option @selected($arriver->etat == $row) value="{{ $row }}">{{ $row }}</option>
                            @endforeach
                        </x-select>
                    </div>
                    @endif
                    <x-textarea :value="$arriver->objet" place="objet du courrier" name="objet" label="Objet/Origine du courrier" />
                    <x-textarea :value="$arriver->observation" place="observation ou commentaire sur le courrier" name="observation" :required='false' label="observation ou commentaire Facultatif" />
                </div>
            </x-form>
        </div>
    </div>
</div>

@endsection
